@extends('../layout')

@section('slide')
    @include('pages.slide')
@endsection

@section('content')

<h3>TRUYỆN HAY MỚI CẬP NHẬT</h3>

        <div class="album py-5 bg-light">
            <div class="container">
              <div class="row">
                @foreach ($truyen as $truyens )
                  <div class="col-md-3">
                    <div class="card mb-3 box-shadow">
                      <div class="info_truyen">
                          <span class="badge badge-danger loaitruyen">Truyện đọc</span>
                      </div>
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

                            <div class="d-flex   justify-content-between align-items-center">
                            <div class="btn-group">
                              <a href="{{ url('xem-truyen/'.$truyens->slug_truyen) }}" class="btn btn-sm btn-outline-secondary">Đọc ngay</a>
                              <a class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-eye"></i>{{ $truyens->views }}</a>
                            </div>
                          </div>
                        </div>
                      
                    </div>
                  </div>
                @endforeach
            </div>
            <br>
            <div class="pagination justify-content-center">
                 {{$truyen->onEachSide(1)->links('pagination::bootstrap-4')}}
            </div>
        </div>
               
@endsection