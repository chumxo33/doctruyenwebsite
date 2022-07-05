<?php

namespace App\Http\Controllers;

use App\Models\Theloai;
use Illuminate\Http\Request;

class TheloaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $theloaitruyen = TheLoai::orderBy('id', 'DESC')->get();
        $count = $theloaitruyen->count();

        return view('Admin.theloai.index')->with(compact('theloaitruyen', 'count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.theloai.create');
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
            'tentheloai' => 'required|unique:theloais|max:255',
            'slug_theloai' => 'required|unique:theloais|max:255',
            'mota' =>'required|max:300',
            'kichhoat' => 'required',
            ],
            [
                'tentheloai.unique' => 'Tên thể loại đã có vui lòng điền tên khác',
                'slug_theloai.unique' => 'Slug thể loại đã có vui lòng điền slug khác',
                'tentheloai.required' => 'Tên thể loại phải có',
                'mota.required' =>'Mô tả thể loại phải có',
            ]
        );
        $data = $request->all();
        $theloaitruyen = new Theloai();
        $theloaitruyen->tentheloai = $data['tentheloai'];
        $theloaitruyen->slug_theloai = $data['slug_theloai'];
        $theloaitruyen->mota = $data['mota'];
        $theloaitruyen->kichhoat = $data['kichhoat'];
        $theloaitruyen->save();
        return redirect()->back()->with('success', 'Thêm thể loại thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Theloai  $theloai
     * @return \Illuminate\Http\Response
     */
    public function show(Theloai $theloai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Theloai  $theloai
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $theloaitruyen = Theloai::find($id);
        return view('Admin.theloai.edit')->with(compact('theloaitruyen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Theloai  $theloai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data= $request->validate(
            [
            'tentheloai' => 'required|max:255', 
            'slug_theloai'=>'required|max:255',
            'mota' =>'required|max:300',
            'kichhoat' => 'required',
            ],
            [
                'tentheloai.required' => 'Tên thể loại phải có',
                'slug_theloai.required' => 'Slug thể loại phải có',
                'mota.required' =>'Mô tả thể loại phải có',
            ]
        );
        $data = $request->all();
        $theloaitruyen = Theloai::find($id); // Tìm cái id để update
        $theloaitruyen->tentheloai = $data['tentheloai'];
        $theloaitruyen->slug_theloai = $data['slug_theloai'];
        $theloaitruyen->mota = $data['mota'];
        $theloaitruyen->kichhoat = $data['kichhoat'];
        $theloaitruyen->save();
        return redirect()->back()->with('success', 'Cập nhật thể loại thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Theloai  $theloai
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Theloai::find($id)->delete();
        return redirect()->back()->with('success', 'Xóa thể loại thành công');
    }
}
