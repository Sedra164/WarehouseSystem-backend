<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Unit;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'isAdmin']);
    }

    public function index()
    {
        //من اجل حساب عدد المنتجات حسب التصنيف
        $productQuantitiesPerCategory = DB::table('warehouse_products')
            ->join('products', 'products.id', '=', 'warehouse_products.product_id')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->select('categories.name as category_name', DB::raw('SUM(warehouse_products.quantity) as total_quantity'))
            ->groupBy('categories.name')
            ->get();

//من اجل حساب النسبة المئوية لكمية المنتجات الموجودة في كل مخزن
        $productQuantitiesPerWarehouse = DB::table('warehouse_products')
            ->join('warehouses', 'warehouses.id', '=', 'warehouse_products.warehouse_id')
            ->select('warehouses.name as warehouse_name', DB::raw('SUM(warehouse_products.quantity) as total_quantity'))
            ->groupBy('warehouses.name')
            ->get();
        $totalQuantity = $productQuantitiesPerWarehouse->sum('total_quantity');
        $productQuantitiesPerWarehouse= $productQuantitiesPerWarehouse->map(function ($item) use ($totalQuantity) {
            $item->percentage = $totalQuantity > 0
                ? round(($item->total_quantity / $totalQuantity) * 100)
                : 0;
            return $item;
        });
//من اجل اظهار المنتجات الموجودة في مخزن معين في حال كانت الكمية الموجودة في المخزن تحت الحد الادنى
        $lowStockProducts = DB::table('warehouse_products')
            ->join('products', 'products.id', '=', 'warehouse_products.product_id')
            ->join('warehouses', 'warehouses.id', '=', 'warehouse_products.warehouse_id')
            ->whereColumn('warehouse_products.quantity', '<', 'warehouse_products.min_quantity')
            ->select(
                'products.name as product_name',
                'warehouses.name as warehouse_name',
                'warehouse_products.quantity',
                'warehouse_products.min_quantity'
            )
            ->get();
        return view('admin.dashboard', [
            'productCount'  =>Product::count(),
            'warehouseCount'=>Warehouse::count(),
            'unitCount'     =>Unit::count(),
            'categoryCount' =>Category::count(),
        ],compact('productQuantitiesPerCategory','productQuantitiesPerWarehouse','lowStockProducts') );


    }
}
