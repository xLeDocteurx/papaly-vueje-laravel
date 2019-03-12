@extends('layouts.app')

@section('content')
<div class="container text-center full-height">

        <h3>My boards</h3>

        <div class="row text-left">
        <div class="col-md-3"></div>
        <div class="col-md-6">
                <ul class="list-group">
                @forelse ($boards as $board)
                        <a class="list-group-item list-group-item-action" href="{{ route('board', ['id' => $board->id]) }}">
                        {{ $board->name }}
                        <span class="badge badge-primary badge-pill">{{ $board->id }}</span>
                        </a>
                @empty
                        <h5 class="text-center"><i>You have no board yet ...</i></h5>
                @endforelse
                </ul>
        </div>
        <div class="col-md-3"></div>
        </div>




</div>
@endsection
