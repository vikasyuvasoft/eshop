<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function subcategory(){
    	return $this->hasMany(SubCategory::class,'cat_id');
    }

     public function product(){
      return $this->hasManyThrough(Product::class, SubCategory::class,'cat_id','sub_cat_id','id','id');
    }
}
