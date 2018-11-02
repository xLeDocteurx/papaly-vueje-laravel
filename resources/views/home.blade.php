@extends('layouts.app')

@section('content')
        <div id="app"></div>
    <script>
        const currentUser = "{{ Auth::user()->id }}";
    </script>
@endsection
