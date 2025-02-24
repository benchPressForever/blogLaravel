<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class CommentsController extends  Controller
{
    public function index(){

        $comments = Comment::query()->with('user')->orderBy("created_at",'desc')->paginate(3);

        return view('admin.comments.index',[
            'comments' => $comments
        ]);
    }

    public function delete(Comment $comment){
        try {
            $comment->delete();
        }
        catch (\Exception $exception){
            return redirect()->route('admin.comments.index')->with('error', 'Ошибка удаления комментария!');
        }
        return redirect()->route('admin.comments.index')->with('success', 'Комментарий успешно удалён!');
    }

    public function create()
    {
        $posts = Post::all();
        $users = User::all();

        return view('admin.comments.create',[
            "posts" => $posts,
            'users' => $users,
        ]);
    }

    public function store(StoreCommentRequest $request)
    {
        try{
            Comment::create($request->validated());
        }
        catch (\Exception $exception){
            return redirect()->route('admin.comments.index')->with('error', 'Ошибка добавления комментария!');
        }
        return redirect()->route('admin.comments.index')->with('success', 'Комментарий успешно добавлен!');
    }

    public function edit(Comment $comment)
    {
        $posts = Post::all();
        $users = User::all();

        return view('admin.comments.edit',[
            'comment'=>$comment,
            "posts" => $posts,
            "users" => $users,
        ]);
    }

    public function update(StoreCommentRequest $request, Comment $comment)
    {
        try{
            $comment->update($request->validated());
        }catch (\Exception $exception) {
            return redirect()->route('admin.comments.index')->with('error', 'Ошибка обновления комментария!');
        }
        return redirect()->route('admin.comments.index')->with('success', 'Комментарий успешно обновлён!');
    }

}
