<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable=['name','SKU','description','unit_id','category_id'];
    public function warehouseProduct(){
        return $this->hasMany(WarehouseProduct::class,'product_id');
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function unit(){
        return $this->belongsTo(Unit::class);
    }


}
