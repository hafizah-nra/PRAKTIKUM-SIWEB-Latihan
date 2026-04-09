<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display shopping cart
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = $this->calculateTotal($cart);

        return view('user.cart', [
            'cart' => $cart,
            'total' => $total,
        ]);
    }

    /**
     * Add product to cart
     */
    public function add(product $product, Request $request)
    {
        $quantity = $request->input('quantity', 1);
        $cart = session()->get('cart', []);

        // Check if product already in cart
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'description' => $product->description,
                'quantity' => $quantity,
            ];
        }

        session()->put('cart', $cart);

        return redirect()
            ->back()
            ->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    /**
     * Update cart item quantity
     */
    public function update(Request $request, $productId)
    {
        $quantity = $request->input('quantity', 1);
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            if ($quantity <= 0) {
                unset($cart[$productId]);
            } else {
                $cart[$productId]['quantity'] = $quantity;
            }
            session()->put('cart', $cart);
        }

        return redirect()
            ->back()
            ->with('success', 'Keranjang berhasil diperbarui!');
    }

    /**
     * Remove product from cart
     */
    public function remove($productId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }

        return redirect()
            ->back()
            ->with('success', 'Produk berhasil dihapus dari keranjang!');
    }

    /**
     * Clear entire cart
     */
    public function clear()
    {
        session()->forget('cart');

        return redirect()
            ->back()
            ->with('success', 'Keranjang berhasil dikosongkan!');
    }

    /**
     * Calculate cart total
     */
    private function calculateTotal($cart)
    {
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }
}
