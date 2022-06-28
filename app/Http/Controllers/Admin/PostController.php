<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderByDesc('id')->get();
        $tags = Tag::all();
        return view('admin.posts.index', compact('posts', 'tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //get all category
        $categories = Category::all();
        //get all tags
        $tags = Tag::all();
        //dd($categories);
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PostRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        /* Effettua verifica della validazione */
        /* ddd($request->all()); */

        $val_data = $request->validated();
        // Genera la slug
        $slug = Post::generateSlug($request->title);
        $val_data['slug'] = $slug;


        // Verificare la richiesta e se contiene un file con una condizione
        /* ddd($request->hasFile('cover')); */
        if(array_key_exists('cover', $request->all())) {
            // Valida il file
            $request->validate([
                'cover' => 'nullable|image|max:500'
            ]);
            // Salvarlo nel file System
            $path = Storage::put('post_images', $request->cover);
            // Recupera il percorso
            /* ddd($path); */
            // passo il percorso all'array di dati per il salvataggio
            $val_data['cover'] = $path;
        }

        // Crea la risorsa
        $new = Post::create($val_data);
        $new->tags()->attach($request->tags);
        /* Ora il return del pattern */
        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // Qua mi basta solo ritornare la view
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        /* Qua Dichiaro i dati da editare tramite modello */
        $categories = Category::all();
        $tags = Tag::all();
        /* Qua ritorno la view del form per editare */
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        /* Validazione dei dati */
        $val_data = $request->validate(
            [
                'title' => 'required|max:50',
                'category_id' => 'nullable|exists:categories,id',
                'cover' => 'nullable',
                'content' => 'nullable',
                'tags' => 'exists:tags,id' //validate tags
            ]
        );

        // Genera lo slug
        $slug = Post::generateSlug($request->title);
        $val_data['slug'] = $slug;
         /* Avvio l'update */
        $post->update($val_data);
        /* Lo sincronizzo coi Tags */
        $post->tags()->sync($request->tags);

        /* Ora eseguo il return della rotta */
        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // Qui si Cancella un record
        $post->delete();
        /* Ora eseguo il return della rotta */
        return redirect()->route('admin.posts.index');
    }
}
