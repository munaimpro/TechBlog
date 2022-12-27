@extends('Techblog.Masterlayout.app')
@foreach($postbyid as $value)
@section('title', $value->posttitle.' - Tech Blog')
@endforeach
@section('content')
    <div id="wrapper">
        <section class="section single-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                        <div class="page-wrapper">
                            <div class="blog-title-area text-center">
                            @foreach($postbyid as $value)
                            @if(Session::has('loginid'))
                                {{session()->put('postid',$value->postid)}}
                            @endif
                                <ol class="breadcrumb hidden-xs-down">
                                    <li class="breadcrumb-item"><a href="{{url('techblog/')}}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="#">Blog</a></li>
                                    <li class="breadcrumb-item active">{{ $value->posttitle }}</li>
                                </ol>

                                <span class="color-orange"><a href="{{ url('techblog/category/'.$value->catId) }}" title="">{{ $value->catName }}</a></span>

                                <h3>{{ $value->posttitle }}</h3>

                                <div class="blog-meta big-meta">
                                    <small><a href="{{url('techblog/postdetails/'.$value->postId)}}" title="">{{ $value->posttime->format('j F, Y') }}</a></small>
                                    <small><a href="{{url('techblog/postdetails/'.$value->postId)}}" title="">by {{ $value->firstname.' '.$value->lastname }}</a></small>
                                    <small><a href="#" title=""><i class="fa fa-eye"></i> {{ $value->postview }}</a></small>
                                </div><!-- end meta -->

                                <div class="post-sharing">
                                    <ul class="list-inline">
                                        <li><a href="#" class="fb-button btn btn-primary"><i class="fa fa-facebook"></i> <span class="down-mobile">Share on Facebook</span></a></li>
                                        <li><a href="#" class="tw-button btn btn-primary"><i class="fa fa-twitter"></i> <span class="down-mobile">Tweet on Twitter</span></a></li>
                                        <li><a href="#" class="gp-button btn btn-primary"><i class="fa fa-google-plus"></i></a></li>
                                    </ul>
                                </div><!-- end post-sharing -->
                            </div><!-- end title -->

                            <div class="single-post-media">
                                <img src="{{asset('uploads/post/'.$value->postImg)}}" alt="" class="img-fluid">
                            </div><!-- end media -->

                            <div class="blog-content">  
                                <div class="pp">
                                    
                                    <p>{{$value->postcontent}}</p>

                                </div><!-- end pp -->
                            </div><!-- end content -->

                            <div class="blog-title-area">
                                <div class="tag-cloud-single">
                                    <span>Tags</span>
                                    <small><a href="#" title="">{{$value->posttags}}</a></small>
                                </div><!-- end meta -->
                            
                                <div class="post-sharing">
                                    <ul class="list-inline">
                                        <li><a href="#" class="fb-button btn btn-primary"><i class="fa fa-facebook"></i> <span class="down-mobile">Share on Facebook</span></a></li>
                                        <li><a href="#" class="tw-button btn btn-primary"><i class="fa fa-twitter"></i> <span class="down-mobile">Tweet on Twitter</span></a></li>
                                        <li><a href="#" class="gp-button btn btn-primary"><i class="fa fa-google-plus"></i></a></li>
                                    </ul>
                                </div><!-- end post-sharing -->
                            </div><!-- end title -->

                            <hr class="invis1">

                            <div class="custombox authorbox clearfix">
                                <h4 class="small-title">About author</h4>
                                <div class="row">
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                        <img
                                                    @if($value->userImg == '')
                                                    src="{{asset('images/default_image/avater.png')}}" alt="Author Image"
                                                    @else
                                                    src="{{asset('uploads/users/'.$value->userImg)}}" alt="Author Image"
                                                    @endif 
                                                    class="img-fluid rounded-circle"> 
                                    </div><!-- end col -->

                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                        <h4><a href="#">{{ $value->firstname.' '.$value->lastname }}</a></h4>
                                        <p>{{ $value->about }}</p>

                                        <div class="topsocial">
                                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Facebook"><i class="fa fa-facebook"></i></a>
                                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Youtube"><i class="fa fa-youtube"></i></a>
                                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Pinterest"><i class="fa fa-pinterest"></i></a>
                                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Twitter"><i class="fa fa-twitter"></i></a>
                                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Instagram"><i class="fa fa-instagram"></i></a>
                                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Website"><i class="fa fa-link"></i></a>
                                        </div><!-- end social -->

                                    </div><!-- end col -->
                                </div><!-- end row -->
                            </div><!-- end author-box -->
                            
                            <hr class="invis1">

                            <div class="custombox clearfix">
                                <h4 class="small-title">You may also like</h4>
                                <div class="row">
                                @php
                                    $catId = $value->catId;
                                    $postbycat = App\Models\PostModel::Join('tbl_category', 'tbl_category.id', '=', 'tbl_post.catId')->where('tbl_post.catId','=',$catId)->where('tbl_post.poststatus', '=', 1)->take(4)->get(['tbl_post.id', 'tbl_post.posttitle', 'tbl_post.postImg', 'tbl_post.posttime', 'tbl_category.catName']);
                                @endphp
                                @foreach($postbycat as $value)
                                    <div class="col-lg-6">
                                        <div class="blog-box">
                                            <div class="post-media">
                                                <a href="{{url('techblog/postdetails/'.$value->id)}}" title="">
                                                    <img src="{{asset('uploads/post/'.$value->postImg)}}" alt="Post Image" class="img-fluid" style="height:200px">
                                                    <div class="hovereffect">
                                                        <span class=""></span>
                                                    </div><!-- end hover -->
                                                </a>
                                            </div><!-- end media -->
                                            <div class="blog-meta">
                                                <h4><a href="{{url('techblog/postdetails/'.$value->id)}}" title="">{{ $value->posttitle }}</a></h4>
                                                <small><a href="{{url('techblog/postdetails/'.$value->id)}}" title="">{{ $value->catName }}</a></small>
                                                <small><a href="{{url('techblog/postdetails/'.$value->id)}}" title="">{{ $value->posttime->format('j F, Y') }}</a></small>
                                            </div><!-- end meta -->
                                        </div><!-- end blog-box -->
                                    </div><!-- end col -->
                                @endforeach
                                    
                                </div><!-- end row -->
                            </div><!-- end custom-box -->

                            <hr class="invis1">

                            <div class="custombox clearfix">
                                <h4 class="small-title">{{$comments->count()}} Comments</h4>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="comments-list">
                                        @if(Session::has('mancommentfail'))
                                            <div class="alert alert-danger">{{Session::get('mancommentfail')}}</div>
                                        @endif
                                        @if(Session::has('mancommentsuccess'))
                                            <div class="alert alert-success">{{Session::get('mancommentsuccess')}}</div>
                                        @endif

                                        @foreach($comments as $postcomment)    
                                            <div class="media">
                                                <a class="media-left" href="#">
                                                    <img 
                                                    @if($postcomment->userImg == '')
                                                    src="{{asset('images/default_image/avater.png')}}" alt="Author Image"
                                                    @else
                                                    src="{{asset('uploads/users/'.$postcomment->userImg)}}" alt="Author Image"
                                                    @endif class="rounded-circle">
                                                </a>
                                                <div class="media-body">
                                                    <h4 class="media-heading user_name">{{ $postcomment->userName }} <small>{{ $postcomment->date->format('d M, Y - h:i a') }}</small></h4>
                                                    <p>{!! $postcomment->text !!}</p>
                                                @if($postcomment->userId != Session::get('loginid'))    
                                                    <a href="#" class="btn btn-primary btn-sm">Reply</a>
                                                @endif
                                                @if($postcomment->userId == Session::get('loginid'))
                                                    <a href="{{url('techblog/editcomment/'.$postcomment->id)}}" class="btn btn-success btn-sm" style="padding:5px 15px !important;font-size: 11px !important; background: rgba(0, 0, 0, 0) linear-gradient(to right, #388f0c 0px, #75d91a 100%) repeat scroll 0 0 !important">Edit</a>
                                                    <a style="padding:5px 15px !important;font-size: 11px !important; background: rgba(0, 0, 0, 0) linear-gradient(to right, #c01575 0px, #ff0404 100%) repeat scroll 0 0 !important" href="{{url('techblog/removecomment/'.$postcomment->id)}}" class="btn btn-danger btn-sm">Delete</a>
                                                @endif
                                                </div>
                                            </div>
                                        @endforeach
                                        </div>
                                    </div><!-- end col -->
                                </div><!-- end row -->
                            </div><!-- end custom-box -->

                            <hr class="invis1">
                        
                            <div class="custombox clearfix">
                                <h4 class="small-title">Leave a Reply</h4>
                                @if(Session::has('loginid'))
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form action="{{url('techblog/addcomment/'.Session::get('postid'))}}" method="POST" class="form-wrapper">
                                        @csrf
                                        @if(Session::has('fail'))
                                            <div class="alert alert-danger">{{Session::get('fail')}}</div>
                                        @endif
                                        @if(Session::has('success'))
                                            <div class="alert alert-success">{{Session::get('success')}}</div>
                                        @endif
                                            @if(@error)
                                                @error('name')
                                                    <div class="alert alert-danger">{{$message}}</div>
                                                @enderror
                                            @endif
                                            <input type="text" class="form-control" placeholder="Your name" name="name" value="{{old('name')}}">
                                            @if(@error)
                                                @error('email')
                                                    <div class="alert alert-danger">{{$message}}</div>
                                                @enderror
                                            @endif
                                            <input type="text" class="form-control" placeholder="Email address" name="email" value="{{old('email')}}">
                                            @if(@error)
                                                @error('website')
                                                    <div class="alert alert-danger">{{$message}}</div>
                                                @enderror
                                            @endif
                                            <input type="text" class="form-control" placeholder="Website" name="website" value="{{old('website')}}">
                                            @if(@error)
                                                @error('text')
                                                    <div class="alert alert-danger">{{$message}}</div>
                                                @enderror
                                            @endif
                                            <textarea class="form-control" placeholder="Your comment" name="text" value="{{old('text')}}"></textarea>
                                            <button type="submit" class="btn btn-primary">Submit Comment</button>
                                        </form>
                                    </div>
                                </div>
                                @else
                                <div class="text-center my-3">
                                    <a href="{{url('admin/login')}}"><button class="btn btn-primary">Login</button></a> To Reply
                                </div> 
                                @endif
                            </div>
                            @endforeach
                        </div><!-- end page-wrapper -->
                    </div><!-- end col -->
@endsection


