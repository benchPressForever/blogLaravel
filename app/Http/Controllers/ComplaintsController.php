<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComplaintRequest;
use App\Models\Complaint;
use App\Models\Post;
use App\Models\Reason;
use http\Env\Request;

class ComplaintsController extends Controller
{

    public function create($postId)
    {
        $post = Post::query()->findOrFail($postId);
        $reasons = Reason::all();

        return view('complaints.create', [
            'postId' => $postId,
            'userId' => $post->user_id,
            'reasons' => $reasons,
        ]);
    }

    public function store(StoreComplaintRequest $request)
    {
        try{
            Complaint::create($request->validated());
        }
        catch (\Exception $exception){
            return redirect()->route('posts.show',$request->get('post_id'))->with('error', 'Ошибка отправления жалобы!');
        }
        return redirect()->route('posts.show',$request->get('post_id'))->with('success', 'Жалоба успешно отправлена!');
    }
}
