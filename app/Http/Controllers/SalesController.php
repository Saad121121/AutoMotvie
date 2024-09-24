<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = Sales::all();
        return view('dashboard.sales.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.sales.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'invoice_number' => 'required|string|max:255',
            'customer_id' => 'required|string|max:255',
            'full_name' => 'required|string|max:255',
            'contact_info' => 'required|string|max:255',
            'driver_license' => 'required|string|max:255',
            'customer_type' => 'required|string|max:255',
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|digits:4',
            'vin' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'mileage' => 'required|string|max:255',
            'condition' => 'required|string|max:255',
            'additional_features' => 'nullable|string',
            'sales_date' => 'required|date',
            'sales_person_name' => 'required|string|max:255',
            'payment_method' => 'required|string|max:255',
            'financing_details' => 'nullable|string',
            'trade_in_details' => 'nullable|string',
            'discounts_offers' => 'nullable|string',
            'total_price' => 'required|numeric',
            'warranty_type' => 'required|string|max:255',
            'warranty_duration' => 'nullable|string',
            'service_plan' => 'nullable|string',
            'scheduled_delivery_date' => 'nullable|date',
            'documents_required' => 'nullable|string',
            'signed_contract' => 'required|string|max:3',
            'regulatory_compliance' => 'nullable|string',
            'delivery_method' => 'required|string|max:255',
            'delivery_address' => 'nullable|string',
            'delivery_status' => 'required|string|max:255',
            'special_instructions' => 'nullable|string',
            'comments' => 'nullable|string',
        ]);

        // Create a new sale record
        $sale = Sales::create($validatedData);

        // Redirect or return a response
        return redirect()->route('sales.index')->with('success', 'Sale created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $sale = Sales::findOrFail($id);
        return view('dashboard.sales.detail', compact('sale'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sales $sales)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sales $sales)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sales $sales)
    {
        //
    }
    public function generateInvoiceNumber()
    {
        // Generate a unique part number using UUID or a similar method
        $partNumber = 'IN-' . strtoupper(Str::random(8));

        // Ensure that the generated part number is unique in the database
        while (Sales::where('invoice_number', $partNumber)->exists()) {
            $partNumber = 'IN-' . strtoupper(Str::random(8));
        }

        return response()->json(['invoice_number' => $partNumber]);
    }
    public function generateCustomerNumber()
    {
        // Generate a unique part number using UUID or a similar method
        $partNumber = 'CUST-' . strtoupper(Str::random(8));

        // Ensure that the generated part number is unique in the database
        while (Sales::where('customer_id', $partNumber)->exists()) {
            $partNumber = 'CUST-' . strtoupper(Str::random(8));
        }

        return response()->json(['customer_id' => $partNumber]);
    }
    public function generatePdf($id)
    {
        $sale = Sales::findOrFail($id);

        $pdf = Pdf::loadView('dashboard.sales.report', compact('sale'));
        return $pdf->download('sale_invoice_' . $id . '.pdf');
    }
}
