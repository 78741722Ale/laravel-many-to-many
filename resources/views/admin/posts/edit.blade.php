@extends('layouts.admin')


@section('content')


<h2 class="py-4">Edit {{$post->title}}</h2>
@include('partials.errors')
<form action="{{route('admin.posts.update', $post->slug)}}" method="post">
    <!-- Token e metodo -->
    @csrf
    @method('PUT')
    <!-- Zona edit del titolo -->
    <div class="mb-4">
        <label for="title">Titolo</label>
        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Learn php article" aria-describedby="titleHelper" value="{{old('title', $post->title)}}">
        <small id="titleHelper" class="text-muted">Max 150 caratteri</small>
    </div>
    <!-- Zona edit dell'immagine -->
    <div class="d-flex">
        <!-- Immagine -->
        <div class="media me-4 pb-4">
            <img class="shadow" width="140" src="{{$post->cover}}" alt="{{$post->title}}">
        </div>
        <!-- Messaggi -->
        <div class="mb-4 px-3">
            <label for="cover">Immagine</label>
            <input type="text" name="cover" id="cover" class="form-control w-100  @error('cover') is-invalid @enderror" placeholder="Learn php article" aria-describedby="coverHelper" value="{{old('cover', $post->cover)}}">
            <small id="coverHelper" class="text-muted">Edita l'immagine del post</small>
        </div>
    </div>
    <!-- Seleziona una categoria -->
    <div class="mb-3">
        <label for="category_id" class="form-label">Categorie</label>
        <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
            <option value="">Select a category</option>
            @foreach($categories as $category)
            <option value="{{$category->id}}" {{$category->id == old('category_id', $post->category->id)  ? 'selected' : ''}}>{{$category->name}}</option>
            @endforeach
        </select>
    </div>
    <!-- Contenuto del Post -->
    <div class="mb-4">
        <label for="content">Contenuto del Post</label>
        <textarea class="form-control p-1  @error('content') is-invalid @enderror" name="content" id="content" rows="3">
        {{old('content', $post->content)}}
        </textarea>
    </div>
    <!-- Button per l'edit -->
    <button type="submit" class="btn btn-primary">Edita</button>
</form>



@endsection
