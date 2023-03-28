@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <p><b>{{ $article_detail->title }}</b></p>
                    <p>
                        {{ $article_detail->body }}
                    </p>
                    <hr />
                    <h4>Add comment</h4>
                    <form id="comment-form" method="POST" action="{{ route('review.store',$article_detail->id) }}">
                        {{ csrf_field() }}
                        <input type="hidden" value="{{ $article_detail->id }}" name="article_id">
                        <div class="form-group">
                            <input type="text" name="message" id="review" class="form-control" placeholder="Comment on Article" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" id="btncomment" class="btn btn-warning" value="Add Comment" required>
                        </div>
                    </form>
                    <h3><strong>Comments</strong></h3>
                    <div id="comments-section">
                        @foreach($article_detail->reviews as $comment) 
                                <h3 id="message"><strong>{{ $comment->message }}</strong></h3>
                                Comment By: <strong>{{ $comment->user->name }}</strong><br>
                                <form class="reply-form" method="post" action="{{ url('store.replies',$comment->id) }}">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <input type="text" name="body" class="form-control" placeholder="Reply to this comment" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-warning" value="Reply" required>
                                    </div>
                                </form>  
                                <H4>Replies</H4>
                                <hr>
                                @foreach($comment->replies as $reply)
                                       <div class="display-comment">
                                        {{ $reply->user->name }} : Replied
                                        <h4><strong>{{ $reply->body }}</strong></h4>
                                        <hr>
                                       </div>
                                @endforeach
                        @endforeach
                    </div>
                    <hr/>    
                
                </div>
            </div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('.reply-form').submit(function(e) {
            e.preventDefault();
    
            var form = $(this);
            var url = form.attr('action');
            var formData = form.serialize();
    
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                success: function(response) {
                    var reply = response.reply;
                    var userName = response.user.name;
                    var html = '<div class="display-comment">' +
                        userName+' : Replied' +
                        '<h4><strong>' + reply.body + '</strong></h4>' +
                        '<hr>' +
                        '</div>';
    
                    form.closest('#comments-section').append(html);
                    $('#comment-form').find('.form-control').val('');
                },
                error: function(xhr) {
                }
            });
        });
    
        $(document).ready(function() {
            $('#comment-form').submit(function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                var url = $(this).attr('action');
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        var comment = response.comment;
                        var userName = response.user.name;
                        var commentHtml = '<div class="comments-section">' +
                            '<h3 id="message"><strong>' + comment.message + '</strong></h3>' +
                            'Comment By: <strong>' + userName + '</strong><br>' +
                            '<form method="post" action="store.replies">' +
                            '{{ csrf_field() }}' +
                            '<div class="form-group">' +
                            '<input type="text" name="body" class="form-control" placeholder="Reply to this comment" required/>' +
                            '</div>' +
                            '<div class="form-group">' +
                            '<input type="submit" class="btn btn-warning" value="Reply" required />' +
                            '</div>' +
                            '</form>' +
                            '<H4>Replies</H4>' +
                            '<hr>' +
                            '</div>';
                        $('#comments-section').append(commentHtml);
                        $('#comment-form').find('.body').val('');
                    },
                });
            });
        });
    });
</script>  
@endsection

{{--  
$('.display-comment').append(html);
$('.body').val('');  --}}

