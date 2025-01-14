<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Models\ProductModel;

class ProductCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->transform(function (ProductModel $product) {
                return new ProductResourse($product);
            }),
            'meta' => [
                'total_products' => $this->collection->count(),
            ],
        ];
    }
}
