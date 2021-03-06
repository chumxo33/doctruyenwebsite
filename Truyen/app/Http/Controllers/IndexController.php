<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Truyen;
use App\Models\Chapter;
use App\Models\Theloai;
use App\Models\Thuocdanhmuc;
use App\Models\Thuoctheloai;

class IndexController extends Controller
{   
    // public function __construct()
    // {
    //     $this->middleware('permission:publish category|edit category|delete category|add category',['only'=>['index', 'show']]);
    //     $this->middleware('permission:add category',['only'=>['create','store']]);
    //     $this->middleware('permission:edit category',['only'=>['edit','update']]);
    //     $this->middleware('permission:delete category',['only'=>['destroy']]);
    // }
    
    public function timkiem(){
        $theloai = Theloai::orderBy('id', 'DESC')->get();
        $danhmuc = Category::orderBy('id', 'DESC')->get();

        $tukhoa = $_GET['tukhoa'];
        $truyen = Truyen::with('thuocnhieudanhmuctruyen', 'thuocnhieutheloaitruyen')->where('tentruyen', 'LIKE', '%'.$tukhoa.'%')
                                                                                    ->orWhere('tacgia', 'LIKE', '%'.$tukhoa.'%')
                                                                                    ->get();
        return view('pages.timkiem')->with(compact('danhmuc', 'truyen', 'theloai', 'tukhoa'));
    }

    public function home(){
        $theloai = Theloai::orderBy('id', 'DESC')->get();
        $danhmuc = Category::orderBy('id', 'DESC')->get();

        $slide_truyen = Truyen::with('thuocnhieudanhmuctruyen', 'thuocnhieutheloaitruyen')->orderBy('id', 'DESC')->where('kichhoat', 0)->take(8)->get();

        $truyen = Truyen::with('thuocnhieudanhmuctruyen', 'thuocnhieutheloaitruyen')->orderBy('id', 'DESC')->where('kichhoat', 0)->paginate(8);
        
        return view('pages.home')->with(compact('danhmuc', 'truyen', 'theloai', 'slide_truyen',));
    
    }

    public function theloai($slug){
        $theloai = Theloai::orderBy('id', 'DESC')->get();
        $danhmuc = Category::orderBy('id', 'DESC')->get();
         //L???y ra 1 trong b???ng Theloai
        $theloai_id = Theloai::where('slug_theloai', $slug)-> first();  
        // dd($theloai_id->id);
        
        $theloaitruyen = Theloai::find($theloai_id->id);
        //dd( $theloaitruyen->nhieutheloaitruyen);
        $nhiutruyen = [];
        foreach($theloaitruyen->nhieutheloaitruyen as $the){
            $nhiutruyen[] = $the->id;
           // echo $nhiutruyen[] = $the->id;
        }

        $tentheloai = $theloai_id->tentheloai;

        //whereIn ktra gi?? tr??? id vs m???ng
        $truyen = Truyen::with('thuocnhieudanhmuctruyen', 'thuocnhieutheloaitruyen')->orderBy('id', 'DESC')->where('kichhoat', 0)->whereIn('id',$nhiutruyen)->paginate(8);
        return view('pages.theloai')->with(compact('danhmuc','truyen','tentheloai', 'theloai'));
    }

    public function danhmuc($slug){
        $theloai = Theloai::orderBy('id', 'DESC')->get();
        $danhmuc = Category::orderBy('id', 'DESC')->get();
        //L???y ra 1 trong b???ng category
        $danhmuc_id = Category::where('slug_danhmuc', $slug)-> first();
        
        $danhmuctruyen = Category::find($danhmuc_id->id);
        // dd($danhmuctruyen->nhieutruyen);
        $nhiutruyen = [];
        foreach($danhmuctruyen->nhieutruyen as $danh){
            $nhiutruyen[] = $danh->id;
            //echo $nhiutruyen[] = $danh->id;
        }

        $tendanhmuc = $danhmuc_id->tendanhmuc;
        //whereIn ktra gi?? tr??? id vs m???ng
        $truyen = Truyen::with('thuocnhieudanhmuctruyen', 'thuocnhieutheloaitruyen')->orderBy('id', 'DESC')->where('kichhoat', 0)->whereIn('id',$nhiutruyen)->paginate(8);
        //dd($truyen);
        return view('pages.danhmuc')->with(compact('danhmuc','truyen','tendanhmuc', 'theloai'));
    }

    public function xemtruyen($slug){

        $theloai = Theloai::orderBy('id', 'DESC')->get();
        $danhmuc = Category::orderBy('id', 'DESC')->get();
           
        $truyen = Truyen::with('thuocnhieudanhmuctruyen', 'thuocnhieutheloaitruyen')->where('slug_truyen',$slug)->where('kichhoat',0)->first();
        // l???y ra t???t c??? chapter
        $chapter = Chapter::with('truyen')->orderBy('id', 'ASC')->where('truyen_id',$truyen->id)->get();
        //dd($chapter);

        // xem chapter c???a truy???n ???? 
        $chapter_dau = Chapter::with('truyen')->where('truyen_id',$truyen->id)->orderBy('id', 'ASC')->first();//l???y tr??n  
        $chapter_moinhat = Chapter::with('truyen')->where('truyen_id',$truyen->id)->orderBy('id', 'DESC')->first(); //l???y d?????i 
        
        $nhiutruyen = [];
        foreach($truyen->thuocnhieudanhmuctruyen as $danh){
            $nhiutruyen = $danh->id;
           //echo $nhiutruyen = $danh->id;
        }
        // L???y ra nh???ng truy???n c?? c??ng danh m???c
        $cungdanhmuc = Category::with('nhieutruyen')->where('id',$nhiutruyen)->take(10)->get(); 
        //echo($cungdanhmuc);

        $truyennoibat = Truyen::where('truyen_noibat', 1)->take(20)->get();
        $truyenxemnhieu = Truyen::where('truyen_noibat', 2)->take(20)->get();

        return view('pages.truyen')->with(compact('danhmuc','truyen', 'chapter', 
                                                  'cungdanhmuc', 'chapter_dau', 'theloai', 
                                                  'truyennoibat', 'truyenxemnhieu', 'chapter_moinhat'));
    }

    public function xemchapter($slug){

        $theloai = Theloai::orderBy('id', 'DESC')->get();
        $danhmuc = Category::orderBy('id', 'DESC')->get();

        // L???y ra slug_chapter thay v?? l???y id t??? chapter
        $truyen = Chapter::where('slug_chapter',$slug)->first();
        //dd($truyen->truyen_id); 

         //breadcrumb
         $truyen_breadcrumb = Truyen::with('category', 'theloai')->where('id',$truyen->truyen_id)->first();

        // l???y n???i dung truy???n
        $chapter = Chapter::with('truyen')->where('slug_chapter',$slug)->where('truyen_id',$truyen->truyen_id)->first();
    
        //L???y t???t c??? s??? ch????ng 	
        $all_chapter = Chapter::with('truyen')->where('truyen_id',$truyen->truyen_id)->orderBy('id','ASC')->get();

        $next_chapter = Chapter::where('truyen_id', $truyen->truyen_id)->where('id', '>', $chapter->id)->min('slug_chapter');
        //L???y id cao ho???c th???p nh???t c???a trong chapter
        $max_id = Chapter::where('truyen_id', $truyen->truyen_id)->orderBy('id', 'DESC')->first();  //l???y d?????i 
        //dd($max_id->id);
        $min_id = Chapter::where('truyen_id', $truyen->truyen_id)->orderBy('id', 'ASC')->first();  //l???y tr??n  
        //dd($min_id);
        // ch????ng sau
        $previous_chapter = Chapter::where('truyen_id', $truyen->truyen_id)->where('id', '<', $chapter->id)->max('slug_chapter');

        return view('pages.chapter')->with(compact('danhmuc','chapter','all_chapter', 
                                                    'next_chapter', 'previous_chapter',
                                                    'max_id', 'min_id', 'theloai', 
                                                    'truyen_breadcrumb'));

    }

}
