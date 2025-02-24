@extends('layouts.app')

@section('title', 'Отправить жалобу')

@section('menu')
    @include('admin.parts.menu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">


                <div class="card">
                    <div class="card-header">Отправить жалобу</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('complaints.store') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="reason_id" class="col-md-4 col-form-label text-md-end">Причина жалобы</label>

                                <div class="col-md-6">
                                    <select class="form-select" name="reason_id" id="reason_id">
                                        @foreach ($reasons as $reason)
                                            <option @if ($reason->id == old('reason_id')) selected @endif value="{{ $reason->id }}" >
                                                {{ $reason->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('reason_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>



                                <div class="row mb-3">
                                <label for="description" class="col-md-4 col-form-label text-md-end">Описание нарушения</label>

                                <div class="col-md-6">
                                    <input id="description" type="text"
                                           class="form-control @error('description') is-invalid @enderror" name="description"
                                           autofocus value="{{ old('description') }}">

                                    @error('description')
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
                                           autofocus value="{{$userId}}">
                                </div>
                            </div>




                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Отправить
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
