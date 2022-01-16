<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spaceport extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $with = ["country"];
    protected $fillable = [
        "country_id", "name", "launches", "active_from", "latitude", "longitude"
    ];
    public function country(){
        return $this->belongsTo(Country::class);
    }
    public function spaceportImages(){
        return $this->hasMany(SpaceportImage::class);
    }
}
