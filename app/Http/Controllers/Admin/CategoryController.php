<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $categories = Category::search()->paginate(5)->withQueryString(); 
        return view('admin.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.add');
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
            'name' =>'required|min:2|unique:categories',
        ],[
            'name.required' =>'Tên không được để rỗng',
            'name.unique' =>$request->name.'đã tồn tại',
            'name.unique.required' =>$request->name.'đã tồn tại'
            
        ]);
        $categories = Category::create($request->all());
        if ($categories) {
            return redirect()->route('category.index')->with('success', 'Thêm mới thành công');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::find($id);
        return view('admin.category.edit',compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' =>'required|min:2|unique:categories,name,'.$id,
        ],[
            'name.required' =>'Tên không được để rỗng',
            'name.unique' =>$request->name.'đã tồn tại',
            'name.unique.required' =>$request->name.'đã tồn tại'
            
        ]);
        $categories = Category::find($id);
        try {
            $categories->update($request->all());
            return redirect()->route('category.index')->with('success', 'Cập nhật thành công');
        } catch (\Throwable $th) {
            return redirect()->route('category.index')->with('error', "Không thể cập nhật danh mục");
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
        $categories = Category::find($id);

        try {
            $categories->delete();
            return redirect()->route('category.index')->with('success', 'Xóa thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', "Không thể xóa danh mục $categories->name vì đã tồn tại trong book");
        }
    }
    public function softDelete()
    {
        $categories = Category::onlyTrashed()->get();
        return view('admin.category.softDelete',compact('categories'));
    }

    public function restore($id)
    {
        try{
            Category::withTrashed()->find($id)->restore();
            return redirect()->route('category.index');
        } catch (\Throwable $th) {
            throw $th; 
        }
    }
    
    public function forceDelete($id)
    {
        try{
            Category::withTrashed()->find($id)->forceDelete();
            return redirect()->route('category.index');
        } catch (\Throwable $th) {
            throw $th; 
        }
    }
}
