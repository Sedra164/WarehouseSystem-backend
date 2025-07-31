<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class isStaff
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        // تأكد أن المستخدم موجود ومصنف كـ "staff"
        if (!$user || $user->role !== 'staff') {
            return abort(403, 'أنت لست موظفًا.');
        }

        // جلب أول مستودع مرتبط بهذا الموظف
        $warehouseUser = $user->warehouseUser()->first();

        if (!$warehouseUser) {
            return abort(403, 'أنت لست موظفًا في أي مستودع.');
        }

        // بإمكانك تخزين بيانات المستودع في الريكوست إن حبيت تستخدمها لاحقاً
        $request->merge([
            'warehouse_id' => $warehouseUser->warehouse_id
        ]);

        return $next($request);
    }
}
