<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable=['warehouse_product_id','user_id','current_quantity'];
    public function warehouseUser(){
        return $this->belongsTo(WarehouseUser::class);
    }
    public function warehouseProduct(){
        return $this->belongsTo(WarehouseProduct::class);
    }
}
