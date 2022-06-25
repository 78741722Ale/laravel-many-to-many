@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between py-4">
        <h1>Tutti i Post</h1>
        <div><a href="{{route('admin.posts.create')}}" class="btn btn-primary">Aggiungi un Post</a></div>
    </div>

    @include('partials.session_message')
    <table class="table">
        <!-- Intestazione della tabella -->
        <thead class="thead-inverse">
            <tr>
                <th>ID</th>
                <th>TITOLO</th>
                <th>SLUG</th>
                <th>IMAGE</th>
                <th>AZIONI</th>
            </tr>
        </thead>
        <!-- Corpo della tabella -->
        <tbody>
            @forelse($posts as $post)
            <tr>
                <!-- Colonna dell'ID -->
                <td scope="row">{{$post->id}}</td>
                <!-- Colonna del Titolo -->
                <td>{{$post->title}}</td>
                <!-- Colonna dello Slug (praticamente mette i trattini al titolo (?) ) -->
                <td>{{$post->slug}}</td>
                <!-- Colonna dell'immagine -->
                <td><img width="150" src="{{$post->cover_image}}" alt="Cover image {{$post->title}}"></td>
                <!-- Colonna delle opzioni -->
                <td>
                    <!-- Button per la rotta show.blade.php -->
                    <a class="btn btn-primary text-white btn-sm" href="{{route('admin.posts.show', $post->slug)}}">Visualizza</a>
                    <!-- Button per la rotta edit.blade.php -->
                    <a class="btn btn-secondary text-white btn-sm" href="{{route('admin.posts.edit', $post->slug)}}">Edit</a>

                    <!-- Da qua il modale per il click del delete -->
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-post-{{$post->id}}">Cancella</button>

                    <!-- Modal -->
                    <div class="modal fade" id="delete-post-{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitle-{{$post->id}}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Cancella</h5>
                                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <!-- Domanda del Modale -->
                                <div class="modal-body">
                                    Sicuro di voler cancellare?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <!-- Form per Eliminare -->
                                    <form action="{{route('admin.posts.destroy', $post->slug)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <!-- Button per conferma eliminazione -->
                                        <button type="submit" class="btn btn-danger">Conferma</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>

            @empty
            <!-- Condizione in caso di Vuoto -->
            <tr>
                <td scope="row">Non ci sono Post<a href="{{route('admin.posts.create')}}">Creane uno tu!</a></td>
            </tr>
            @endforelse
        </tbody>
    </table>


</div>
@endsection
