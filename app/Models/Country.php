<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $fillable = [
        "name", "agency_name", "prefix_rockets"
    ];
    public $timestamps = false;
    public function manufacturers(){
        return $this->hasMany(Manufacturer::class);
    }
    public function spaceports(){
        return $this->hasMany(Spaceport::class);
    }
}
