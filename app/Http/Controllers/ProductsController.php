<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    public function __construct()
    {
        // Require authentication for all except index and show
        $this->middleware('auth')->except(['index']);
        // Only admin can create, update, delete
        $this->middleware('admin')->except(['index', 'purchaseForm', 'purchase']);
    }

    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity_available' => 'required|integer|min:0',
        ]);

        Product::create($request->only('name', 'price', 'quantity_available'));

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function purchaseForm(Product $product)
    {
        return view('products.purchase', compact('product'));
    }

    public function purchase(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $quantity = $request->input('quantity');

        try {
            $product->purchase(Auth::id(), $quantity);
            return redirect()->route('products.index')->with('success', 'Purchase successful!');
        } catch (\Exception $e) {
            return back()->withErrors(['quantity' => $e->getMessage()]);
        }
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}
