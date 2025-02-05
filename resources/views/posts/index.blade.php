@extends('layouts.app')

@section('title', 'Посты')

@section('menu')
    @include('parts.menu')
@endsection


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                @forelse ($posts as $post)

                    <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a><br>
                @empty
                    <p>Нет постов</p>
                @endforelse

                <div class="mt-5">
                    {{ $posts->links() }}
                </div>



            </div>
        </div>
    </div>
@endsection



