@extends('layouts.app')

@section('title', 'Админ | Причины жалоб')

@section('menu')
    @include('admin.parts.menu')
@endsection



@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    @include('parts.messages')

                    <div class="card-header">Причины</div>

                    <div class="card-body">

                        <h2>CRUD причин</h2>

                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Название</th>
                                <th scope="col">Изменить</th>
                                <th scope="col">Удалить</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse ($reasons as $reason)

                                <tr>
                                    <td>
                                        <h6>{{ $reason->name }}</h6>
                                    </td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ route('admin.reasons.edit', $reason) }}">Изменить</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.reasons.delete', $reason) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger w-auto mt-2">Удалить</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <p>Нет причин</p>
                            @endforelse

                            </tbody>
                        </table>

                        <a href="{{ route('admin.reasons.create') }}" class="btn btn-success">Создать причину</a>

                        <div class="mt-5">
                            {{ $reasons->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

@endsection
