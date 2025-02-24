@extends('layouts.app')

@section('name', 'Изменить комментарий')

@section('menu')
    @include('parts.menu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">


                <div class="card">
                    <div class="card-header">Изменить комментарий</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('comments.update',$comment->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label for="text" class="col-md-4 col-form-label text-md-end">Текст комментария</label>

                                <div class="col-md-6">
                                    <input id="text" type="text"
                                           class="form-control @error('text') is-invalid @enderror" name="text"
                                           autofocus value="{{ $comment->text}}">
                                    @error('text')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>




                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Обновить
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



