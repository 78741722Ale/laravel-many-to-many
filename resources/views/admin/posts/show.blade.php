@extends('layouts.admin')


@section('content')

<div class="posts d-flex py-4">
    <!-- Immagine del Post -->
    <img class="img-fluid" src="{{$post->cover}}" alt="{{$post->title}}">
    <!-- Contenuto di tutto il post con le categorie -->
    <div class="post-data px-4">
        <!-- Titolo -->
        <h1>{{$post->title}}</h1>
        <!-- Categoria -->
        <div class="metadata">
            <strong>Category: </strong> <em>{{$post->category ? $post->category->name : 'Uncategorized'}}</em>
        </div>
        <!-- Tags -->
        <div class="tags">
            tags: @if(count($post->tags) > 0)
                @foreach($post->tags as $tag)
                {{$tag->name}}
                @endforeach
            @else
            <span>No tags</span>
            @endif
        </div>
        <!-- Contenuto -->
        <div class="content">{{$post->content}}</div>
    </div>
</div>


@endsection
