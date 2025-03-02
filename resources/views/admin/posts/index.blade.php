@extends('layouts.app')

@section('title', 'Админ | Посты')

@section('menu')
    @include('admin.parts.menu')
@endsection


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">

                    @include('parts.messages')


                    <div class="card-header">Посты</div>

                    <div class="card-body">


                        <h2>CRUD посты</h2>


                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Заголовок</th>
                                <th scope="col">Изменить</th>
                                <th scope="col">Удалить</th>
                            </tr>
                            </thead>
                            <tbody>

                                @forelse ($posts as $post)
                                    <tr>
                                        <td>
                                            <a  href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                                        </td>
                                        <td>
                                            <a class="btn btn-primary" href="{{ route('admin.posts.edit', $post) }}">Изменить</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.posts.delete', $post) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Удалить</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <p>Нет постов</p>
                                @endforelse

                            </tbody>
                        </table>

                        <a href="{{ route('admin.posts.create') }}" class="btn btn-success">Создать пост</a>

                        <div class="mt-5">
                            {{ $posts->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
