<?php

namespace App\Http\Controllers;

use App\Models\chapter;
use Illuminate\Http\Request;
use App\Models\Truyen;
class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_chapter = Chapter::with('truyen')->orderBy('id', 'DESC')->get();
        // dd($list_chapter);
        $count = $list_chapter->count();
        return view('Admin.chapter.index')->with(compact('list_chapter','count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $truyen =  Truyen::orderBy('id','DESC')->get();
        return view('Admin.chapter.create')->with(compact('truyen'));
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
            'tieude' => 'required|unique:chapters|max:255', #unique:categories -> categories không trùng nhau
            'slug_chapter' => 'required|unique:chapters|max:255',
            'tomtat' =>'required',
            'kichhoat' => 'required',
            'noidung'=>'required',
            'truyen_id' => 'required'
            ],
            [
                'tieude.unique' => 'Tiêu đề truyện đã có vui lòng điền tiêu đề khác',
                'tieude.required' => 'Tiêu đề truyện phải có',
                'slug_chapter.unique' => 'Slug chapter đã có vui lòng điền slug khác',
                'slug_chapter.required' => 'Slug chapter phải có',
                'tomtat.required' =>'Tóm tắt truyện phải có',
                'noidung.required' => ' Nôi dung chapter phải có '
            
            ]
        );
       $data = $request->all();
        $chapter = new Chapter();
        $chapter->tieude = $data['tieude'];
        $chapter->slug_chapter = $data['slug_chapter'];
        $chapter->tomtat = $data['tomtat'];
        $chapter->kichhoat = $data['kichhoat'];
        $chapter->noidung = $data['noidung'];
        $chapter->truyen_id = $data['truyen_id'];

        $chapter->save();
        return redirect()->back()->with('success', 'Thêm chapter thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function show(chapter $chapter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $chapter = Chapter::find($id);
        $truyen =  Truyen::orderBy('id','DESC')->get();
        return view('Admin.chapter.edit')->with(compact('truyen','chapter'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate(
            [
            'tieude' => 'required|max:255', #unique:categories -> categories không trùng nhau
            'slug_chapter' => 'required|max:255',
            'tomtat' =>'required',
            'kichhoat' => 'required',
            'noidung'=>'required',
            'truyen_id' => 'required'
            ],
            [
                'tieude.required' => 'Tiêu đề truyện phải có',
                'slug_chapter.required' => 'Slug chapter phải có',
                'tomtat.required' =>'Tóm tắt truyện phải có',
                'noidung.required' => ' Nôi dung chapter phải có '
            
            ]
        );
        $data = $request->all();
        // dd($data);
        $chapter = Chapter::find($id);
        $chapter->tieude = $data['tieude'];
        $chapter->slug_chapter = $data['slug_chapter'];
        $chapter->tomtat = $data['tomtat'];
        $chapter->kichhoat = $data['kichhoat'];
        $chapter->noidung = $data['noidung'];
        $chapter->truyen_id = $data['truyen_id'];

        $chapter->save();
        return redirect()->back()->with('success', 'Cập nhật chapter thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Chapter::find($id)->delete();
        return redirect()->back()->with('success', 'Xóa chapter thành công');
    }
}
