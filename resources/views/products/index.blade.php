@extends('layouts.app')

@section('content')
<h1>Available Products</h1>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Price ($)</th>
            <th>Quantity Available</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>{{ number_format($product->price, 3) }}</td>
            <td>{{ $product->quantity_available }}</td>
            <td>
                @auth
                @if($product->quantity_available > 0)
                <a href="{{ route('products.purchaseForm', $product) }}" class="btn btn-primary btn-sm">Purchase</a>
                @else
                <span class="text-muted">Out Of Stock</span>
                @endif
                @if(Auth::user()->isAdmin())
                <form action="{{ route('products.destroy', $product) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                </form>
                @endif
                @else
                <a href="{{ route('login') }}" class="btn btn-secondary btn-sm">Login to Purchase</a>
                @endauth
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4">No products available.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection