<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts=Post::all();
        return response()->json(data: $posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        $data=$request->all();
        $slug=Str::slug($data['title'],'-');
        $data['slug']=$slug;
        Post::create($data);
        return response()->json( ['message'=>'Le post a bien été enregistré'],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post= Post::findOrFail($id);
        return response()->json(data: $post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data=$request->all();
        $slug=Str::slug($data['title'],'-');
        $data['slug']=$slug;
        $post=Post::findOrFail($id);
        $post->update($data);
        return response()->json( ['message'=>'Le post a bien été modifié'],201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post=Post::findOrFail($id);
        $post->delete();
        return response()->json(['message'=>'Le post a bien été supprimé'],200);
    }
}
