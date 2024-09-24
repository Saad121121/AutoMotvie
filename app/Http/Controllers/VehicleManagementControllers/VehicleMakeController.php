<?php

namespace App\Http\Controllers\VehicleManagementControllers;

use App\Http\Controllers\Controller;
use App\Models\UserActivityLog;
use App\Models\Vehicle;
use App\Models\VehicleMake;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class VehicleMakeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $makes = VehicleMake::orderBy('id', 'desc')->get();

        // Prepare data for charts
        $vehicleCountsByMake = Vehicle::select('make_id', DB::raw('count(*) as total_vehicles'))
            ->groupBy('make_id')
            ->pluck('total_vehicles', 'make_id');

        return view('dashboard.vehicleManagement.vehicleMake.index', compact('makes', 'vehicleCountsByMake'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:vehicle_makes,name',
        ]);

        VehicleMake::create([
            'name' => $request->name,
        ]);
        $log = new UserActivityLog();
        $log->user_id = Auth::user()->id;
        $log->action = 'Created Vehicle Make: ' . $request->name;
        $log->showroom_id = Auth::user()->showroom_id;
        $log->created_at = now();
        $log->save();

        return redirect()->route('vehicle-make.index')->with('success', 'Vehicle Make created successfully.');
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VehicleMake $vehicleMake)
    {
        $id = $request->makeId;
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('vehicle_makes')->ignore($id)
            ],
        ]);

        $vehicleMake->update([
            'name' => $request->name,
        ]);
        $log = new UserActivityLog();
        $log->user_id = Auth::user()->id;
        $log->action = 'Updated Vehicle Make: ' . $request->name;
        $log->showroom_id = Auth::user()->showroom_id;
        $log->created_at = now();
        $log->save();

        return redirect()->route('vehicle-make.index')->with('success', 'Vehicle Make updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Find the role by its ID
            $role = VehicleMake::findOrFail($id);
            // Delete the role

            $log = new UserActivityLog();
            $log->user_id = Auth::user()->id;
            $log->action = 'Deleted Vehicle Make: ' . $role->name;
            $log->showroom_id = Auth::user()->showroom_id;
            $log->created_at = now();
            $log->save();

            $role->delete();

            // Return a successful response
            return response()->json(['success' => 'Vehicle Make deleted successfully.']);
        } catch (\Exception $e) {
            // Return an error response
            return response()->json(['error' => 'Unable to delete vehicle make.'], 500);
        }
    }
}
