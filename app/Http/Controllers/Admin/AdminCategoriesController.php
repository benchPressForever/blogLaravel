<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAndStoreCategoryRequest;
use App\Http\Requests\UpdateAndStorePostRequest;
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



    public function store(UpdateAndStoreCategoryRequest $request)
    {
        try{
            Category::create($request->validated());
        }
        catch (\Exception $exception){
            return redirect()->route('admin.categories.index')->with('error', 'Ошибка добавления категории!');
        }

        return redirect()->route('admin.categories.index')->with('success', 'Категория успешно добавлена!');
    }


    public function edit(Category $category)
    {
        return view('admin.categories.edit', ['category' => $category]);
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function update(UpdateAndStoreCategoryRequest $request, Category $category)
    {
        try{
            $category->update($request->validated());
        }
        catch (\Exception $exception){
            return redirect()->route('admin.categories.index')->with('error', 'Не удалось изменить категорию!');
        }

        return redirect()->route('admin.categories.index')->with('success', 'Категория успешно изменёна!');
    }


    public function delete(Category $category)
    {
        try {
            Post::query()->where('category_id', $category->id)->delete();
            $category->delete();
        }catch (\Exception $exception){
            return redirect()->route('admin.categories.index')->with('error', 'Пост не удалось удалить!');
        }

        return redirect()->route('admin.categories.index')->with('success', 'Пост успешно удалён!');
    }

}
