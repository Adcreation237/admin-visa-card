@extends('layouts.navbar')
@section('body-start')
<div class="container px-5 py-3 mb-2">
    <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('branch_manager') }}">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Demandes Recues</a>
        </li>
    </ul>

    <div class="row">
        <div class="col">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mt-5" role="alert">
                    <i class="bi bi-emoji-smile-fill me-2"></i>
                    {{session('success')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('fail'))
                <div class="alert alert-danger alert-dismissible fade show mt-5" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    {{session('fail')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
        <div class="col">
            <h2 class='mb-4 mt-5 text-right'><b>Mes demandes <u class="text-danger">reçues</u></b></h2>
        </div>
    </div>
    <table id="dtBasicExample" class="table" width="100%">
        <thead>
            <tr>
                <th scope="col">N°</th>
                <th scope="col">Service</th>
                <th scope="col">Date d'envoie</th>
                <th scope="col">Nombre de carte</th>
                <th scope="col">Segment</th>
                <th scope="col">Statut</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($myask as $item)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $item->name_acteur }} - {{ $item->role_acteur }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->segment }}</td>
                    <td>{{ $item->nbre_card }}</td>
                    <td>
                        @if ($item->statut == 0)
                            <div class="spinner-grow spinner-grow-sm text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            En cours...
                        @endif

                        @if ($item->statut == 1)
                            <i class="bi bi-check-lg text-success fs-4"></i>Traitée
                        @endif

                        @if ($item->statut == 2)
                            Traitement terminée
                        @endif

                        @if ($item->statut == 3)
                            <i class="bi bi-archive-fill text-danger fs-6 me-1"></i>Annulée
                        @endif
                    </td>
                    <td>
                        @if ($item->statut == 3)
                        <span>Demande Annulée</span>
                        @endif

                        @if ($item->statut == 1)
                        <span>Demande Traitée</span>
                        @endif

                        @if ($item->statut == 2)
                            <span>Demande Confirmée</span>
                        @endif

                        @if ($item->statut == 0)
                        <a href="{{ route('treated_ask', ['id'=>$item->id]) }}"  class="text-primary fs-4" title="Traiter">
                            <i class="bi bi-arrow-clockwise"></i>
                        </a>
                        <a href="{{ route('trash_ask', ['id'=>$item->id]) }}"  class="text-danger fs-4" title="Annuler">
                            <i class="bi bi-trash-fill"></i>
                        </a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
