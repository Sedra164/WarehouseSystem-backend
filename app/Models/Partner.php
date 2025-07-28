<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;
    protected $fillable=['name','type','phone','email','address'];
    public function document(){
        return $this->hasMany(Document::class,'partner_id');
    }
}
