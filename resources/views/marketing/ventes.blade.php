@extends('layouts.navbar')
@section('body-start')
<div class="container py-5">
    <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link " href="{{ route('marketing') }}">Accueil</a>
        </li>
      </ul>
    <div class="row mt-5">
      <div class="col">
        <table id="dtBasicExample" class="table" width="100%">
          <thead>
            <tr>
              <th scope="col">N°</th>
              <th scope="col">Vendeur</th>
              <th scope="col">Service</th>
              <th scope="col">Segment</th>
              <th scope="col">Branche</th>
              <th scope="col">Distribution</th>
              <th scope="col">Series</th>
              <th scope="col">Nombre</th>
            </tr>
          </thead>
          <tbody>
            @foreach($ventes as $item)
                <tr class="text-center">
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $item->name_acteur }}</a></td>
                    <td>{{ $item->role_acteur }}</a></td>
                    <td>{{ $item->segment_card }}</a></td>
                    <td>{{ $item->branch_partner }}</a></td>
                    <td>{{ $item->branch_distri }}</a></td>
                    <td>{{ $item->first_num }} - {{ $item->last_num }}</a></td>
                    <td>{{ $item->last_num - $item->first_num }}</a></td>
                </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
</div>
@endsection
