<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promotion;
use Illuminate\Support\Facades\Storage;

class PromotionController extends Controller
{
    public function index()
    {
        $promotions = Promotion::all();
        return view('dashboard.promotion.index', compact('promotions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'details' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $promotion = new Promotion();
        $promotion->name = $request->input('name');
        $promotion->details = $request->input('details');
        $promotion->start_date = $request->input('start_date');
        $promotion->end_date = $request->input('end_date');


        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/promotionsImages');
            $promotion->image = basename($imagePath);
        }

        $promotion->save();
        return redirect()->route('promotions.index')->with('success', 'Promotion added successfully.');
    }

    public function show(Promotion $promotion)
    {
        return view('promotions.show', compact('promotion'));
    }

    public function edit(Promotion $promotion)
    {
        return view('dashboard.promotion.edit', compact('promotion'));
    }

    public function update(Request $request, Promotion $promotion)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'details' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $promotion->name = $request->input('name');
        $promotion->details = $request->input('details');
        $promotion->start_date = $request->input('start_date');
        $promotion->end_date = $request->input('end_date');

        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($promotion->image) {
                Storage::delete('public/promotionsImages/' . $promotion->image);
            }

            $imagePath = $request->file('image')->store('public/promotionsImages');
            $promotion->image = basename($imagePath);
        }

        $promotion->save();
        return redirect()->route('promotions.index')->with('success', 'Promotion updated successfully.');
    }

    public function destroy(Promotion $promotion)
    {
        $promotion->delete();
        return redirect()->route('promotions.index')->with('success', 'Promotion deleted successfully.');
    }
}
