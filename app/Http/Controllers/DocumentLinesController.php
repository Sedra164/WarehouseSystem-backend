<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\DocumentLines\StoreDocumentLinesRequest;
use App\Http\Requests\DocumentLines\UpdateDocumentLinesRequest;
use App\Http\Resources\DocumentLinesResource;
use App\Models\Document;
use App\Models\DocumentLines;
use App\Models\Product;
use Illuminate\Http\Request;

class DocumentLinesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $documentline=DocumentLines::with(['document'])->where('document_id', $id)->get();
      //  return ApiResponse::success(DocumentLinesResource::collection($documentline),'This is All DocumentLines ',201);
        return view('staff.documentLine.index',compact('documentline'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Document $document)
    {
        $product  = $document->warehouseProduct->product->name ?? 'اسم غير معروف';
        return view('staff.documentLine.create', compact('document', 'product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDocumentLinesRequest $request)
    {
        $documentLine             =new DocumentLines();
        $documentLine->quantity   =$request->input('quantity');
        $documentLine->unit_price =$request->input('unit_price');
        $documentLine->total_price=$request->input('total_price');
        $documentLine->document()->associate($request->document_id);
        $documentLine->save();
      //  return ApiResponse::success(DocumentLinesResource::make($documentLine),'DocumentLines Created Successfully!',201);
        return redirect()->route('staff.documents.index', $request->document_id)
            ->with('success', 'تمت إضافة سطر جديد. يمكنك إدخال المزيد من التفاصيل.');
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
    public function edit( DocumentLines $documentLine)
    {
        return view('staff.documentLine.edit',compact('documentLine'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDocumentLinesRequest $request,  DocumentLines $documentLine)
    {
        $documentLine->update([
                'quantity'        => $request->filled('quantity')     ? $request->quantity    : $documentLine->quantity,
                'total_price'     => $request->filled('total_price')  ? $request->total_price : $documentLine->total_price,
                'unit_price'      => $request->filled('unit_price')   ? $request->unit_price  : $documentLine->unit_price,

        ]);
       // return ApiResponse::success(DocumentLinesResource::make($documentLine),'DocumentLines Updated Successfully!',201);
        return redirect()->route('staff.documents.index')->with('success','تم تعديل تفاصيل الفاتورة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        //
    }

}
