<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class CategoryController extends Controller
{
    public function index()
    {
        $cats = Category::paginate(4);
        return new CategoryResource( $cats );
    }
	public function products( $id ){
        $category = Category::find( $id );
        $products = $category->products()->paginate( 5 );
        return  ProductResource::collection( $products );
    }
    public function create()
    {
        //
        return view("admin.categories.create")->with([
            "categories" => Category::all()
        ]);
    }
    public function store(Request $request)
{

        //validation
        $this->validate($request, [
            "title" => "required|min:3",
            "slug" => "required|min:5",
            "image" => "required|image|mimes:png,jpg,jpeg|max:2048",
        ]);

        //add data
        if ($request->has("image")) {
            $file = $request->image;
            $imageName = "images/products/" . time() . "_" . $file->getClientOriginalName();
            $file->move(public_path("images/categories"), $imageName);
            $title = $request->title;

            Category::create([
                "title" => $title,
                "slug" => Str::slug($title),
                "image" => $imageName,
            ]);
            return redirect()->route("admin.categories")
                ->withSuccess("Category added");
        }

}
}
