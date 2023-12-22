<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ShowController extends Controller
{
    public function __invoke(Product $product)
    {
        $tags = $product->tags;
        $colors = $product->colors;

        return view('product.show', compact('product', 'tags','colors'));
    }
}
