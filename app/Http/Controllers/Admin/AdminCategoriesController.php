<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminCategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(5);

        return view('admin.categories.index', [
            'categories' => $categories,
        ]);

    }

    public function show(string $id){
        $posts = Post::where('category_id', $id)->paginate(5);

        return view('admin.posts.index', [
           'posts' => $posts,
        ]);
    }



    public function store(Request $request)
    {

        //валидация данных
        $validated = $request->validate([
            'name' => 'required|min:5|max:255',
        ]);

        try{
            Category::create($validated);
        }
        catch (\Exception $exception){
            return redirect()->route('admin.categories.index')->with('error', 'Ошибка добавления категории!');
        }

        return redirect()->route('admin.categories.index')->with('success', 'Категория успешно добавлена!');
    }


    public function edit(string $id)
    {
        $category = Category::findOrFail($id);

        return view('admin.categories.edit', [
            'category' => $category,
        ]);
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function update(Request $request,string $id)
    {
        $validated = $request->validate([
            'name' => 'required|min:5|max:255',
        ]);

        try{
            Category::findOrFail($id)->update($validated);
        }
        catch (\Exception $exception){
            return redirect()->route('admin.categories.index')->with('error', 'Не удалось изменить категорию!');
        }

        return redirect()->route('admin.categories.index')->with('success', 'Категория успешно изменёна!');
    }


    public function delete(string $id)
    {

        try {
            Post::query()->where('category_id', $id)->delete();
            Category::query()->findOrFail($id)->delete();
        }catch (\Exception $exception){
            return redirect()->route('admin.categories.index')->with('error', 'Пост не удалось удалить!');
        }

        return redirect()->route('admin.categories.index')->with('success', 'Пост успешно удалён!');
    }

}
