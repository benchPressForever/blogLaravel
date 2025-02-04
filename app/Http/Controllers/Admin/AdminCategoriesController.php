<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminCategoriesController extends Controller
{
    public function index()
    {
        $categories = DB::table('categories')->get();

        return view('admin.categories.index', [
            'categories' => $categories,
        ]);

    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {

        //валидация данных
        $validated = $request->validate([
            'name' => 'required|min:5|max:255',
        ]);


        $post = DB::table('categories')->insert($validated);
        $id = DB::getPdo()->lastInsertId();

        if (is_null($post)) return redirect()->route('admin.categories.index', $id)->with('error', 'Ошибка добавления категории!');

        return redirect()->route('admin.categories.index', $id)->with('success', 'Категория успешно добавлена!');
    }


    public function edit(string $id)
    {
        $category = DB::table('categories')->find($id);

        if (!$category) {
            abort(404);
        }

        return view('admin.categories.edit', [
            'category' => $category,
        ]);
    }

    public function update(Request $request,string $id)
    {
        $validated = $request->validate([
            'name' => 'required|min:5|max:255',
        ]);

        $category = DB::table('categories')->where('id',$id)->update($validated);

        if(is_null($category)){
            return redirect()->route('admin.categories.index', $id)->with('error', 'Не удалось изменить категорию!');
        }

        return redirect()->route('admin.categories.index', $id)->with('success', 'Категория успешно изменёна!');
    }


    public function delete(string $id)
    {
        $category = DB::table('categories')->where('id',$id)->delete();

        if(is_null($category)){
            return redirect()->route('admin.categories.index', $id)->with('error', 'Пост не удалось удалить!');
        }

        return redirect()->route('admin.categories.index', $id)->with('success', 'Пост успешно удалён!');
    }

}
