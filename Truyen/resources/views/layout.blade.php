<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/owl.theme.default.min.css') }}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        
      </head>

    <body>
                    <!--------------------------MENU--------------------------->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary" style="font-family:tahoma">
        <a class="navbar-brand" href="#">Sach Truyen</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" 
        aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent" style="font-family:tahoma">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                  <a class="nav-link" href="{{ url('/') }}">Trang Chủ <span class="sr-only">(current)</span></a>
              </li>

              <div class="dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdownMenuButton2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Danh Mục Truyện
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                  <li>

                    @foreach ($danhmuc as $danh )
                      <a class="dropdown-item" href="{{ url('danh-muc/'.$danh->slug_danhmuc) }}">{{ $danh->tendanhmuc }}</a>
                    @endforeach
                  
                  </li> 
                </ul>
              </div>

              <div class="dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdownMenuButton2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Thể Loại Truyện
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                  <li>
                    @foreach ($theloai as $loai )
                      <a class="dropdown-item" href="{{ url('the-loai/'.$loai->slug_theloai) }}">{{ $loai->tentheloai }}</a>
                    @endforeach
                  </li>
                </ul>
              </div>
            </ul>

            <form  class="form-inline my-2 my-lg-0" action="{{ url('tim-kiem') }}" method="GET">
            {{-- @csrf --}}
              <input class="form-control mr-sm-2" type="search" name="tukhoa" placeholder="Tìm kiếm tác giả,truyện..." aria-label="Search">
            <div id="search_ajax"></div>
            <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Tìm kiếm</button>
            </form>

        </div>
        </nav>
        <div class="p-1 bg-secondary text-white">
          <h5 align='middle'>
            <span style="font-style: oblique"> Trang đọc truyện chữ hay 2022 cập nhật chương mới nhanh hằng phút hay nhất việt nam.</span>
          </h5>
        </div>
        <hr>
    <div class="container">
      {{-- Nhận giá trị mặc định --}}
        <!-----------------------SLIDE------------------------->
        @yield('slide')
        <!---------------------------Sách Mới -------------------------------------->
        
        @yield('content')
        @yield('chapter')

          <footer class="text-muted mt-5 ">
            <div class="container ">
              <p class="float-right">
                <a  class="btn btn-outline-secondary" href="#">Back to top</a>
              </p>
              <br>
              <p class="text-black-50">Nếu sang chương bị load lâu vui lòng bấm lại</p>
              <p class="text-black-50">Các chương 100, 1000 -> 1009 trong chế độ "Please allow up to 5 second" Quý khách vui lòng chờ load, lâu quá 1 phút thì tải lại trang. Đây là cách chúng tôi chống DDos quý khách thông cảm :D</p>
              <p class="text-info">Sách Truyện là website đọc truyện online cập nhật liên tục và nhanh nhất các truyện tiên hiệp, kiếm hiệp, sắc hiệp, huyền ảo được các thành viên liên tục đóng góp rất nhiều truyện hay và nổi bật.</a>.</p>
            </div>
          </footer>

    </div>
        <script src="{{ asset('js/app.js') }}" defer></script>
        
        <script  type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
  
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

        <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
        <script type="text/javascript">
        $('.owl-carousel').owlCarousel({
            loop:true, //lạp lại silde
            margin:10,
            //dot: true,
            nav:true,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:5
                }
            }
        })
        </script>

        {{--  --}}
        <script type="text/javascript">
        $('.select-chapter').on('change',function(){ 
          var url = $(this).val();  //val: giá trị cho từng option
          // alert(url);
          if(url){
            window.location = url;// trả về url cho trang hiện tại
          }
          return false;
        }); 

        current_chapter();
        function current_chapter(){
          var url = window.location.href; //lấy đường dẫn hiện tại
          // Trong '.select-chapter' nó tìm option nào có giá tri là url = +url+ thêm selected
          $('.select-chapter').find('option[value="'+url+'"]').attr("selected",true);
        }
        </script>
    </body>
</html>
