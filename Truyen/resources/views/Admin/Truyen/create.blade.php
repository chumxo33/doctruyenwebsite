@extends('layouts.app')

@section('content')

@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Thêm Truyện Sách</div>
                {{-- Kiểm tra xem có lỗi nào không --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            {{-- Lấy toàn bộ lỗi --}}
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
                    <form method="POST" action="{{ route('truyen.store') }}" enctype="multipart/form-data"> 
                        @csrf   
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Tên Truyện</label>
                          <input 
                            type="text" 
                            class="form-control" 
                            name="tentruyen" 
                            {{-- old nó sẽ giữ tên danh mục đã có --}}
                            value="{{ old('tentruyen') }}" 
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
                              value="{{ old('tacgia') }}" 
                              {{-- onkeyup có nghĩa có nhập vào --}}
                              onkeyup="ChangeToSlug();"
                              id="slug" 
                              aria-describedby="emailHelp"
                              placeholder="tác giả"
                              >
                          </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Slug Truyện</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                name="slug_truyen" 
                                value="{{ old('slug_truyen') }}"
                                id="convert_slug" 
                                aria-describedby="emailHelp"
                                placeholder="Slug truyện"
                                >
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Tóm Tắt Truyện</label>
                            <textarea name="tomtat" class="form-control" rows="5" style="resize: none"></textarea>
                        </div>
                    
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Hình Ảnh Truyện</label>
                            <input type="file" class="form-control-file" name="image" >
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Danh Mục Truyện</label>
                            <br>
                            @foreach($danhmuc as $key=>$muc)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="danhmuc[]" type="checkbox" id="danhmuc_{{ $muc->id }}" value="{{ $muc->id }}">
                                    <label class="form-check-label" for="danhmuc_{{$muc->id }}">{{ $muc->tendanhmuc }}</label>
                                </div>
                            @endforeach
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Thể loại</label>
                            <br>
                            @foreach($theloai as $key=>$the)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="theloai[]" type="checkbox" id="theloai_{{ $the->id }}" value="{{ $the->id }}">
                                    <label class="form-check-label" for="theloai_{{ $the->id }}">{{ $the->tentheloai }}</label>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="mb-3">
                            <label for="exampleInputEmail1">Kích Hoạt</label>
                            <select class="custom-select" name="kichhoat">
                                <option value="0">Kích hoạt</option>
                                <option value="1">Không kích hoạt</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1">Lượt xem</label>
                            <input type="text" class="form-control" value="{{old('views')}}" name="views"  aria-describedby="emailHelp" placeholder="Lượt xem">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1">Truyện nổi bật/hot</label>
                            <select class="custom-select" name="truyennoibat">
                                <option value="0">Truyện mới</option>
                                <option value="1">Truyện nổi bật</option>
                                <option value="2">Truyện xem nhiều</option>
                            </select>
                        </div>
                        <br>
                        <button name="themtruyen" type="submit" class="btn btn-primary">Thêm Truyện</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
