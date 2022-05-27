@extends('layouts.navbar')
@section('body-start')
<div class="container mt-5">
    <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('branch_manager') }}">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Mon stock</a>
        </li>
    </ul>

    <h2 class='mb-3 mt-4'>Votre stock de cartes</h2>
                <table id="dtBasicExample" class="table" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">N°</th>
                            <th scope="col">Date de validité</th>
                            <th scope="col">Date d'expiration</th>
                            <th scope="col">Branche</th>
                            <th scope="col">Segment</th>
                            <th scope="col">Distribution</th>
                            <th scope="col">Series</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($visacard as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td><a href="{{ route('show_card_branch', ['id'=>$item->id]) }}">{{ $item->date_start }}</a></td>
                                <td><a href="{{ route('show_card_branch', ['id'=>$item->id]) }}">{{ $item->date_start }}</a></td>
                                <td><a href="{{ route('show_card_branch', ['id'=>$item->id]) }}">{{ $item->branch_partner }}</a></td>
                                <td><a href="{{ route('show_card_branch', ['id'=>$item->id]) }}">{{ $item->segment_card }}</a></td>
                                <td><a href="{{ route('show_card_branch', ['id'=>$item->id]) }}">{{ $item->branch_distri }}</a></td>
                                <td><a href="{{ route('show_card_branch', ['id'=>$item->id]) }}">{{ $item->first_num }} - {{ $item->last_num }}</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
    </div>

@endsection
