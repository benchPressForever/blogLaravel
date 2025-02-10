@extends('layouts.app')

@section('title', 'Админ | Пользователи')

@section('menu')
    @include('admin.parts.menu')
@endsection


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">

                    @include('parts.messages')


                    <div class="card-header">Пользователи</div>

                    <div class="card-body">


                        <h2>CRUD Пользователи</h2>

                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Имя</th>
                                <th scope="col">Изменить</th>
                                <th scope="col">Удалить</th>
                                <th scope="col">Сделать админом</th>
                            </tr>
                            </thead>
                            <tbody>


                                @forelse ($users as $user)

                                    <tr>
                                        <th scope="row">
                                            <a class="@if($user->is_admin) text-danger @endif"  href="{{ route('users.show', $user) }}">{{ $user->name }} : {{$user->email}}</a>
                                        </th>
                                        <td>
                                            <a class="btn btn-primary" href="{{ route('admin.users.edit', $user) }}">Изменить</a>
                                        </td>
                                        <td>
                                            <a class="btn btn-danger" href="{{ route('admin.users.delete', $user) }}">Удалить</a>
                                        </td>
                                        <td>
                                            <a class="btn btn-info" href="{{ route('admin.users.change.admin', $user) }}">Сделать админом</a>
                                        </td>
                                    </tr>

                                @empty
                                    <p>Нет пользователей</p>
                                @endforelse

                            </tbody>
                        </table>

                        <div class="mt-5">
                            {{ $users->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
