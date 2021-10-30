<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return
        [
            'id'=>$this->id,
             'cart_id'=>$this->cart_id,
             'status'=>$this->status,
             'total'=>$this->total,

             'code'=>$this->code,
             'created_at' =>$this->created_at->format('jS F Y h:i:s A')
        ];
    }
}
