@extends('layouts.main.layout')

@section('content')
    <div class="container d-flex align-items-center justify-content-center vh-100">
        <div class="text-center">
            <h1>404 Not Found</h1>
            <p>The page you are looking for does not exist.</p>
            <p><a href="{{ route('web.index') }}" style="color: #fff; background-color: #f7992b;" class="btn btn-primary">Go back to the home page</a></p>
        </div>
    </div>
@endsection
