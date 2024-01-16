<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\UpdateRequest;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Product $product)
    {
        $data = $request->validated();
        if (isset($data['preview_image'])) {
            $name = md5(Carbon::now() . '_' . $data['preview_image']->getClientOriginalName()) . '.' . $data['preview_image']->getClientOriginalExtension();
            $data['preview_image'] = Storage::disk('public')->putFileAs('/images', $data['preview_image'], $name);
        }

        $tagsIds = $data['tags'] ?? [];
        $colorsIds = $data['colors'] ?? [];

        unset($data['tags'], $data['colors']);

        $product->update($data);
        $product->tags()->sync($tagsIds);
        $product->colors()->sync($colorsIds);

        $tags = $product->tags;
        $colors = $product->colors;

        return view('product.show', compact('product', 'tags', 'colors'));
    }
}
