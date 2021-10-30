<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\CartItem;

use function PHPUnit\Framework\isNull;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'cart_items',
        'total',
        'user_id'
    ];
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // public function increaseOffreInCart(Offre $offre, $qty = 1)
    // {
    //     $cartItems = $this->cart_items;
    //     if (is_null($cartItems)) {
    //         $cartItems = [];
    //     } else {
    //         if (!is_array($cartItems))

    //             $cartItems = json_decode($cartItems);
    //     }
    //     foreach ($cartItems as $cartItem) {
    //         if ($cartItem->offre->id === $offre->id) {
    //            (String) $cartItem->qty += $qty;
    //         }
    //     }
    //     $this->cart_items = json_encode($cartItems);
    //     $tempTotal = 0;

    //     $this->total = $tempTotal;

    //     //return array cartItems
    // }
    // //
    // //  return $cartItems;

    // //

    // public function addOffreToCart(Offre $offre,$qty=1)
    // {
    //     $cartItems = $this->cart_items;
    //     if (is_null($cartItems)) {
    //         $cartItems = [];
    //     } else {
    //         if (!is_array($cartItems))

    //             $cartItems = json_decode($cartItems);
    //     }
    //     $cartItem = new CartItem($offre, $qty);
    //     array_push($cartItems, $cartItem);
    //     $this->cart_items = json_encode($cartItems);
    //     //  var_dump($cartItems);
    //     $tempTotal = 0;

    //     $this->total = $tempTotal;

    //    // $this->save();
    //     //  return $cartItems;
    // }

    // public function inItems2($offre_id){
    //     $cartItems = $this->cart_items;
    //     if (is_null($cartItems)) {
    //         $cartItems = [];
    //     } else {
    //         if (!is_array($cartItems)) {
    //             $cartItems = json_decode($cartItems);
    //         }
    //     }
    //     $returnResults = false;

    //     //print('yes');
    //     //var_dump($product_id);
    //     //var_dump($cartItem->product->id);
    //    // var_dump($returnResults);
    //     return $returnResults;
    // }
    // cart products
    //
    //
    public function increaseProductInCart(Product $product, $qty = 1)
    {
        $cartItems = $this->cart_items;
        if (is_null($cartItems)) {
            $cartItems = [];
        } else {
            if (!is_array($cartItems))

                $cartItems = json_decode($cartItems);
        }
        foreach ($cartItems as $cartItem) {
            if ($cartItem->product->id === $product->id) {
               (String) $cartItem->qty += $qty;
            }
        }
        $this->cart_items = json_encode($cartItems);
        $tempTotal = 0;
        foreach ($cartItems as $cartItem) {
            $tempTotal += ($cartItem->qty * $cartItem->product->price);
        }
        $this->total = $tempTotal;

        //return array cartItems
    }
    //
    public function removeProductFromCart(Product $product)
    {
    $cartItems = $this->cart_items;
    if (is_null($cartItems)) {
        $cartItems = [];
    } else {
        if (!is_array($cartItems))

            $cartItems = json_decode($cartItems);
    }
  //  $cartItem = new CartItem($product);
   // array_push($cartItems, $cartItem);
    $this->cart_items = json_encode($cartItems);
    //  var_dump($cartItems);
    $tempTotal = 0;
    foreach ($cartItems as $cartItem) {
        $tempTotal += ($cartItem->qty * $cartItem->product->price);
    }
    $this->total = $tempTotal;

    $this->save();
    //  return $cartItems;

    //
}
    public function addProductToCart(Product $product,$qty=1)
    {
        $cartItems = $this->cart_items;
        if (is_null($cartItems)) {
            $cartItems = [];
        } else {
            if (!is_array($cartItems))

                $cartItems = json_decode($cartItems);
        }
        $cartItem = new CartItem($product, $qty);
        array_push($cartItems, $cartItem);
        $this->cart_items = json_encode($cartItems);
        //  var_dump($cartItems);
        $tempTotal = 0;
        foreach ($cartItems as $cartItem) {
            $tempTotal += ($cartItem->qty * $cartItem->product->price);
        }
        $this->total = $tempTotal;

       // $this->save();
        //  return $cartItems;
    }

    public function inItems($product_id)
    {
        $cartItems = $this->cart_items;
        if (is_null($cartItems)) {
            $cartItems = [];
        } else {
            if (!is_array($cartItems)) {
                $cartItems = json_decode($cartItems);
            }
        }
        $returnResults = false;
        foreach($cartItems as $cartItem) {
            if ($product_id == $cartItem->product->id) {
                $returnResults = true;
            }
        }
        //print('yes');
        //var_dump($product_id);
        //var_dump($cartItem->product->id);
       // var_dump($returnResults);
        return $returnResults;
    }

}
