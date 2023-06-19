<?php

namespace App\Models;

use App\Models\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $table = "categories";
    protected $guarded = [];

    public function getIsActiveAttribute($is_active){
        return  $is_active ? 'فعال' : 'غیر فعال' ;
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'attribute_category');
    }

    public function parent(){

        return $this->belongsTo(Category::class , 'parent_id') ;
    }

    public function children(){

        return $this->hasMany(Category::class , 'parent_id') ;
    }
}
