<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseUser extends Model
{
    use HasFactory;
    protected $fillable=['type','warehouse_id','user_id'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function warehouse(){
        return $this->belongsTo(Warehouse::class);
    }
    public function notification(){
        return $this->hasMany(Notification::class,'warehouse_user_id');
    }
    public function document(){
        return $this->hasMany(Document::class,'user_id');
    }

}
