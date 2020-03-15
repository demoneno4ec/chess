@extends('layouts.default')
@section('title')
    Chess - laravel
@endsection
@section('content')
    <section class="play">
        <div class="square board">
            @foreach($table as $square)
                <div class="square cell {{$square['color']}}" data-index="{{$square['code']}}">
                    @if(!empty($square['figure']))
                        <div class="figure" data-figure="{{$square['figure']['code']}}" data-coord="{{$square['code']}}">
                            <div>{{$square['figure']['template']}}</div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </section>
@endsection

