@extends('Admin.Masterlayout.app')
@section('title', 'All Category')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">All Category</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Category</li>
            </ol>
            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
            <div class="row">
                <div class="card mb-4 p-0">
                    <div class="card-header">
                        <h4 class="float-start">Category List</h4>
                        <a href="{{ url('admin/addcategory') }}" class="float-end"><button class="btn btn-primary">Add Category</button></a>
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Category</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach($catlist as $value)
                                @php
                                    $i++;
                                @endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $value->catName }}</td>
                                    <td><img src="{{ asset('uploads/category/'.$value->catImg) }}" alt="Category Image" height="50px" width="50px"></td>
                                    <td>
                                    @if(Session::get('loginrole') == 2)
                                        <a href="{{url('admin/editcategory'.'/'.$value->id)}}"><button class="btn btn-primary">Edit</button></a>
                                        <a onclick="return confirm('Are you sure to delete {{$value->catName}} category?')" href="{{url('admin/removecategory'.'/'.$value->id)}}"><button class="btn btn-danger">Delete</button></a>
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