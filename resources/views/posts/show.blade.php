@extends('layouts.app')

@section('title', 'Пост')

@section('menu')
    @include('parts.menu')
@endsection



@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                @include('parts.messages')

                <div class="card">

                    <div class="card-header">{{ $post->title }}</div>

                    <div class="p-3">
                        <h5 class="m-3">Автор : {{$user->name}}</h5>
                        <div class="textDiv">
                            @if ($post->image)
                                <img class="w-25 me-2 float-start" src="{{ asset('storage/' . $post->image) }}" alt="img">
                            @endif
                            <div>
                                {{ $post->text }}
                            </div>
                        </div>

                        <div class="panel">
                            <button data-id="{{ $post->id }}" class="btn btn-primary w-25 likeButton  m-2">
                                Likes: <span id="likeCount">{{ $post->likes }}</span>
                            </button>


                            @if(Auth::id() == $post->user_id)
                                <form action="{{ route('posts.delete', $post->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger w-auto ms-3 mb-2">Удалить пост</button>
                                </form>
                                <a class = "btn btn-warning w-auto ms-3 mb-2" href="{{route("posts.edit",$post->id)}}">Обновить пост</a>
                            @else
                                <a class = "btn btn-danger w-auto ms-3 mb-2" href="{{route("complaints.create",$post->id)}}">Отправить жалобу</a>
                            @endif

                        </div>

                        <h1 class="m-3  mt-5">Комментарии</h1>

                        @forelse ($comments as $comment)
                            <div class="card m-3" >
                                <div class="card-body">
                                    <b><p class="card-title">{{$comment->user->name}}</p></b>
                                    <p class="card-text">{{$comment->text}}</p>

                                    <b><p>{{$comment->created_at}}</p></b>

                                    <div class="row w-25">

                                        @if(Auth::user() == $comment->user)

                                            <div class="col">
                                                <a class = "btn btn-warning" href="{{route('comments.edit',$comment->id)}}">Изменить</a>
                                            </div>

                                            <div  class="col">
                                                <form action="{{ route('comments.delete',$comment->id) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">Удалить</button>
                                                </form>
                                            </div>
                                            @endif

                                    </div>

                                </div>
                            </div>
                        @empty
                            <h5 class="m-3">Нет комментариев</h5>
                        @endforelse

                        <a href="{{ route('comments.create',$post->id) }}" class="btn btn-success w-25 m-3">Написать комментарий</a>
                        <div class="m-3">
                            {{ $comments->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
