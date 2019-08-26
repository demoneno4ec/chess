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
                        <div class="figure">
                            <div class="{{$square['figure']['code']}}">{{$square['figure']['template']}}</div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </section>
@endsection
