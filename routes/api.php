<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WarehousController;
use App\Http\Controllers\WarehousUserController;
use App\Http\Controllers\WarehousProductController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DocumentLinesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('admin')->group(function(){
   Route::get('/categories',[CategoryController::class,'index']);
   Route::post('/categories',[CategoryController::class,'store']);
   Route::put('/categories/{categories}',[CategoryController::class,'update']);
   Route::delete('/categories/{categories}',[CategoryController::class,'destroy']);


    Route::get('/units',[UnitController::class,'index']);
    Route::post('/units',[UnitController::class,'store']);
    Route::put('/units/{unit}',[UnitController::class,'update']);
    Route::delete('/units/{unit}',[UnitController::class,'destroy']);


    Route::get('/products',[ProductController::class,'index']);
    Route::post('/products',[ProductController::class,'store']);
    Route::put('/products/{product}',[ProductController::class,'update']);
    Route::delete('/products/{product}',[ProductController::class,'destroy']);


    Route::get('/warehouses',[WarehousController::class,'index']);
    Route::post('/warehouses',[WarehousController::class,'store']);
    Route::put('/warehouses/{warehouse}',[WarehousController::class,'update']);
    Route::delete('/warehouses/{warehouse}',[WarehousController::class,'destroy']);

    Route::get('/warehouseProducts',[WarehousProductController::class,'index']);

    Route::get('/warehouseUsers',[WarehousUserController::class,'index']);
    Route::post('/warehouseUsers',[WarehousUserController::class,'store']);
    Route::put('/warehouseUsers/{warehouseUser}',[WarehousUserController::class,'update']);
    Route::delete('/warehouseUsers/{user}',[WarehousUserController::class,'destroy']);
});



Route::prefix('manager')->group(function(){
    Route::get('/warehouseProducts',[WarehousProductController::class,'index']);
    Route::post('/warehouseProducts',[WarehousProductController::class,'store']);
    Route::put('/warehouseProducts/{warehouseProduct}',[WarehousProductController::class,'update']);
    Route::delete('/warehouseProducts/{warehouseProducts}',[WarehousProductController::class,'destroy']);


    Route::get('/partners',[PartnerController::class,'index']);
    Route::post('/partners',[PartnerController::class,'store']);
    Route::put('/partners/{partner}',[PartnerController::class,'update']);
    Route::delete('/partners/{partner}',[PartnerController::class,'destroy']);

});
Route::prefix('staff')->group(function(){
Route::get('/documents',[DocumentController::class,'index']);
Route::post('/documents',[DocumentController::class,'store']);
Route::put('/documents/{document}',[DocumentController::class,'update']);
Route::delete('/documents/{document}',[DocumentController::class,'destroy']);


Route::get('/documentLines',[DocumentLinesController::class,'index']);
Route::post('/documentLines',[DocumentLinesController::class,'store']);
Route::put('/documentLines/{documentLine}',[DocumentLinesController::class,'update']);
Route::delete('/documentLines/{documentLine}',[DocumentLinesController::class,'destroy']);
});
