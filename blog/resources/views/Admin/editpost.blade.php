@extends('Admin.Masterlayout.app')
@section('title', 'Update Post')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Update Post</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Post</li>
            </ol>
            <div class="row">
                <div class="col-md-12">
                    <form action="{{url('admin/updatepost/'.$postbyid->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(Session::has('fail'))
                            <div class="alert alert-danger">
                                {{ Session::get('fail') }}
                            </div>
                        @endif
                        <div class="mb-3">
                            <label for="Post Title">Post Title</label><br><br>
                            <input class="form-control" type="text" name="posttitle" id="inputFirstName" value={{$postbyid->posttitle}}>
                        </div>
                        @if(@error)
                            @error('posttitle')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        @endif
                        <div class="mb-3">
                            <label for="Post Category">Post Category</label><br><br>
                            <select class="form-control" name="postcategory" id="">
                                <option value="">-- Choose Category --</option>
                                @foreach($catlist as $value)
                                <option value="{{$value->id}}" 
                                @if($postbyid->catId == $value->id)
                                    selected = "selected"
                                @endif > {{$value->catName}}</option>
                                @endforeach
                            </select>
                        </div>
                        @if(@error)
                            @error('postcategory')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        @endif
                        <div class="mb-3">
                            <img src="{{asset('uploads/post/'.$postbyid->postImg)}}" alt="Post Image" width=200px height=200px>
                        </div>

                        <div class="mb-3">
                            <label for="Post Image">Post Image</label><br><br>
                            <input class="form-control" type="file" name="postimage">
                        </div>

                        <div class="mb-3">
                            <label for="Post Content">Post Content</label><br><br>
                            <textarea class="form-control" name="postcontent" id="" cols="30" rows="10" placeholder="Enter post content">{{$postbyid->postcontent}}</textarea>
                        </div>
                        @if(@error)
                            @error('postcontent')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        @endif
                        <div class="mb-3">
                            <label for="Post Tags">Post Tags</label><br><br>
                            <input class="form-control" type="text" name="posttags" id="inputFirstName" value={{$postbyid->posttags}}>
                        </div>
                        @if(@error)
                            @error('posttags')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        @endif
                        <div class="mb-3">
                            <label for="Post Status">Post Status</label><br><br>
                            <select class="form-control" name="poststatus" id="">
                                <option value="">-- Choose Status --</option>
                                <option value="0" 
                                @if($postbyid->poststatus == 0) selected='selected' @endif>Hidden</option>
                                <option value="1" 
                                @if($postbyid->poststatus == 1) selected='selected' @endif>Published</option>
                            </select>
                        </div>
                        @if(@error)
                            @error('poststatus')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        @endif
                        @if($postbyid->postedby == Session::get('loginid') || Session::get('loginrole') == 2)
                        <div class="mb-3">
                            <button class="btn btn-primary btn-block" type="submit">Update Post</button>
                        </div>
                        @endif
                    </form>
                </div>
            </div>    
        </div>
    </main>








@endsection