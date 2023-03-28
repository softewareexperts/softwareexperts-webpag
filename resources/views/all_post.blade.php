@extends('layouts.app')
@section('title')
Add Members
@endsection
@section('content')
@foreach($posts as $post)
<div class="container mt-5 mb-5">
<div class="d-flex justify-content-center row">
    <div class="d-flex flex-column col-md-8">
<div class="coment-bottom bg-white p-2 px-4">
<div
    class="commented-section mt-2">
    <div class="d-flex flex-row align-items-center commented-user">
        </div>
        <div class="comment-text-sm">
            <span>{{ $post->title }}.</span>
        </div>
        <a data-target="#exampleModalCenter">
           Comments ({{ count($post->comments) }})
        </a>
        <br>
        <a href="{{ url('post_detail', $post->id) }}">View Post</a> |
{{--         
        @can
        <a href="{{ url('post_detail', $post->id) }}">Edit post</a>
        @endcan  --}}
        <p>
    </div>
            </div>    
        </div>
    </div>
        </div>
        @endforeach
@endsection
