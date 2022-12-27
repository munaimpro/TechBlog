@extends('Admin.Masterlayout.app')
@section('title', 'Add Post')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Add Post</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Post</li>
            </ol>
            <div class="row">
                <div class="col-md-12">
                    @if(Session::has('fail'))
                        <div class="alert alert-danger">
                            {{Session::get('fail')}}
                        </div>
                    @endif
                    <form action="insertpost" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="Post Title">Post Title</label><br><br>
                            <input class="form-control" type="text" name="posttitle" id="inputFirstName" placeholder="Enter post title" value="{{old('posttitle')}}">
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
                                <option value="{{ $value->id }}">{{ $value->catName }}</option>
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
                            <label for="Post Image">Post Image</label><br><br>
                            <input type="file" name="postimage" class="form-control">
                        </div>
                        @if(@error)
                            @error('postimage') 
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        @endif
                        <div class="mb-3">
                            <label for="Post Content">Post Content</label><br><br>
                            <textarea class="form-control" name="postcontent" id="" cols="30" rows="10" placeholder="Enter post content">{{old('postcontent')}}</textarea>
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
                            <input class="form-control" type="text" name="posttags" id="inputFirstName" placeholder="Enter post tags" value="{{old('posttags')}}">
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
                                <option>-- Choose Status --</option>
                                <option value="0">Hidden</option>
                                <option value="1">Published</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <button class="btn btn-primary btn-block" type="submit">Add Post</button>
                        </div>
                    </form>
                </div>
            </div>    
        </div>
    </main>








@endsection