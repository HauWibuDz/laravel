<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::search()->paginate(5)->withQueryString();
        return view('admin.product.index',compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.product.add',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' =>'required|unique:products|min:3',
            'price' =>'required|numeric|min:1',
            'file' =>'required|mimes:jqg,png,web'

        ],[
            'name.required' =>'Tên không được để rỗng',
            'name.unique' =>$request->name.'đã tồn tại',
            'name.unique.required' =>$request->name.'đã tồn tại',
            'price.required' =>'Giá không được để rỗng',
            'price.numeric' =>'Không đúng định dạng',
            'price.numeric.required' =>'Không đúng định dạng',
            'price.min' =>'Giá không nhỏ hơn 1',
            'price.min.required' =>'Giá không nhỏ hơn 1',
            'file.required' => 'Ảnh không đuợc để rỗng',
            'file.mimes' => 'Ảnh không đúng định dạng',
            'file.mimes.required' => 'Ảnh không đúng định dạng'
        ]);

        if($request->has('file')){
            $file = $request->file;
            $file_name = $file->getClientOriginalName();
            $file->move(public_path('uploads'),$file_name);
        }

        try {
            $request->merge(['image' => $file_name]);
            Product::create($request->all());
            return redirect()->route('product.index')->with('success', 'Thêm mới thành công');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $product = Product::find($id);
        // $categories = Category::all();
        // return view('product.show',compact('product','categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return view('admin.product.edit',compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        $req->validate([
            'name' =>'required|min:3|unique:products,name,'.$id,
            'price' =>'required|numeric|min:1',
            'file' =>'mimes:jqg,png,web'

        ],[
            'name.required' =>'Tên không được để rỗng',
            'name.unique' =>$req->name.'đã tồn tại',
            'name.unique.required' =>$req->name.'đã tồn tại',
            'price.required' =>'Giá không được để rỗng',
            'price.numeric' =>'Không đúng định dạng',
            'price.numeric.required' =>'Không đúng định dạng',
            'price.min' =>'Giá không nhỏ hơn 1',
            'price.min.required' =>'Giá không nhỏ hơn 1',
            'file.mimes' => 'Ảnh không đúng định dạng',
            'file.mimes.required' => 'Ảnh không đúng định dạng'
        ]);
        $product = Product::find($id);
        $file_name = $product->image;
        if($req->has('file')){
            $file = $req->file;
            $file_name = $file->getClientOriginalName();
            $file->move(public_path('uploads'),$file_name);
        }

        try {
            $req->merge(['image' => $file_name]);
            Product::find($id)->update($req->all());
            return redirect()->route('product.index')->with('success', 'Cập nhật thành công');
        } catch (\Throwable $th) {
            return redirect()->route('product.index')->with('error', "Không thể cập nhật danh mục");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        try {
            $product->delete();
            return redirect()->route('product.index')->with('success', 'Xóa thành công');
        } catch (\Throwable $th) {
            return redirect()->route('product.index')->with('error', "Không thể xóa danh mục");
        }
    }
    public function softDelete()
    {
        $product = Product::onlyTrashed()->get();
        return view('admin.product.softDelete',compact('product'));
    }
    public function restore($id)
    {
        try{
            Product::withTrashed()->find($id)->restore();
            return redirect()->route('product.index');
        } catch (\Throwable $th) {
            throw $th; 
        }
    }
    public function forceDelete($id)
    {
        try{
            Product::withTrashed()->find($id)->forceDelete();
            return redirect()->route('product.index');
        } catch (\Throwable $th) {
            throw $th; 
        }
    }
    
}
