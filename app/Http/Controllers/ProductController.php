<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
class ProductController extends Controller
{
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(10);
       // var_dump($products);

       // return view('home')->with([
       //     "products" => Product::latest()->paginate(10),
        //    "categories" => Category::has("products")->get(),
      //  ]);
        return ProductResource::collection( $products );
    }
    public function search($query)
    {
         $products = Product::where('title', 'like', "%$query%")
                         
                           ->paginate(5)
                        ;

        return ProductResource::collection( $products );
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("admin.products.create")->with([
            "categories" => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation
        $this->validate($request, [
            "title" => "required|min:3",
            "description" => "required|min:5",
            "image" => "required|image|mimes:png,jpg,jpeg|max:2048",
            "price" => "required|numeric",
            "category_id" => "required|numeric",
        ]);

        //add data
        if ($request->has("image")) {
            $file = $request->image;
            $imageName = "images/products/" . time() . "_" . $file->getClientOriginalName();
            $file->move(public_path("images/products"), $imageName);
            $title = $request->title;

            Product::create([
                "title" => $title,
                "slug" => Str::slug($title),
                "description" => $request->description,
                "price" => $request->price,
                "old_price" => $request->old_price,
                "inStock" => $request->inStock,
                "category_id" => $request->category_id,
                "image" => $imageName,
            ]);
            return redirect()->route("admin.products")
                ->withSuccess("Product added");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
        return view("products.show")->with([
            "product" => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
        return view("admin.products.edit")->with([
            "product" => $product,
            "categories" => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //validation
        $this->validate($request, [
            "title" => "required|min:3",
            "description" => "required|min:5",
            "image" => "image|mimes:png,jpg,jpeg|max:2048",
            "price" => "required|numeric",
            "category_id" => "required|numeric",
        ]);

        //update data
        if ($request->has("image")) {
            $image_path = public_path("images/products/" . $product->image);
            if (File::exists($image_path)) {
                unlink($image_path);
            }
            $file = $request->image;
            $imageName = "images/products/" . time() . "_" . $file->getClientOriginalName();
            $file->move(public_path("images/products"), $imageName);
            $product->image = $imageName;
        }
        $title = $request->title;
        $product->update([
            "title" => $title,
            "slug" => Str::slug($title),
            "description" => $request->description,
            "price" => $request->price,
            "old_price" => $request->old_price,
            "inStock" => $request->inStock,
            "category_id" => $request->category_id,
            "image" =>  $product->image,
        ]);
        return redirect()->route("admin.products")
            ->withSuccess("Product updated");
    }

   
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //delete data
        $image_path = public_path("images/products/" . $product->image);
        if (File::exists($image_path)) {
            unlink($image_path);
        }
        $product->delete();
        return redirect()->route("admin.products")
            ->withSuccess("Product deleted");
    }
}
