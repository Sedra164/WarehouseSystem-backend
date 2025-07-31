<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\Unit\StoreUnitRequest;
use App\Http\Requests\Unit\UpdateUnitRequest;
use App\Http\Resources\UnitResource;
use App\Models\Unit;

class UnitController extends Controller
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
        $unit=Unit::all();
//        return ApiResponse::success(UnitResource::collection($unit),'This is all units',201);
        return view('admin.units.index', compact('unit'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.units.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUnitRequest $request)
    {
        $unit             =new Unit();
        $unit->name       =$request->input('name');
        $unit->abbreviation=$request->input('abbreviation');
        $unit->save();
//        return ApiResponse::success(UnitResource::make($unit),'Unit Created Successfully',201);
        return redirect()->route('admin.units.index')->with('success', 'تمت إضافة الوحدة بنجاح');
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
    public function edit(Unit $unit)
    {
        return view('admin.units.edit',compact('unit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUnitRequest $request, Unit $unit)
    {
       $unit->update([
           'name'        => $request->filled('name')            ? $request->name        : $unit->name,
           'abbreviation'=> $request->filled('abbreviation')    ? $request->abbreviation: $unit->abbreviation,

       ]);
//            return ApiResponse::success(UnitResource::make($unit),'Unit Updated successfully',201);
        return redirect()->route('admin.units.index')->with('success', 'تم تحديث الواحدة بنجاح!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit)
    {
        $unit->delete();
//        return ApiResponse::success(null,'Unit Deleted Successfully',201);
        return redirect()->route('admin.units.index')->with('success', 'تم الحذف بنجاح');
    }
}
