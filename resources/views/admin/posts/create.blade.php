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
        <small id="titleHelper" class="text-muted">Max 150 Caratteri</small>
    </div>
    <!-- Input immagine del post -->
    <div class="mb-4">
        <label for="cover">Immagine</label>
        <input type="text" name="cover" id="cover" class="form-control @error('cover') is-invalid @enderror" placeholder="Learn php article" aria-describedby="coverHelper" value="{{old('cover')}}">
        <small id="cover" class="text-muted">Immagine del Post</small>
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
    <!-- Tag della categoria -->
    <div class="form-group">
        <label for="tags">Tags</label>
        <select multiple class="form-control" name="tags[]" id="tags">
            @if($tags) @foreach($tags as $tag)
            <option value="{{$tag->id}}">{{$tag->name}}</option>
            @endforeach @endif
        </select>
    </div>
    @error('tags')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <!-- Contenuto del post -->
    <div class="mb-4">
        <label for="content">Contenuto</label>
        <textarea class="form-control  @error('content') is-invalid @enderror" name="content" id="content" rows="4">{{old('content')}}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Aggiungi Post</button>
</form>

@endsection
