@extends('layouts.app')

@section('content')
    <div class="container text-center full-height">
        
        <h3>All boards</h3>

            <div class="row text-left">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <ul class="list-group">
                        @foreach ($boards as $board)
                            <a class="list-group-item list-group-item-action" href="{{ route('board', ['id' => $board->id]) }}">
                                {{ $board->name }}
                                <span class="badge badge-primary badge-pill">{{ $board->user_id }}</span>
                            </a>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-3"></div>
            </div>




    </div>
@endsection
