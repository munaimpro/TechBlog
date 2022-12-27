@extends('Admin.Masterlayout.app')
@section('title', 'Message')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Message</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Message</li>
            </ol>
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="Date">Date</label><br><br>
                        <input class="form-control" type="text" value=
                        "{{$message->date->format('j F, Y')}}">
                    </div>
                    <div class="mb-3">
                        <label for="Name">Name</label><br><br>
                        <input class="form-control" type="text" value=
                        "{{$message->name}}">
                    </div>
                    <div class="mb-3">
                        <label for="Email">Email</label><br><br>
                        <input class="form-control" type="text" value=
                        "{{$message->email}}">
                    </div>
                    <div class="mb-3">
                        <label for="Phone">Phone</label><br><br>
                        <input class="form-control" type="text" value=
                        "{{$message->phone}}">
                    </div>
                    <div class="mb-3">
                        <label for="Subject">Subject</label><br><br>
                        <input class="form-control" type="text" value=
                        "{{$message->subject}}">
                    </div>
                    <div class="mb-3">
                        <label for="Message">Message</label><br><br>
                        <textarea class="form-control" cols="30" rows="10">
                            {{$message->message}}
                        </textarea>
                    </div>
                    
                    <div class="mb-3">
                        <a href="{{url('admin/replymessage/'.$message->id)}}"><button class="btn btn-primary btn-block" type="submit">Reply Message</button></a>
                    </div>
                </div>
            </div>    
        </div>
    </main>








@endsection