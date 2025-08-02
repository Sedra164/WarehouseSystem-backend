<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\DocumentLines;
use App\Models\Partner;
use App\Models\WarehouseProduct;
use App\Models\WarehouseUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MDashboardController extends Controller
{
    public function managerDashboard()
    {
        $partnersCount = Partner::count();
        $warehouseProductsCount = WarehouseProduct::count();
        $documentsCount = Document::count();


        $partnersStats = Partner::selectRaw('type, COUNT(*) as total')->groupBy('type')->get()
            ->pluck('total','type')->toArray();

        $docsStats = Document::selectRaw('type, COUNT(*) as total')->groupBy('type')->get()
            ->pluck('total','type')->toArray();

        $monthly = Document::selectRaw('MONTH(created_at) as m, COUNT(*) as total')
            ->groupBy('m')->orderBy('m')->get();
        $monthlyStats = ['months'=> $monthly->pluck('m'), 'counts'=>$monthly->pluck('total')];

        $topProducts = DB::table('document_lines')
            ->join('documents','document_lines.document_id','=','documents.id')
            ->join('warehouse_products', 'documents.warehouse_product_id', '=', 'warehouse_products.id')
            ->join('products', 'warehouse_products.product_id', '=', 'products.id')
            ->select('products.name', DB::raw('SUM(document_lines.quantity) as total_quantity'))
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('total_quantity')
            ->limit(5)
            ->get();
        $productNames = $topProducts->pluck('name');
        $productQuantities = $topProducts->pluck('total_quantity');

        return view('manager.dashboard', compact(
            'partnersCount','warehouseProductsCount','documentsCount',
            'partnersStats','docsStats','monthlyStats','productNames','productQuantities'
        ));
    }

}
