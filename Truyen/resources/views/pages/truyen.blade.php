@extends('../layout')

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Trang chủ</a></li>
			@foreach($truyen->thuocnhieudanhmuctruyen as $breadcrumb_danh)
            <li class="breadcrumb-item"><a href="{{ url('danh-muc/' .$breadcrumb_danh->slug_danhmuc) }}">{{ $breadcrumb_danh->tendanhmuc }}</a></li>
			@endforeach
			<li class="breadcrumb-item active" aria-current="page">{{ $truyen->tentruyen }}</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-9">
            <div class="row">
				{{-- @php
					$mucluc = count($chapter);
				@endphp --}}
                <div class="col-md-3">
                    <img class="card-img-top" src="{{ asset('public/uploads/truyen/'.$truyen->image) }}" data-holder-rendered="true">
                </div>
                <div class="col-md-9">
                    <style type="text/css">
                        .infotruyen{
                            list-style: none;
                        }
                    </style>
                    <ul class="infotruyen">

						<li><h3>{{ $truyen->tentruyen }}</h3></li>
                        <li><i class='fa fa-user-circle'></i> Tác Giả: {{ $truyen->tacgia }}</li>
                        <li><i class="fa">&#xf07c;</i> Danh mục truyện:
							@foreach($truyen->thuocnhieudanhmuctruyen as $thuocdanh) 
							<a href="{{ url('danh-muc/'.$thuocdanh->slug_danhmuc) }}"><span class="badge badge-warning">{{ $thuocdanh->tendanhmuc }}</span></a>
							@endforeach 
						</li>

						<li><i class="fa">&#xf07c;</i> Thể loại truyện: 
							@foreach($truyen->thuocnhieutheloaitruyen as $thuocloai)
                             <a href="{{url('the-loai/'.$thuocloai->slug_theloai)}}"><span class="badge badge-info">{{$thuocloai->tentheloai}}</span></a>
                       		 @endforeach						
						</li>

                        <li><i class="fa-solid fa-eye"></i> Lượt xem:{{ $truyen->views }}</li>
                        <li><a href="">Xem mục lục</a></li>

						{{-- Check truyện có chapter không --}}
						@if($chapter_dau)
                        	<li>
								<a href="{{ url('xem-chapter/'.$chapter_dau->slug_chapter) }}" class="btn btn-primary">Đọc online</a>
							</li>
							<li>
								<a href="{{ url('xem-chapter/'.$chapter_moinhat->slug_chapter) }}" class="btn btn-success mt-2">Đọc chương mới nhất</a>
							</li>
						@else
							<li><a class="btn btn-danger">Hiện tại chưa có chương</a></li>
						@endif
					</ul>
                </div>
            </div>
			<div class="col-md-12">
				<br>
					<h4>Mô tả</h4>
					<p>{{ $truyen->tomtat }}</p>
				</div>
				<hr>
				<div>
					<style type="text/css">
						.muc-luc-truyen{
							list-style: none;
							background: #EEEEEE;
						}
					</style>
														{{------------- Mục Lục --------------}}
					<h4>Mục lục</h4>
						<ul class="muc-luc-truyen">
							{{-- Hàm count mục lục --}}
							@php
								$mucluc = count($chapter);
							@endphp
							@if($mucluc > 0)
								@foreach ( $chapter as $chap )
									<li><a href="{{ url('xem-chapter/'.$chap->slug_chapter) }}">{{ $chap->tieude }}</a></li>
								@endforeach
								@else
									<li>Mục lục đang cập nhật...</a></li>
							@endif	
						</ul>

														{{------------- Sách cùng danh mục --------------}}					
						<h4>Sách cùng danh mục</h4>
						<div class="row">
							@foreach($cungdanhmuc as $cungdanh)
								@foreach($cungdanh->nhieutruyen as $value)
									@if($value->id != $truyen->id)
										<div class="col-md-3">
											<div class="card mb-3 box-shadow">
											
												<img class="card-img-top" src="{{ asset('public/uploads/truyen/'.$value->image) }}">
												
												<div class="card-body">
												<h4>{{ $value->tentruyen }}</h4>
												<p class="card-text">{{ $value->tomtat }}</p>
												@foreach($value->thuocnhieudanhmuctruyen as $thuocdanh) 
														<a href="{{url('danh-muc/'.$thuocdanh->slug_danhmuc)}}"><span class="badge badge-warning">{{$thuocdanh->tendanhmuc}}</span></a>
												@endforeach 
												<br>
												@foreach($value->thuocnhieutheloaitruyen as $thuocloai)
													<a href="{{url('the-loai/'.$thuocloai->slug_theloai)}}"><span class="badge badge-info">{{$thuocloai->tentheloai}}</span></a>
												@endforeach
												<div class="d-flex   justify-content-between align-items-center">
													<div class="btn-group">
													<a href="{{ url('xem-truyen/'.$value->slug_truyen) }}" class="btn btn-sm btn-outline-secondary">Đọc ngay</a>
													<a class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-eye"></i>{{ $value->views}}</a>
													</div>
												</div>
												</div>
											
											</div>
										</div>
									@endif
								@endforeach
							@endforeach
						</div>
				</div>

			</div>

        <div class="col-md-3">
			<style type="text/css">
				.col-md-7.sidebar a{ 
					/* padding: 0 */
					font-zine: 15px;
					text-decoration: none;
					color:#000;
				}
				/* .col-md-7.sidebar {
					background: darkgray !important;
				} */
			</style>

            <h3 class="card-header">Truyện nổi bật</h3>
			@foreach ($truyennoibat as $noibat)
			<div class="row mt-2">
				<div class="col-md-5">
					<img class="img img-responsive" width="100%" class="card-img-top" src="{{ asset('public/uploads/truyen/'.$noibat->image) }}" alt="{{ $noibat->tentruyen }}">
				</div>
				<div class="col-md-7 sidebar">
					<a href="{{ url('xem-truyen/'.$noibat->slug_truyen) }}">
					<p>{{ $noibat->tentruyen }}</p>
					<p><i class="fas fa-eye"></i>{{ $noibat->views }}</p>
					</a>
				</div>
			</div>
				<hr>
			@endforeach

			<h3 class="card-header">Truyện xem nhiều</h3>
			@foreach ($truyenxemnhieu as $xemnhieu)
			<div class="row mt-2">
				<div class="col-md-5">
					<img class="img img-responsive" width="100%" class="card-img-top" src="{{ asset('public/uploads/truyen/'.$xemnhieu->image) }}" alt="{{ $xemnhieu->tentruyen }}">
				</div>
				<div class="col-md-7 sidebar">
					<a href="{{ url('xem-truyen/'.$xemnhieu->slug_truyen) }}">
					<p>{{ $xemnhieu->tentruyen }}</p>
					<p><i class="fas fa-eye"></i>{{ $xemnhieu->views }}</p>
					</a>
				</div>
			</div>
				<hr>
			@endforeach
        </div>
    </div> 
@endsection