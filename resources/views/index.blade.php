@extends('layouts.default')
@section('title')
    Chess - laravel
@endsection
@section('content')
    <section class="play">
        <div class="square board">
            <div class="square cell white">
                <div class="figure">
                    <div class="king"></div>
                </div>
            </div>
            <div class="square cell black"></div>
            <div class="square cell black"></div>
            <div class="square cell white">
                <div class="figure">
                    <div class="rook"></div>
                </div>
            </div>
        </div>
    </section>
@endsection
