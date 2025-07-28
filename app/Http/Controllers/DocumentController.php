<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\Document\StoreDoumentRequest;
use App\Http\Requests\Document\UpdateDoumentRequest;
use App\Http\Resources\DocumentResource;
use App\Http\Resources\PartnerResource;
use App\Models\Document;
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
    }
    public function index()
    {
        $document=Document::with(['warehouseUser.user', 'warehouseUser.warehouse', 'warehouseProduct.product','partner'])->get();
        return ApiResponse::success(DocumentResource::collection($document),'This is All Documents',201);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        return ApiResponse::success(DocumentResource::make($document),'Document Created Successfully!',201);
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
    public function edit(string $id)
    {
        //
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
        return ApiResponse::success(DocumentResource::make($document),'Documents Updated Successfully!',201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $document)
    {
        $document->delete();
        return ApiResponse::success(null,'Document deleted successfully!',201);
    }
    public function managerDocument()
    {
        $userId = auth()->id();
        $warehouseUserIds = WarehouseUser::where('user_id', $userId)->pluck('id');
        $document = Document::with([
            'warehouseUser.user',
            'warehouseUser.warehouse',
            'warehouseProduct.product',
            'partner'
        ])->whereIn('warehouse_user_id', $warehouseUserIds)->get();
        return view('manager.document.managerDocument', compact('document'));
    }

}
