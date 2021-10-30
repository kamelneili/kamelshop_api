<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Category extends Model
{
    protected $fillable = ["title", "slug","cat_image"];

    public function getRouteKeyName()
    {
        return "slug";
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
