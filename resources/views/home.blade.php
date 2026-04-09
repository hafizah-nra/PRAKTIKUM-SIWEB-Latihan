@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="hero-section">
    <h1>Welcome, {{ Auth::user()->name }}!</h1>
    <p>Enjoy shopping our amazing products</p>
</div>

<div class="grid-layout">
    @forelse (\App\Models\product::all() as $product)
        <div class="product-card">
            <h3>{{ $product->name }}</h3>
            <p class="description">{{ $product->description }}</p>
            <p class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            <p class="stock">Stock: {{ $product->stock }}</p>
            
            <div class="product-categories">
                <strong>Categories:</strong>
                <div class="category-tags">
                    @foreach ($product->categories as $category)
                        <span class="category-tag">{{ $category->name }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    @empty
        <p class="empty-state">No products available.</p>
    @endforelse
</div>
@endsection
