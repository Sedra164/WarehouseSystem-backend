<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;
    protected $fillable=['name','location','description'];
    public function warehouseUser(){
        return $this->hasMany(WarehouseUser::class,'warehouse_id');
    }
    public function warehouseProduct(){
        return $this->hasMany(WarehouseProduct::class,'warehouse_id');
    }
}
