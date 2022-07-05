@extends('layouts.app')

@section('content')

@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Thêm Truyện Sách</div>
                {{-- Hiển thị thông báo --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                     @endif
                    {{-- Lưu danh mục --}}
                    <form method="POST" action="{{ route('truyen.update', [$truyen->id])}}" enctype="multipart/form-data"> 
                        @method('PUT')
                        @csrf   
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Tên Truyện</label>
                          <input 
                            type="text" 
                            class="form-control" 
                            name="tentruyen" 
                            {{-- old nó sẽ giữ tên danh mục đã có --}}
                            value="{{ $truyen->tentruyen }}" 
                            {{-- onkeyup có nghĩa có nhập vào --}}
                            onkeyup="ChangeToSlug();"
                            id="slug" 
                            aria-describedby="emailHelp"
                            placeholder="Tên"
                            >
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Tác giả</label>
                            <input 
                              type="text" 
                              class="form-control" 
                              name="tacgia" 
                              {{-- old nó sẽ giữ tên danh mục đã có --}}
                              value="{{ $truyen->tacgia }}" 
                              aria-describedby="emailHelp"
                              placeholder="Tác giả"
                              >
                          </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Slug Truyện</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                name="slug_truyen" 
                                value="{{ $truyen->slug_truyen }}"
                                id="convert_slug" 
                                aria-describedby="emailHelp"
                                placeholder="Slug truyện"
                                >
                        </div>
                        {{-- <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Thê Loại Truyện</label>
                            <select name="theloai" class="form-control" name="kichhoat">
                                @foreach ($theloai as $loai )
                                    <option {{ $loai->id==$truyen->theloai_id ? 'selected' : '' }} value="{{ $loai->id }}">{{ $loai->tentheloai }}</option> 
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Danh Mục Truyện</label>
                            <select name="danhmuc" class="form-control" name="kichhoat">
                                @foreach ($danhmuc as $muc )
                                    <option {{ $muc->id==$truyen->danhmuc_id ? 'selected' : '' }} value="{{ $muc->id }}">{{ $muc->tendanhmuc }}</option> 
                                @endforeach
                            </select>
                        </div> --}}
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Tóm Tắt Truyện</label>
                            <textarea name="tomtat" class="form-control" rows="5" style="resize: none">{{ $truyen->tomtat }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Hình Ảnh Truyện</label>
                            <input 
                                type="file" 
                                class="form-control-file" 
                                name="image" 
                            >
                            <img src="{{ asset('public/uploads/truyen/'.$truyen->image) }}" height="300" width="180">
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1">Danh Mục Truyện</label>
                            @foreach($danhmuc as $key=>$muc)
                                <div class="form-check">
                                    <input
                                    {{-- contains: chứa --}}
                                    {{-- ($muc->id) nó có chứa trong $thuocdanhmuc --}}
                                        @if( $thuocdanhmuc->contains($muc->id) ) 
                                            checked 
                                        @endif
                                        name="danhmuc[]" type="checkbox" id="danhmuc_{{ $muc->id }}" value="{{ $muc->id }}">
                                    <label class="form-check-label" for="danhmuc_{{$muc->id }}">{{ $muc->tendanhmuc }}</label>
                                </div>
                            @endforeach
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1">Thể Loại Truyện</label>
                            @foreach($theloai as $key=>$the)
                                <div class="form-check">
                                    <input 
                                        @if( $thuoctheloai->contains($the->id) ) 
                                            checked 
                                        @endif
                                        name="theloai[]" type="checkbox" id="theloai_{{ $the->id }}" value="{{ $the->id }}">
                                    <label class="form-check-label" for="theloai_{{$the->id }}">{{ $the->tentheloai }}</label>
                                </div>
                            @endforeach
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1">Kích Hoạt</label>
                            <select class="custom-select" name="kichhoat">
                                @if ($truyen->kichhoat==0)
                                    <option selected value="0">Kích hoạt</option>
                                    <option value="1">Không kích hoạt</option>
                                @else
                                    <option value="0">Kích hoạt</option>
                                    <option selected value="1">Không kích hoạt</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Lượt xem</label>
                            <input type="text" class="form-control" value="{{$truyen->views}}" name="views"  aria-describedby="emailHelp" placeholder="Lượt xem">
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1">Truyện nổi bật/hot</label>
                            <select class="custom-select" name="truyennoibat">
                                @if ($truyen->truyen_noibat==0)
                                    <option selected value="0">Truyện mới</option>
                                    <option value="1">Truyện nổi bật</option>
                                    <option value="2">Truyện xem nhiều</option>
                                @elseif($truyen->truyen_noibat==1)
                                    <option value="0">Truyện mới</option>
                                    <option selected value="1">Truyện nổi bật</option>
                                    <option value="2">Truyện xem nhiều</option>
                                @else
                                    <option value="0">Truyện mới</option>
                                    <option value="1">Truyện nổi bật</option>
                                    <option selected value="2">Truyện xem nhiều</option>
                                @endif
                            </select>
                        </div>
                        
                        <br>
                        <button name="themtruyen" type="submit" class="btn btn-primary">Cập Nhật Truyện</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
