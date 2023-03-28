@extends('layouts.app')
@section('title')
    Update Members
@endsection
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                
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
                        <form method="POST" action="{{ url('post_update',$data->id) }}">
                            {{ csrf_field() }}
                            <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="Name">Name</label>
                                <input type="text" class="form-control" value="{{ $data->name }}" name="name" id="Name" placeholder="Name" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="rank">Rank</label>
                                <input type="text" class="form-control" value="{{ $data->rank }}" name="rank" id="rank" placeholder="Rank" required>
                            </div>
                            </div>
                            <div class="form-group col-md-12">
                            <label for="company">Comany</label>
                            <input type="text" class="form-control" value="{{ $data->company }}" name="company" id="company" placeholder="inc" required>
                            </div>
                          
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                     </div>
                </div>
          </div>
     </div>


@endsection