@extends('layouts.app')

@section('content')
@include('layouts.nav')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Liệt Kê Chapter: Tổng {{ $count }}</div>

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
                            <th scope="col">Tên Chapter</th>
                            <th scope="col">Slug Chapter</th>
                            <th scope="col">Tóm tắt Chapter</th>
                            {{-- <th scope="col">Nội dung Chapter</th> --}}
                            <th scope="col">Thuộc Truyện</th>
                            <th scope="col">Kích hoạt</th>
                            <th scope="col">Quản lý</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ( $list_chapter as $key => $chapter )
                                <tr>
                                    <th scope="row">{{ $key  }}</th>
                                    <td>{{ $chapter->tieude }}</td>
                                    <td>{{ $chapter->slug_chapter }}</td>
                                    <td>{{ $chapter->tomtat }}</td>
                                    {{-- <td>{{ $chapter->noidung }}</td> --}}
                                    <td>{{ $chapter->truyen->tentruyen }}</td>
                                    <td>
                                        @if( $chapter->kichhoat==0)
                                            <span class="text text-success">Kích hoạt</span>   
                                        @else
                                            <span class="text text-danger">Không kích hoạt</span> 
                                        @endif
                                    </td>
                                    <td>
                                        @can('edit chapter')
                                        <a href="{{ route('chapter.edit',[$chapter->id]) }}" class="btn btn-primary">Edit</a>
                                        @endcan
                                        @can('delete chapter') 
                                        <form action="{{ route('chapter.destroy',[$chapter->id]) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button onclick="return confirm('Bạn chắc chắn xóa chapter này không')" class="btn btn-danger">Delete</button>
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
