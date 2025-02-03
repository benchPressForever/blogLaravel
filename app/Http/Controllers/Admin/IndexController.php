<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {

        //валидация данных
        $validated = $request->validate([
            'title' => 'required|min:5|max:255',
            'text' => 'required|min:5|max:20000',
        ]);


        DB::table('posts')->insert($validated);
        $id = DB::getPdo()->lastInsertId();

       // if (true) return redirect()->route('posts.show', $id)->with('error', 'Ошибка добавления поста');

        return redirect()->route('posts.show', $id)->with('success', 'Пост успешно добавлен');
    }

    public function posts()
    {
        return view('admin.posts.index');
    }

    public function categories()
    {
        return view('admin.categories');
    }
}
