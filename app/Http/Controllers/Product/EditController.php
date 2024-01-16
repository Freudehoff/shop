<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\Group;
use App\Models\Product;
use App\Models\Tag;

class EditController extends Controller
{
    public function __invoke(Product $product)
    {
        $tags = Tag::all();
        $colors = Color::all();
        $categories = Category::all();
        $groups = Group::all();

        $product_tags = $product->tags;
        $product_colors = $product->colors;

        return view('product.edit', compact('product', 'categories','groups','tags','colors','product_tags','product_colors'));
    }
}
