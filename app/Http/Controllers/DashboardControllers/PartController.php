<?php

namespace App\Http\Controllers\DashboardControllers;

use App\Http\Controllers\Controller;
use App\Models\Part;
use App\Models\PartTransaction;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PartController extends Controller
{
    public function index()
    {
        $parts = Part::all();
        $suppliers = Supplier::all();
        return view('dashboard.part.index', compact('parts', 'suppliers'));
    }

    public function create()
    {
        return view('parts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'part_number' => 'required|unique:parts',
            'part_name' => 'required',
            'category' => 'required',
            'location' => 'required',
            'supplier_id' => 'required|exists:suppliers,id',
            'stock_level' => 'required|integer',
            'reorder_point' => 'required|integer',
        ]);

        $part = Part::create($request->all());
        // Create a new part transaction
        PartTransaction::create([
            'part_id' => $part->id,
            'transaction_type' => 'Initial Stock',
            'quantity' => $part->stock_level,
            'transaction_date' => now(),
            'showroom_id' => Auth::user()->showroom_id, // Assuming the showroom_id is associated with the logged-in user
            'notes' => 'Initial stock added when creating part.'
        ]);

        return redirect()->route('parts.index')->with('success', 'Part created successfully.');
    }

    public function show(Part $part)
    {
        return view('parts.show', compact('part'));
    }

    public function edit(Part $part)
    {
        $suppliers = Supplier::all();
        return view('dashboard.part.edit', compact('part', 'suppliers'));
    }

    public function update(Request $request, Part $part)
    {
        $request->validate([
            'part_number' => 'required|unique:parts,part_number,' . $part->id,
            'part_name' => 'required',
            'category' => 'required',
            'location' => 'required',
            'supplier_id' => 'required|exists:suppliers,id',
            'stock_level' => 'required|integer',
            'reorder_point' => 'required|integer',
        ]);
        if ($request->stock_level != $part->stock_level) {
            $quantityChange = $request->stock_level - $part->stock_level;
            $transactionType = $quantityChange > 0 ? 'Stock Increase' : 'Stock Decrease';

            // Create a new part transaction
            PartTransaction::create([
                'part_id' => $part->id,
                'transaction_type' => $transactionType,
                'quantity' => abs($quantityChange),
                'transaction_date' => now(),
                'showroom_id' => Auth::user()->showroom_id, // Assuming the showroom_id is associated with the logged-in user
                'notes' => 'Stock level updated during part update.'
            ]);
        }

        $part->update($request->all());

        return redirect()->route('parts.index')->with('success', 'Part updated successfully.');
    }

    public function destroy(Part $part)
    {
        $part->delete();
        return redirect()->route('parts.index')->with('success', 'Part deleted successfully.');
    }
    public function generatePartNumber()
    {
        // Generate a unique part number using UUID or a similar method
        $partNumber = 'PART-' . strtoupper(Str::random(8));

        // Ensure that the generated part number is unique in the database
        while (Part::where('part_number', $partNumber)->exists()) {
            $partNumber = 'PART-' . strtoupper(Str::random(8));
        }

        return response()->json(['part_number' => $partNumber]);
    }
}
