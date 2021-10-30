<?php

namespace App\Models;

class CartItem
{
    public String $qty;
    public $product;
    public function __construct(Product $product, String $qty)
    {
        $this->product=$product;
        $this->qty=$qty;
    }
}
