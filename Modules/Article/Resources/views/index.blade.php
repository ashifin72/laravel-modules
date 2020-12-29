@extends('article::layouts.master')

@section('content')
    <h1>Hello World 123</h1>

    <p>
        This view is loaded from module: {!! config('article.name') !!}
    </p>
@endsection
