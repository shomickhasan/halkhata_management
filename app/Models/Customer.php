<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Village;
use App\Models\Laid;

class Customer extends Model
{
    use HasFactory;
    protected $fillable=([
        'customer_name',
        'customer_relations',
        'slug',
        'village_id',
        'laids_id',
        'privious_total_due',
        'payment',
        'current_due',
        'status',
    ]);
    public function village(){
        return $this->belongsTo(Village::class,'village_id');
    }
    public function laid(){
        return $this->belongsTo(Laid::class,'laids_id');
    }
}
