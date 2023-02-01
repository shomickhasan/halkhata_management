<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Village;


class Laid extends Model
{
    use HasFactory;
    protected $fillable = [
        'village_id',
        'laid_name',
        'laid_name',

    ];
    public function village(){
        return $this->belongsTo(Village::class,'village_id');
    }

}
