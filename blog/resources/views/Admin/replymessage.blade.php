@extends('Admin.Masterlayout.app')
@section('title', 'Reply Message')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Reply Message</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Message</li>
            </ol>
            <div class="row">
                <div class="col-md-12">
                    @if(Session::has('fail'))
                        <div class="alert alert-danger">
                            {{Session::get('fail')}}
                        </div>
                    @endif
                    @if(Session::has('success'))
                        <div class="alert alert-danger">
                            {{Session::get('success')}}
                        </div>
                    @endif
                    <form action="{{url('admin/sendreply')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="From">From</label><br><br>
                            <input class="form-control" type="text" name="fromemail" id="inputFirstName" placeholder="Enter your email" value="{{old('fromemail')}}">
                        </div>
                        @if(@error)
                            @error('fromemail') 
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        @endif
                        @foreach($message as $value)
                        <div class="mb-3">
                            <label for="To">To</label><br><br>
                            <input readonly class="form-control" type="text" name="toemail" id="inputFirstName" placeholder="Enter your email" value="{{$value->email}}">
                        </div>
                        @endforeach
                        <div class="mb-3">
                            <label for="Subject">Subject</label><br><br>
                            <input class="form-control" type="text" name="subject" id="inputFirstName" placeholder="Enter your subject" value="{{old('fromemail')}}">
                        </div>
                        @if(@error)
                            @error('subject') 
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        @endif
                        <div class="mb-3">
                            <label for="Reply Message">Reply Message</label><br><br>
                            <textarea class="form-control" name="replymessage" id="" cols="30" rows="10" placeholder="Enter post content">{{old('replymessage')}}</textarea>
                        </div>
                        @if(@error)
                            @error('replymessage') 
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        @endif

                        <div class="mb-3">
                            <button class="btn btn-primary btn-block" type="submit">Send Reply</button>
                        </div>
                    </form>
                </div>
            </div>    
        </div>
    </main>








@endsection