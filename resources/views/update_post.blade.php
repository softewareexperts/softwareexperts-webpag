@extends('layouts.app')
@section('title')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
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
            <div class="card">
                <div class="card-header">Edit Post</div>
                <div class="card-body">
                    <form method="post" action="{{ Route('p.update',$update_post->id) }}">
                        <div class="form-group">
                            {{ csrf_field() }}
                            <h3>Title</h3>
                            <input type="text" value="{{ $update_post->title }}" name="title" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <h3>Post<h3>
                            <textarea name="body"  class="form-control" required>{{ $update_post->body }}</textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Save Changes" class="btn btn-success" />
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
