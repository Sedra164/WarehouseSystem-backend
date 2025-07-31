<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Requests\Warehouse\StoreWarehouseRequest;
use App\Http\Resources\WarehouseResource;
use App\Http\Resources\WarehouseRsource;
use App\Models\Warehouse;

class WarehousController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware(['auth', 'isAdmin']);
    }

    public function index()
    {
        $warehouse=Warehouse::all();
//        return ApiResponse::success(WarehouseResource::collection($warehouse),'This is all warehouses',201);
        return view('admin.warehouses.index',compact('warehouse'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.warehouses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWarehouseRequest $request)
    {
        $warehouse             =new Warehouse();
        $warehouse->name       =$request->input('name');
        $warehouse->description=$request->input('description');
        $warehouse->location   =$request->input('location');
        $warehouse->save();
//        return ApiResponse::success(WarehouseResource::make($warehouse),'Warehouse Created Successfully',201);
        return redirect()->route('admin.warehouses.index')->with('success','!تم إضافة المستودع بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Warehouse $warehouse)
    {
        return view('admin.warehouses.edit',compact('warehouse'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Warehouse $warehouse)
    {
        $warehouse->update([
            'name'        => $request->filled('name')        ? $request->name        : $warehouse->name,
            'location'    => $request->filled('location')    ? $request->location    : $warehouse->location,
            'description' => $request->filled('description') ? $request->description : $warehouse->description,
        ]);
//        return ApiResponse::success(WarehouseResource::make($warehouse),'Warehouse Update Successfully',201);
        return redirect()->route('admin.warehouses.index')->with('success','تم التعديل بنجاح!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Warehouse $warehouse)
    {
        $warehouse->delete();
//        return ApiResponse::success(null,'Warehouse Deleted Successfully',201);
        return redirect()->route('admin.warehouses.index')->with('success','تم حذف المستودع بنجاح!');
    }
}
