@extends('layouts.app')

@section('content')

@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cập Nhật Chapter Truyện</div>
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
                    <form method="POST" action="{{ route('chapter.update',[$chapter->id]) }}"> 
                        @method('PUT')
                        @csrf   
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Tên Chapter</label>
                          <input 
                            type="text" 
                            class="form-control" 
                            name="tieude" 
                            {{-- old nó sẽ giữ tên danh mục đã có --}}
                            value="{{ $chapter->tieude }}" 
                            {{-- onkeyup có nghĩa có nhập vào --}}
                            onkeyup="ChangeToSlug();"
                            id="slug" 
                            aria-describedby="emailHelp"
                            placeholder="Tên"
                            >
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Slug Chapter</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                name="slug_chapter" 
                                {{-- old nó sẽ giữ mô tả danh mục đã có --}}
                                value="{{ $chapter->slug_chapter }}"
                                id="convert_slug" 
                                aria-describedby="emailHelp"
                                placeholder="Slug danh mục"
                                >
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Tóm Tắt Chapter</label>
                            <input 
                              type="text" 
                              class="form-control" 
                              name="tomtat" 
                              {{-- old nó sẽ giữ tên danh mục đã có --}}
                              value="{{ $chapter->tomtat }}" 
                              id="exampleInputEmail1" 
                              aria-describedby="emailHelp"
                              placeholder="Tóm tắt"
                              >
                          </div>

                          <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nội Dung Chapter</label>
                            <textarea name="noidung" id="noidung_chapter" class="form-control" rows="5" style="resize: none" >{{ $chapter->noidung }}</textarea>
                          </div>

                          <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Thuộc Truyện</label>
                            <select class="form-control " name="truyen_id">
                                @foreach ( $truyen as $key => $value )
                                    <option {{ $chapter->truyen_id == $value->id ? 'selected': '' }} value="{{ $value->id }}">{{ $value->tentruyen }}</option>
                                @endforeach
                            </select>
                          </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1">Kích Hoạt</label>
                            <select class="custom-select" name="kichhoat">
                                @if ($chapter->kichhoat==0)
                                    <option selected value="0">Kích hoạt</option>
                                    <option value="1">Không kích hoạt</option>
                                @else
                                    <option value="0">Kích hoạt</option>
                                    <option selected value="1">Không kích hoạt</option>
                                @endif
                               
                            </select>
                        </div>
                        <br>
                        <button type="submit" name="themdanhmuc" class="btn btn-primary">Cập Nhật</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
