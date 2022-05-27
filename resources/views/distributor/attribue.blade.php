@extends('layouts.navbar')
@section('body-start')
<div class="container p-5 mb-4">
    <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('distributor') }}">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('distribute') }}">Attribuer carte</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Cartes attribuées</a>
        </li>
    </ul>

    <h2 class='mb-4 mt-5 text-right'><b>Mes stock <u class="text-primary">actuel</u></b></h2>

    <div class="row">
        @foreach ($mystock as $item)
            <div class="col-3 my-2">
                <div class="card mb-4" style="width: 18 rem; background: rgba(1, 11, 44, 0.87) url({{asset('img/bg-card.jpg')}}); background-size:cover; background-blend-mode: multiply; border-radius: 10px">
                    <div class="container p-2">
                        <div class="row">
                            <div class="col-6 text-left mb-2 py-2">
                                <h6 style="color: white ;font-family: cursive; font-size: 8px">{{ $item->receive }}</h6>
                            </div>
                            <div class="col-6 text-right mb-2">
                                <img src="{{asset('img/cremincam.png')}}" height="20" loading="lazy" />
                            </div>
                            <div class="col-12 mb-2">
                                <div class="row">
                                    <div class="col text-left">
                                        <img src="{{asset('img/card_design_2.png')}}" class="ms-2" height="30" loading="lazy" />
                                    </div>
                                    <div class="col text-right">
                                        <img src="{{asset('img/card_design_1.png')}}" height="35" loading="lazy" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12" style="font-family: cursive">
                                <h6 class="ms-3 text-white">1234 4321 2341 1432</h6>
                            </div>
                            <div class="col-12 mb-2" style="font-family: cursive">
                                <div class="row">
                                    <div class="col-3 text-left text-white">
                                        <i class="bi bi-caret-left-fill" style="font-size: 16px"></i>
                                    </div>
                                    <div class="col text-right">
                                        <sup style="font-size: 6px; color:white">VALID THRU</sup> <span class="text-white">{{ $item->num_card }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
