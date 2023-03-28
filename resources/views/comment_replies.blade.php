 @foreach($comments as $comment)
    <div class="display-comment">
        <h3><strong>{{ $comment->body }}</strong></h3>
        Comment By: <strong>{{ $comment->user->name }}</strong><br>
            <form method="post" action="{{ route('reply.add') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="text" name="comment_body" class="form-control" required/>
                    <input type="hidden" name="post_id" value="{{ $post_id }}" />
                    <input type="hidden" name="comment_id" value="{{ $comment->id }}" />
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-warning" value="Reply" required />
                </div>
            </form> 
        @include('replies', ['comments' => $comment->replies])
    </div>
@endforeach