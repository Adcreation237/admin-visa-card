@extends('layouts.navbar')
@section('body-start')
    <div class="container mt-5">
        <div class="row">
            <div class="col-4 p-2">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                      <h5 class="card-title mb-4">Enregistrement des cartes</h5>
                      <p class="card-text" style="font-size: 12px; text-align: justify">Cet enregistrement
                        se fait suivant un segment precis et une série de carte précise. Veuillez bien lire
                        avant de valider !</p>
                      <a href="{{ route('save.card') }}" class="card-link">Commencer</a>
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
                      <a href="{{ route('view.card') }}" class="card-link">Commencer</a>
                    </div>
                </div>
            </div>
            <div class="col-4 p-2">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                      <h5 class="card-title mb-4">Demandes reçues</h5>
                      <p class="card-text" style="font-size: 12px; text-align: justify">Cet enregistrement
                        se fait suivant un segment precis et une série de carte précise. Veuillez bien lire
                        avant de valider !</p>
                      <a href="{{ route('view.demandes') }}" class="card-link">Commencer</a>
                    </div>
                </div>
            </div>
            <div class="col-4 p-2">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                      <h5 class="card-title mb-4">Historique des transactions</h5>
                      <p class="card-text" style="font-size: 12px; text-align: justify">Cet section vous permet d'avoir
                        une visibilité sur vos transactions de cartes. Veuillez bien lire
                        avant de valider !
                      </p>
                      <a href="{{ route('historik') }}" class="card-link">Commencer</a>
                    </div>
                </div>
            </div>
            <div class="col-4 p-2">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                      <h5 class="card-title mb-4">Gestion des utilisateurs</h5>
                      <p class="card-text" style="font-size: 12px; text-align: justify">Cet section vous permet
                        de gérer les utilisateurs pour la vente des cartes. Veuillez bien lire
                        avant de valider !</p>
                      <a href="{{ route('users') }}" class="card-link">Commencer</a>
                    </div>
                </div>
            </div>
            <div class="col-4 p-2">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                      <h5 class="card-title mb-4">Enregistrement des cartes</h5>
                      <p class="card-text" style="font-size: 12px; text-align: justify">Cet enregistrement
                        se fait suivant un segment precis et une série de carte précise. Veuillez bien lire
                        avant de valider !</p>
                      <a href="#" class="card-link">Commencer</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
