<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\DocumentLines\StoreDocumentLinesRequest;
use App\Http\Requests\DocumentLines\UpdateDocumentLinesRequest;
use App\Http\Resources\DocumentLinesResource;
use App\Models\DocumentLines;
use Illuminate\Http\Request;

class DocumentLinesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documentline=DocumentLines::with(['document'])->get();
        return ApiResponse::success(DocumentLinesResource::collection($documentline),'This is All DocumentLines ',201);
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
    public function store(StoreDocumentLinesRequest $request)
    {
        $documentLine             =new DocumentLines();
        $documentLine->quantity   =$request->input('quantity');
        $documentLine->unit_price =$request->input('unitPrice');
        $documentLine->total_price=$request->input('totalPrice');
        $documentLine->document()->associate($request->document_id);
        $documentLine->save();
        return ApiResponse::success(DocumentLinesResource::make($documentLine),'DocumentLines Created Successfully!',201);
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
    public function update(UpdateDocumentLinesRequest $request,  DocumentLines $documentLine)
    {
        $documentLine->update([
                'quantity'        => $request->filled('quantity')     ? $request->quantity    : $documentLine->quantity,
                'total_price'     => $request->filled('total_price')  ? $request->total_price : $documentLine->total_price,
                'unit_price'      => $request->filled('unit_price')   ? $request->unit_price  : $documentLine->unit_price,
                'document_id'     => $request->filled('document_id')  ? $request->document_id : $documentLine->document_id,
        ]);
        return ApiResponse::success(DocumentLinesResource::make($documentLine),'DocumentLines Updated Successfully!',201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DocumentLines $documentLine)
    {
        $documentLine->delete();
        return ApiResponse::success(null,'DocumentLine Deleted Successfully!',201);
    }
    public function managerDocumentLines($id)
    {
        $documentline = DocumentLines::with(['document'])->where('document_id', $id)->get();
        return view('manager.documentLine.managerDocumentLine', compact('documentline'));
    }
}
