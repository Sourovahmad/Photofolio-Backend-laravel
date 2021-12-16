<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class project extends Model
{
    use HasFactory;

    public function categories()
    {
       return $this->hasMany(projectHasCategory::class, 'project_id', 'id');
    }

    public function user()
    {
      return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function contents()
    {
       return $this->hasMany(projectHasContent::class, 'project_id', 'id');
    }

    public function projectWithCategory($category_id)
    {
      return $this->hasMany(projectHasCategory::class, 'project_id', 'id')->where('category_id', $category_id);
    }

   

}
