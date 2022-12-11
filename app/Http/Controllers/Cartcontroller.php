<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class Cartcontroller extends Controller
{
    public function addProductToCart($id, $qty)
    {
        $product = Product::find($id);
        $cart = session()->get('cart') ?? [];
        $totalPrice = session()->get('total_price') ?? 0;

        //add product to cart
        $cart[$id]['qty'] = ($cart[$id]['qty'] ?? 0) + $qty;
        $cart[$id]['price'] = $product->price;
        $cart[$id]['name'] = $product->name;
        $cart[$id]['image'] = $product->image;
        $totalPrice += ($qty * $product->price);
        $amount = count($cart);

        session()->put('cart', $cart);
        session()->put('total_price', $totalPrice);
        session()->put('amount', $amount);
        return response()->json(['total_price' => number_format($totalPrice), 'amount' => $amount]);
    }
    public function shoppingCart()
    {
        //session()->flush();
        $cart = session()->get('cart') ?? [];
        return view('frontend.shopping-cart')->with('cart', $cart);
    }
    public function deleteCart()
    {
        session()->flush();
        return redirect()->route('shopping.cart');
    }
    public function deleteItemCart($id)
    {
        $cart = session()->get('cart') ?? [];


        //xoa cach 1
        // foreach ($cart as $idCart => $item) {
        //     if ($idCart == $id) {
        //         unset($cart[$idCart]);
        //     }
        // }
        //xoa cach 2
        if (array_key_exists($id, $cart)) {
            unset($cart[$id]);
        }
        session()->put('cart', $cart);
        return redirect()->route('shopping.cart');
    }
    public function checkoutCart()
    {
        $cart = session()->get('cart');
        return view('frontend.checkout')->with('cart', $cart);
    }
    public function updateCart(Request $request)
    {
        $cart = session()->get('cart') ?? [];
        $list = $request->list;
        foreach ($list as $item) {
            if (array_key_exists($item['id'], $cart)) {
                $cart[$item['id']]['qty'] = $item['qty'];
            }
        }
        session()->put('cart', $cart);
        return response()->json(['cart' => $cart]);
    }
}
