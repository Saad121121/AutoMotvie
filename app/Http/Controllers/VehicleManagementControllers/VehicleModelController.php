<?php

namespace App\Http\Controllers\VehicleManagementControllers;

use App\Http\Controllers\Controller;
use App\Models\UserActivityLog;
use App\Models\VehicleMake;
use App\Models\VehicleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class VehicleModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all vehicle makes and models
        $makes = VehicleMake::orderBy('id', 'desc')->get();
        $models = VehicleModel::with('make')->orderBy('id', 'desc')->get();

        // Prepare data for the chart
        $modelsByMake = VehicleModel::select('make_id', DB::raw('count(*) as total'))
            ->groupBy('make_id')
            ->get()
            ->pluck('total', 'make_id')
            ->all();

        // Extract make names and model counts for the chart
        $makeNames = [];
        $modelCounts = [];
        foreach ($makes as $make) {
            $makeNames[] = $make->name;
            $modelCounts[] = $modelsByMake[$make->id] ?? 0;
        }

        return view('dashboard.vehicleManagement.vehicleModel.index', compact('makes', 'models', 'makeNames', 'modelCounts'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'make_id' => 'required|exists:vehicle_makes,id',
        ]);

        VehicleModel::create([
            'name' => $request->name,
            'make_id' => $request->make_id,

        ]);
        $log = new UserActivityLog();
        $log->user_id = Auth::user()->id;
        $log->action = 'Created Vehicle model: ' . $request->name;
        $log->showroom_id = Auth::user()->showroom_id;
        $log->created_at = now();
        $log->save();

        return redirect()->route('vehicle-model.index')->with('success', 'Vehicle Make created successfully.');
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VehicleModel $vehicleModel)
    {
        // dd($request->all());
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255'
            ],
            'make_id' => 'required|exists:vehicle_makes,id',
        ]);

        $vehicleModel->update([
            'name' => $request->name,
            'make_id' => $request->make_id,
        ]);
        $log = new UserActivityLog();
        $log->user_id = Auth::user()->id;
        $log->action = 'Updated Vehicle model: ' . $request->name;
        $log->showroom_id = Auth::user()->showroom_id;
        $log->created_at = now();
        $log->save();

        return redirect()->route('vehicle-model.index')->with('success', 'Vehicle Model updated successfully.');
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
            $log->action = 'Deleted Vehicle model: ' . $role->name;
            $log->showroom_id = Auth::user()->showroom_id;
            $log->created_at = now();
            $log->save();

            $role->delete();

            // Return a successful response
            return response()->json(['success' => 'Vehicle Make deleted successfully.']);
        } catch (\Exception $e) {
            // Return an error response
            return response()->json(['error' => 'Unable to delete vehicle ake.'], 500);
        }
    }
}
