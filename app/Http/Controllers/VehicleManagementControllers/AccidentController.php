<?php

namespace App\Http\Controllers\VehicleManagementControllers;

use App\Http\Controllers\Controller;
use App\Models\Accident;
use App\Models\AccidentImage;
use App\Models\Showroom;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AccidentController extends Controller
{
    public function index()
    {
        $accidents = [];
        return view('dashboard.showroomManagement.accident.index', compact('accidents'));
    }
    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'vehicle_vin' => 'required|string|max:255',
            'description' => 'required|string',
            'accident_date' => 'required|date',
            'accident_images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:5120', // Image validation
        ]);

        $vehicle = Vehicle::where('vin', $validatedData['vehicle_vin'])->first();
        if (!$vehicle) {
            return redirect()->back()->withErrors(['Vehicle not found!']);
        }
        // Create a new accident record
        $accident = new Accident();

        $accident->vehicle_id = $vehicle->id;
        $accident->description = $request->description;
        $accident->accident_date = $request->accident_date;
        $accident->save();

        // Handle image uploads
        if ($request->hasFile('accident_images')) {
            $request->validate([
                'accident_images' => 'array|max:4', // Validate array and limit to 4 accident_images
                'accident_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120', // Individual file validation
            ]);

            foreach ($request->file('accident_images') as $image) {
                // Store image and get the path
                $imagePath = $image->store('images/accident_images', 'public');

                // Create an AccidentImage record
                AccidentImage::create([
                    'accident_id' => $accident->id,
                    'vehicle_id' =>  $vehicle->id,
                    'image_path' => $imagePath,
                ]);
            }
        }

        // Redirect back with a success message
        return redirect()->route('accidents.index')->with('success', 'Accident reported successfully.');
    }
    public function update(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'vehicle_id' => 'required|string|max:255',
            'description' => 'required|string',
            'accident_date' => 'required|date',
            'accident_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // Image validation
        ]);

        // Find the existing accident record
        $accident = Accident::findOrFail($id);

        $vehicle = Vehicle::where('vin', $validatedData['vehicle_id'])->first();
        if (!$vehicle) {
            return redirect()->back()->withErrors(['Vehicle not found!']);
        }

        // Update accident details
        $accident->vehicle_id = $vehicle->id;
        $accident->description = $request->description;
        $accident->accident_date = $request->accident_date;
        $accident->save();

        // Handle image updates
        if ($request->hasFile('accident_images')) {
            $request->validate([
                'accident_images' => 'array|max:4', // Validate array and limit to 4 accident_images
                'accident_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120', // Individual file validation
            ]);

            // Delete old images
            $oldImages = AccidentImage::where('accident_id', $accident->id)->get();
            foreach ($oldImages as $oldImage) {
                Storage::disk('public')->delete($oldImage->image_path); // Delete from storage
                $oldImage->delete(); // Delete the record from the database
            }

            // Store new images
            foreach ($request->file('accident_images') as $image) {
                $imagePath = $image->store('images/accident_images', 'public');

                // Create a new AccidentImage record
                AccidentImage::create([
                    'accident_id' => $accident->id,
                    'vehicle_id' => $vehicle->id,
                    'image_path' => $imagePath,
                ]);
            }
        }

        // Redirect back with a success message
        return redirect()->route('accidents.index')->with('success', 'Accident updated successfully.');
    }


    public function searchVin(Request $request)
    {
        $showrooms = [];
        if (Auth::user()->role_id == 5) {
            $showrooms = Showroom::orderBy('id', 'desc')->get();
        }

        $request->validate([
            'vin' => 'required|string',
        ]);

        $vin = $request->input('vin');

        $vehicle = Vehicle::with('showroom')->where('vin', $vin)->first();

        if ($vehicle) {
            $accidents = Accident::with('vehicle', 'vehicle.showroom', 'vehicle.owner', 'images')
                ->where('vehicle_id', $vehicle->id)
                ->orderBy('id', 'desc')
                ->get();

            if ($accidents->isEmpty()) {
                return view('dashboard.showroomManagement.accident.index', [
                    'vehicle' => $vehicle,
                    'accidents' => $accidents,
                    'showrooms' => $showrooms,
                    'message' => 'No Accident details found for this vehicle.'
                ]);
            }

            return view('dashboard.showroomManagement.accident.index', compact('vehicle', 'accidents', 'showrooms'));
        } else {
            return redirect()->back()->with('error', 'Vehicle not found.');
        }
    }
    public function getImages($id)
    {
        $accident = Accident::findOrFail($id);
        $images = $accident->images;

        return response()->json([
            'images' => $images
        ]);
    }
    public function edit($id)
    {
        $accident = Accident::with('vehicle', 'images')->findOrFail($id);

        return response()->json([
            'accident' => $accident,
        ]);
    }
}
