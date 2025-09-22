<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ApiProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->only('destroy');
    }

    public function index()
    {
        return response()->json(Product::all());
    }

    public function show(Product $product)
    {
        return response()->json($product);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['message' => 'Product deleted successfully']);
    }
}
