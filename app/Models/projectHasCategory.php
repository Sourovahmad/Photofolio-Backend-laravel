<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class projectHasCategory extends Model
{
    use HasFactory;


    public function singleCategory()
    {
        return $this->belongsTo(category::class, 'category_id', 'id')->get();
    }
}
