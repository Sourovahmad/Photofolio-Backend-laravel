<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class item extends Model
{
    use HasFactory;

    public function images()
    {
       return $this->hasMany( image::class, 'image_id', 'id')->get();
    }
}
