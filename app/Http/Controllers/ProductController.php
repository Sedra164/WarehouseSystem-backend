<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Models\Unit;

class ProductController extends Controller
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

        $product=Product::with(['unit','category'])->paginate(20);
//        return ApiResponse::success(ProductResource::collection($product),'This is all products',201);
        return view('admin.products.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $units = Unit::all();
        return view('admin.products.create', compact('categories', 'units'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $product            =new Product();
        $product->name      =$request->input('name');
        $product->SKU       =$request->input('SKU');
        $product->description=$request->input('description');
        $product->unit()->associate($request->unit_id);
        $product->category()->associate($request->category_id);
        $product->save();
//        return ApiResponse::success(ProductResource::make($product),'Product Created Successfully',201);
        return redirect()->route('products.index')->with('success', 'تم إضافة المنتج بنجاح');
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
    public function edit(Product $product)
    {
        $categories = Category::all();
        $units = Unit::all();
        return view('admin.products.edit', compact('product', 'categories', 'units'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
      $product->update([
          'name'        => $request->filled('name')        ? $request->name        : $product->name,
          'SKU'         => $request->filled('SKU')         ? $request->SKU         : $product->SKU,
          'description' => $request->filled('description') ? $request->description : $product->description,
          'unit_id'     => $request->filled('unit_id')     ? $request->unit_id     : $product->unit_id,
          'category_id' => $request->filled('category_id') ? $request->category_id : $product->category_id,
      ]);
      //return ApiResponse::success(ProductResource::make($product),'Product Updated Successfully!',201);
      return redirect()->route('products.index')->with('success','تم تحديث المنتج بنجاح!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'تم الحذف بنجاح');
//        return ApiResponse::success(null,'Product Deleted Successfully',201);
    }
}
