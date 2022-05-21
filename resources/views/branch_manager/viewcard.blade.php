@extends('layouts.navbar')
@section('body-start')
<div class="container mt-5">

    <div class="container">
        <!-- Tabs navs -->
        <ul class="nav nav-tabs nav-justified mb-3" id="ex1" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="ex3-tab-0" data-mdb-toggle="tab" href="#ex3-tabs-0"  role="tab" aria-controls="ex3-tabs-0" aria-selected="false">
                    Demandes envoyées
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="ex3-tab-1" data-mdb-toggle="tab" href="#ex3-tabs-1" role="tab" aria-controls="ex3-tabs-1" aria-selected="true">
                    Confirme stock reçu
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="ex3-tab-3" data-mdb-toggle="tab" href="#ex3-tabs-3"  role="tab" aria-controls="ex3-tabs-3" aria-selected="false">
                    Votre stock
                </a>
            </li>
        </ul>
        <!-- Tabs navs -->

        <!-- Tabs content -->
        <div class="tab-content" id="ex2-content">
            <div class="tab-pane fade " id="ex3-tabs-0" role="tabpanel" aria-labelledby="ex3-tab-0">

                <table id="dtBasicExample1" class="table" width="100%">
                    <thead>
                        <tr>
                          <th scope="col">N°</th>
                          <th scope="col">Nombre de carte</th>
                          <th scope="col">Segments</th>
                          <th scope="col">Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($demandes as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td><a href="/marketing/seg-card-detail/{{$item->id}}">{{$item->nbre_card}}</a></td>
                                <td><a href="/marketing/seg-card-detail/{{$item->id}}">{{$item->segment}}</a></td>
                                @if ($item->statut == 0)
                                    <td><a href="/marketing/seg-card-detail/{{$item->id}}" class="text-warning"><i class="bi bi-circle-fill me-2"></i>en attente</a></td>
                                @endif
                                @if ($item->statut == 1)
                                    <td><a href="/marketing/seg-card-detail/{{$item->id}}" class="text-success"><i class="bi bi-circle-fill me-2"></i>traitée</a></td>
                                @endif
                                @if ($item->statut == 3)
                                    <td><a href="/marketing/seg-card-detail/{{$item->id}}" class="text-danger"><i class="bi bi-circle-fill me-2"></i>annulée</a></td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="tab-pane fade show active" id="ex3-tabs-1" role="tabpanel" aria-labelledby="ex3-tab-1">

                @foreach($valideAsk as $item)
                <div class="alerte alert-success" role="alert">
                    A simple success alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
                </div>
                @endforeach
            </div>

            <div class="tab-pane fade" id="ex3-tabs-3" role="tabpanel" aria-labelledby="ex3-tab-3">
                <h2 class='mb-3'>Votre stock de cartes</h2>
                <table id="dtBasicExample" class="table" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">N°</th>
                            <th scope="col">Date de validité</th>
                            <th scope="col">Date d'expiration</th>
                            <th scope="col">Branche</th>
                            <th scope="col">Distribution</th>
                            <th scope="col">Series</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($visacard as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td><a href="/marketing/seg-card-detail/{{$item->id}}">{{ $item->date_start }}</a></td>
                                <td><a href="/marketing/seg-card-detail/{{$item->id}}">{{ $item->date_start }}</a></td>
                                <td><a href="/marketing/seg-card-detail/{{$item->id}}">{{ $item->branch_partner }}</a></td>
                                <td><a href="/marketing/seg-card-detail/{{$item->id}}">{{ $item->branch_distri }}</a></td>
                                <td><a href="/marketing/seg-card-detail/{{$item->id}}">{{ $item->first_num }} - {{ $item->last_num }}</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Tabs content -->
    </div>

@endsection
