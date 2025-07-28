<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Requests\WarehouseProduct\StoreWarehouseProductRequest;
use App\Http\Resources\WarehouseProductResource;
use App\Models\Product;
use App\Models\Warehouse;
use App\Models\WarehouseProduct;
use App\Models\WarehouseUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class WarehousProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware(['auth', 'isManager']);
    }
    public function index(Request $request)
    {
        $warehouseIds     = $request->manager_warehouse_ids;
        $warehouseProduct = WarehouseProduct::whereIn('warehouse_id', $warehouseIds)
            ->with(['product', 'warehouse'])
            ->get();
      //  return ApiResponse::success(WarehouseProductResource::collection($warehouseProduct),'This is all product for this warehouse',201);
        return view('manager.WarehouseProduct.index', compact('warehouseProduct'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product     = Product::all();
        $warehouseId = DB::table('warehouse_users')
            ->where('user_id', auth()->id())
            ->value('warehouse_id');
        if (!$warehouseId) {
            abort(403, 'لا تملك صلاحية على أي مستودع.');
        }
        $warehouse = Warehouse::find($warehouseId);
        return view('manager.WarehouseProduct.create', compact('product', 'warehouse'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWarehouseProductRequest $request)
    {
        $userId = auth()->id();
        $warehouseId = DB::table('warehouse_users')
            ->where('user_id', $userId)
            ->value('warehouse_id');

        if (!$warehouseId) {
            abort(403, 'لا تملك صلاحية إضافة منتجات.');
        }
            $warehouseProduct  = new WarehouseProduct();
            $warehouseProduct->quantity     = $request->input('quantity');
            $warehouseProduct->min_quantity = $request->input('min_quantity');
            $warehouseProduct->warehouse()->associate($request->warehouse_id);
            $warehouseProduct->product()->associate($request->product_id);
            $warehouseProduct->save();
            return redirect()->route('manager.WarehouseProducts.index')->with('success', 'تمت إضافة المنتج إلى المستودع بنجاح.');
            //    return ApiResponse::success(WarehouseProductResource::make($warehouseProduct),'WarehouseProduct Created Successfully',201);

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
    public function edit(WarehouseProduct $warehouseProduct)
    {
        $product   = Product::all();
        $warehouse = Warehouse::all();
        return view('manager.WarehouseProduct.edit', compact('warehouseProduct', 'product', 'warehouse'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, WarehouseProduct $warehouseProduct)
    {
        $userId      = auth()->id();
        $warehouseId = DB::table('warehouse_users')
            ->where('user_id', $userId)
            ->value('warehouse_id');
        if (!$warehouseId) {
            abort(403, 'لا تملك صلاحية تعديل منتجات.');
        }
        $warehouseProduct->update([
            'product_id'   => $request->filled('product_id')    ? $request->product_id   : $warehouseProduct->product_id,
            'quantity'     => $request->filled('quantity')      ? $request->quantity     : $warehouseProduct->quantity,
            'min_quantity' => $request->filled('min_quantity')  ? $request->min_quantity : $warehouseProduct->min_quantity,
        ]);
        //    return ApiResponse::success(WarehouseProductResource::make($warehouseProduct),'WarehouseProduct Updated Successfully',201);
        return redirect()->route('manager.WarehouseProducts.index')->with('success', ' تم تعديل المنتج بنجاح.');

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WarehouseProduct $warehouseProduct)
    {
        $userId      = auth()->id();
        $warehouseId = DB::table('warehouse_users')
            ->where('user_id', $userId)
            ->value('warehouse_id');
        if (!$warehouseId) {
            abort(403, 'لا تملك صلاحية إضافة منتجات.');
        }
        $warehouseProduct->delete();
       // return ApiResponse::success(null,'WarehouseProduct Deleted Successfully',201);
        return redirect()->route('manager.WarehouseProducts.index')->with('success','تم الحذف بنجاح');

    }
}
