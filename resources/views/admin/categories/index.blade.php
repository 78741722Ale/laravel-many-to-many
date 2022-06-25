@extends('layouts.admin')

@section('content')

@include('partials.session_message')
@include('partials.errors')

<div class="container">
    <h1 class="my-3">Categorie</h1>
    <div class="row">
        <!-- Colonna per l'aggiunta di una categoria -->
        <div class="col pe-5">
            <form action="" method="post" class="d-flex align-items-center">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" name="name" class="form-control" placeholder="Aggiungi Categoria" aria-label="Aggiungi Categoria" aria-describedby="button-addon2">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Aggiungi</button>
                </div>
            </form>
        </div>
        <!-- Colonna con le categorie -->
        <div class="col">
            <table class="table table-striped table-inverse table-responsive">
                <!-- Intestazione Tabella -->
                <thead class="thead-inverse">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Posts Count</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <!-- Corpo della tabella -->
                <tbody>
                    @forelse($cats as $category)
                    <tr>
                        <!-- Id -->
                        <td scope="row">{{$category->id}}</td>
                        <!-- Slug -->
                        <td>
                            <form id="category-{{$category->id}}" action="{{route('admin.categories.update', $category->slug)}}" method="post">
                                @csrf
                                @method('PATCH')
                                <input class="border-0 bg-transparent" type="text" name="name" value="{{$category->name}}">
                            </form>
                        </td>
                        <!-- Slug -->
                        <td>{{$category->slug}}</td>
                        <td><span class="badge badge-info bg-dark">{{count($category->posts)}}</span></td>
                        <!-- Buttons edit e cancella -->
                        <td>
                            <!-- Button edit -->
                            <button form="category-{{$category->id}}" type="submit" class="btn btn-primary">Aggiorna</button>
                            <!-- Button Delete -->
                            <form action="{{route('admin.categories.destroy', $category->slug)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger text-white">Cancella</button>
                            </form>
                        </td>
                    </tr>
                    <!-- In caso di vuoto -->
                    @empty
                    <tr>
                        <td scope="row">Non ci sono categorie</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
