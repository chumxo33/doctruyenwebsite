<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $danhmuctruyen = Category::orderBy('id', 'DESC')->get();
        $count = $danhmuctruyen->count();

        return view('Admin.danhMucTruyen.index')->with(compact('danhmuctruyen', 'count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.danhMucTruyen.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $request->validate(
            [
            'tendanhmuc' => 'required|unique:categories|max:255', #unique:categories -> categories không trùng nhau
            'slug_danhmuc' => 'required|unique:categories|max:255',
            'motadanhmuc' =>'required|max:255',
            'kichhoat' => 'required',
            ],
            [
                'tendanhmuc.unique' => 'Tên danh mục đã có vui lòng điền tên khác',
                'slug_danhmuc.unique' => 'Slug danh mục đã có vui lòng điền slug khác',
                'tendanhmuc.required' => 'Tên danh mục phải có',
                'motadanhmuc.required' =>'Mô tả danh mục phải có',
            ]
        );
        $data = $request->all();
        $danhmuctruyen = new Category(); //khởi tạo category để insert
        $danhmuctruyen->tendanhmuc = $data['tendanhmuc']; 
        $danhmuctruyen->slug_danhmuc = $data['slug_danhmuc'];
        $danhmuctruyen->motadanhmuc = $data['motadanhmuc'];
        $danhmuctruyen->kichhoat = $data['kichhoat'];
        $danhmuctruyen->save();
        return redirect()->back()->with('success', 'Thêm danh mục thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $danhmuc = Category::find($id);
        return view('Admin.danhMucTruyen.edit')->with(compact('danhmuc'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data= $request->validate(
            [
            'tendanhmuc' => 'required|max:255', 
            'slug_danhmuc'=>'required|max:255',
            'motadanhmuc' =>'required|max:255',
            'kichhoat' => 'required',
            ],
            [
                'tendanhmuc.required' => 'Tên danh mục phải có',
                'slug_danhmuc.required' => 'Slug danh mục phải có',
                'motadanhmuc.required' =>'Mô tả danh mục phải có',
            ]
        );
        $data = $request->all();
        $danhmuctruyen = Category::find($id); // Tìm cái id để update
        $danhmuctruyen->tendanhmuc = $data['tendanhmuc'];
        $danhmuctruyen->slug_danhmuc = $data['slug_danhmuc'];
        $danhmuctruyen->motadanhmuc = $data['motadanhmuc'];
        $danhmuctruyen->kichhoat = $data['kichhoat'];
        $danhmuctruyen->save();
        return redirect()->back()->with('success', 'Cập nhật danh mục thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::find($id)->delete();
        return redirect()->back()->with('success', 'Xóa danh mục thành công');
    }
}
