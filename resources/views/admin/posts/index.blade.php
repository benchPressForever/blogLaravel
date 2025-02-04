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

                    @include('admin.parts.errors')


                    <div class="card-header">Посты</div>

                    <div class="card-body">

                        <div class="row w-50">
                            <div class="col">
                                <h2>CRUD посты</h2>
                            </div>

                            <div class="col">
                                <a href="{{ route('admin.posts.create') }}" class="btn btn-success">Создать пост</a>
                            </div>
                        </div>

                        @forelse ($posts as $post)

                            <div class="row">
                                <div class="col">
                                    <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a>
                                </div>

                                <div class="col">
                                    <a href="{{ route('admin.posts.edit', $post->id) }}">Изменить</a>
                                </div>

                                <div class="col">
                                    <a href="{{ route('admin.posts.delete', $post->id) }}">Удалить</a>
                                </div>
                            </div><br>
                        @empty
                            <p>Нет постов</p>
                        @endforelse

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
