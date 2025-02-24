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

                                <h2>CRUD категории</h2>

                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Название</th>
                                        <th scope="col">Изменить</th>
                                        <th scope="col">Удалить</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                            @forelse ($categories as $category)

                                                    <tr>
                                                        <td>
                                                            <a href="{{route('admin.categories.show', $category->id)}}">{{ $category->name }}</a>
                                                        </td>
                                                        <td>
                                                            <a class="btn btn-primary" href="{{ route('admin.categories.edit', $category) }}">Изменить</a>
                                                        </td>
                                                        <td>
                                                            <form action="{{ route('admin.categories.delete', $category) }}" method="POST">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button type="submit" class="btn btn-danger">Удалить</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                            @empty
                                                <p>Нет категорий</p>
                                            @endforelse

                                    </tbody>
                                </table>

                                <a href="{{ route('admin.categories.create') }}" class="btn btn-success">Создать категорию</a>

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
