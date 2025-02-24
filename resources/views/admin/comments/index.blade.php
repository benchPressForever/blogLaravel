@extends('layouts.app')

@section('title', 'Админ | Комментарии')

@section('menu')
    @include('admin.parts.menu')
@endsection



@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    @include('parts.messages')

                    <div class="card-header">Комментарии</div>

                    <div class="card-body">

                        <h2>CRUD комментарий</h2>



                        @forelse ($comments as $comment)
                            <div class="card m-3" >
                                <div class="card-body">
                                    <b><p class="card-title">{{$comment->user->name}}</p></b>
                                    <p class="card-text">{{$comment->text}}</p>

                                    <p>Создано : <b>{{$comment->created_at}}</b></p>

                                    @if($comment->updated_at)
                                        <p>Изменнено : <b>{{$comment->updated_at}}</b></p>
                                    @endif

                                    <div class="row w-25">

                                            <div class="col">
                                                <a class = "btn btn-warning" href="{{route('admin.comments.edit',$comment->id)}}">Изменить</a>
                                            </div>

                                        <div  class="col">
                                            <form action="{{ route('admin.comments.delete', $comment->id) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Удалить</button>
                                            </form>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        @empty
                            <p>Нет комментариев</p>
                        @endforelse

                        <a href="{{ route('admin.comments.create') }}" class="btn btn-success w-25 m-3">Написать комментарий</a>




                        <div class="mt-5">
                            {{ $comments->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

@endsection
