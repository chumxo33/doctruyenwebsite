@extends('layouts.app')

@section('content')
@include('layouts.nav')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Liệt Kê Truyện Sách: Tổng {{ $count }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-responsive">
                        <thead class="table-light">
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên Truyện</th>
                            <th scope="col">Hình Ảnh</th>
                            <th scope="col">Slug Truyện</th>
                            <th scope="col">Tóm Tắt</th>
                            <th scope="col">Thuộc Thể Loại</th>
                            <th scope="col"> Thuộc Danh Mục</th>
                            <th scope="col">Kích Hoạt</th>
                            <th scope="col">Truyện nổi bật</th>
                            <th scope="col">Quản lý</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($list_truyen as $key=>$truyen )
                                <tr>
                                    <th scope="row">{{ $key  }}</th>
                                    <td>{{ $truyen->tentruyen }}</td>
                                    <td><img src="{{ asset('public/uploads/truyen/'.$truyen->image) }}" height="300" width="180"></td>
                                    <td>{{ $truyen->slug_truyen }}</td>
                                    <td>{{ $truyen->tomtat }}</td>
                                    <td>
                                
                                        @foreach ($truyen->thuocnhieudanhmuctruyen as $thuocdanh)
                                            <span class="badge badge-dark">{{ $thuocdanh->tendanhmuc }}</span>
                                        @endforeach
                                    </td>

                                    <td>
                                        @foreach ($truyen->thuocnhieutheloaitruyen as $thuocloai)
                                            <span class="badge badge-dark">{{ $thuocloai->tentheloai }}</span>
                                         @endforeach
                                    </td>
                                    
                                    <td>
                                        @if( $truyen->kichhoat==0)
                                            <span class="text text-success">Kích hoạt</span>   
                                        @else
                                            <span class="text text-danger">Không kích hoạt</span> 
                                        @endif
                                    </td>

                                    <td>
                                        @if ($truyen->truyen_noibat==0)
                                            <span class="text text-success">Truyện mới</span>   
                                        @elseif($truyen->truyen_noibat==1)
                                            <span class="text text-primary">Truyện nổi bật</span> 
                                        @else
                                            <span class="text text-danger">Truyện xem nhiều</span>
                                        @endif
                                    </td>

                                    <td>
                                        @can('edit articles')
                                        <a href="{{ route('truyen.edit',[$truyen->id]) }}" class="btn btn-primary">Edit</a>
                                        @endcan
                                        @can('delete articles')
                                        <form action="{{ route('truyen.destroy',[$truyen->id]) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button onclick="return confirm('Bạn chắc chắn xóa truyện này không')" class="btn btn-danger">Delete</button>
                                        </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
