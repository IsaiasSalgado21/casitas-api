<?php

namespace App\Http\Controllers\Api;

use App\Helper\CommonHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::query()->paginate(5);

        return ProductResource::collection($products);
    }

    public function save(CreateProductRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['image'] = CommonHelper::uploadFile($request->file('image'), 'product');
        Product::query()->create($data);

        return response()->json(['message' => 'Product create successfuly'], 200);
    }

    public function show($id): JsonResponse|ProductResource
    {
        $product = Product::query()->find($id);
        if (! empty($product)) {
            return new ProductResource($product);
        }

        return response()->json(['message' => 'Product not found'], 404);
    }

    public function update($id, CreateProductRequest $request): JsonResponse
    {
        $data = $request->validated();

        $product = Product::query()->where('id', $id)->first();
        if (! empty($product)) {
            if ($request->hasFile('image')) {
                $data['image'] = CommonHelper::uploadFile($request->file('image'), 'product', $product->image);
            }
            $product->update($data);

            return response()->json(['message' => 'Product update successfully'], 200);
        }

        return response()->json(['message' => 'Product not found'], 404);
    }

    public function delete($id): JsonResponse
    {
        $product = Product::where('id', $id)->first();

        if (! empty($product)) {
            CommonHelper::removeOldFile('public/product/'.$product->image);
            $product->delete();

            return response()->json(['message' => 'Product delete successfully'], 200);
        }

        return response()->json(['message' => 'Product not found'], 404);
    }
}
