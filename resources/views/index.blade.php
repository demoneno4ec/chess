@extends('layouts.default')
@section('title')
    Chess - laravel
@endsection
@section('content')
    <section class="play">
        <div class="square board">
            @foreach($table as $square)
                <div class="square cell {{$square->color}}" data-index="{{$square->name}}">
                    @if(!empty($square->figure))
                        <div class="figure">
                            <div class="{{$square->figure->name}}">{{$square->figure->html}}</div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </section>
@endsection
