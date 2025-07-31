<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\Document\StoreDoumentRequest;
use App\Http\Requests\Document\UpdateDoumentRequest;
use App\Http\Resources\DocumentResource;
use App\Http\Resources\PartnerResource;
use App\Models\Document;
use App\Models\Partner;
use App\Models\Warehouse;
use App\Models\WarehouseProduct;
use App\Models\WarehouseUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware(['auth', 'isManager'])->only('managerDocument');
        $this->middleware(['auth','isStaff'])->except('managerDocument');
    }
    public function index()
    {
        $user = auth()->user();
        $warehouseUser = $user->warehouseUser()->first();
        if (!$warehouseUser) {
            abort(403, 'أنت لا تملك صلاحية الوصول لأي مستودع.');
        }
        $document = Document::with(['warehouseUser.user', 'warehouseUser.warehouse', 'warehouseProduct.product', 'partner'])
            ->where('warehouse_user_id', $warehouseUser->id)
            ->get();
        return view('staff.document.index', compact('document'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $userId            =auth()->id();
        $warehouseUser    = WarehouseUser::with('warehouse','user')->where('user_id',$userId)->firstOrFail();
        $warehouseUserId  =$warehouseUser->id;
        $userName         =$warehouseUser->user->full_name;
        $warehouseName    =$warehouseUser->warehouse->name;
        $partner          = Partner::all();
        $warehouseProduct = WarehouseProduct::with('product')->get();
        return view('staff.document.create', compact('partner', 'warehouseUserId', 'warehouseProduct','userName','warehouseName'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDoumentRequest $request)
    {
        $document       = new Document();
        $document->type = $request->type;
        $document->notes= $request->notes;
        $document->date = $request->date;
        $document->warehouseUser()->associate($request->warehouse_user_id);
        $document->warehouseProduct()->associate($request->warehouse_product_id);
        if ($request->type !== 'waste') {
            $document->partner_id = $request->partner_id;
        }
        $document->save();
       // return ApiResponse::success(DocumentResource::make($document),'Document Created Successfully!',201);
        return redirect()->route('staff.documentLines.create', $document->id)
            ->with('success', 'تمت إضافة الفاتورة. الرجاء إدخال تفاصيلها.');
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
    public function edit( Document $document)
    {
        $partner          = Partner::all();
        $warehouseProduct = WarehouseProduct::with('product')->get();
        $warehouseUser    = WarehouseUser::with(['user', 'warehouse'])->get();

        return view('staff.document.edit', compact('document', 'partner', 'warehouseProduct', 'warehouseUser'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDoumentRequest $request, Document $document)
    {
        $document->update([
            'type'                 =>$request->filled('type')                 ? $request->type                 :$document->type,
            'notes'                =>$request->filled('notes')                ? $request->notes                :$document->notes,
            'date'                 =>$request->filled('date')                 ? $request->date                 :$document->date,
            'warehouse_user_id'    =>$request->filled('warehouse_user_id')    ? $request->warehouse_user_id    :$document->warehouse_user_id,
            'warehouse_product_id' =>$request->filled('warehouse_product_id') ? $request->warehouse_product_id :$document->warehouse_product_id,
        ]);
        if ($request->type !== 'waste') {
            $document->update([
                'partner_id'   =>$request->filled('partner_id')  ? $request->partner_id   :$document->partner_id
            ]);
        }
      //  return ApiResponse::success(DocumentResource::make($document),'Documents Updated Successfully!',201);
        return redirect()->route('staff.documents.index')->with('success','تم تعديل الفاتورة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $document)
    {
        $document->delete();
//        return ApiResponse::success(null,'Document deleted successfully!',201);
        return redirect()->route('staff.documents.index')->with(['success','تم حف الفاتورة بنجاح']);
    }

}
