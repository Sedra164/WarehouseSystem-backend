<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\warehouseUser\StoreWarehouseUserRequest;
use App\Http\Requests\warehouseUser\UpdateWarehouseUserRequest;
use App\Http\Resources\WarehouseUserResource;
use App\Models\User;
use App\Models\Warehouse;
use App\Models\WarehouseUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class WarehousUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        if ($user->role === 'admin') {
            $warehouseUser = WarehouseUser::with(['user', 'warehouse'])
                ->where('type', 'manager')
                ->get();
            return view('admin.warehouseUser.index', compact('warehouseUser'));

        } elseif ($user->role === 'manager') {
            $warehouseIds = WarehouseUser::where('user_id', $user->id)
                ->where('type', 'manager')
                ->pluck('warehouse_id');
            $warehouseUser = WarehouseUser::with(['user', 'warehouse'])
                ->where('type', 'staff')
                ->whereIn('warehouse_id', $warehouseIds)
                ->get();
            return view('manager.warehouseUser.index', compact('warehouseUser'));

        } else {
            abort(403, 'ليست لديك صلاحية الوصول.');
        }
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        if ($user->role === 'admin') {
            $warehouse = Warehouse::all();
        return view('admin.warehouseUser.create',compact('warehouse'));
        }elseif ($user->role === 'manager') {
            $warehouseIds = WarehouseUser::where('user_id', $user->id)
                ->where('type', 'manager')
                ->pluck('warehouse_id');
            $warehouse = Warehouse::whereIn('id', $warehouseIds)->first();
            return view('manager.warehouseUser.create',compact('warehouse'));
        } else {
            abort(403, 'ليست لديك صلاحية الوصول.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWarehouseUserRequest $request)
    {
        $user                        = new User();
        $user->full_name             = $request->full_name;
        $user->email                 = $request->email;
        $user->password              = Hash::make($request->password);
        $user->save();
        $warehouseUser               = new WarehouseUser();
        $warehouseUser->user_id      = $user->id;
        if (auth()->user()->role === 'admin') {
            $warehouseUser->warehouse_id = $request->warehouse_id;
            $warehouseUser->type         = 'manager';
            $warehouseUser->save();
           // return ApiResponse::success(WarehouseUserResource::make($warehouseUser),'WarehouseUser Created Successfully! ',201);
            return redirect()->route('admin.warehouseUsers.index')->with('success', 'تم إضافة المدير وربطه بالمستودع بنجاح');
        }

        if (auth()->user()->role === 'manager') {
            $managerWarehouse = WarehouseUser::where('user_id', auth()->id())->where('type', 'manager')->first();
            if (!$managerWarehouse) {
                abort(403, 'ليس لديك صلاحية إضافة موظفين.');
            }
            $warehouseUser->warehouse_id = $managerWarehouse->warehouse_id;
            $warehouseUser->type         = 'staff';
            $warehouseUser->save();
            return redirect()->route('manager.warehouse_users.index')
                ->with('success', 'تم إضافة الموظف إلى المستودع بنجاح');
        }
        abort(403, 'صلاحية غير معروفة.');

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
    public function edit($id)
    {
        $user = auth()->user();
        $warehouseUser = WarehouseUser::with('user', 'warehouse')->findOrFail($id);
        if ($user->role === 'admin') {
            $warehouse=Warehouse::all();
            return view('admin.warehouseUser.edit', compact('warehouseUser','warehouse'));
        }
        if ($user->role === 'manager') {
            $isManager = WarehouseUser::where('user_id', $user->id)
                ->where('type', 'manager')
                ->where('warehouse_id', $warehouseUser->warehouse_id)
                ->exists();
            if ($isManager && $warehouseUser->type === 'staff') {
                return view('manager.warehouseUser.edit', compact('warehouseUser'));
            }
            abort(403, 'غير مصرح لك بالدخول.');
        }
        abort(403, 'غير مصرح لك بالدخول.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWarehouseUserRequest$request,$id)
   {
       $user = auth()->user();
       $warehouseUser = WarehouseUser::with('user')->findOrFail($id);
       if ($user->role === 'admin') {
           $warehouseUser->user->update([
               'full_name' => $request->filled('full_name') ? $request->full_name : $user->full_name,
               'email' => $request->filled('email') ? $request->email : $user->email,
               'password' => $request->filled('password') ? Hash::make($request->password) : $user->password,
           ]);
           $warehouseUser->update([
               'warehouse_id' => $request->filled('warehouse_id') ? $request->warehouse_id : $warehouseUser->warehouse_id,
           ]);
           // return ApiResponse::success(WarehouseUserResource::make($warehouseUser),'Manager Warehouse Updated!',201);
           return redirect()->route('admin.warehouseUsers.index')->with('success', 'تم التحديث بنجاح');
       } if ($user->role === 'manager') {
       $isManager = WarehouseUser::where('user_id', $user->id)
           ->where('type', 'manager')
           ->where('warehouse_id', $warehouseUser->warehouse_id)
           ->exists();
       if ($isManager && $warehouseUser->type === 'staff') {
           $warehouseUser->user->update([
               'full_name' => $request->filled('full_name') ? $request->full_name : $user->full_name,
               'email' => $request->filled('email') ? $request->email : $user->email,
               'password' => $request->filled('password') ? Hash::make($request->password) : $user->password,
           ]);
           return redirect()->route('manager.warehouse_users.index')->with('success', 'تم التعديل بنجاح');
       }
       abort(403, 'غير مصرح لك بالتعديل.');
   }
       abort(403, 'غير مصرح لك.');

   }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = auth()->user();
        $warehouseUser = WarehouseUser::where('id', $id)->with('user')->firstOrFail();
        if ($user->role === 'admin') {
            DB::table('warehouse_users')->where('user_id', $warehouseUser->user_id)->delete();
            $warehouseUser->user->delete();
            return redirect()->route('admin.warehouseUsers.index')->with('success', 'تم حذف مدير المستودع بنجاح');
        }
        if ($user->role === 'manager' && $warehouseUser->type === 'staff') {
            $isManager = WarehouseUser::where('user_id', $user->id)
                ->where('type', 'manager')
                ->where('warehouse_id', $warehouseUser->warehouse_id)
                ->exists();
            if ($isManager) {
                DB::table('warehouse_users')->where('user_id', $warehouseUser->user_id)->delete();
                $warehouseUser->user->delete();
                return redirect()->route('manager.warehouse_users.index')->with('success', 'تم حذف الموظف بنجاح');
            }
        }
        abort(403, 'غير مصرح لك بالحذف.');
    }
}
