<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AdminPostsController extends Controller
{

    public function index(){

        $posts = Post::paginate(5);

        return view('admin.posts.index', [
            'posts' => $posts,
        ]);
    }

    public function edit(string $id)
    {
        $categories = Category::all();
        $post = Post::query()->findOrFail($id);

        return view('admin.posts.edit', [
            'categories' => $categories,
            'post' => $post,
        ]);
    }

    public function update(Request $request,string $id)
    {
        $validated = $request->validate([
            'title' => 'required|min:5|max:255',
            'text' => 'required|min:5|max:20000',
            'category_id' => 'required|exists:categories,id',
        ]);

        try {
            Post::findOrFail($id)->update($validated);
        }
        catch (\Exception $exception){
            return redirect()->route('admin.posts.index')->with('error', 'Не удалось изменить пост!');
        }

        return redirect()->route('admin.posts.index')->with('success', 'Пост успешно изменён!');
    }



    public function create()
    {
        $categories = Category::all();

        return view('admin.posts.create', [
            'categories' => $categories
        ]);
    }

    public function delete(string $id)
    {
        try {
            Post::findOrFail($id)->delete();
        }
        catch (\Exception $exception){
            return redirect()->route('admin.posts.index')->with('error', 'Пост не удалось удалить!');
        }

        return redirect()->route('admin.posts.index')->with('success', 'Пост успешно удалён!');
    }

    public function store(Request $request)
    {

        //валидация данных
        $validated = $request->validate([
            'title' => 'required|min:5|max:255',
            'text' => 'required|min:5|max:20000',
            'category_id' => 'required|exists:categories,id',
        ]);

        try{
            Post::create($validated);
        }
        catch (\Exception $exception){
            return redirect()->route('admin.posts.index')->with('error', 'Ошибка добавления поста');
        }

        return redirect()->route('admin.posts.index')->with('success', 'Пост успешно добавлен');
    }

}
