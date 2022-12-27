@extends('Admin.Masterlayout.app')
@section('title', 'Update Category')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Update Category</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Category</li>
            </ol>
            <div class="row">
                <div class="col-md-12">
                    @if(Session::has('fail'))
                        <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                    @endif
                    <form action="{{ url('admin/updatecategory/'.$catbyid->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                        <div class="mb-3">
                            <label for="Category Name">Category Name</label><br><br>
                            <input class="form-control" type="text" name="categoryname" id="inputFirstName" value=
                            {{$catbyid->catName}}>
                        </div>
                        @if(@error)
                            @error('categoryname')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        @endif
                        <div class="mb-3">
                            <img src="{{ asset('uploads/category/'.$catbyid->catImg) }}" alt="Category Image" width="200px" height="200px">
                        </div>

                        <div class="mb-3">
                            <label for="Category Image">Category Image</label><br><br>
                            <input class="form-control" type="file" name="categoryimage">
                        </div>
                        @if(@error)
                            @error('categoryimage')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        @endif
                        <div class="mb-3">
                            <button class="btn btn-primary btn-block" type="submit">Update Category</button>
                        </div>
                    </form>
                </div>
            </div>    
        </div>
    </main>








@endsection