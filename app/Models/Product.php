<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function subcategory(){
    	return $this->belongsTo(SubCategory::class,'sub_cat_id');
    }

    public function productImage()
    {
    	return $this->hasMany(ProductImage::class,'product_id');
    }


public function category(){
      return $this->hasManyThrough(Product::class, SubCategory::class,'cat_id','sub_cat_id','id','id');
    }
   

     public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
