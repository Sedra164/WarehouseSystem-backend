<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseProduct extends Model
{
    use HasFactory;
    protected $fillable=['warehouse_id','product_id','quantity','min_quantity'];
    public function warehouse(){
        return $this->belongsTo(Warehouse::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function document(){
        return $this->hasMany(Document::class,'warehouse_product_id');
    }
    public function notification(){
        return $this->hasMany(Notification::class,'warehouse_product_id');
    }
}
