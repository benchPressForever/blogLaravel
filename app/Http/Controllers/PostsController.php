<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAndStorePostRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Complaint;
use App\Models\Post;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    public function addLike(Post $post){

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

    public function show(Post  $post)
    {

        $comments = Comment::where('post_id',$post->id)->with('user')->orderBy("created_at",'desc')->paginate(3);
        $user = User::query()->where("id",$post->user_id)->first();

        return view('posts.show', [
            'post' => $post,
            'comments' => $comments,
            'user' => $user,
        ]);
    }

    public function indexUser()
    {

        $posts = Post::query()->where("user_id",Auth::id())->orderBy('likes','desc')->paginate(10);

        return view('posts.my',[
            'posts' => $posts,
        ]);
    }


    public function store(UpdateAndStorePostRequest $request)
    {

        $validated = $request->validated();

        try{
            $imagePath = null;
            if($request->hasFile('image')){
                $imagePath = $request->file('image')->store('posts', 'public');
            }
            $validated['image'] = $imagePath;
            $validated['user_id'] = Auth::id();
            Post::create($validated);
        }
        catch (\Exception $exception){
            return redirect()->route('posts.index.my')->with('error', 'Ошибка добавления поста');
        }

        return redirect()->route('posts.index.my')->with('success', 'Пост успешно добавлен');
    }


    public function create()
    {
        $categories = Category::all();

        return view('posts.create', [
            'categories' => $categories
        ]);
    }


    public function delete(Post $post)
    {
        try {
            Comment::query()->where("post_id", $post->id)->delete();
            Complaint::query()->where("post_id",$post->id)->delete();
            $post->delete();
        }
        catch (\Exception $exception){
            return redirect()->route('posts.index.my')->with('error', 'Пост не удалось удалить!');
        }

        return redirect()->route('posts.index.my')->with('success', 'Пост успешно удалён!');
    }

    public function edit(Post $post)
    {
        $categories = Category::all();

        return view('posts.edit', [
            'categories' => $categories,
            'post' => $post,
        ]);
    }

    public function update(UpdateAndStorePostRequest $request, Post $post)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
            $data['image'] = $imagePath;
        }
        $data['user_id'] = $post->user_id;

        try {
            $post->update($data);
        }
        catch (\Exception $exception){
            return redirect()->route('posts.index.my')->with('error', 'Не удалось изменить пост!');
        }

        return redirect()->route('posts.index.my')->with('success', 'Пост успешно изменён!');
    }
}
