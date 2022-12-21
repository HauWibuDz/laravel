<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
class HomeController extends Controller
{
    public function home()
    {
        $product = Product::orderByDesc('id')->paginate(6);
        $categories = Category::all();
        return view('home',compact('product', 'categories'));
    }
    public function show($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return view('show',compact('product','categories'));
    }
    public function danhmuc($id)
    {
        $category = Category::find($id);
        $categories = Category::all();
        // $product = $category->products->get();
        return view('danhmuc',compact('categories', 'category'));
    }
}
