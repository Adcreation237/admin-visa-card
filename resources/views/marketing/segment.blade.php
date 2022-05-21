@extends('layouts.navbar')
@section('body-start')
<div class="container py-5">
    <div class="row">
      <div class="col">
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
  </div>
@endsection
