@extends('layouts.app')
@section('title')
    Dashboard
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    {{ session('status') }}
                </div>
                @elseif(session('failed'))
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    {{ session('failed') }}
                </div>
                @endif
                <div class="panel-body">
                    <table class="table caption-top">
                        <caption>List of users</caption>
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Company</th>
                            <th scope="col">Rank</th>
                            <th scope="col">Action</th>                            
                          </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $data)
                          <tr>
                            <th scope="row">{{$data->id}}</th>
                            <td>{{$data->name}}</td>
                            <td>{{$data->company}}</td>
                            <td>{{$data->rank}}</td>
                            <td>
                                <!-- Button trigger modal -->
                                <a href="{{ url('update_member',$data->id) }}"><button class="btn btn-success">Update</button></a>
                                <a href="{{ url('delete_member',$data->id) }}"><button onclick="return confirm('Are You Sure to delete this?')"
                                     class="btn btn-danger">Delete</button></a>
                                                         
                                 </td>
                          </tr>
                            @empty
                                No Records Available
                            @endforelse

                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
