<h3><strong>Replies</strong></h3>
<hr>
@foreach($comments as $comment)
<div class="display-comment">
    {{ $comment->user->name }} : Replied
    <h4><strong>{{ $comment->body }}</strong></h4>
    {{--  <p>
        <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
          Reply
        </a>
      </p>  --}}
       <hr>
      <div class="collapse" id="collapseExample">
        <div class="card card-body">
         <form method="post" action="{{ route('reply.add') }}">
            {{ csrf_field() }}
            <div class="form-group">
                <input type="text" name="comment_body" class="form-control" required/>
                <input type="hidden" name="post_id" value="{{ $post->id }}" />
                <input type="hidden" name="comment_id" value="{{ $comment->id }}" />
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-warning" value="Reply" />
            </div>
        </form>
        </div>
      </div>
{{--  @include('replies', ['comments' => $comment->replies])--}}
</div>
@endforeach
</hr>