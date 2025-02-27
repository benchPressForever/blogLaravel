<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Complaint;
use App\Models\Post;
use App\Models\Reason;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ComplaintsController extends Controller
{

    public function index(){
        $complaints = Complaint::query()->with(["user",'reason'])->orderBy("created_at","desc")->paginate(5);

        return view('admin.complaints.index', [
            'complaints' => $complaints
        ]);
    }

    public function show(Complaint $complaint)
    {

        $post = Post::query()->where('id',$complaint->post_id)->first();
        $user = User::query()->where('id',$complaint->user_id)->first();
        $reason = Reason::query()->where('id',$complaint->reason_id)->first();

        return view('admin.complaints.show', [
            'complaint' => $complaint,
            'post' => $post,
            'user' => $user,
            'reason' => $reason
        ]);
    }

    public function deletePost(Complaint $complaint)
    {
        try {

            Comment::query()->where("post_id",$complaint->post_id)->delete();
            Complaint::query()->where("post_id", $complaint->post_id)->delete();
            Post::query()->where("id", $complaint->post_id)->delete();

        }
        catch(\Exception $exception){
            return redirect()->route('admin.complaints.index')->with('error', 'Ошибка!Не удалось обработать жалобу!');
        }

        return redirect()->route('admin.complaints.index')->with('success', 'Жалоба успешно обработана!');
    }

    public function deleteUser(Complaint $complaint)
    {
        try {

            Comment::query()->where("user_id",$complaint->user_id)->delete();
            Complaint::query()->where("post_id", $complaint->post_id)->delete();
            Post::query()->where("user_id", $complaint->user_id)->delete();
            User::query()->where("id",$complaint->user_id)->delete();
        }
        catch(\Exception $exception){
            return redirect()->route('admin.complaints.index')->with('error', 'Ошибка!Не удалось обработать жалобу!');
        }

        return redirect()->route('admin.complaints.index')->with('success', 'Жалоба успешно обработана!Нарушитель наказан!');
    }

    public function delete(Complaint $complaint)
    {
        try {
            $complaint->delete();
        }
        catch(\Exception $exception){
            return redirect()->route('admin.complaints.index')->with('error', 'Ошибка!Не удалось обработать жалобу!');
        }

        return redirect()->route('admin.complaints.index')->with('success', 'Жалоба успешно обработана!');
    }


}
