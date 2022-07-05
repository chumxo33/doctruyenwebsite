@extends('layouts.app')

@section('content')

@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Thêm Thể Loại Truyện</div>
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
                    <form method="POST" action="{{ route('theloai.store') }}" enctype="multipart/form-data"> 
                        @csrf   
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Tên Thể Loại</label>
                          <input 
                            type="text" 
                            class="form-control" 
                            name="tentheloai" 
                            {{-- old nó sẽ giữ tên danh mục đã có --}}
                            value="{{ old('tentheloai') }}" 
                            {{-- onkeyup có nghĩa có nhập vào --}}
                            onkeyup="ChangeToSlug();"
                            id="slug" 
                            aria-describedby="emailHelp"
                            placeholder="Tên"
                            >
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Slug Thể Loại</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                name="slug_theloai" 
                                {{-- old nó sẽ giữ mô tả danh mục đã có --}}
                                value="{{ old('slug_theloai') }}"
                                id="convert_slug" 
                                aria-describedby="emailHelp"
                                placeholder="Slug thể loại"
                                >
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Mô Tả Thể Loại</label>
                            <input 
                              type="text" 
                              class="form-control" 
                              name="mota" 
                              {{-- old nó sẽ giữ tên danh mục đã có --}}
                              value="{{ old('mota') }}" 
                              id="exampleInputEmail1" 
                              aria-describedby="emailHelp"
                              placeholder="Mô tả"
                              >
                          </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1">Kích Hoạt</label>
                            <select class="custom-select" name="kichhoat">
                                <option value="0">Kích hoạt</option>
                                <option value="1">Không kích hoạt</option>
                            </select>
                        </div>
                        <br>
                        <button type="submit" name="themtheloai" class="btn btn-primary">Thêm</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
