@extends('Admin.Masterlayout.app')
@section('title', 'All User')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">All Users</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">User</li>
            </ol>
            <div class="row">
                <div class="card mb-4 p-0">
                    <div class="card-header">
                        <h4>User List</h4>
                    </div>
                    <div class="card-body">
                    @if(Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 0; @endphp
                                @foreach($user as $value)
                                @php $i++; @endphp
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$value->firstname.' '.$value->lastname}}</td>
                                    <td>{{$value->email}}</td>
                                    <td>{{$value->phone}}</td>
                                    <td>
                                        @if($value->role == 0) User
                                        @elseif($value->role == 1) Author
                                        @else Admin
                                        @endif
                                    </td>
                                    <td>
                                    @if(Session::get('loginrole') == 2)
                                        <a href="{{url('admin/edituser/'.$value->userId)}}"><button class="btn btn-primary">Edit</button></a>
                                        <a onclick="return confirm('Are you sure to remove this user?')" href="{{url('admin/removeuser/'.$value->userId)}}"><button class="btn btn-danger">Delete</button></a>
                                    @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>   
                </div>
            </div>
        </div>
    </main>








@endsection