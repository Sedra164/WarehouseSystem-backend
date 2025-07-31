<?php
use App\Exports\DocumentsWithLinesExport;
use App\Exports\DocumentsWithLinesForAdminExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Manager\MDashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\WarehousController;
use App\Http\Controllers\WarehousUserController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\WarehousProductController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DocumentLinesController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login.submit');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', function () {
        return 'لوحة تحكم الادمن';
    })->name('admin.dashboard');

    Route::get('/manager/dashboard', function () {
        return 'لوحة تحكم المدير';
    })->name('manager.dashboard');

    Route::get('/staff/dashboard', function () {
        return 'لوحة تحكم الموظف';
    })->name('staff.dashboard');
});



Route::prefix('admin')->name('admin.') ->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::get('/products/{product}', [ProductController::class, 'edit'])->name('products.edit');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.delete');


    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::get('/categories/{category}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.delete');


    Route::get('/units', [UnitController::class, 'index'])->name('units.index');
    Route::get('/units/create', [UnitController::class, 'create'])->name('units.create');
    Route::post('/units', [UnitController::class, 'store'])->name('units.store');
    Route::put('/units/{unit}', [UnitController::class, 'update'])->name('units.update');
    Route::get('/units/{unit}', [UnitController::class, 'edit'])->name('units.edit');
    Route::delete('/units/{unit}', [UnitController::class, 'destroy'])->name('units.delete');


    Route::get('/warehouses', [WarehousController::class, 'index'])->name('warehouses.index');
    Route::get('/warehouses/create', [WarehousController::class, 'create'])->name('warehouses.create');
    Route::post('/warehouses', [WarehousController::class, 'store'])->name('warehouses.store');
    Route::get('/warehouses/{warehouse}', [WarehousController::class, 'edit'])->name('warehouses.edit');
    Route::put('/warehouses/{warehouse}', [WarehousController::class, 'update'])->name('warehouses.update');
    Route::delete('/warehouses/{warehouse}', [WarehousController::class, 'destroy'])->name('warehouses.delete');


    Route::get('/warehouseUsers', [WarehousUserController::class, 'index'])->name('warehouseUsers.index');
    Route::get('/warehouseUsers/create', [WarehousUserController::class, 'create'])->name('warehouseUsers.create');
    Route::post('/warehouseUsers', [WarehousUserController::class, 'store'])->name('warehouseUsers.store');
    Route::get('/warehouseUsers/{id}', [WarehousUserController::class, 'edit'])->name('warehouseUsers.edit');
    Route::put('/warehouseUsers/{id}', [WarehousUserController::class, 'update'])->name('warehouseUsers.update');
    Route::delete('/warehouseUsers/{id}', [WarehousUserController::class, 'destroy'])->name('warehouseUsers.delete');

    Route::get('/export-documents', function () {
        return Excel::download(new DocumentsWithLinesForAdminExport(), 'فواتير المخزن.xlsx');
    })->name('export.documents');
});




Route::prefix('manager')->name('manager.')->middleware(['auth', 'isManager'])->group(function () {
    Route::get('/dashboard', [MDashboardController::class, 'managerDashboard'])->name('dashboard');

    Route::get('/partners',[PartnerController::class,'index'])->name('partners.index');
    Route::get('/partners/create',[PartnerController::class,'create'])->name('partners.create');
    Route::post('/partners',[PartnerController::class,'store'])->name('partners.store');
    Route::get('/partners/{partner}',[PartnerController::class,'edit'])->name('partners.edit');
    Route::put('/partners/{partner}',[PartnerController::class,'update'])->name('partners.update');
    Route::delete('/partners/{partner}',[PartnerController::class,'destroy'])->name('partners.delete');


    Route::get('/warehouseProducts',[WarehousProductController::class,'index'])->name('WarehouseProducts.index');
    Route::get('/warehouseProducts/create',[WarehousProductController::class,'create'])->name('WarehouseProducts.create');
    Route::post('/warehouseProducts',[WarehousProductController::class,'store'])->name('WarehouseProducts.store');
    Route::get('/warehouseProducts/{warehouseProduct}',[WarehousProductController::class,'edit'])->name('WarehouseProducts.edit');
    Route::put('/warehouseProducts/{warehouseProduct}',[WarehousProductController::class,'update'])->name('WarehouseProducts.update');
    Route::delete('/warehouseProducts/{warehouseProduct}',[WarehousProductController::class,'destroy'])->name('WarehouseProducts.delete');


    Route::get('/warehouse_users', [WarehousUserController::class, 'index'])->name('warehouse_users.index');
    Route::get('/warehouse_users/create', [WarehousUserController::class, 'create'])->name('warehouse_users.create');
    Route::post('/warehouse_users', [WarehousUserController::class, 'store'])->name('warehouse_users.store');
    Route::get('/warehouse_users/{id}', [WarehousUserController::class, 'edit'])->name('warehouse_users.edit');
    Route::put('/warehouse_users/{id}', [WarehousUserController::class, 'update'])->name('warehouse_users.update');
    Route::delete('/warehouse_users/{id}', [WarehousUserController::class, 'destroy'])->name('warehouse_users.delete');

    Route::get('/export-documents', function () {
        return Excel::download(new DocumentsWithLinesExport(auth()->id()), 'فواتير المخزن.xlsx');
    })->name('export.documents');
});


Route::prefix('staff')->name('staff.')->middleware(['auth', 'isStaff'])->group(function(){
    Route::get('/documents',[DocumentController::class,'index'])->name('documents.index');
    Route::get('/documents/create',[DocumentController::class,'create'])->name('documents.create');
    Route::post('/documents',[DocumentController::class,'store'])->name('documents.store');
    Route::get('/documents/{document}',[DocumentController::class,'edit'])->name('documents.edit');
    Route::put('/documents/{document}',[DocumentController::class,'update'])->name('documents.update');
    Route::delete('/documents/{document}',[DocumentController::class,'destroy'])->name('documents.delete');


    Route::get('/documentLines/{id}',[DocumentLinesController::class,'index'])->name('documentLines.index');
    Route::get('/documentLines/create/{document}',[DocumentLinesController::class,'create'])->name('documentLines.create');
    Route::post('/documentLines',[DocumentLinesController::class,'store'])->name('documentLines.store');
    Route::get('/documentLines/edit/{documentLine}',[DocumentLinesController::class,'edit'])->name('documentLines.edit');
    Route::put('/documentLines/{documentLine}',[DocumentLinesController::class,'update'])->name('documentLines.update');

});
