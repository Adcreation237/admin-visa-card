@extends('layouts.navbar')
@section('body-start')
    <div class="container p-5">
        <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link " href="{{ route('marketing') }}">Accueil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active disabled" href="#">Consultation cartes</a>
            </li>
          </ul>
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
