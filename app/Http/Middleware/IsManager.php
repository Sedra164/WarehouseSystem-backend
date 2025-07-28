<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class IsManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (!$user || $user->role !== 'manager') {
            abort(403, 'أنت لا تملك صلاحية مدير مستودع.');
        }
        $warehouseIds = DB::table('warehouse_users')
            ->where('user_id', $user->id)
            ->pluck('warehouse_id');
        if ($warehouseIds->isEmpty()) {
            abort(403, 'لم يتم تحديد مستودعك.');
        }
        $request->merge(['manager_warehouse_ids' => $warehouseIds]);
        return $next($request);
    }
}
