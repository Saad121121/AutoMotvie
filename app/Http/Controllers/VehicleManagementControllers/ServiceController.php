<?php

namespace App\Http\Controllers\VehicleManagementControllers;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceItems;
use App\Models\Showroom;
use App\Models\Vehicle;
use Brick\Math\BigInteger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function index()
    {
        $services = [];
        $showrooms = [];
        return view('dashboard.showroomManagement.service.index', compact('services', 'showrooms'));
    }
    public function create($vehicle_id)
    {
        $vehicle = Vehicle::with('showroom')->findOrFail($vehicle_id);
        if (Auth::user()->role_id == 5) {
            $showrooms = Showroom::orderBy('id', 'desc')->get();
        } else {
            $showrooms = Showroom::where('showroom_id', Auth::user()->showroom_id)->orderBy('id', 'desc')->get();
        }
        return view('dashboard.showroomManagement.service.create', compact('vehicle', 'showrooms'));
    }
    public function store(Request $request)
    {
        // dd($request->toArray());
        // Validate the incoming request data
        $validatedData = $request->validate([
            'vehicle_vin' => 'required|string|max:255',
            'showroom_id' => 'nullable|exists:showrooms,id',
            'service_date' => 'required|date',
            'kilometers_driven' => 'required|integer',
            'service_type' => 'required|in:Routine maintenance,Repair,Specific request',
            'status' => 'required|in:Pending,Completed,Upcoming',
            'additional_requests' => 'nullable|string',
            'estimated_completion_time' => 'nullable',
            'cost_estimate' => 'nullable|numeric',
            'items_serviced' => 'nullable|array|min:1',
            'items_serviced.*' => 'nullable|string|max:255',
            'remarks' => 'nullable|string',
        ]);

        // dd('After Validate', $validatedData);
        // Find the vehicle and showroom based on VIN and showroom name
        $vehicle = Vehicle::where('vin', $validatedData['vehicle_vin'])->first();


        if (!$vehicle) {
            return redirect()->back()->withErrors(['Vehicle or Showroom not found!']);
        }



        // dd($vehicle->id, $showroom->id);
        // Store the service data
        $service = Service::create([
            'vehicle_id' => $vehicle->id,
            'showroom_id' => $validatedData['showroom_id'],
            'service_date' => $validatedData['service_date'],
            'kilometers_driven' => $validatedData['kilometers_driven'],
            'service_type' => $validatedData['service_type'],
            'status' => $validatedData['status'],
            'additional_requests' => $validatedData['additional_requests'],
            'estimated_completion_time' => $validatedData['estimated_completion_time'],
            'cost_estimate' => $validatedData['cost_estimate'],
            'remarks' => $validatedData['remarks'],
        ]);

        if (!empty($validatedData['items_serviced'])) {
            foreach ($validatedData['items_serviced'] as $item) {
                // Check if the item is not empty before inserting
                if (!empty($item)) {
                    ServiceItems::create([
                        'service_id' => $service->id,
                        'item' => $item,
                    ]);
                }
            }
        }

        // Redirect back with success message
        return redirect()->route('services.index')->with('success', 'Service created successfully!');
    }
    public function edit($id)
    {
        $service = Service::with('vehicle', 'showroom', 'serviceItems')->findOrFail($id);
        if (Auth::user()->role_id == 5) {
            $showrooms = Showroom::all(); // Assuming you want to populate the showroom dropdown
        } else {
            $showrooms = [];
        }

        return response()->json([
            'service' => $service,
            'showrooms' => $showrooms
        ]);
    }
    public function update(Request $request)
    {
        // dd($request->all());
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
            $services = Service::with('vehicle', 'showroom', 'serviceItems')
                ->where('vehicle_id', $vehicle->id)
                ->orderBy('id', 'desc')
                ->get();

            if ($services->isEmpty()) {
                return view('dashboard.showroomManagement.service.index', [
                    'vehicle' => $vehicle,
                    'services' => $services,
                    'showrooms' => $showrooms,
                    'message' => 'No services found for this vehicle.',
                    'create' => 'yes'
                ]);
            }
            $create = 'yes';


            return view('dashboard.showroomManagement.service.index', compact('vehicle', 'services', 'showrooms', 'create'));
        } else {
            return redirect()->back()->with('error', 'Vehicle not found.');
        }
    }

    public function indexForScheduleCustomer()
    {
        $userId = Auth::user()->id;
        // Get all vehicle IDs owned by the user
        $vehicleIds = Vehicle::where('owner_id', $userId)->pluck('id');
        // Get services for those vehicles
        $services = Service::with('serviceItems')->whereIn('vehicle_id', $vehicleIds)->get();
        $vehicles = Vehicle::where('owner_id', $userId)
            ->get(['id', 'vin']);
        $showrooms = Showroom::all();
        // dd($services->toArray());
        return view('dashboard.customer.scheduleService', compact('services', 'showrooms', 'vehicles'));
    }
    public function storeScheduleService(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'showroom_id' => 'required|exists:showrooms,id',
            'service_date' => 'required|date|after:today',
            'kilometers_driven' => 'required|numeric|min:0',
            'service_type' => 'required|in:Routine maintenance,Repair,Specific request',
            'additional_requests' => 'nullable|string|max:1000',
            'items_serviced' => 'required|array|min:1',
            'items_serviced.*' => 'string|max:255',
        ]);

        // Ensure the vehicle belongs to the authenticated user
        $vehicle = Vehicle::where('id', $validatedData['vehicle_id'])
            ->where('owner_id', Auth::user()->id)
            ->first();

        if (!$vehicle) {
            return redirect()->back()->with('error', 'Vehicle not found or does not belong to you!');
        }

        // dd($validatedData);
        // Ensure the showroom exists (optional: you might want additional checks)
        $showroom = Showroom::find($validatedData['showroom_id']);
        if (!$showroom) {
            return redirect()->back()->with('error', 'Showroom not found!');
        }
        // Create the Service record
        $service = Service::create([
            'vehicle_id' => $validatedData['vehicle_id'],
            'showroom_id' => $validatedData['showroom_id'],
            'service_date' => $validatedData['service_date'],
            'kilometers_driven' => $validatedData['kilometers_driven'],
            'service_type' => $validatedData['service_type'],
            'status' => 'Upcoming',  // Set default status for scheduled services
            'additional_requests' => $validatedData['additional_requests'] ?? null,
            'estimated_completion_time' => null,
            'cost_estimate' => null,
            'remarks' => null,
        ]);

        // Create ServiceItems records
        foreach ($validatedData['items_serviced'] as $item) {
            ServiceItems::create([
                'service_id' => $service->id,
                'item' => $item,
            ]);
        }

        // Redirect to the services index with a success message
        return redirect()->back()->with('success', 'Service scheduled successfully!');
    }
}
