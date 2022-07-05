@extends('../layout')

{{-- @section('slide')
    @include('pages.slide')
@endsection --}}

@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Trang chủ</a></li>
        <li class="breadcrumb-item"><a href="{{ url('the-loai/' .$truyen_breadcrumb->theloai->slug_theloai) }}">{{ $truyen_breadcrumb->theloai->tentheloai }}</a></li>
        <li class="breadcrumb-item"><a href="{{ url('danh-muc/' .$truyen_breadcrumb->category->slug_danhmuc) }}">{{ $truyen_breadcrumb->category->tendanhmuc }}</a></li>
        <li class="breadcrumb-item " aria-current="page">{{ $truyen_breadcrumb->tentruyen }}</li>
        <li class="breadcrumb-item active"><a href="{{ url('xem-chapter/'.$chapter->slug_chapter)}}">{{ $chapter->tieude }}</a></li>
    </ol>
</nav>
<div class="row">
    <div class="col-md-12">
        <h4>{{ $chapter->truyen->tentruyen }}</h4>
        <p>Chương hiện tại: {{ $chapter->tieude }}</p>

        <div class="col-md-5">
                <div class="form-group">
                    <select name="select-chapter" class="custom-select select-chapter">
                        @foreach ($all_chapter as $key=>$chap)
                            <option value="{{ url('xem-chapter/'.$chap->slug_chapter)}}">{{ $chap->tieude }}</option>
                        @endforeach
                    </select>
            </div>
        </div>

        <style type="text/css">
            .isDisabled{
                color: currentColor;
                pointer-events: none;
                opacity: 0.5;
                text-decoration: none;
            }
        </style>
        <div class="d-flex justify-content-between  mt-3">
            <p><a class="btn btn-outline-primary p-2-left {{ $chapter->id == $min_id->id ? 'isDisabled': '' }}" href="{{ url('xem-chapter/'.$previous_chapter) }}">Tập trước</a></p>
            <p><a class="btn btn-outline-primary p-2-right {{ $chapter->id == $max_id->id ? 'isDisabled': '' }}" href="{{ url('xem-chapter/'.$next_chapter) }}">Tập sau</a></p>
        </div>

        <div class="noidungchuong mt-4 breadcrumb">
            {!! $chapter->noidung !!}
        </div>

            <div class="form-group mt-2">
                <label for="exampleInputEmail1">Chọn chương</label>
                <select name="select-chapter" class="custom-select select-chapter">
                    @foreach ($all_chapter as $key=>$chap)
                        <option value="{{ url('xem-chapter/'.$chap->slug_chapter)}}">{{ $chap->tieude }}</option>
                    @endforeach  
                </select>
            </div>
            
        </div>
        
    </div>
</div>

@endsection