@extends('layouts.navbar')
@section('body-start')
    <div class="container p-5">
        {{json_encode($content)}}
        <canvas id="myChart" width="200" height="80">
            <p>Hello Fallback World</p>
        </canvas>
    </div>

@endsection


