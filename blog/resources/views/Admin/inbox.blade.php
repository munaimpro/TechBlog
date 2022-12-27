@extends('Admin.Masterlayout.app')
@section('title', 'Inbox')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">All Message</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Message</li>
            </ol>
            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
            <div class="row">
                <div class="card mb-4 p-0">
                    <div class="card-header">
                        <h4 class="float-start">Message List</h4>
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Message</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach($inbox as $value)
                                @php
                                    $i++;
                                @endphp
                                <tr @if($value->status == 0) style="background:#cbc6a8" @endif>
                                    <td>{{ $i }}</td>
                                    <td>{{ Str::limit($value->message, 50) }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->email }}</td>
                                    <td>
                                    @if(Session::get('loginrole') == 2)
                                        <a href="{{url('admin/viewmessage'.'/'.$value->id)}}"><button class="btn btn-primary">View</button></a>
                                        <a onclick="return confirm('Are you sure to delete this message?')" href="{{url('admin/removemessage'.'/'.$value->id)}}"><button class="btn btn-danger">Delete</button></a>
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