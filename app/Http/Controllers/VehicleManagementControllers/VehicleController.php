<?php

namespace App\Http\Controllers\VehicleManagementControllers;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use App\Models\Showroom;
use App\Models\Staff;
use App\Models\User;
use App\Models\UserActivityLog;
use App\Models\Vehicle;
use App\Models\VehicleImages;
use App\Models\VehicleMake;
use App\Models\VehicleModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{

    public function index(Request $request)
    {
        // Retrieve all the possible filter values from the request
        $makeId = $request->input('make_filter_id');
        $modelId = $request->input('model_filter_id');
        $ownerId = $request->input('owner_id');
        $showroomId = $request->input('showroom_id');

        // Get all the required data for dropdowns
        $makes = VehicleMake::orderBy('id', 'desc')->get();
        $showrooms = Showroom::orderBy('id', 'desc')->get();

        if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2 || Auth::user()->role_id == 3) {
            $showroomId = Auth::user()->showroom_id;
            $owners = User::where('role_id', 4)
                ->where('showroom_id', $showroomId)
                ->whereNotNull('showroom_id')
                ->orderBy('id', 'desc')
                ->get();
            $vehiclesQuery = Vehicle::with('make', 'images', 'model', 'owner', 'showroom')->where('showroom_id', $showroomId)->orderBy('id', 'desc');
        } elseif (Auth::user()->role_id == 4) {
            $owners = [];
            $vehiclesQuery = Vehicle::with('make', 'images', 'model', 'owner', 'showroom')->where('owner_id', Auth::user()->id)->orderBy('id', 'desc');
        } else if (Auth::user()->role_id == 5) {
            $vehiclesQuery = Vehicle::with('make', 'images', 'model', 'owner', 'showroom')->orderBy('id', 'desc');
            $owners = User::where('role_id', 4)->orderBy('id', 'desc')->get();
        }
        // Apply filters if provided
        if ($makeId) {
            $vehiclesQuery->where('make_id', $makeId);
        }

        if ($modelId) {
            $vehiclesQuery->where('model_id', $modelId);
        }

        if ($ownerId) {
            $vehiclesQuery->where('owner_id', $ownerId);
        }

        if ($showroomId) {
            $vehiclesQuery->where('showroom_id', $showroomId);
        }

        // Execute the query and get the filtered results
        $vehicles = $vehiclesQuery->get();
        // dd($vehicles->toArray());

        // Return the view with the filtered results and dropdown data
        return view('dashboard.vehicleManagement.vehiclesinfo.index', compact('vehicles', 'makes', 'showrooms', 'owners'));
    }



    public function store(Request $request)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'vin' => 'required|string|max:255|unique:vehicles,vin',
                'make_id' => 'required|exists:vehicle_makes,id',
                'model_id' => 'required|exists:vehicle_models,id',
                'year_of_manufacture' => 'required|integer|between:1900,2099',
                'color' => 'required|string|max:50',
                'engine_type' => 'required|string|max:50',
                'mileage' => 'required|numeric|min:0',
                'registration_number' => 'required|string|max:255|unique:vehicles,registration_number',
                'owner_id' => 'required|exists:users,id',
                'showroom_id' => 'nullable|exists:showrooms,id',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120', // Validate images
            ]);
            // dd($request->all());

            // Create a new vehicle record
            if (isset(Auth::user()->showroom_id)) {
                $validatedData['showroom_id'] = Auth::user()->showroom_id;
            }

            if ($request->hasFile('images')) {
                $request->validate([
                    'images' => 'array|max:4', // Validate array and limit to 4 images
                    'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120', // Individual file validation
                ]);
                $vehicle = Vehicle::create($validatedData);

                foreach ($request->file('images') as $file) {
                    $path = $file->store('images/vehicle_images', 'public');
                    VehicleImages::create([
                        'vehicle_id' => $vehicle->id,
                        'image_path' => $path,
                    ]);
                }
            }
            //activitylog
            $log = new UserActivityLog();
            $log->user_id = Auth::user()->id;
            $log->action = 'Created vehicle: ' . $request->vin . ' Registration Number : ' . $request->registration_number;
            $log->showroom_id = Auth::user()->showroom_id;
            $log->created_at = now();
            $log->save();

            // Redirect or return response
            return redirect()->route('vehicle.index')->with('success', 'Vehicle added successfully.');
        } catch (Exception $e) {
            // Log the error
            // Log::error('Vehicle store failed: ' . $e->getMessage());
            // Redirect with error message
            return redirect()->back()->with('error', 'Failed to add vehicle. Please try again.'  . $e->getMessage());
        }
    }



    
    public function update(Request $request)
    {
        // dd($request->all(), $request->file('imagess'));
        // dd($request->file('imagess'));

        $validatedData = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'vin' => 'required|string|max:255|unique:vehicles,vin,' . $request->vehicle_id,
            'make_id' => 'required|exists:vehicle_makes,id',
            'model_id' => 'required|exists:vehicle_models,id',
            'year_of_manufacture' => 'required|integer|between:1900,2099',
            'color' => 'required|string|max:50',
            'engine_type' => 'required|string|max:50',
            'mileage' => 'required|numeric|min:0',
            'registration_number' => 'required|string|max:255|unique:vehicles,registration_number,' . $request->vehicle_id,
            'owner_id' => 'required|exists:users,id',
            'showroom_id' => 'nullable|exists:showrooms,id',
            'imagess.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // Validate each file as an image, allow null
            'imagess' => 'nullable|array|max:4', // Validate as an array, max 4 images
        ]);

        try {
            $vehicle = Vehicle::findOrFail($request->vehicle_id);

            if (Auth::user()->role_id == 2 && isset(Auth::user()->showroom_id)) {
                $validatedData['showroom_id'] = Auth::user()->showroom_id;
            }

            // Handle image uploads
            if ($request->hasFile('imagess')) {
                $existingImages = $vehicle->images;

                // Delete existing images from storage
                if ($existingImages) {
                    foreach ($existingImages as $image) {
                        $imagePath = $image->image_path;
                        if (Storage::disk('public')->exists($imagePath)) {
                            Storage::disk('public')->delete($imagePath);
                        }
                    }

                    // Delete existing images from the database
                    $vehicle->images()->delete();
                }

                // Save new images
                foreach ($request->file('imagess') as $file) {
                    $path = $file->store('images/vehicle_images', 'public');
                    VehicleImages::create([
                        'vehicle_id' => $vehicle->id,
                        'image_path' => $path,
                    ]);
                }
            }

            // Update vehicle with validated data
            $vehicle->update($validatedData);

            // Log activity
            $log = new UserActivityLog();
            $log->user_id = Auth::user()->id;
            $log->action = 'Update vehicle: ' . $request->vin . ' Registration Number : ' . $request->registration_number;
            $log->showroom_id = Auth::user()->showroom_id;
            $log->created_at = now();
            $log->save();

            return redirect()->route('vehicle.index')->with('success', 'Vehicle updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to update vehicle. Please try again.' . $e->getMessage());
        }
    }




    public function destroy($id)
    {
        // dd($id);
        try {
            $owner = Vehicle::findOrFail($id);
            if ($owner) {
                //activitylog
                $log = new UserActivityLog();
                $log->user_id = Auth::user()->id;
                $log->action = 'Deleted vehicle: ' . $owner->vin . ' Registration Number : ' . $owner->registration_number;
                $log->showroom_id = Auth::user()->showroom_id;
                $log->created_at = now();
                $log->save();
                $owner->delete();
                return response()->json(['success' => 'Vehicle deleted successfully.']);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to delete Vehicle.'], 500);
        }
    }
    public function getModelsByMake($makeId)
    {
        // Fetch models based on makeId
        $models = VehicleModel::where('make_id', $makeId)->get(['id', 'name']);

        // Return as JSON object with models property
        return response()->json(['models' => $models]);
    }
    // VehicleController.php
    public function getImages($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $images = $vehicle->images; // Assuming the relationship is set up

        return response()->json([
            'images' => $images
        ]);
    }
}
