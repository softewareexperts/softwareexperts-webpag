@extends('layouts.app')
<style>
    .display-comment .display-comment {
        margin-left: 40px
    }
</style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <p><b>{{ $post->title }}</b></p>
                    <p>
                        {{ $post->body }}
                    </p>
                    <hr />
                    <h4>Add comment</h4>
                    <form method="post" action="{{ route('comment.add') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="text" name="comment_body" class="form-control" required/>
                            <input type="hidden" name="post_id" value="{{ $post->id }}" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-warning" value="Add Comment"/>
                        </div>
                    </form>
                    <h3><strong>Comments</strong></h3>
                    {{--  @include('comment_replies', ['comments' => $post->comments, 'post_id' => $post->id])  --}}
                    @foreach($post->comments as $comment)
                    <div class="display-comment">
                        <h3><strong>{{ $comment->body }}</strong></h3>
                        Comment By: <strong>{{ $comment->user->name }}</strong><br>
                            <form method="post" action="{{ route('reply.add') }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="text" name="comment_body" class="form-control" required/>
                                    <input type="hidden" name="post_id" value="{{ $post->id }}" />
                                    <input type="hidden" name="comment_id" value="{{ $comment->id }}" />
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-warning" value="Reply" required />
                                </div>
                            </form>
                        @include('replies', ['comments' => $comment->replies])
                    </div>
                @endforeach
                    <hr />              
                </div>
            </div>
        </div>
    </div>
</div>
@endsection