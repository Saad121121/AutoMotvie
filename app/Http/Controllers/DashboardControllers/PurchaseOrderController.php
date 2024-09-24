<?php

namespace App\Http\Controllers\DashboardControllers;

use App\Http\Controllers\Controller;
use App\Models\Part;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $showroomId = Auth::user()->showroom_id;
        $parts = Part::all();
        $purchaseOrders = PurchaseOrder::with('items')->where('showroom_id', $showroomId)->get();
        return view('dashboard.purchaseOrder.index', compact('parts', 'purchaseOrders'));
    }

    /**
     * Store a newly detail resource in storage.
     */
    public function detail(Request $request, string $id)
    {
        // Check if the ID is correctly passed

        // Find the purchase order by ID or fail
        $purchaseOrder = PurchaseOrder::with('items')->findOrFail($id);
        // dd($purchaseOrder->toArray());

        // Return the view with the purchase order details
        return view('dashboard.purchaseOrder.detail', compact('purchaseOrder'));
    }
    public function updateStatus(Request $request, string $id)
    {
        $purchaseOrder = PurchaseOrder::findOrFail($id);
        $purchaseOrder->status = $request->input('status');
        $purchaseOrder->save();

        return redirect()->route('purchase-orders.detail', $id)->with('success', 'Purchase Order status updated successfully.');
    }

    public function addReceivedQuantity(Request $request, string $id)
    {
        $purchaseOrder = PurchaseOrder::findOrFail($id);
        $receivedQuantity = $request->input('received_quantity');
        $purchaseOrder->received_quantity += $receivedQuantity;
        $purchaseOrder->save();

        return redirect()->route('purchase-orders.detail', $id)->with('success', 'Received quantity updated successfully.');
    }

    // public function store(Request $request)
    // {
    //     // Validate the incoming request
    //     $request->validate([
    //         'po' => 'required|string|unique:purchase_orders,po',
    //         'order_date' => 'required|date',
    //         'parts' => 'required|array',
    //         'parts.*' => 'required|exists:parts,id',
    //         'quantities' => 'required|array',
    //         'quantities.*' => 'required|integer|min:1',
    //         'total_amount' => 'required|numeric'
    //     ]);
    //     // Begin a transaction
    //     DB::beginTransaction();

    //     try {
    //         // Create the purchase order
    //         $purchaseOrder = PurchaseOrder::create([
    //             'po' => $request->po,
    //             'showroom_id' => Auth::user()->showroom_id,
    //             'order_date' => $request->order_date,
    //             'status' => 'Pending', // Or any other default status
    //             'total_amount' => $request->total_amount
    //         ]);

    //         // Create the purchase order items
    //         $parts = $request->parts;
    //         $quantities = $request->quantities;

    //         foreach ($parts as $index => $partId) {
    //             PurchaseOrderItem::create([
    //                 'purchase_order_id' => $purchaseOrder->id,
    //                 'part_id' => $partId,
    //                 'quantity' => $quantities[$index]
    //             ]);
    //         }

    //         // Commit the transaction
    //         DB::commit();
    //         // dd('car33qqqe', $parts, $quantities);

    //         return redirect()->route('purchase_orders.index')->with('success', 'Purchase Order created successfully.');
    //     } catch (\Exception $e) {
    //         // Rollback the transaction on error
    //         DB::rollback();
    //         return redirect()->back()->with('error', 'An error occurred while creating the Purchase Order.');
    //     }
    // }
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'po' => 'required|string|unique:purchase_orders,po',
            'order_date' => 'required|date',
            'parts' => 'required|array',
            'parts.*' => 'required|exists:parts,id',
            'quantities' => 'required|array',
            'quantities.*' => 'required|integer|min:1',
            'total_amount' => 'required|numeric'
        ]);

        // Begin a transaction
        DB::beginTransaction();

        try {
            // Create the purchase order
            $purchaseOrder = PurchaseOrder::create([
                'po' => $request->po,
                'showroom_id' => Auth::user()->showroom_id,
                'order_date' => $request->order_date,
                'status' => 'Pending', // Or any other default status
                'total_amount' => $request->total_amount
            ]);

            // Create the purchase order items
            $parts = $request->parts;
            $quantities = $request->quantities;

            foreach ($parts as $index => $partId) {
                PurchaseOrderItem::create([
                    'purchase_order_id' => $purchaseOrder->id,
                    'part_id' => $partId,
                    'quantity' => $quantities[$index]
                ]);
            }

            // Commit the transaction
            DB::commit();

            return redirect()->route('purchase-orders.index')->with('success', 'Purchase Order created successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction on error
            DB::rollback();
            return redirect()->back()->with('error', 'An error occurred while creating the Purchase Order.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function generatePartNumber()
    {
        // Generate a unique part number using UUID or a similar method
        $partNumber = 'PO-' . strtoupper(Str::random(8));

        // Ensure that the generated part number is unique in the database
        while (PurchaseOrder::where('po', $partNumber)->exists()) {
            $partNumber = 'PO-' . strtoupper(Str::random(8));
        }

        return response()->json(['part_number' => $partNumber]);
    }
}
