@extends('layouts.app')

@section('title', 'Админ | Категории')

@section('menu')
    @include('admin.parts.menu')
@endsection



@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    @include('admin.parts.errors')

                    <div class="card-header">Категории</div>

                    <div class="card-body">

                        <div class="row w-50">
                            <div class="col">
                                <h2>CRUD категории</h2>
                            </div>

                            <div class="col">
                                <a href="{{ route('admin.categories.create') }}" class="btn btn-success">Создать категорию</a>
                            </div>

                            @forelse ($categories as $category)

                                <div class="row">
                                    <div class="col">
                                        <div>{{ $category->name }}</div>
                                    </div>

                                    <div class="col">
                                        <a href="{{ route('admin.categories.edit', $category->id) }}">Изменить</a>
                                    </div>

                                    <div class="col">
                                        <a href="{{ route('admin.categories.delete',$category->id) }}">Удалить</a>
                                    </div>
                                </div><br>
                            @empty
                                <p>Нет категорий</p>
                            @endforelse


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
