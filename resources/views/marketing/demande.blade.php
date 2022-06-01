@extends('layouts.navbar')
@section('body-start')
<div class="container py-5">
    <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link " href="{{ route('marketing') }}">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active disabled" href="#">Consultation demandes</a>
        </li>
      </ul>
    <div class="row mt-5">
        <div class="col">
            <table id="dtBasicExample" class="table" width="100%">@csrf
                <thead>
                    <tr>
                    <th scope="col">N°</th>
                    <th scope="col">Demandeurs</th>
                    <th scope="col">Services</th>
                    <th scope="col">Segment</th>
                    <th scope="col">Nombre de carte</th>
                    <th scope="col">Statut</th>
                    <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($visademande as $item)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td><a href="/marketing/seg-card-detail/{{$item->id}}">{{ $item->name_acteur }}</a></td>
                            <td><a href="/marketing/seg-card-detail/{{$item->id}}">{{ $item->role_acteur }}</a></td>
                            <td><a href="/marketing/seg-card-detail/{{$item->id}}">{{ $item->segment }}</a></td>
                            <td><a href="/marketing/seg-card-detail/{{$item->id}}">{{ $item->nbre_card }}</a></td>
                            @if ($item->statut == 0)
                                <td><a href="/marketing/seg-card-detail/{{$item->id}}" class="text-warning"><i class="bi bi-circle-fill me-2"></i>en attente</a></td>
                            @endif
                            @if ($item->statut == 1)
                                <td><a href="/marketing/seg-card-detail/{{$item->id}}" class="text-primary"><i class="bi bi-circle-fill me-2"></i>traitée</a></td>
                            @endif
                            @if ($item->statut == 2)
                                <td><a href="/marketing/seg-card-detail/{{$item->id}}" class="text-success"><i class="bi bi-circle-fill me-2"></i>reçu</a></td>
                            @endif
                            <td>
                                
                                @if ($item->statut == 0)
                                    <a href="traitement/{{$item->id}}" class="link-btn mx-2 text-danger text-center" >
                                        <i class="bi bi-trash-fill"></i>
                                    </a>
                                    <a href="traitement/{{$item->id}}" class="link-btn mx-2 text-success">
                                        <i class="bi bi-send-fill"></i>
                                    </a>
                                @elseif ($item->statut == 1)
                                    En attente de confirmation
                                @else
                                    Demande traitée
                                @endif

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
  </div>
@endsection
