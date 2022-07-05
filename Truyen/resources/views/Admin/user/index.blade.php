@extends('layouts.app')

@section('content')
@include('layouts.nav')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">Liệt Kê User</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                     @endif
                    <table class="table table-responsive">
                        <thead class="table-light">
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên User</th>
                            <th scope="col">Email</th>
                            <th scope="col">Password</th>
                            <th scope="col">Vai Trò (Roles)</th>
                            <th scope="col">Quyền (Permissions)</th>
                            <th scope="col">Quản Lý</th>

                          </tr>
                        </thead>
                        <tbody>
                            @foreach ( $user as $key=>$u)
                                <tr>
                                    <th scope="row">{{ $key }}</th>
                                    <th scope="row">{{ $u->name }}</th>
                                    <th scope="row">{{ $u->email }}</th>
                                    <th scope="row">{{ $u->password }}</th>
                                    <th scope="row">
                                        @foreach ($u->roles as $role )
                                           <h5><span class="badge badge-secondary">{{ $role->name }}</span></h5>
                                        @endforeach
                                    </th>
                                    <th scope="row">
                                        @foreach ($role->permissions as $permission )
                                                <h5><span class="badge badge-info">{{ $permission->name }}</span></h5>
                                        @endforeach
                                    </th>
                                    <th scope="row">
                                        @role('admin')
                                            <a href="{{ url('phan-vaitro/'.$u->id) }}" class="btn btn-success">Phân vai trò</a>
                                            <a href="{{ url('phan-quyen/'.$u->id) }}" class="btn btn-danger">Phân quyền</a>
                                            <a href="{{ url('impersonate/user/'.$u->id) }}"class="btn btn-primary">chuyển quyền nhanh</a>
                                        @endrole
                                    </th>
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
