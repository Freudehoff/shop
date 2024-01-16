<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreRequest;
use App\Models\ColorProduct;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductTag;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $productImages = $data['product_images'];
        $name = md5(Carbon::now() . '_' . $data['preview_image']->getClientOriginalName()) . '.' . $data['preview_image']->getClientOriginalExtension();
        $data['preview_image'] = Storage::disk('public')->putFileAs('/images', $data['preview_image'], $name);
        $tagsIds = $data['tags'];
        $colorsIds = $data['colors'];
        unset($data['tags'], $data['colors'], $data['product_images']);

        $product = Product::firstOrCreate([
            'title' => $data['title']
        ], $data);

        foreach ($tagsIds as $tagsId) {
            ProductTag::firstOrCreate([
                'product_id' => $product->id,
                'tag_id' => $tagsId,
            ]);
        }

        foreach ($colorsIds as $colorsId) {
            ColorProduct::firstOrCreate([
                'product_id' => $product->id,
                'color_id' => $colorsId,
            ]);
        }

        foreach ($productImages as $productImage) {
            $currentImages = ProductImage::where('product_id', $product->id)->get();
            if (count($currentImages) > 3) continue;
            $nameGallery = md5(Carbon::now() . '_' . $productImage->getClientOriginalName()) . '.' . $productImage->getClientOriginalExtension();
            $filePath = Storage::disk('public')->putFileAs('/images', $productImage, $nameGallery);
            ProductImage::create([
                'product_id' => $product->id,
                'file_path' => $filePath,
            ]);
        }

        return redirect()->route('product.index');
    }
}
