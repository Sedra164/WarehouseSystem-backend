<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\Partner\StorePartnerRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\PartnerResource;
use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware(['auth', 'isManager']);
    }
    public function index()
    {
        $partner=Partner::all();
       // return ApiResponse::success(PartnerResource::collection($partner),'This All Partners',201);
        return view('manager.partner.index',compact('partner'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manager.partner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePartnerRequest $request)
    {
        $partner         =new Partner();
        $partner->name   =$request->input('name');
        $partner->email  =$request->input('email');
        $partner->phone  =$request->input('phone');
        $partner->address=$request->input('address');
        $partner->type   =$request->input('type');
        $partner->save();
      //  return ApiResponse::success(PartnerResource::make($partner),'Partner Created Successfully',201);
        return redirect()->route('manager.partners.index')->with('success', 'تمت إضافة الشريك بنجاح');
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
    public function edit( Partner $partner)
    {
        return view('manager.partner.edit', compact('partner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Partner $partner)
    {
        $partner->update([
            'name'   =>$request->filled('name')   ? $request->name   :$partner->name,
            'email'  =>$request->filled('email')  ? $request->email  :$partner->email,
            'phone'  =>$request->filled('phone')  ? $request->phone  :$partner->phone,
            'address'=>$request->filled('address')? $request->address:$partner->address,
            'type'   =>$request->filled('type')   ? $request->type   :$partner->type,
        ]);
        //return ApiResponse::success(PartnerResource::make($partner),'Partner Updated Successfully!',201);
        return redirect()->route('manager.partners.index')->with('success', 'تم تعديل الشريك بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partner $partner)
    {
        $partner->delete();
//        return ApiResponse::success(null,'Partner Deleted Successfully!',201);
        return redirect()->route('manager.partners.index')->with('success', 'تم الحذف بنجاح');
    }
}
