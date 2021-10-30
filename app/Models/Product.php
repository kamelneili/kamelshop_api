<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        "title", "slug", "description",
        "price", "old_price",
        "image", "inStock", "category_id"
    ];

    public function getRouteKeyName()
    {
        return "slug";
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public static function searchp($key)
    {
        var_dump(Product::all()->where('title', 'like', '%' .$key. '%'));
        return Product::all()->where('title', 'like', '%' .$key. '%');
    }
}
