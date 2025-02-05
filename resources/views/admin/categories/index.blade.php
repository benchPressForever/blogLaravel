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

                    @include('parts.messages')

                    <div class="card-header">Категории</div>

                            <div class="card-body">

                                <div class="row mb-5">
                                    <div class="col">
                                        <h2>CRUD категории</h2>
                                    </div>

                                    <div class="col">
                                        <a href="{{ route('admin.categories.create') }}" class="btn btn-success">Создать
                                            категорию</a>
                                    </div>
                                    <div class="col"></div>

                                </div>

                                @forelse ($categories as $category)

                                        <div class="row justify-content-center mb-3">
                                            <div class="col">
                                                <a href="{{route('admin.categories.show', $category->id)}}">{{ $category->name }}</a>
                                            </div>

                                            <div class="col">
                                                <a class="btn btn-primary" href="{{ route('admin.categories.edit', $category->id) }}">Изменить</a>
                                            </div>

                                            <div class="col">
                                                <a class="btn btn-danger" href="{{ route('admin.categories.delete',$category->id) }}">Удалить</a>
                                            </div>
                                        </div><br>
                                @empty
                                    <p>Нет категорий</p>
                                @endforelse

                                <div class="mt-5">
                                        {{ $categories->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
