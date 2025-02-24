@extends('layouts.app')

@section('title', 'Мои посты')

@section('menu')
    @include('parts.menu')
@endsection


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                @forelse ($posts as $post)

                    <a href="{{ route('posts.show', $post) }}">{{ $post->title }}:{{$post->likes}}</a><br>
                @empty
                    <p>Нет постов</p>
                @endforelse

                <div class="mt-5">
                    {{ $posts->links() }}
                </div>

                    <a href="{{ route('posts.create') }}" class="btn btn-success">Создать пост</a>


            </div>
        </div>
    </div>
@endsection



