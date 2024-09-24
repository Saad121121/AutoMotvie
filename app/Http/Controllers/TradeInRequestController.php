<?php

namespace App\Http\Controllers;

use App\Models\Showroom;
use App\Models\TradeInRequest;
use Illuminate\Http\Request;

class TradeInRequestController extends Controller
{
    public function index()
    {
        $tradeInRequests = TradeInRequest::all();

        return view('dashboard.tradeIn.index', compact('tradeInRequests'));
    }
    public function create()
    {
        $showrooms = Showroom::where('id', '!=', '1')->get();
        return view('dashboard.tradeIn.create', compact('showrooms'));
    }
    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'full_name' => 'required|string|max:255',
            'email_address' => 'required|email|max:255',
            'phone_number' => 'required|string|max:15',
            'street_address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip_code' => 'required|string|max:10',
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|between:2000,2024',
            'mileage' => 'required|numeric',
            'vin' => 'required|string|max:17',
            'condition' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'current_market_value' => 'nullable|numeric',
            'car_photos.*' => 'nullable|image|max:5120', // 5MB max per photo
            'additional_comments' => 'nullable|string',
            'preferred_contact_method' => 'required|string|max:255',
            'trade_in_timing' => 'required|date',
            'preferred_dealership_location' => 'required|string|max:255',
        ]);
        try {
            $tradeInRequest = new TradeInRequest();
            $tradeInRequest->fill($request->except('car_photos'));

            // Handle car photos
            if ($request->hasFile('car_photos')) {
                $photos = [];
                foreach ($request->file('car_photos') as $file) {
                    $path = $file->store('tradeInpics', 'public');
                    // dd($path); // Debug the path
                    $photos[] = $path;
                }
                $tradeInRequest->car_photos = json_encode($photos);
            }

            $tradeInRequest->save();

            return redirect()->route('tradein.index')->with('success', 'Thank you for your submission! We will review your information and contact you with an offer soon.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'There was an error processing your request. Please try again.');
        }
    }
    public function show($id)
    {
        $tradeInRequest = TradeInRequest::findOrFail($id);
        return view('dashboard.tradeIn.detail', compact('tradeInRequest'));
    }
}
