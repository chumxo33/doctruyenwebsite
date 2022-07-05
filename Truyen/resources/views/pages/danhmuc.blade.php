@extends('../layout')

{{-- @section('slide')
    @include('pages.slide')
@endsection --}}

@section('content')


<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Trang Chủ</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $tendanhmuc }}</a></li>
  </ol>
</nav>

<h3>{{ $tendanhmuc }}</h3>
        <div class="album py-5 bg-light">
            <div class="container">
              <div class="row">

                @php
                    $count = count($truyen); //Đếm $truyện
                @endphp
                {{-- Nếu $truyen không có thì Trang đang cập nhật...  --}}
                @if($count == 0) 
                  <div class="col-md-12">
                    <div class="card mb-12 box-shadow">
                      <div class="card-body">
                        <p>Trang đang cập nhật....</p>
                      </div>
                    </div>
                  </div>
                @else

                    @foreach ($truyen as $truyens )
                      <div class="col-md-3">
                        <div class="card mb-3 box-shadow">
                          
                            <img class="card-img-top" src="{{ asset('public/uploads/truyen/'.$truyens->image) }}">
                            
                            <div class="card-body">
                              <h4>{{ $truyens->tentruyen }}</h4>
                              <p class="card-text">{{ $truyens->tomtat }}</p>
                              @foreach($truyens->thuocnhieudanhmuctruyen as $thuocdanh) 
                                <a href="{{url('danh-muc/'.$thuocdanh->slug_danhmuc)}}"><span class="badge badge-warning">{{$thuocdanh->tendanhmuc}}</span></a>
                              @endforeach 
                              <br>
                              @foreach($truyens->thuocnhieutheloaitruyen as $thuocloai)
                                   <a href="{{url('the-loai/'.$thuocloai->slug_theloai)}}"><span class="badge badge-info">{{$thuocloai->tentheloai}}</span></a>
                              @endforeach
                              <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                  <a href="{{ url('xem-truyen/' .$truyens->slug_truyen) }}" class="btn btn-sm btn-outline-secondary">Đọc ngay</a>
                                  <a class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-eye"></i>{{ $truyens->views }}</a>
                                </div>

                              </div>
                            </div>
                          
                        </div>
                      </div>
                    @endforeach

                @endif
              </div>
               
            </div>
            <br>
            <div class="pagination justify-content-center">
                 {{-- <a class="btn btn-success"  href="">Xem tất cả</a> --}}
                 {{$truyen->onEachSide(1)->links('pagination::bootstrap-4')}}
            </div>
        </div>
               
@endsection