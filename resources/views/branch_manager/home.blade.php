@extends('layouts.navbar')
@section('body-start')
<div class="container mt-5">
    <div class="row">
        <div class="col-4 p-2">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                  <h5 class="card-title mb-4">Faire une demande</h5>
                  <p class="card-text" style="font-size: 12px; text-align: justify">Cliquez sur <b>commencer</b>
                pour faire votre demande de carte visa. Soyez attentif lors de votre demande.</p>
                  <a href="{{ route('demander') }}" class="card-link">Commencer</a>
                </div>
            </div>
        </div>
        <div class="col-4 p-2">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                  <h5 class="card-title mb-4">Consultation des cartes</h5>
                  <p class="card-text" style="font-size: 12px; text-align: justify">Cette consultation
                    se fait suivant un segment precis et une série de carte précise. Veuillez bien lire
                    avant de valider !</p>
                  <a href="{{ route('view.card_branch') }}" class="card-link">Commencer</a>
                </div>
            </div>
        </div>
        <div class="col-4 p-2">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                  <h5 class="card-title mb-4">Demandes & transmission</h5>
                  <p class="card-text" style="font-size: 12px; text-align: justify">Cet transmission se fait par carte en fonction du
                    segment et du numéro de carte. Veuillez bien lire
                    avant de valider !</p>
                  <a href="{{ route('trans.card') }}" class="card-link">Commencer</a>
                </div>
            </div>
        </div>
        <div class="col-4 p-2">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                  <h5 class="card-title mb-4">Consultations ventes</h5>
                  <p class="card-text" style="font-size: 12px; text-align: justify">Cet enregistrement
                    se fait suivant un segment precis et une série de carte précise. Veuillez bien lire
                    avant de valider !</p>
                  <a href="{{ route('ventes') }}" class="card-link">Commencer</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
