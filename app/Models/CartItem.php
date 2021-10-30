<?php

namespace App\Models;

// class CartItem
// {
//     public String $qty;
//     public $offre;
//     public function __construct(Offre $offre, String $qty)
//     {
//         $this->offre=$offre;
//         $this->qty=$qty;
//     }
// }

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

