<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminPostsController extends Controller
{

    public function index(){

        $posts = DB::table('posts')->get();

        return view('admin.posts.index', [
            'posts' => $posts,
        ]);
    }

    public function edit(string $id)
    {
        $post = DB::table('posts')->find($id);

        if (!$post) {
            abort(404);
        }

        return view('admin.posts.edit', [
            'post' => $post,
        ]);
    }

    public function update(Request $request,string $id)
    {
        $validated = $request->validate([
            'title' => 'required|min:5|max:255',
            'text' => 'required|min:5|max:20000',
        ]);

        $post = DB::table('posts')->where('id',$id)->update($validated);

        if(is_null($post)){
            return redirect()->route('admin.posts.index', $id)->with('error', 'Не удалось изменить пост!');
        }

        return redirect()->route('admin.posts.index', $id)->with('success', 'Пост успешно изменён!');
    }



    public function create()
    {
        return view('admin.posts.create');
    }

    public function delete(string $id)
    {
        $post = DB::table('posts')->where('id',$id)->delete();

        if(is_null($post)){
            return redirect()->route('admin.posts.index', $id)->with('error', 'Пост не удалось удалить!');
        }

        return redirect()->route('admin.posts.index', $id)->with('success', 'Пост успешно удалён!');
    }

    public function store(Request $request)
    {

        //валидация данных
        $validated = $request->validate([
            'title' => 'required|min:5|max:255',
            'text' => 'required|min:5|max:20000',
        ]);


        $post = DB::table('posts')->insert($validated);
        $id = DB::getPdo()->lastInsertId();

        if (is_null($post)) return redirect()->route('admin.posts.index', $id)->with('error', 'Ошибка добавления поста');

        return redirect()->route('admin.posts.index', $id)->with('success', 'Пост успешно добавлен');
    }

}
