@extends('layouts.navbar')
@section('body-start')

<div class="container py-5">
    <div class="row">
        <div class="col-12">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-emoji-smile-fill me-2"></i>
                        {{session('success')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session('fail'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        {{session('fail')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
        </div>
      <div class="col">
        <table id="dtBasicExample" class="table" width="100%">
          <thead>
            <tr>
              <th scope="col">N°</th>
              <th scope="col">Date de validité</th>
              <th scope="col">Date d'expiration</th>
              <th scope="col">Segment</th>
              <th scope="col">Branche</th>
              <th scope="col">Distribution</th>
              <th scope="col">Series</th>
              <th scope="col">Nombre</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($visacard as $item)
                <tr class="text-center">
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td><a href="/marketing/seg-card-detail/{{$item->id}}">{{ $item->date_start }}</a></td>
                    <td><a href="/marketing/seg-card-detail/{{$item->id}}">{{ $item->date_start }}</a></td>
                    <td><a href="/marketing/seg-card-detail/{{$item->id}}">{{ $item->segment_card }}</a></td>
                    <td><a href="/marketing/seg-card-detail/{{$item->id}}">{{ $item->branch_partner }}</a></td>
                    <td><a href="/marketing/seg-card-detail/{{$item->id}}">{{ $item->branch_distri }}</a></td>
                    <td><a href="/marketing/seg-card-detail/{{$item->id}}">{{ $item->first_num }} - {{ $item->last_num }}</a></td>
                    <td><a href="/marketing/seg-card-detail/{{$item->id}}">{{ $item->last_num - $item->first_num }}</a></td>
                    <td><a href="/marketing/share/{{$item->id}}{{$InfoAskceur['iddemandeur']}}" title="Transmettre" style="font-size: 20px;"><i class="bi bi-arrow-clockwise"></i></a></td>
                </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
</div>
@endsection
