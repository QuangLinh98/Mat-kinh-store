<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class CartsController extends Controller
{


    public function addToCard($id)
    {

        $product = DB::table('product')->where('product_id', $id)->first();


        $cart = session()->get('cart');
        if (isset($cart[$id])) {

            $cart[$id]['quantity'] = $cart[$id]['quantity'] + 1;
        } else {
            $price = intval($product->product_price);

            $cart[$id] = [
                'name' => $product->product_name,
                'price' => $price,
                'img' => $product->product_image,
                'quantity' => 1
            ];
        }

        session()->put('cart', $cart);
        $carts = session()->get('cart');
        return response()->json([
            'code' => 200,
            'message' => 'sussces',
            'data' => $carts
        ], 200);
    }
    public function showCart()
    {

        $carts = session()->get('cart');
        return view('client.cart', compact('carts'));
    }
    public function upDateCart(Request $request)
    {


        if ($request->id && $request->quantity) {
            $carts = session()->get('cart');


            $carts[$request->id]['quantity'] = $request->quantity;

            session()->put('cart', $carts);
            $cartComponent = view('client.cart_component', compact('carts'))->render();

            return response()->json(['cart_component' => $cartComponent, 'data' => $carts, 'code' => 200], 200);
        }
    }
    public function deleteCartById(Request $request)
    {

        // Xác định sản phẩm cần xóa
        $carts = session('cart', []);
        $productToRemove = $request->id; // Chuyển đổi sang chuỗi nếu cần

        // Xóa sản phẩm khỏi mảng
        if (isset($carts[$productToRemove])) {
            unset($carts[$productToRemove]);
        }


        // Cập nhật lại giỏ hàng trong session
        session(['cart' => $carts]);

        // Render view với mảng cập nhật
        $cartComponent = view('client.cart_component', compact('carts'))->render();

        return response()->json(['cart_Component' => $cartComponent, 'data' => $carts, 'code' => 200], 200);
    }
    public function getTotal()
    {
        $carts = session()->get('cart');
        return view('checkout.CheckOut', compact('carts'));
    }
}
