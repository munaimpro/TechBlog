@extends('Admin.Masterlayout.app')
@section('title', 'Profile')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">User Profile</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">User</li>
            </ol>
            <div class="row">
                <div class="col-md-12">
                @foreach($user as $value)
                    <form action="{{url('admin/updateprofile/'.$value->userId)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(Session::has('fail'))
                            <div class="alert alert-danger">
                                {{ Session::get('fail') }}
                            </div>
                        @endif
                        @if(Session::has('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        <div class="mb-3">
                            <label for="First Name">First Name</label><br><br>
                            @if(@error)
                                @error('firstname') <div class="alert alert-danger">{{$message}}</div>@enderror
                            @endif
                            <input class="form-control" type="text" name="firstname" id="inputFirstName" value="{{$value->firstname}}">
                        </div>
                        
                        <div class="mb-3">
                            <label for="Last Name">Last Name</label><br><br>
                            @if(@error)
                                @error('lastname') <div class="alert alert-danger">{{$message}}</div>@enderror
                            @endif
                            <input class="form-control" type="text" name="lastname" id="inputFirstName" value="{{$value->lastname}}">
                        </div>
                        
                        <div class="mb-3">
                            <label for="Email Address">Email Address</label><br><br>
                            @if(@error)
                                @error('email') <div class="alert alert-danger">{{$message}}</div>@enderror
                            @endif
                            <input class="form-control" type="email" name="email" id="inputFirstName" value="{{$value->email}}">
                        </div>
                        
                        <div class="mb-3">
                            <label for="Phone">Phone</label><br><br>
                            @if(@error)
                                @error('phone') <div class="alert alert-danger">{{$message}}</div>@enderror
                            @endif
                            <input class="form-control" type="phone" name="phone" id="inputFirstName" value="{{$value->phone}}">
                        </div>
                        <div class="mb-3">
                            <label for="Profile Picture">Profile Picture</label><br><br>
                            <img 
                            @if($value->userImg == '')
                                src="{{asset('images/default_image/avater.png')}}"
                            @else
                                src="{{asset('uploads/users/'.$value->userImg)}}"
                            @endif alt="User Image" width=200px height=200px>
                        </div>
                        <div class="mb-3">
                            <input class="form-control" type="file" name="userimage" id="">
                        </div>
                        <div class="mb-3">
                            <label for="User Bio">User Bio</label><br><br>
                            <textarea class="form-control" id="" cols="30" rows="10" name="about">{{ $value->about }}</textarea>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary btn-block" type="submit">Update Profile</button>
                        </div>
                    </form>
                @endforeach
                </div>
            </div>    
        </div>
    </main>








@endsection