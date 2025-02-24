@extends('layouts.app')

@section('title', 'Жалоба')

@section('menu')
    @include('admin.parts.menu')
@endsection


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">



                    <div class="card mb-3" >
                        <div class="card-body">
                            <b><h4 class="card-title">{{$reason->name}}</h4></b>
                            <p class="card-text">{{$complaint->description}}</p>

                            <p>Создано : <b>{{$complaint->created_at}}</b></p>

                            @if($complaint->updated_at)
                                <p>Изменнено : <b>{{$complaint->updated_at}}</b></p>
                            @endif



                        </div>
                    </div>

                <h2>Жалоба на пост:</h2>

                <div class="card mb-3 mt-3">

                    <div class="card-header">{{ $post->title }}</div>

                    <div class="p-3">
                        <div class="card-body">

                            @if ($post->image)
                                <img class="w-25 me-2 float-start" src="{{ asset('storage/' . $post->image) }}" alt="img">
                            @endif
                            {{ $post->text }}

                                <h5 class="mt-3">Автор : {{ $user->name}}</h5>
                        </div>
                    </div>
                </div>



                <div class="mb-3 w-auto ">
                        <form action="{{ route('admin.complaints.delete.post', $complaint) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-warning">Удалить пост в связи с наружение правил</button>
                        </form>

                        <form action="{{ route('admin.complaints.delete.user', $complaint) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger">Наказать пользователя в связи с наружение правил (Удалить)</button>
                        </form>

                        <form action="{{ route('admin.complaints.delete', $complaint) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-success">Нарушений не обнаружено</button>
                        </form>
                    </div>
                </div>




            </div>
        </div>
    </div>
@endsection
