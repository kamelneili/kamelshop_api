<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\OffreResource;
use App\Models\Offre;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class CategoryController extends Controller
{
    public function index()
    {
        $cats = Category::paginate(4);
        return new CategoryResource( $cats );
    }
	public function offres( $id ){
        $category = Category::find( $id );
        $offres = $category->offres()->paginate( 8 );
        return  OffreResource::collection( $offres );
    }
    public function products( $id ){
        $category = Category::find( $id );
        $products = $category->products()->paginate( 5 );
        return  ProductResource::collection( $products );
    }
}
