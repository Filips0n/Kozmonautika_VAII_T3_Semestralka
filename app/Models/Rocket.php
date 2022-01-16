<?php

namespace App\Models;

use App\Models\Manufacturer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rocket extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        "manufacturer_id", "image", "name", "human_rated", "payload", "height"
    ];
    public function manufacturer(){
        return $this->belongsTo(Manufacturer::class);
    }
}
