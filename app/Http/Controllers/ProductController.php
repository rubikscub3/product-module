<?php

namespace App\Http\Controllers;

use App\Events\ProductCreated;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::query();

        // Filter products by name
        if ($request->filled('name')) {
            $products->where('name', 'LIKE', "%{$request->input('name')}%");
        }

        // Filter products by added_by
        if ($request->filled('added_by')) {
            $products->where('added_by', 'LIKE', "%{$request->input('added_by')}%");
        }

        $products = $products->latest()->paginate();

        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive',
            'type' => 'required|in:item,service',
            'added_by_name' => 'required|string|max:255',
            'added_by_email' => 'required|email|max:255',
        ]);

        $product = Product::create($validatedData);

        // Fire ProductCreated event
        event(new ProductCreated($product));

        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'price' => 'sometimes|required|numeric|min:0',
            'status' => 'sometimes|required|in:active,inactive',
            'type' => 'sometimes|required|in:item,service',
        ]);

        $product->update($validatedData);

        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json(null, 204);
    }
}
