@extends('Frontend.includes.master')
@section('content')
    <!-- content -->
    <div class="page-content">
        <div class="container">
            <div class="jumbotron text-center">
                <h1 class="display-3">Thank You!</h1>
                <p class="lead">
                    for shopping with us. Hope you have a nice day with the delicious
                    food.
                </p>
                <hr/>
                <p class="lead mb-2">Order more food !</p>
                <p class="lead">
                    <a
                            class="btn btn-primary btn-sm"
                            href="{{('/menu')}}"
                            role="button"
                    >Continue shopping</a
                    >
                </p>
            </div>
        </div>
    </div>

@endsection