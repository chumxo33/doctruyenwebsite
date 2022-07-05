@extends('layouts.app')

@section('content')

@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cập Nhật Danh Mục Truyện</div>
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
                    <form method="POST" action="{{ route('danhmuc.update', [$danhmuc->id]) }}"> 
                        @method('PUT')
                        @csrf   
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Tên Danh Mục</label>
                          <input 
                            type="text" 
                            class="form-control" 
                            name="tendanhmuc" 
                            {{-- onkeyup có nghĩa có nhập vào --}}
                            onkeyup="ChangeToSlug();"
                            id="slug" 
                            aria-describedby="emailHelp"
                            value="{{ $danhmuc->tendanhmuc }}"
                            placeholder="Tên"
                            >
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Slug Danh Mục</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                name="slug_danhmuc" 
                                {{-- old nó sẽ giữ mô tả danh mục đã có --}}
                                value="{{ $danhmuc->slug_danhmuc }}"
                                id="convert_slug" 
                                aria-describedby="emailHelp"
                                placeholder="Slug danh mục"
                                >
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Mô Tả Danh Mục</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                name="motadanhmuc" 
                                id="exampleInputEmail1" 
                                aria-describedby="emailHelp"
                                value="{{ $danhmuc->motadanhmuc }} "
                                placeholder="Mô tả"
                            >
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1">Kích Hoạt</label>
                            <select class="custom-select" name="kichhoat">
                                @if ($danhmuc->kichhoat==0)
                                    <option selected value="0">Kích hoạt</option>
                                    <option value="1">Không kích hoạt</option>
                                @else
                                    <option value="0">Kích hoạt</option>
                                    <option selected value="1">Không kích hoạt</option>
                                @endif
                               
                            </select>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
