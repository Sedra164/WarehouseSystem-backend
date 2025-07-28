<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class CategoryController extends Controller
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
        $categories=Category::all();
        return view('admin.categories.index',compact('categories'));
//        return ApiResponse::success(CategoryResource::collection($categories),'This is all categories',201);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $categories             =new Category();
        $categories->name       =$request->input('name');
        $categories->description=$request->input('description');
        $categories->save();
//        return ApiResponse::success(CategoryResource::make($categories),'Category Created Successfully',201);
        return redirect()->route('categories.index')->with('success', 'تمت إضافة الصنف بنجاح!');
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
    public function edit(Category $category)
    {
        return view('admin.categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $categories)
    {
        $categories->update([
            'name'        => $request->filled('name')        ? $request->name        : $categories->name,
            'description' => $request->filled('description') ? $request->description : $categories->description,
        ]);
//            return ApiResponse::success(CategoryResource::make($categories), 'Category Updated Successfully', 201);
            return redirect()->route('categories.index')->with('success', 'تم تحديث الصنف بنجاح!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $categories)
    {
        $categories->delete();
//        return ApiResponse::success(null,'Category Deleted Successfully',201);
        return redirect()->route('categories.index')->with('success', 'تم الحذف بنجاح');
    }
}
