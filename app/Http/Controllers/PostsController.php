<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::query()->orderBy('likes','desc')->paginate(10);

        return view('posts.index', [
            'posts' => $posts,
        ]);
    }
    public function addLike(string $id){

        $post = Post::query()->find($id);

        if($post){
            $post->increment('likes');
            return response()->json([
                'seccess' => true,
                'message' => 'Liked',
                'likes' => $post->likes,
            ]);
        }
        return response()->json([
            'seccess'=>'false',
            'message'=>'No Liked',
            'likes'=> $post->likes,
        ]);
    }

    public function show(string $id)
    {

        $post = Post::findOrFail($id);

        return view('posts.show', [
            'post' => $post,
        ]);
    }
}
