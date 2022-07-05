@extends('layouts.app')

@section('content')
@include('layouts.nav')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Liệt Kê Danh Mục Truyện: Tổng {{ $count }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                     @endif
                    <table class="table">
                        <thead class="table-light">
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên danh mục</th>
                            <th scope="col">Slug danh mục</th>
                            <th scope="col">Mô tả</th>
                            <th scope="col">Kích hoạt</th>
                            <th scope="col">Quản lý</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ( $danhmuctruyen as $key => $danhmuc )
                                <tr>
                                    <th scope="row">{{ $key  }}</th>
                                    <td>{{ $danhmuc->tendanhmuc }}</td>
                                    <td>{{ $danhmuc->slug_danhmuc }}</td>
                                    <td>{{ $danhmuc->motadanhmuc }}</td>
                                    <td>
                                        @if( $danhmuc->kichhoat==0)
                                            <span class="text text-success">Kích hoạt</span>   
                                        @else
                                            <span class="text text-danger">Không kích hoạt</span> 
                                        @endif
                                    </td>
                                    <td>
                                        @can('edit category')                          
                                        <a href="{{ route('danhmuc.edit',[$danhmuc->id]) }}" class="btn btn-primary">Edit</a>
                                        @endcan

                                        @can('delete category')                          
                                        <form action="{{ route('danhmuc.destroy',[$danhmuc->id]) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button onclick="return confirm('Bạn chắc chắn xóa danh mục này không')" class="btn btn-danger">Delete</button>
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
