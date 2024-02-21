<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.posts.index')->only('index');
        $this->middleware('can:admin.posts.edit')->only('edit', 'update');
        $this->middleware('can:admin.posts.create')->only('create','store');
        $this->middleware('can:admin.posts.destroy')->only('destroy');
    }
    public function index()
    {
        return view('admin.posts.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id');
        $tags = Tag::all();
        
        return view('admin.posts.create', compact('categories', 'tags') );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        
        // Storage::put('posts', $request->file('file'));
        $post = Post::create($request->all());

        if($request->file('file')){
            $url = Storage::put('public/posts', $request->file('file'));
            $post->image()->create([
                'url' => $url
            ]);
        }

        Cache::flush(); // para eliminar todos los datos en chace y se actualice la base de datos

        if($request->tags){
            $post->tags()->attach($request->tags);
        }
        return redirect()->route('admin.posts.edit', $post);
    }

    
    public function edit(Post $post)
    {
        $this->authorize('author', $post);
        $categories = Category::pluck('name', 'id');
        $tags = Tag::all();
        
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post)
    {
        $this->authorize('author', $post);
        $post->update($request->all());
        if($request->file('file')){
            $url = Storage::put('public/posts', $request->file('file'));
            if($post->image){
                Storage::delete($post->image->url);
                $post->image->update([
                    'url' => $url
                ]);
            } else {
                $post->image()->create([
                    'url' => $url
                ]);
            }
        }
        if($request->tags){
            $post->tags()->sync($request->tags);
        }
        Cache::flush(); // para eliminar todos los datos en chace y se actualice la base de datos
        return redirect()->route('admin.posts.edit', $post)->with('info', 'El Post se actualizó con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('author', $post);
        $post->delete();
        Cache::flush(); // para eliminar todos los datos en chace y se actualice la base de datos
        return redirect()->route('admin.posts.index')->with('info', 'El Post se eliminó con exito');
    }
}
