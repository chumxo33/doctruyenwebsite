<?php

namespace App\Http\Controllers;

use App\Models\Truyen;
use Illuminate\Http\Request;
use App\Models\Category; 
use App\Models\TheLoai;
use App\Models\Thuocdanhmuc;
use App\Models\Thuoctheloai;

 
class TruyenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_truyen = Truyen::with(['thuocnhieudanhmuctruyen', 'thuocnhieutheloaitruyen'])->orderBy('id', 'DESC')->get();
        $count = $list_truyen->count();

        return view('Admin.Truyen.index')->with(compact('list_truyen', 'count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = Category::orderBy('id','DESC')->get();
        return view('Admin.Truyen.create')->with(compact('danhmuc', 'theloai' ));

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
            'tentruyen' => 'required|unique:truyens|max:255', #unique:categories -> categories không trùng nhau
            'tacgia' =>'required',
            'slug_truyen' => 'required|unique:truyens|max:255',
            'tomtat' =>'required',
            'kichhoat' => 'required',
            'truyennoibat' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|
                        dimensions:min_width=100, min_height=100, max_width=2000,max_height=2000',
            'danhmuc' => 'required',
            'views' =>'required',
            'theloai' => 'required'
            ],
            [
                'tentruyen.unique' => 'Tên truyện đã có vui lòng điền tên khác',
                'tentruyen.required' => 'Tên truyện phải có',
                'slug_truyen.unique' => 'Slug truyện đã có vui lòng điền slug khác',
                'slug_truyen.required' => 'Slug truyện phải có',
                'tomtat.required' =>'Tóm tắt truyện phải có',
                'tacgia.required' =>'Tác giả truyện phải có',
                'image.required' => ' Vui lòng chèn hình ảnh truyện ',
                'views.required' => 'Yêu cầu nhập lượt xem',
            ]
        );
        $data = $request->all();
        $truyen = new Truyen();
        $truyen->tentruyen = $data['tentruyen'];
        $truyen->tacgia = $data['tacgia'];
        $truyen->slug_truyen = $data['slug_truyen'];
        $truyen->tomtat = $data['tomtat'];
        $truyen->kichhoat = $data['kichhoat'];
        $truyen->views = $data['views'];
        $truyen->truyen_noibat = $data['truyennoibat'];

        // Lấy ra mảng data['danhmuc'] sau đó lấy danhmuc đầu tiên
        foreach($data['danhmuc'] as $key => $danh){ 
            $truyen->danhmuc_id = $danh[0];
        }
        foreach($data['theloai'] as $key => $the){ 
            $truyen->theloai_id = $the[0];
        }

        $get_image = $request->image;
        $path = 'public/uploads/truyen/';
        $get_name_image = $get_image->getClientOriginalName(); 
        $name_image = current(explode('.', $get_name_image )); //Lấy tên hình ảnh gắn định dạng 
        $new_image = $name_image.rand (0,99).'.'.$get_image->getClientOriginalExtension(); //Trả về đuôi mở rộng của file
        $get_image->move($path, $new_image);
        $truyen->image = $new_image;
    
        $truyen->save();

        // (n-n) thêm thuocnhieudanhmuctruyen cho 1 truyen dùng pthuc attach 
        $truyen->thuocnhieudanhmuctruyen()->attach($data['danhmuc']);
        $truyen->thuocnhieutheloaitruyen()->attach($data['theloai']);

        return redirect()->back()->with('success', 'Thêm truyện thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Truyen  $truyen
     * @return \Illuminate\Http\Response
     */
    public function show(Truyen $truyen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Truyen  $truyen
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $truyen = Truyen::find($id);
        $thuocdanhmuc = $truyen->thuocnhieudanhmuctruyen;
        $thuoctheloai = $truyen->thuocnhieutheloaitruyen;

        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = Category::orderBy('id','DESC')->get();
        return view('Admin.Truyen.edit')->with(compact('truyen','danhmuc', 'theloai', 'thuocdanhmuc', 'thuoctheloai'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Truyen  $truyen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate(
            [
            'tentruyen' => 'required|max:255', 
            'slug_truyen' => 'required|max:255',
            'tomtat' =>'required',
            'tacgia' =>'required',
            'kichhoat' => 'required',
            'theloai' => 'required',
            'danhmuc' => 'required',
            'views' => 'required',
            'truyennoibat' => 'required',
            ],
            [
                'tentruyen.required' => 'Tên truyện phải có',
                'slug_truyen.required' => 'Slug truyện phải có',
                'tomtat.required' =>'Tóm tắt truyện phải có',
                'tacgia.required' =>'Tác giả truyện phải có',
                'views.required' =>'Yêu cầu nhập lượt xem',
            ]
        );


       
        $truyen = Truyen::find($id);
        // (n-n) bất kìa id nào không nằm trong [ ] bị xóa ra khỏi trung gian
        $truyen->thuocnhieudanhmuctruyen()->sync($data['danhmuc']); 
        $truyen->thuocnhieutheloaitruyen()->sync($data['theloai']);

        $truyen->tentruyen = $data['tentruyen'];
        $truyen->tacgia = $data['tacgia'];
        $truyen->slug_truyen = $data['slug_truyen'];
        $truyen->tomtat = $data['tomtat'];
        $truyen->kichhoat = $data['kichhoat'];
        $truyen->views = $data['views'];
        $truyen->truyen_noibat = $data['truyennoibat'];
        
        foreach($data['danhmuc'] as $key => $danh){ 
            $truyen->danhmuc_id = $danh[0];
        }

        foreach($data['theloai'] as $key => $the){ 
            $truyen->theloai_id = $the[0];
        }
        
        $get_image = $request->image;
        if($get_image)
        {
            $path = 'public/uploads/truyen/'.$truyen->image;
            // xóa file đường dẫn truyền vào
            if(file_exists($path)){
                unlink($path);
            }
            $path = 'public/uploads/truyen/';
            $get_name_image = $get_image->getClientOriginalName(); 
            $name_image = current(explode('.', $get_name_image )); 
            $new_image = $name_image.rand (0,99).'.'.$get_image->getClientOriginalExtension(); 
            $get_image->move($path, $new_image);
            $truyen->image = $new_image;
        }
        
        $truyen->save(); 
        return redirect()->back()->with('success', 'Cập nhật  truyện thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Truyen  $truyen
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Tìm hình ảnh dựa vào cái id của truyện
        $truyen = Truyen::find($id);
        $path = 'public/uploads/truyen/'.$truyen->image;
        if(file_exists($path)){
            unlink($path);
        }
        $truyen->thuocnhieudanhmuctruyen()->detach($truyen->danhmuc_id);
        $truyen->thuocnhieutheloaitruyen()->detach($truyen->theloai_id);

        Truyen::find($id)->delete();
        return redirect()->back()->with('success', 'Xóa truyện thành công');
    }

}
