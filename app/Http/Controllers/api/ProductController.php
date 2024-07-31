<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductModel;
use App\Models\PropertyModel;
use App\Models\ProductPropertyModel;
use App\Http\Resources\ProductResourse;
use Illuminate\Database\Eloquent\Builder;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $params = $request->get('properties');

        $products = ProductModel::whereHas('properties', function (Builder $query) use ($params) {
            foreach($params as $key => $value){
                $property = PropertyModel::where('name', $key)->first();
                $query->where(function (Builder $q) use($property, $value){
                    $q->where('property_id', $property->id)
                          ->where('value', $value);
                });
            }
        })->paginate(40);

        return ProductResourse::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = new ProductModel();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->save();

        return response()->json($product);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = ProductModel::find($id);
        //return ProductResourse::collection($product);
        return $product;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function storeProductProperty(Request $request)
    {
        $product_property = new ProductPropertyModel();

        $product_property->product_id = $request->product_id;
        $product_property->property_id = $request->property_id;
        $product_property->value = $request->value;
        $product_property->save();

        return response()->json($product_property);
    }
}
