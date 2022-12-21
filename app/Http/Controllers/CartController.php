<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Helper\Cart;
use App\Models\Category;
use App\Models\Order;

class CartController extends Controller
{
    public function add(Request $req, $id)
    {
        $product = Product::find($id);
        $cart = new Cart();
        $cart->add($product, $req->quantity);
        if ($cart) {
            // return redirect()->route('showcart')->with('success', 'Thêm mới thành công');
            return redirect()->back()->with('success', 'Thêm mới thành công');
        }
    }
    public function showCart(Request $req)
    {
        $cart = new Cart();
        $carts = $cart->getContent();
        // dd($cart);
        $product = Product::all();
        $categories = Category::all();
        return view('showcart', compact('product', 'categories', 'carts'));
    }
    public function update(Request $req,$id)
    {
        $cart = new Cart();
        $cart->update($id,$req->quantity);
        return redirect()->back()->with('success', 'Thêm mới thành công');
    }
    public function delete($id, Cart $cart)
    {
        $cart->delete($id);
        return redirect()->back()->with('success', 'Xóa thành công');
    }
}
