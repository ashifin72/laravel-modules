@extends('layouts.admin')

@section('header')
    @include('admin.inc-admin.header')
@endsection
@section('main-sidebar')
    @include('admin.inc-admin.main-sidebar')
@endsection
@section('content')
    контент админки
@endsection
@section('control-sidebar')
    @include('admin.inc-admin.control-sidebar')
@endsection
@section('footer')
    @include('admin.inc-admin.footer')
@endsection
