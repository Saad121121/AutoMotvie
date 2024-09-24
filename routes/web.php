<?php

use App\Http\Controllers\AccessoriesController;
use App\Http\Controllers\DashboardControllers\PartController;
use App\Http\Controllers\DashboardControllers\PurchaseOrderController;
use App\Http\Controllers\DashboardControllers\UserController;
use App\Http\Controllers\DashboardControllers\SupplierController;
use App\Http\Controllers\DashCamController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SellmycarController;
use App\Http\Controllers\TradeInRequestController;
use App\Http\Controllers\VehicleManagementControllers\AccidentController;
use App\Http\Controllers\VehicleManagementControllers\ServiceController;
use App\Http\Controllers\VehicleManagementControllers\ShowroomController;
use App\Http\Controllers\VehicleManagementControllers\VehicleController;
use App\Http\Controllers\VehicleManagementControllers\VehicleMakeController;
use App\Http\Controllers\VehicleManagementControllers\VehicleModelController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
        // 2 nnew dashboard daleingy
        // return redirect()->route('dealer-dashboard',['id' => Auth::user()->showroom_id]);
    } else {
        // Return the login view for unauthenticated users
        return view('auth.login');
    }
});
Route::get('/login/customer', function () {
    return view('auth.login');
})->name('login.customer');
 
// Route for dealer login
Route::get('/login/dealer', function () {
    return view('auth.login_dealer');
})->name('login.dealer');
 
// Route for company login
Route::get('/login/company', function () {
    return view('auth.login_company');
})->name('login.company');

// Route::get('/dashboard', function () {
//     return view('dashboard.index');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // home
    // Route::get('/dashboard', [HomeController::class, 'index'])->name('home.index');
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    // roles
    // Route::get('/role', [RoleController::class, 'index'])->name('role.index');
    // Route::resource('roles', RoleController::class);

    // users
    Route::get('/users', [UserController::class, 'index'])->name('user.index');
    Route::Post('/users-store', [UserController::class, 'store'])->name('user.store');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('user.delete');
    //user activity
    Route::get('/usersActivity', [UserController::class, 'activity'])->name('userActivity.index');

    // Showroom
    Route::get('/showroom', [ShowroomController::class, 'index'])->name('showroom.index');
    Route::Post('/showroom-store', [ShowroomController::class, 'store'])->name('showroom.store');
    Route::put('/showroom/{id}', [ShowroomController::class, 'update'])->name('showroom.update');
    Route::delete('/showroom/{id}', [ShowroomController::class, 'destroy'])->name('showroom.delete');

    // vehicle
    Route::get('/vehicle', [VehicleController::class, 'index'])->name('vehicle.index');
    Route::Post('/vehicle-store', [VehicleController::class, 'store'])->name('vehicle.store');
    Route::put('/vehicle/{id}', [VehicleController::class, 'update'])->name('vehicle.update');
    Route::delete('/vehicle/{id}', [VehicleController::class, 'destroy'])->name('vehicle.delete');
    Route::get('/vehicle/models/{makeId}', [VehicleController::class, 'getModelsByMake'])->name('vehicle.models');
    //for vehicles filter
    Route::post('/vehicles/filter', [VehicleController::class, 'index'])->name('vehicles.filter');
    //for vehicle images
    Route::get('/vehicles/{id}/images', [VehicleController::class, 'getImages']);


    //vehicle-make
    Route::get('/vehicle-make', [VehicleMakeController::class, 'index'])->name('vehicle-make.index');
    Route::resource('vehicle-make', VehicleMakeController::class);

    //vehicle-models
    Route::get('/vehicle-model', [VehicleModelController::class, 'index'])->name('vehicle-model.index');
    Route::resource('vehicle-model', VehicleModelController::class);

    // userprofileDefault
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Services
    Route::get('/service', [ServiceController::class, 'index'])->name('services.index');
    Route::Post('/service-store', [ServiceController::class, 'store'])->name('services.store');
    Route::put('/service/{id}', [ServiceController::class, 'update'])->name('services.update');
    Route::delete('/service/{id}', [ServiceController::class, 'destroy'])->name('services.delete');
    Route::post('/service/search', [ServiceController::class, 'searchVin'])->name('services.search');
    Route::get('/services/{id}/edit', [ServiceController::class, 'edit']);
    Route::get('/service/create/{vehicle_id}', [ServiceController::class, 'create'])->name('services.create');

    //Accidents
    Route::get('/accident', [AccidentController::class, 'index'])->name('accidents.index');
    Route::Post('/accident-store', [AccidentController::class, 'store'])->name('accidents.store');
    Route::put('/accident/{id}', [AccidentController::class, 'update'])->name('accidents.update');
    Route::delete('/accident/{id}', [AccidentController::class, 'destroy'])->name('accidents.delete');
    Route::post('/accident/search', [AccidentController::class, 'searchVin'])->name('accidents.search');
    Route::get('/accidents/{id}/edit', [AccidentController::class, 'edit']);
    Route::get('/accidents/{id}/images', [AccidentController::class, 'getImages']);


    //For Company Author
    Route::get('/dealer-dashboard/{id}', [HomeController::class, 'showroomIndex'])->name('dealer-dashboard');
    //customers
    Route::get('/customers', [UserController::class, 'customerIndex'])->name('customer');
    Route::post('/customers-store', [UserController::class, 'customerStore'])->name('customer.store');
    Route::put('/customers-update/{id}', [UserController::class, 'customerEdit'])->name('customer.update');
    // showroomreport
    Route::get('/showroomsReport', [ShowroomController::class, 'showroomReports'])->name('showroomReport');
    Route::get('/dealer-service-report/{id}', [ShowroomController::class, 'showroomReportIndex'])->name('dealer-service-report');
    Route::get('/generate-vehicle-report/{showroomId}', [ShowroomController::class, 'generateReport'])
        ->name('generate-vehicle-report');
    //shamiir
    Route::get('monthly_service_cost', [HomeController::class, 'monthly_service_cost'])->name('monthly_service_cost');
    Route::get('/sales-filter', [HomeController::class, 'showSalesPerformance'])->name('sales.filter');

    //static
    Route::get('/showInventory', [HomeController::class, 'showInventory'])->name('showInventory');
    Route::get('/masterInventory', [HomeController::class, 'masterInventory'])->name('masterInventory');
    Route::get('/view_part_page_detail', [HomeController::class, 'viewPageDetail'])->name('view_part_page_detail');
    Route::get('/view_supplier_page_detail', [HomeController::class, 'viewSupplierPageDetail'])->name('view_supplier_page_detail');
    Route::get('/showInventorySupport', [HomeController::class, 'showInventorySupport'])->name('showInventorySupport');
    Route::get('/showVirtualSupport', [HomeController::class, 'showVirtualSupport'])->name('showVirtualSupport');
    Route::get('/download-inventory-pdf', [HomeController::class, 'downloadInventoryPdf'])->name('download-inventory-pdf');
    Route::get('/send-inventory-report', [HomeController::class, 'sendInventoryReport'])->name('send-inventory-report');
    Route::get('/sales-performance', [HomeController::class, 'showSalesPerformance'])->name('sales-performance');

    //ContactUS
    Route::post('/send-contact', [HomeController::class, 'sendContact'])->name('send-contact');

    //Customer
    Route::get('/schedule-service', [ServiceController::class, 'indexForScheduleCustomer'])->name('schedule-service');
    Route::post('/store-schedule-service', [ServiceController::class, 'storeScheduleService'])->name('store-schedule-service');

    // inventory module
    Route::resource('suppliers', SupplierController::class);
    Route::resource('parts', PartController::class);
    Route::resource('stocks', StockController::class);
    Route::get('/generate-part-number', [PartController::class, 'generatePartNumber'])->name('generate.part.number');
    Route::resource('purchase-orders', PurchaseOrderController::class);
    Route::get('/generate-po-number', [PurchaseOrderController::class, 'generatePartNumber'])->name('generate.po.number');
    Route::get('/purchase-orders/details/{id}', [PurchaseOrderController::class, 'detail'])->name('purchase-orders.detail');
    Route::put('/purchase-orders/{id}/update-status', [PurchaseOrderController::class, 'updateStatus'])->name('purchase-orders.update-status');
    Route::post('/purchase-orders/{id}/add-quantity', [PurchaseOrderController::class, 'addReceivedQuantity'])->name('purchase-orders.add-quantity');

    //promotion
    Route::resource('promotions', PromotionController::class);

    //sales
    Route::resource('sales', SalesController::class);
    Route::get('/generate-invoice-number', [SalesController::class, 'generateInvoiceNumber'])->name('generate.invoice.number');
    Route::get('/generate-customer-number', [SalesController::class, 'generateCustomerNumber'])->name('generate.customer.number');
    Route::get('/sales/{id}/pdf', [SalesController::class, 'generatePdf'])->name('sales.pdf');

    //accessories
    Route::get('/accessories', [AccessoriesController::class, 'index'])->name('accessories.index');
    Route::get('/accessories/{id}', [AccessoriesController::class, 'show'])->name('accessories.show');
    
    // Trade-In Request Routes
    Route::resource('tradein', TradeInRequestController::class);

    //data cam login
    Route::get('/dataCamLogin', [DashCamController::class, 'index'])->name('dataCamLogin.index');
    Route::Post('/dataCamLogin-store', [DashCamController::class, 'store'])->name('dataCamLogin.store');
    
    // chat gpt
    Route::post('/chat', [ChatController::class, 'chat']);
    // In web.php (routes file)
Route::get('/meet-in-person', function () {
    return view('mit');
})->name('mitPage');

    Route::get('/sellmycar',[SellmycarController::class, 'sellmycar'])->name('sellmycar');
    
    Route::get('/CarModel',[SellmycarController::class, 'CarModel'])->name('CarModel');
    Route::post('/create',[SellmycarController::class, 'create'])->name('create');
    Route::post('/Model',[SellmycarController::class, 'Model'])->name('Model');
    Route::post('/model_name_create',[SellmycarController::class, 'model_name_create'])->name('model_name_creat');
    Route::get('/model_company',[SellmycarController::class, 'model_company'])->name('model_company');
    Route::get('/show',[SellmycarController::class, 'show'])->name('show');
    Route::get('/showToAll',[SellmycarController::class, 'showToAll'])->name('showToAll');
    // Route::get('/edit{/id}',[SellmycarController::class, 'edit'])->name('edit');
    Route::get('/sellmycar/{id}/edit', [SellMyCarController::class, 'edit'])->name('edit');
    Route::put('/sellmycar/{id}', [SellMyCarController::class, 'update'])->name('sellmycar.update');
    Route::get('/destroy/{id}', [SellMyCarController::class, 'destroy'])->name('destroy');
    Route::post('/get.city.areas',[SellmycarController::class, 'get.city.areas'])->name('get.city.areas');
    
});

require __DIR__ . '/auth.php';
