<?php

namespace App\Http\Controllers\VehicleManagementControllers;

use App\Http\Controllers\Controller;
use App\Models\Showroom;
use App\Models\UserActivityLog;
use App\Models\Vehicle;
use App\Rules\PakistaniPhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Barryvdh\DomPDF\Facade\Pdf;

class ShowroomController extends Controller
{

    public function index()
    {
        $showrooms = Showroom::with('manager')->orderBy('id', 'desc')->get();
        // dd($showrooms->toArray());
        // $showrooms = Showroom::with('manager', 'vehicle')->orderBy('id', 'desc')->get();
        return view('dashboard.showroomManagement.showroom.index', compact('showrooms'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // Validate the request
        $request->validate([
            'shr_name' => 'required|string|max:255',
            'shr_contact_number' => 'required|string|max:20|unique:showrooms,shr_contact_number',
            new PakistaniPhoneNumber,
            'shr_contact_email' => 'required|email|unique:showrooms,shr_contact_email',
            'shr_location' => 'required|string|max:255',
        ], [
            'shr_contact_email.unique' => 'The email address you entered is already in use.',
            'shr_contact_number.unique' => 'The number you entered is already in use.',
        ]);

        // Create the owner
        $owner = new Showroom();
        $owner->shr_name = $request->input('shr_name');
        $owner->shr_contact_number = $request->input('shr_contact_number');
        $owner->shr_contact_email = $request->input('shr_contact_email');
        $owner->shr_location = $request->input('shr_location');
        $owner->save();

        $log = new UserActivityLog();
        $log->user_id = Auth::user()->id;
        $log->action = 'Created Dealer Name: ' . $request->input('shr_name') . ' Contact Number : ' . $request->input('shr_contact_number');
        $log->created_at = now();
        $log->save();

        // Redirect or return response
        return redirect()->route('showroom.index')->with('success', 'Dealer created successfully.');
    }
    public function update(Request $request)
    {
        $id = $request->input('showroom_id');
        // dd(json_encode($request->all()) . "   " . $id);
        try {
            // Validate the request
            $request->validate([
                'shr_name' => 'required|string|max:255',
                'shr_contact_number' => [
                    'required',
                    'string',
                    'max:13',
                    Rule::unique('showrooms')->ignore($id),
                    new PakistaniPhoneNumber,
                ],
                'shr_contact_email' => [
                    'required',
                    'email',
                    'max:255',
                    Rule::unique('showrooms')->ignore($id),
                ],
                'shr_location' => 'required|string|max:255',
            ], [
                'shr_contact_email.unique' => 'The email address you entered is already in use.',
                'shr_contact_number.unique' => 'The number you entered is already in use.',
            ]);


            // Find the owner
            $showroom = Showroom::findOrFail($id);
            // Update owner details
            if ($showroom) {

                $showroom->shr_name = $request->input('shr_name');
                $showroom->shr_contact_number = $request->input('shr_contact_number');
                $showroom->shr_contact_email = $request->input('shr_contact_email');
                $showroom->shr_location = $request->input('shr_location');
                $showroom->save();
                //activitylog
                $log = new UserActivityLog();
                $log->user_id = Auth::user()->id;
                $log->action = 'Updated Dealer Name: ' . $request->input('shr_name') . ' Contact Number : ' . $request->input('shr_contact_number');
                $log->created_at = now();
                $log->save();
            }
            return redirect()->route('showroom.index')->with('success', 'Dealer updated successfully.');
        } catch (\Exception $e) {
            // Redirect back with error message
            return redirect()->back()->with('error', 'An error occurred while updating the Dealer. Please try again. ' . $e->getMessage());
        }
    }


    public function destroy($id)
    {
        // dd($id);
        try {
            $owner = Showroom::findOrFail($id);
            if ($owner) {
                //activitylog
                $log = new UserActivityLog();
                $log->user_id = Auth::user()->id;
                $log->action = 'Deleted Dealer Name: ' . $owner->input('shr_name') . ' Contact Number : ' . $owner->input('shr_contact_number');
                $log->created_at = now();
                $log->save();
                $owner->delete();
                return response()->json(['success' => 'Dealer deleted successfully.']);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to delete Dealer.'], 500);
        }
    }
    public function showroomReports()
    {
        if (Auth::user()->role_id == 5) {
 
            $showrooms = Showroom::with('manager')->orderBy('id', 'desc')->get();
        } else {
            $showrooms = Showroom::with('manager')->where('id', Auth::user()->showroom_id)->orderBy('id', 'desc')->get();
        }
 
 
        // dd($showrooms->toArray());
        // $showrooms = Showroom::with('manager', 'vehicle')->orderBy('id', 'desc')->get();
        return view('dashboard.companyreports.showroomReports.index', compact('showrooms'));
    }
    public function showroomReportIndex($id)
    {
        $startOfMonth = now()->startOfMonth();
        $endOfMonth = now()->endOfMonth();

        // Get the showroom
        $showroom = Showroom::find($id);

        if (!$showroom) {
            return redirect()->back()->with('error', 'Showroom not found.');
        }

        // Query to get all vehicles with service count and total estimated cost, paginated
        $vehicles = Vehicle::select(
            'vehicles.id',
            'vehicles.vin',
            'vehicles.owner_id',
            DB::raw('COUNT(services.id) as service_count'),
            DB::raw('SUM(services.cost_estimate) as total_estimated_cost')
        )
            ->leftJoin('services', 'services.vehicle_id', '=', 'vehicles.id')
            ->where('vehicles.showroom_id', $id) // Filter by showroom_id
            ->whereBetween('services.created_at', [$startOfMonth, $endOfMonth])
            ->groupBy('vehicles.id', 'vehicles.vin', 'vehicles.owner_id')
            ->orderBy('service_count', 'desc')
            ->paginate(50); // Paginate results, 50 per page

        // Format the total estimated cost to be currency-friendly
        $vehicles->getCollection()->transform(function ($vehicle) {
            $vehicle->total_estimated_cost = number_format($vehicle->total_estimated_cost, 2);
            return $vehicle;
        });

        return view('dashboard.companyreports.showroomReports.dealerServiceReport', [
            'showroom' => $showroom,
            'vehicles' => $vehicles,
            'showroomId' => $id
        ]);
    }
    public function generateReport(Request $request, $showroomId)
    {
        // Fetch the data
        $startOfMonth = now()->startOfMonth();
        $endOfMonth = now()->endOfMonth();

        $vehicles = Vehicle::select(
            'vehicles.id',
            'vehicles.vin',
            'vehicles.owner_id',
            DB::raw('COUNT(services.id) as service_count'),
            DB::raw('SUM(services.cost_estimate) as total_estimated_cost')
        )
            ->leftJoin('services', 'services.vehicle_id', '=', 'vehicles.id')
            ->where('vehicles.showroom_id', $showroomId)
            ->whereBetween('services.created_at', [$startOfMonth, $endOfMonth])
            ->groupBy('vehicles.id', 'vehicles.vin', 'vehicles.owner_id')
            ->get();

        // Load the view and pass the data
        $pdf = PDF::loadView('dashboard.companyreports.showroomReports.vehicle_report', ['vehicles' => $vehicles]);
        // Return the PDF file
        return $pdf->download('vehicle_report.pdf');
    }
}
