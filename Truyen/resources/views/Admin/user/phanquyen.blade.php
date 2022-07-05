@extends('layouts.app')

@section('content')

@include('layouts.nav')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cấp quyền user : {{ $user->name }} </div>
                <form action="{{ url('/insert_permission',[$user->id]) }}" method="POST">
                @csrf
                @if(isset($name_roles))
                    Vai trò hiện tại: {{ $name_roles }}
                @endif
                <br>
                Permission
                @foreach ($permission as $key=>$per )
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox"  
                            @foreach ($get_permission_via_role as $key=> $get )
                                @if ($per->id == $get->id)  
                                    checked
                                @endif
                            @endforeach
                            name="permission[]" 
                            value="{{ $per->id }}" 
                            id="{{ $per->id }}"
                        >

                        <label class="form-check-label" for="{{ $per->id }}">
                            {{ $per->name }}
                        </label>
                    </div>
                @endforeach
                <br>
                <input type="submit" name="insertroles" value="Cấp quyền cho user" class="btn btn-danger">
                </form>
            </div>
        </div>
                                            {{-- Thêm quyền cho User  --}}
        <div class="col-md-8">
            <div class="card">
                <form method="POST" action="{{ url('/axtra-permission') }}"> 
                    @csrf   
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Tên Quyền</label>
                      <input 
                        type="text" 
                        class="form-control" 
                        name="permission" 
                        value="{{ old('permission') }}" 
                        aria-describedby="emailHelp"
                        placeholder="Tên quyền"
                        >
                    </div>
                    <input type="submit" name="insertper" value="Thêm quyền cho user" class="btn btn-danger">
                  </form>
            </div>
        </div>
    </div>
</div>
@endsection