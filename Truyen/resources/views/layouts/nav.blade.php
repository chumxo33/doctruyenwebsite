<div class="container">
    <nav class=" navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
            
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Admin</a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link" href="#">Quản Lý Danh Mục</a>
            </li> --}}
            @role('admin')
            <li class="nav-item dropdown"> 
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Quản lý user
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                    <ul>
                        <li><a class="dropdown-item" href="{{ route('user.create') }}">Thêm User</a></li>
                        <li><a class="dropdown-item" href="{{ route('user.index') }}">Liệt Kê User</a></li>
                    </ul>
                </div>
            </li>
            @endrole

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Quản Lý Danh Mục
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                    <ul>
                        @can('add category')
                        <li><a class="dropdown-item" href="{{ route('danhmuc.create') }}">Thêm Danh Mục</a></li>
                        @endcan
                        <li><a class="dropdown-item" href="{{ route('danhmuc.index') }}">Liệt Kê Danh Mục</a></li>
                    </ul>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Thể Loại
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                    <ul>
                        @can('add genre')
                        <li>
                            <a class="dropdown-item" href="{{ route('theloai.create') }}">Thêm Thể Loại</a>
                        </li>
                        @endcan
                        <li><a class="dropdown-item" href="{{ route('theloai.index') }}">Liệt Kê Thể Loại</a></li>
                    </ul>
                </div>
            </li>
            
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Truyện Đọc
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                    <ul>
                        @can('add articles')
                            <li>
                                <a class="dropdown-item" href="{{ route('truyen.create') }}">Thêm Truyện Đọc</a>
                            </li>
                        @endcan
                            <li>
                                <a class="dropdown-item" href="{{ route('truyen.index') }}">Liệt Kê Truyện Đọc</a>
                            </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Chapter
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                    <ul>
                        @can('add chapter')
                        <li><a class="dropdown-item" href="{{ route('chapter.create') }}">Thêm Chapter</a></li>
                        @endcan
                        <li><a class="dropdown-item" href="{{ route('chapter.index') }}">Liệt Kê Chapter</a></li>
                    </ul>
                </div>
            </li>
            </ul>
            
            {{-- <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
            </form> --}}
        </div>
        </div>
    </nav>
</div>