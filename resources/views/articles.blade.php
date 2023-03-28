@extends('layouts.app')
@section('title')
Add Members
@endsection
@section('content')
@foreach($article as $article)
<div class="container mt-5 mb-5">
<div class="d-flex justify-content-center row">
    <div class="d-flex flex-column col-md-8">
<div class="coment-bottom bg-white p-2 px-4">
<div
    class="commented-section mt-2">
    <div class="d-flex flex-row align-items-center commented-user">
        </div>
        <div class="comment-text-sm">
            <span>{{ $article->title }}.</span>
        </div>
        <a data-target="#exampleModalCenter">
           Comments ({{ count($article->reviews) }})
        </a>
        <br>
        <a href="{{ route('article.detail', $article->id) }}">Read Article</a> |
        <p>
    </div>
            </div>    
        </div>
    </div>
        </div>
        @endforeach
@endsection
