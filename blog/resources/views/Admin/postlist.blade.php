@extends('Admin.Masterlayout.app')
@section('title', 'All Post')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">All Post</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Posts</li>
            </ol>
            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{Session::get('success')}}
                </div>
            @endif
            <div class="row">
                <div class="card mb-4 p-0">
                    <div class="card-header">
                        <h4 class="float-start">Post List</h4>
                        <a href="{{ url('admin/addpost') }}" class="float-end"><button class="btn btn-primary">Add Post</button></a>
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Content</th>
                                    <th>Image</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 0; @endphp
                                @foreach($post as $value)
                                @php $i++; @endphp
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{ $value->posttitle }}</td>
                                    <td>{{ Str::limit($value->postcontent, 50)}}</td>
                                    <td><img src="{{ asset('uploads/post/'.$value->postImg) }}" alt="Category Image" height="50px" width="50px"></td>
                                    <td>{{ $value->catName }}</td>
                                    <td>{{$value->poststatus == 0 ? 'Hidden':'Published'}}</td>
                                    <td>
                                    @if(Session::get('loginid') == $value->postedby || Session::get('loginrole') == 2)
                                        <a href="{{url('admin/editpost/'.$value->id)}}"><button class="btn btn-primary">Edit</button></a>
                                        <a onclick="return confirm('Are you sure to delete {{$value->posttitle}} post?')" href="{{url('admin/removepost/'.$value->id)}}"><button class="btn btn-danger">Delete</button></a>
                                    @else
                                        N/A 
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