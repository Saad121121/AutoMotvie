<?php

namespace App\Http\Controllers;

use App\Models\Accessory;
use App\Models\Showroom;
use Illuminate\Http\Request;

class AccessoriesController extends Controller
{
    public function index(Request $request)
    {
        // Get showrooms for the filter dropdown
        $showrooms = Showroom::where('id', '!=', '1')->get();

        // Filter accessories based on showroom_id if provided
        $accessories = Accessory::when($request->showroom_id, function ($query) use ($request) {
            return $query->where('showroom_id', $request->showroom_id);
        })->get();

        return view('dashboard.accessory.index', compact('accessories', 'showrooms'));
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
    public function store(Request $request) {}

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // $sale = Accessory::findOrFail($id);
        // return view('dashboard.sales.detail', compact('sale'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        //
    }
}
