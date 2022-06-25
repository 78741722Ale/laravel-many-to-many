@extends('layouts.admin')


@section('content')

<div class="posts d-flex py-4">
    <!-- Immagine del Post -->
    <img class="img-fluid" src="{{$post->cover_image}}" alt="{{$post->title}}">
    <!-- Contenuto di tutto il post con le categorie -->
    <div class="post-data px-4">
        <!-- Titolo -->
        <h1>{{$post->title}}</h1>
        <!-- Categoria -->
        <div class="metadata">
            <strong>Category: </strong> <em>{{$post->category ? $post->category->name : 'Uncategorized'}}</em>
        </div>
        <!-- Contenuto -->
        <div class="content">{{$post->content}}</div>
    </div>
</div>


@endsection
