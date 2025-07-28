<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentLines extends Model
{
    use HasFactory;
    protected $fillable=['document_id','quantity','unit_price','total_price'];
    public function document(){
        return $this->belongsTo(Document::class);
    }

}
