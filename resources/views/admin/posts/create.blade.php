@extends('layouts.admin')

@section('content')

<h2 class="py-4">Crea un nuovo post</h2>
@include('partials.errors')
<form action="{{route('admin.posts.store')}}" method="post">
    @csrf
    <!-- Input del titolo -->
    <div class="mb-4">
        <label for="title">Titolo</label>
        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Scrivi un titolo" aria-describedby="titleHelper" value="{{old('title')}}">
        <small id="titleHelper" class="text-muted">Max 150 carachters</small>
    </div>
    <!-- Input immagine del post -->
    <div class="mb-4">
        <label for="cover_image">Immagine</label>
        <input type="text" name="cover_image" id="cover_image" class="form-control  @error('cover_image') is-invalid @enderror" placeholder="Learn php article" aria-describedby="cover_imageHelper" value="{{old('cover_image')}}">
        <small id="cover_imageHelper" class="text-muted">Immagine del Post</small>
    </div>
    <!-- Selezione della categoria -->
    <div class="mb-3">
        <label for="category_id" class="form-label">Categoria</label>
        <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
            <option value="">Seleziona una categoria</option>
            @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
    </div>
    <!-- Contenuto del post -->
    <div class="mb-4">
        <label for="content">Contenuto</label>
        <textarea class="form-control  @error('content') is-invalid @enderror" name="content" id="content" rows="4">{{old('content')}}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Aggiungi Post</button>
</form>

@endsection
