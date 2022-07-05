@extends('layouts.app')

@section('content')

@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Thêm User</div>
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
                    <form method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data"> 
                        @csrf   
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Tên User</label>
                          <input 
                            type="text" 
                            class="form-control" 
                            name="name" 
                            {{-- old nó sẽ giữ tên user đã có --}}
                            value="{{ old('name') }}" 
                            aria-describedby="emailHelp"
                            placeholder="Tên user"
                            >
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                name="email" 
                                value="{{ old('email') }}"
                                aria-describedby="emailHelp"
                                placeholder="Email user"
                                >
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Password</label>
                            <input 
                              type="text" 
                              class="form-control" 
                              name="password" 
                              value="{{ old('password') }}" 
                              aria-describedby="emailHelp"
                              placeholder="Password user"
                              >
                          </div>
                        <br>
                        <button type="submit" name="themuser" class="btn btn-primary">Thêm User</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
