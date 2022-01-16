<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpaceportImage extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $with = ["spaceport"];
    public function spaceport(){
        return $this->belongsTo(Spaceport::class);
    }
}
