@extends('Techblog.Masterlayout.app')
@section('title', 'Home - Tech Blog')
@section('content')
    <div id="wrapper">
        <section class="section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                        <div class="page-wrapper">
                            <div class="blog-top clearfix">
                                <h4 class="pull-left">Recent News <a href="#"><i class="fa fa-rss"></i></a></h4>
                            </div><!-- end blog-top -->

                            <div class="blog-list clearfix">
                            @forelse($post as $value)
                                <div class="blog-box row">
                                    <div class="col-md-4">
                                        <div class="post-media">
                                            <a href="{{url('techblog/postdetails/'.$value->id)}}" title="">
                                                <img src="{{ asset('uploads/post/'.$value->postImg) }}" alt="Post Image" class="img-fluid" style="height:220px">
                                                <div class="hovereffect"></div>
                                            </a>
                                        </div><!-- end media -->
                                    </div><!-- end col -->

                                    <div class="blog-meta big-meta col-md-8">
                                        <h4><a href="{{url('techblog/postdetails/'.$value->id)}}" title="">{{ $value->posttitle }}</a></h4>
                                        
                                        <p>{{Str::limit($value->postcontent, 100)}}</p>

                                        <small class="firstsmall"><a class="bg-orange" href="{{url('techblog/category/'.$value->catId)}}" title="">{{$value->catName}}</a></small>
                                        <small><a href="{{url('/techblog')}}" title="">{{ $value->posttime->format('d M, Y') }}</a></small>
                                        <small><a href="{{url('/techblog')}}" title="">by {{ $value->firstname.' '.$value->lastname}}</a></small>
                                        <small><a href="{{url('/techblog')}}" title=""><i class="fa fa-eye"></i> {{ $value->postview }}</a></small>
                                    </div><!-- end meta -->
                                </div><!-- end blog-box -->

                                <hr class="invis">
                            @empty
                                <div class="card mt-3 mb-3 p-5 text-center">
                                    <h5>No Article available</h5>
                                </div>
                            @endforelse
                            </div><!-- end blog-list -->
                        </div><!-- end page-wrapper -->

                        <hr class="invis">

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
                

        

