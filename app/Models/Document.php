<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $fillable=['type','warehouse_product_id','partner_id','user_id','date','notes'];
    public function partner(){
        return $this->belongsTo(Partner::class);
    }
    public function warehouseUser(){
        return $this->belongsTo(WarehouseUser::class);
    }
    public function documentLine(){
        return $this->hasMany(DocumentLines::class,'document_id');
    }
    public function warehouseProduct(){
        return $this->belongsTo(WarehouseProduct::class);
    }
    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($document){
        $document->documentLine()->delete();
        });
    }
}
