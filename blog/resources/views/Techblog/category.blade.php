@extends('Techblog.Masterlayout.app')
@section('title', 'Category - Tech Blog')
@section('content')

    <div id="wrapper">
        <div class="page-title lb single-wrapper">
            <div class="container">
                @foreach($catname as $value)
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                        <h2><i class="fa fa-gears bg-orange"></i> {{$value->catName}} <small class="hidden-xs-down hidden-sm-down">Nulla felis eros, varius sit amet volutpat non. </small></h2>
                    </div><!-- end col -->
                    <div class="col-lg-4 col-md-4 col-sm-12 hidden-xs-down hidden-sm-down">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('techblog/')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{url('techblog/category/'.$value->id)}}">Category</a></li>
                            <li class="breadcrumb-item active">{{$value->catName}}</li>
                        </ol>
                    </div><!-- end col -->                    
                </div><!-- end row -->
                @endforeach
            </div><!-- end container -->
        </div><!-- end page-title -->

        <section class="section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                        <div class="page-wrapper">
                            <div class="blog-grid-system">
                                <div class="row">
                                @forelse($allcatpost as $value)
                                    <div class="col-md-6">
                                        <div class="blog-box">
                                            <div class="post-media">
                                                <a href="{{url('techblog/postdetails/'.$value->postid)}}" title="">
                                                    <img src="{{asset('uploads/post/'.$value->postImg)}}" alt="Post Image" class="img-fluid" style="height: 330px">
                                                    <div class="hovereffect">
                                                        <span></span>
                                                    </div><!-- end hover -->
                                                </a>
                                            </div><!-- end media -->
                                            <div class="blog-meta big-meta">
                                                <span class="color-orange"><a href="{{url('techblog/category/'.$value->id)}}" title="">{{$value->catName}}</a></span>
                                                <h4><a href="{{url('techblog/postdetails/'.$value->postid)}}" title="">{{$value->posttitle}}</a></h4>
                                                <p>{{Str::limit($value->postcontent, 150)}}</p>
                                                <small><a href="{{url('techblog/category/'.$value->id)}}" title="">{{$value->posttime->format('d M Y')}}</a></small>
                                                <small><a href="{{url('techblog/category/'.$value->id)}}" title="">by {{$value->firstname}}</a></small>
                                                <small><a href="{{url('techblog/category/'.$value->id)}}" title=""><i class="fa fa-eye"></i> {{$value->postview}}</a></small>
                                            </div><!-- end meta -->
                                        </div><!-- end blog-box -->
                                    </div><!-- end col -->
                                    @empty
                                    <div class="form-control m-5 p-5">
                                        <h5>No post available in this category</h5>
                                    </div>
                                @endforelse
                                </div><!-- end row -->
                            </div><!-- end blog-grid-system -->
                        </div><!-- end page-wrapper -->

                        <hr class="invis3">

                        <div class="row">
                            <div class="col-md-12">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination justify-content-start">
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">Next</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div><!-- end col -->
                        </div><!-- end row -->
                    </div><!-- end col -->
@endsection
