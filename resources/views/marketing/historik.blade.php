@extends('layouts.navbar')
@section('body-start')
<div class="container p-4">
    <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link " href="{{ route('marketing') }}">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active disabled" href="#">Historique</a>
        </li>
      </ul>
    <div class="row text-center p-4">
        <div class="col-2"></div>
        <div class="col-8 card p-4 overflow-auto" style="height: 400px">
            <h4 class="mb-4" style="font-family: 'Times New Roman', Times, serif; font-size: 28px">
                <b>Votre historique de transaction</b>
            </h4>
            @for ($i = 0; $i < sizeof($txt); $i++)
                <ul class="">
                    <li class="text-justify" style="font-family: 'Times New Roman', Times, serif; font-size: 18px">
                        {{$txt[$i]}}
                    </li>
                </ul>
            @endfor
        </div>
        <div class="col-2"></div>
    </div>
</div>

@endsection
