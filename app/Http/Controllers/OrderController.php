<?php
namespace App\Http\Controllers;
use App\Http\Resources\OrderResource;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Order;
class OrderController extends Controller
{
    public function index()
    {
        $user = Auth::User();

        $orders = Order::paginate(12)->where('user_id',$user->id);
        return OrderResource::collection( $orders );
    }

public function addOrder(Request $request)
{

    $user = Auth::User();
    $cart_id = $request->input("cart_id");
    $order_date=$request->input("order_date");
    $total=$request->input("total");
   // $qty = $request->input("qty");
    //$product = Product::find($product_id);
    $order = $user->order;
    if (is_null($order)) {
        $order = new Order();
        $order->user_id = $user->id;
        $order->cart_id = $cart_id;
        $order->order_date=$order_date;
        $order->code=uniqid();
        $order->total=$total;
     //  var_dump($cart->user_id);
    }


   // var_dump($cart);
    $order->save();
   // $user->order_id = $order->id;
    $user->save();
    return $order;
    // return new CartResource($cart);


}

}
