@extends('Frontend.includes.master')
@section('content')
    @include(' Frontend.includes.hero')
    @include(' Frontend.includes.featured', ['products' => $products])
    @include('Frontend.includes.category')
    {{--@include('Frontend.includes.gallery')--}}
    @include('Frontend.includes.delivery')
@endsection
