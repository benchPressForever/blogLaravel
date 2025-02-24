@extends('layouts.app')

@section('title', 'Создать категорию')

@section('menu')
    @include('admin.parts.menu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">


                <div class="card">
                    <div class="card-header">Добавить комментарий</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('comments.store') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">Текст комментария</label>

                                <div class="col-md-6">
                                    <input id="text" type="text"
                                           class="form-control @error('text') is-invalid @enderror" name="text"
                                           autofocus value="{{ old('text') }}">

                                    @error('text')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <input id="post_id" type="hidden"
                                           class="form-control" name="post_id"
                                           autofocus value="{{$postId}}">
                                </div>

                                <div class="col-md-6">
                                    <input id="user_id" type="hidden"
                                           class="form-control" name="user_id"
                                           autofocus value="{{Auth::user()->id}}">
                                </div>
                            </div>




                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Добавить
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

