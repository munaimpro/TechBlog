@extends('Techblog.Masterlayout.app')
@section('title', 'Update Comment - Tech Blog')
@section('content')
    <div id="wrapper">
    <section class="section single-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                        <div class="page-wrapper">
                            <div class="custombox clearfix">
                                <h4 class="small-title">Update Comment</h4>
                                <div class="blog-title-area text-center">
                                    <form action="{{url('techblog/updatecomment/'.$comments->id)}}" method="POST" class="form-wrapper">
                                    @csrf
                                    @if(Session::has('mancommentfail'))
                                        <div class="alert alert-danger">{{Session::get('mancommentfail')}}</div>
                                    @endif

                                    
                                    @if(@error)
                                        @error('text')
                                            <div class="alert alert-danger">{{$message}}</div>
                                        @enderror
                                    @endif
                                    <textarea class="form-control" placeholder="Your comment" name="text" value="{{old('text')}}">{{ $comments->text }}</textarea>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
@endsection