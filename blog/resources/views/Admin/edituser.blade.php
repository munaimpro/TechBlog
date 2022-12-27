@extends('Admin.Masterlayout.app')
@section('title', 'Update User')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Update User</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">User</li>
            </ol>
            <div class="row">
                <div class="col-md-12">
                @foreach($user as $value)
                    <form action="{{url('admin/updateuser/'.$value->userId)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(Session::has('fail'))
                            <div class="alert alert-danger">
                                {{ Session::get('fail') }}
                            </div>
                        @endif
                        <div class="mb-3">
                            <label for="User Name">User Name</label><br><br>
                            <input readonly class="form-control" type="text" id="inputFirstName" value="{{$value->firstname.' '.$value->lastname }}">
                        </div>
                        <div class="mb-3">
                            <img 
                            @if($value->userImg == '')
                                src="{{asset('images/default_image/avater.png')}}"
                            @else
                                src="{{asset('uploads/users/'.$value->userImg)}}"
                            @endif alt="User Image" width=200px height=200px>
                        </div>
                        <div class="mb-3">
                            <label for="User Bio">User Bio</label><br><br>
                            <textarea class="form-control" readonly id="" cols="30" rows="10">{{ $value->about }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="User Role">User Role</label><br><br>
                            <select class="form-control" name="userrole" id="">
                                <option value="">-- Choose Role --</option>
                                <option value="0" 
                                @if($value->role == 0) selected='selected' @endif>User</option>
                                <option value="1" 
                                @if($value->role == 1) selected='selected' @endif>Author</option>
                                <option value="2" 
                                @if($value->role == 2) selected='selected' @endif>Admin</option>
                            </select>
                        </div>
                        @if(@error)
                            @error('userrole')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        @endif
                        <div class="mb-3">
                            <button class="btn btn-primary btn-block" type="submit">Update User</button>
                        </div>
                    </form>
                @endforeach
                </div>
            </div>    
        </div>
    </main>








@endsection