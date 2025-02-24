@extends('layouts.app')

@section('title', 'Жалобы')

@section('menu')
    @include('admin.parts.menu')
@endsection


@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-12">

                @include('parts.messages')

                @forelse ($complaints as $complaint)
                    <div class="card mb-3" >
                        <div class="card-body">
                            <b><h4 class="card-title">{{$complaint->reason->name}}</h4></b>
                            <a class="card-title" href="{{route("admin.complaints.show",$complaint)}}">{{$complaint->user->name}}</a>
                        </div>
                    </div>

                @empty
                    <p>Нет жалоб</p>
                @endforelse

                {{$complaints->links()}}


            </div>
        </div>
    </div>
@endsection
