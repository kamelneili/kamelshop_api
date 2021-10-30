<?php
namespace App\Http\Controllers;
use App\Http\Resources\CartResource;
use App\Http\Resources\OffreResource;

use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Offre;
use function PHPUnit\Framework\isNull;

class CartController extends Controller
{
    public function index()
    {
        $user = Auth::User();
        $cart = $user->cart;
        $cartItems=json_decode($cart->cart_items);
        $finalCartItems=[];
        foreach($cartItems as $cartItem){
            $product=Product::find(intval($cartItem->product->id));
            $finalCartItem=new \stdClass();
            $finalCartItem->product= new ProductResource($product);
            $finalCartItem->qty=$cartItem->qty;
            array_push($finalCartItems, $finalCartItem);
        }
        return [
            'cart_items'=>$finalCartItems,
            'id'=>$cart->id,
            'total'=>$cart->total
        ];
    }
    public function index2()
    {
        $user = Auth::User();
        $cart = $user->cart;
        var_dump($cart);

        $cartItems=json_decode($cart->cart_items);
        $finalCartItems=[];
        foreach($cartItems as $cartItem){
            $offre=Offre::find(intval($cartItem->offre->id));
            $finalCartItem=new \stdClass();
            $finalCartItem->offre= new OffreResource($offre);
            $finalCartItem->qty=$cartItem->qty;
            array_push($finalCartItems, $finalCartItem);
        }
        return [
            'cart_items'=>$finalCartItems,
            'id'=>$cart->id,
            'total'=>$cart->total
        ];
    }
    public function addOffreToCart(Request $request)
    {
        $user = Auth::User();
        $offre_id = $request->input("offre_id");
        $qty = $request->input("qty");
        $offre = Offre::find($offre_id);
        $cart = $user->cart;
        if (is_null($cart)) {
            $cart = new Cart();
            $cart->user_id = $user->id;
            $cart->cart_items = [];
            $cart->total = 0;
         //  var_dump($cart->user_id);
        }

        if ($cart->inItems($offre_id)) {
            // var_dump($product);
            print('yes');

            $cart->increaseOffreInCart($offre, $qty);
        } else {
             $cart->addOffreToCart($offre, $qty);

        }
       // var_dump($cart);
        $cart->save();
        $user->cart_id = $cart->id;
        $user->save();
        return $cart;
        // return new CartResource($cart);
    }
    public function addProductToCart(Request $request)
    {
        //print($request);
        $user = Auth::User();
        $product_id = $request->input("product_id");
        $qty = $request->input("qty");
        $product = Product::find($product_id);
        $cart = $user->cart;
        if (is_null($cart)) {
            $cart = new Cart();
            $cart->user_id = $user->id;
            $cart->cart_items = [];
            $cart->total = 0;
         //  var_dump($cart->user_id);
        }

        if ($cart->inItems($product_id)) {
            // var_dump($product);
            print('yes');

            $cart->increaseProductInCart($product, $qty);
        } else {
             $cart->addProductToCart($product, $qty);

        }
       // var_dump($cart);
        $cart->save();
        $user->cart_id = $cart->id;
        $user->save();
        return $cart;
        // return new CartResource($cart);
    }

    private function checkCartStatus(Cart $cart = null)
    {
        if (is_null($cart)) {
            $cart = new Cart();
            $cart->total = 0;
            $cart->cart_items = [];
            return $cart;
        } else
            return $cart;
    }
}
