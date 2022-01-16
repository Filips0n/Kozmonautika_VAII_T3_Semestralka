<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    use HasFactory;
    protected $with = ["country"];
    public $timestamps = false;
    protected $fillable = [
        "country_id", "name"
    ];
    public function rockets(){
        return $this->hasMany(Rocket::class);
    }
    public function country(){
        return $this->belongsTo(Country::class);
    }
}
