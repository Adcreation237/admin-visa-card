@extends('layouts.navbar')
@section('body-start')
    <div class="container p-5">
        <div class="row mt-5">
            @foreach ($segment as $seg)
            <div class="col">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                    <h5 class="card-title">{{$seg}}</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="/marketing/seg-card/{{$seg}}" class="card-link">Consulter</a>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="col-12">
                <div class="card mt-3" style="width: 62.8rem;">
                    <div class="card-body">
                      This is some text within a card body.
                    </div>
                  </div>
            </div>
        </div>
    </div>
@endsection
