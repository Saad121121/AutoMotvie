<?php

namespace App\Http\Controllers;

use App\Mail\InventoryReportMail;
use App\Models\Accident;
use App\Models\Promotion;
use App\Models\Service;
use App\Models\Showroom;
use App\Models\User;
use App\Models\UserActivityLog;
use App\Models\Vehicle;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    // public function index()
    // {

    //     $vehicleCount = Vehicle::where('showroom_id', Auth::user()->showroom_id)->count();
    //     $staffCount = User::where('showroom_id', Auth::user()->showroom_id)->where('role_id', 3)->count();
    //     $userCount = User::where('showroom_id', Auth::user()->showroom_id)->where('role_id', 4)->count();
    //     $showroomId = Auth::user()->showroom_id;

    //     // Count the number of vehicles sold
    //     $vehicleSalesCount = Service::where('showroom_id', $showroomId)
    //         ->where('status', 'Completed') // Adjust according to your 'status' field
    //         ->count();

    //     // Count the number of sales staff
    //     $salesStaffCount = User::where('showroom_id', $showroomId)
    //         ->where('role_id', 3) // Assuming you have a role_id for sales staff
    //         ->count();
    //     $targetSalesPerStaff = 10;
    //     // Calculate sales productivity
    //     $salesProductivityPercentage = $salesStaffCount > 0
    //         ? ($vehicleSalesCount / ($salesStaffCount * $targetSalesPerStaff)) * 100
    //         : 0;
    //     if (Auth::user()->role_id == 4) {

    //         return view('dashboard.userIndex');
    //     } else {

    //         return view('dashboard.index',  compact('vehicleCount', 'userCount', 'staffCount', 'salesProductivityPercentage'));
    //     }
    // }
    // public function index()
    // {
 
    //     $vehicleCount = Vehicle::where('showroom_id', Auth::user()->showroom_id)->count();
    //     $staffCount = User::where('showroom_id', Auth::user()->showroom_id)->where('role_id', 3)->count();
    //     $userCount = User::where('showroom_id', Auth::user()->showroom_id)->where('role_id', 4)->count();
    //     $showroomId = Auth::user()->showroom_id;
 
    //     // Count the number of vehicles sold
    //     $vehicleSalesCount = Service::where('showroom_id', $showroomId)
    //         ->where('status', 'Completed') // Adjust according to your 'status' field
    //         ->count();
 
    //     // Count the number of sales staff
    //     $salesStaffCount = User::where('showroom_id', $showroomId)
    //         ->where('role_id', 3) // Assuming you have a role_id for sales staff
    //         ->count();
    //     $targetSalesPerStaff = 10;
    //     // Calculate sales productivity
    //     $salesProductivityPercentage = $salesStaffCount > 0
    //         ? ($vehicleSalesCount / ($salesStaffCount * $targetSalesPerStaff)) * 100
    //         : 0;
 
    //     $promotions = Promotion::all();
    //     if (Auth::user()->role_id == 4) {
    //             // dd($promotions);
    //         return view('dashboard.userIndex', compact('promotions'));
    //     } else {
 
    //         return view('dashboard.index',  compact('vehicleCount', 'userCount', 'staffCount', 'salesProductivityPercentage'));
    //     }
    // }
    public function index()
    {
 
        $vehicleCount = Vehicle::where('showroom_id', Auth::user()->showroom_id)->count();
        $staffCount = User::where('showroom_id', Auth::user()->showroom_id)->where('role_id', 3)->count();
        $userCount = User::where('showroom_id', Auth::user()->showroom_id)->where('role_id', 4)->count();
        $showroomId = Auth::user()->showroom_id;
        $showroomName = Showroom::where('id', $showroomId)->first();
 
        // Count the number of vehicles sold
        $vehicleSalesCount = Service::where('showroom_id', $showroomId)
            ->where('status', 'Completed') // Adjust according to your 'status' field
            ->count();
 
        // Count the number of sales staff
        $salesStaffCount = User::where('showroom_id', $showroomId)
            ->where('role_id', 3) // Assuming you have a role_id for sales staff
            ->count();
        $targetSalesPerStaff = 10;
        // Calculate sales productivity
        $salesProductivityPercentage = $salesStaffCount > 0
            ? ($vehicleSalesCount / ($salesStaffCount * $targetSalesPerStaff)) * 100
            : 0;
 
        $promotions = Promotion::all();
        if (Auth::user()->role_id == 4) {
 
            return view('dashboard.userIndex', compact('promotions'));
        } elseif (Auth::user()->role_id == 5) {
            return view('dashboard.index',  compact('vehicleCount', 'userCount', 'staffCount', 'salesProductivityPercentage', 'showroomName'));
        } else {
            
            return view('dashboard.dealerIndex',compact('vehicleCount', 'userCount', 'staffCount', 'salesProductivityPercentage', 'showroomName'));
        }
    }
    public function showroomIndex($id)
    {
        $showroomId = $id;
        // this is the upper 4 parts of dashboard
        $vehicleCount = Vehicle::where('showroom_id', $showroomId)->count();
        $staffCount = User::where('showroom_id', $showroomId)->where('role_id', 3)->count();
        $userCount = User::where('showroom_id', $showroomId)->where('role_id', 4)->count();
        $sow = Showroom::where('id', $showroomId)->first();
        $showroomName = $sow->shr_name;
        // Count the number of vehicles sold
        $vehicleSalesCount = Service::where('showroom_id', $showroomId)
            ->where('status', 'Completed') // Adjust according to your 'status' field
            ->count();

        // Count the number of sales staff
        $salesStaffCount = User::where('showroom_id', $showroomId)
            ->where('role_id', 3) // Assuming you have a role_id for sales staff
            ->count();
        $targetSalesPerStaff = 10;
        // Calculate sales productivity
        $salesProductivityPercentage = $salesStaffCount > 0
            ? ($vehicleSalesCount / ($salesStaffCount * $targetSalesPerStaff)) * 100
            : 0;
        // this is the end of upper 4 parts of dashboard
        $servicesForTable = Service::with('vehicle', 'vehicle.owner', 'showroom.manager')
            ->where('showroom_id', $showroomId)
            ->whereIn('status', ['Pending', 'Upcoming'])
            ->orderBy('created_at', 'desc') // Order by the latest created_at
            ->take(5) // Limit to the latest 5 records
            ->get();
        // dd($servicesForTable);
        $completedServicesCount = Service::where('showroom_id', $showroomId)
            ->where('status', 'Completed')
            ->count();

        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $completedCount = Service::where('status', 'Completed')
            ->where('showroom_id', $showroomId)
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->count();

        $inProgressCount = Service::where('status', 'Pending')
            ->where('showroom_id', $showroomId)
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->count();

        $upcomingCount = Service::where('status', 'Upcoming')
            ->where('showroom_id', $showroomId)
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->count();
        $total = $completedCount + $inProgressCount + $upcomingCount;

        // Calculate percentages
        $completedPercentage = ($total > 0) ? ($completedCount / $total) * 100 : 0;
        $inProgressPercentage = ($total > 0) ? ($inProgressCount / $total) * 100 : 0;
        $upcomingPercentage = ($total > 0) ? ($upcomingCount / $total) * 100 : 0;
        //end of 2nd part of dashboard
        // starting 3rd
        $ShowroomActivitylogs = UserActivityLog::with('user')
            ->where('showroom_id', $showroomId)
            ->orderBy('created_at', 'desc')
            ->take(20)
            ->get();

        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        // Get top 4 showrooms with the most services
        $topShowrooms = Showroom::select('showrooms.id', 'showrooms.shr_name', DB::raw('COUNT(services.id) as service_count'))
            ->leftJoin('services', 'services.showroom_id', '=', 'showrooms.id')
            ->whereBetween('services.created_at', [$startOfMonth, $endOfMonth])
            ->groupBy('showrooms.id', 'showrooms.shr_name')
            ->orderBy('service_count', 'desc')
            ->limit(4)
            ->get();

        $topVehicles = Vehicle::select(
            'vehicles.id',
            'vehicles.vin',
            'vehicles.owner_id',
            DB::raw('COUNT(services.id) as service_count'),
            DB::raw('SUM(services.cost_estimate) as total_estimated_cost')
        )
            ->leftJoin('services', 'services.vehicle_id', '=', 'vehicles.id')
            ->where('vehicles.showroom_id', $showroomId) // Filter by showroom_id
            ->whereBetween('services.created_at', [$startOfMonth, $endOfMonth])
            ->groupBy('vehicles.id', 'vehicles.vin', 'vehicles.owner_id')
            ->orderBy('service_count', 'desc')
            ->limit(5) // Limit to top 5
            ->with('owner') // Ensure you load the owner relationship if it's defined
            ->get();

        // Format total estimated cost to be currency-friendly
        $topVehicles->map(function ($vehicle) {
            $vehicle->total_estimated_cost = number_format($vehicle->total_estimated_cost, 2);
            return $vehicle;
        });

        // dd($topVehicles->toArray());
        return view('dashboard.showroomIndex',  compact('vehicleCount', 'userCount', 'staffCount', 'salesProductivityPercentage', 'showroomName', 'servicesForTable', 'completedServicesCount', 'completedCount', 'inProgressCount', 'upcomingCount', 'completedPercentage', 'inProgressPercentage', 'upcomingPercentage', 'ShowroomActivitylogs', 'topShowrooms', 'topVehicles'));
    }
    // public function index()
    // {
    //     $showroomId = 4;

    //     $monthlyVehicleCounts = Vehicle::where('showroom_id', $showroomId)
    //         ->whereNotNull('created_at')
    //         ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(id) as vehicle_count')
    //         ->groupBy('month')
    //         ->orderBy('month', 'asc')
    //         ->get();



    //     // dd($monthlyVehicleCounts);
    //     return view('dashboard.index',  compact('monthlyVehicleCounts'));
    // }
    public function showInventory()
    {
        return view('dashboard.companyreports.inventory.index');
    }
    public function viewPageDetail()
    {
        return view('dashboard.part.detail');
    }
    public function downloadInventoryPdf()
    {
        $data = [
            ['S.No' => 1, 'VIN' => '1HGCM82633A123456', 'Make' => 'Honda', 'Model' => 'Accord', 'Year' => 2023, 'Color' => 'Black', 'Engine Type' => 'V6'],
        ];

        $pdf = Pdf::loadView('dashboard.companyreports.inventory.inventory_pdf', ['data' => $data]);

        return $pdf->download('inventory_report.pdf');
    }
    public function sendInventoryReport()
    {
        $data = [
            ['S.No' => 1, 'VIN' => '1HGCM82633A123456', 'Make' => 'Honda', 'Model' => 'Accord', 'Year' => 2023, 'Color' => 'Black', 'Engine Type' => 'V6'],
        ];

        $pdf = Pdf::loadView('dashboard.companyreports.inventory.inventory_pdf', ['data' => $data])->output();

        // Send email
        Mail::to('monkeydmaaz@gmail.com')->send(new InventoryReportMail($pdf));

        return redirect()->back()->with('success', 'Inventory report sent to your email.');
    }
    public function sendContact(Request $request)
    {
        // Validate the input
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email|max:255',
        //     'subject' => 'required|string|max:255',
        //     'message' => 'required|string',
        // ]);

        // $to = 'chrome@abitmuchco.com';
        // $subject = 'Contact Form Submission';

        // // Create the email body
        // $messageBody = "Name: " . $request->input('name') . "\n";
        // $messageBody .= "Email: " . $request->input('email') . "\n";
        // $messageBody .= "Message: " . $request->input('message') . "\n";

        // // Send the email
        // Mail::raw($messageBody, function ($message) use ($to, $subject) {
        //     $message->to($to)
        //         ->subject($subject)
        //         ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        // });

        return redirect()->back()->with('success', 'Email sent successfully.');
    }

    public function showInventorySupport()
    {
        return view('dashboard.companyreports.supportTicket.inventoryRequest');
    }

    public function showVirtualSupport()
    {
        return view('dashboard.companyreports.supportTicket.virtualSupport');
    }
    public function showSalesPerformance(Request $request)
    {
        // Get the selected showroom_id from the form, or use the user's showroom_id by default
        $showroom_id = $request->input('showroom_id', Auth::user()->showroom_id);
        
        // Filter data based on showroom_id
        $total_services = Service::where('showroom_id', $showroom_id)->count();
        $total_services_cost = Service::where('showroom_id', $showroom_id)->sum('cost_estimate');
        $total_vehicles = Vehicle::where('showroom_id', $showroom_id)->count();
        $total_accidents = Accident::whereHas('vehicle', function ($query) use ($showroom_id) {
            $query->where('showroom_id', $showroom_id);
        })->count();
    
        $showrooms = Showroom::orderBy('id', 'desc')->get();
    
        // Pass the selected showroom_id back to the view
        return view('dashboard.companyreports.showroomReports.salesPerfShowroom', compact(
            'total_services', 'total_services_cost', 'total_vehicles', 'total_accidents', 'showrooms', 'showroom_id'
        ));
    }
     // for chart
 
     public function monthly_service_cost() {
        $showroomId = Auth::user()->showroom_id;
 
        $monthlyCosts = Service::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(cost_estimate) as total_cost')
        )
            ->where('showroom_id', $showroomId)
            ->groupBy(DB::raw('YEAR(created_at)'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('year')
            ->orderBy('month')
            ->get();
 
            $formattedMonthlyCosts = $monthlyCosts->map(function ($item) {
                // Create a DateTime object from the year and month
                $date = new \DateTime();
                $date->setDate($item->year, $item->month, 1); // 1st day of the month
 
                // Format the month and year
                $formattedMonth = $date->format('M Y'); // Example: Jan 2024
 
                return [
                    'month' => $formattedMonth,
                    'total_cost' => $item->total_cost,
                ];
            });
 
            $labels = [];
            $monthlycost = [];
            foreach($formattedMonthlyCosts as $cost){
                $labels[] = $cost['month'];
                $monthlycost[] = $cost['total_cost'];
            }
 
            return response()->json(['labels' => $labels, 'monthly_cost' => $monthlycost]);
    }
    public function masterInventory()
    {
        return view('dashboard.companyreports.masterInventory.index');
    }
    public function viewSupplierPageDetail()
    {
        return view('dashboard.supplier.detail');
    }


    
}
