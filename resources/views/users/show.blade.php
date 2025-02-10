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

                    <div class="card-header">Профиль</div>

                    <div class="card-body p-5">

                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">
                                        Роль
                                    </th>
                                    <td>
                                        {{$user->is_admin ? "Admin" : "User"}}
                                    </td>
                                </tr>

                                <tr>
                                    <th scope="row">
                                        Имя
                                    </th>
                                    <td>
                                        {{$user->name}}
                                    </td>
                                </tr>

                                <tr>
                                    <th scope="row">
                                        Почта
                                    </th>
                                    <td>
                                        {{$user->email}}
                                    </td>
                                </tr>


                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
