<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function create($postId)
    {
        return view('comments.create',[
            'postId'=>$postId
        ]);
    }

    public function store(StoreCommentRequest $request)
    {
        try{
            Comment::create($request->validated());
        }
        catch (\Exception $exception){
            return redirect()->route('posts.show',$request->get('post_id'))->with('error', 'Ошибка добавления комментария!');
        }
        return redirect()->route('posts.show',$request->get('post_id'))->with('success', 'Комментарий успешно добавлен!');
    }


    public function delete(Comment $comment){
        try {
            $comment->delete();
        }
        catch (\Exception $exception){
            return redirect()->route('posts.show',$comment->post_id)->with('error', 'Ошибка удаления комментария!');
        }
        return redirect()->route('posts.show',$comment->post_id)->with('success', 'Комментарий успешно удалён!');
    }

    public function edit(Comment $comment)
    {
        return view('comments.edit',[
            'comment'=>$comment
        ]);
    }

    public function update(Request $request, Comment $comment)
    {
        $validated = $request->validate([
           'text'=>'required|min:10|max:1000',
        ]);

        try{
            $comment->update($validated);
        }catch (\Exception $exception) {
            return redirect()->route('posts.show',$comment->post_id)->with('error', 'Ошибка обновления комментария!');
        }
        return redirect()->route('posts.show',$comment->post_id)->with('success', 'Комментарий успешно обновлён!');
    }
}
