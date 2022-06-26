<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
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
        return view('admin.posts.index', compact('posts'));
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
        $val_data = $request->validated();
        // Genera la slug
        $slug = Post::generateSlug($request->title);
        $val_data['slug'] = $slug;
        // Crea la risorsa
        Post::create($val_data);
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
        /* Qua ritorno la view del form per editare */
        return view('admin.posts.edit', compact('post', 'categories'));
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
                'cover_image' => 'nullable',
                'content' => 'nullable'
            ]
        );

        // Genera lo slug
        $slug = Post::generateSlug($request->title);
        $val_data['slug'] = $slug;
         /* Avvio l'update */
        $post->update($val_data);

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
