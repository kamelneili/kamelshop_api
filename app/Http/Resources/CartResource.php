<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
                        parent::toArray($request);

     //   return [
                //parent::toArray($request);
     //   'cart_items'=>CartItemsResource::collection($this->cartItems),
     //   ];
    }
}
