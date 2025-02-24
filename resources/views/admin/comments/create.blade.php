@extends('layouts.app')

@section('name', 'Админ | Создать комментарий')

@section('menu')
    @include('admin.parts.menu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">


                <div class="card">
                    <div class="card-header">Создать комментарий</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.comments.store') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="text" class="col-md-4 col-form-label text-md-end">Текст комментария</label>

                                <div class="col-md-6">
                                    <input id="text" type="text"
                                           class="form-control @error('text') is-invalid @enderror" name="text"
                                           autofocus value="{{ old('text')}}">
                                    @error('text')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="user_id" class="col-md-4 col-form-label text-md-end">Пользователь</label>
                                <div class="col-md-6">

                                    <select class="form-select" name="user_id" id="user_id">
                                        @foreach ($users as $user)
                                            <option @if ($user->id == old('user_id')) selected @endif value="{{ $user->id }}" >
                                                {{ $user->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('user')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="post_id" class="col-md-4 col-form-label text-md-end">Пост</label>
                                <div class="col-md-6">

                                    <select class="form-select" name="post_id" id="post_id">
                                        @foreach ($posts as $post)
                                            <option @if ($post->id == old('post_id')) selected @endif value="{{ $post->id }}" >
                                                {{ $post->title }}</option>
                                        @endforeach
                                    </select>

                                    @error('post')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>




                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Создать
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

