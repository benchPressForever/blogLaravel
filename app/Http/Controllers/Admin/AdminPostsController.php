<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAndStorePostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function update(UpdateAndStorePostRequest $request, string $id)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
            $data['image'] = $imagePath;
        }

        try {
            Post::findOrFail($id)->update($data);
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

    public function store(UpdateAndStorePostRequest $request)
    {

        $validated = $request->validated();

        try{
            $imagePath = null;
            if($request->hasFile('image')){
                $imagePath = $request->file('image')->store('posts', 'public');
            }
            $validated['image'] = $imagePath;
            Post::create($validated);
        }
        catch (\Exception $exception){
            return redirect()->route('admin.posts.index')->with('error', 'Ошибка добавления поста');
        }

        return redirect()->route('admin.posts.index')->with('success', 'Пост успешно добавлен');
    }

}
