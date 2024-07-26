<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\ProductVariant;
use http\Client\Curl\User;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //

    public function list() {}

    public function add(Request $request)
    {
//        dd($request->all());
        $product = Product::query()->where('id', $request->product_id)->first();
        $productVariant = ProductVariant::query()->where([
            'product_id' => $request->product_id,
            'product_size_id' => $request->product_size_id,
            'product_color_id' => $request->product_color_id
        ])->first();
        // giả định người đặt hàng là user 1
        $user = \App\Models\User::query()->first();

        $cart = Cart::query()->where('user_id', $user->id)->first();
        // kiểm tra chưa có giỏ hàng thì tạo mới
        if (empty($cart)) {
            $cart = Cart::query()->create(['user_id' => $user->id]);
        }

        // chuẩn bị data để lưu vào cartItem
        $data = [
            'product_variant_id' => $productVariant->id,
            'cart_id' => $cart->id,
            'quantity' => $request->quantity
        ];
        // kiểm tra nếu có product_variant_id thì phải cộng số lượng
        $cartItems = CartItem::query()->where('product_variant_id',  $productVariant->id)->first();
        if (empty($cartItems)) {
            CartItem::query()->create($data);
        } else {
            $data["quantity"] += $cartItems->quantity;
            $cartItems->update(["quantity" => $data["quantity"]]);
        }

        return redirect()->route('cart.list');
    }
}
