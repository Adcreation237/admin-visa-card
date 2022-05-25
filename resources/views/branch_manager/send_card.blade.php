@extends('layouts.navbar')
@section('body-start')
<div class="container p-5 mb-4">
    <a href="{{ route('trans.card') }}" class="fs-5"><i class="bi bi-arrow-left"></i> Retour</a>
    <hr class="mb-4">
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
    </div>
    <table id="dtBasicExample" class="table" width="100%">
        <thead>
            <tr>
                <th scope="col">N°</th>
                <th scope="col" rowspan="2">Gérant</th>
                <th scope="col">numero de la carte</th>
                <th scope="col">Segment</th>
                <th scope="col">Statut</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($seriecard as $item)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $item->name_acteur }} - {{ $item->role_acteur }}</td>
                    <td>{{ $item->num_card }}</td>
                    <td>{{ $item->segment }}</td>
                    <td>
                        @if ($item->statut == 0)
                            <span class="text-danger">Pas vendu</span>
                        @endif    
                    </td>
                    <td>
                        <a href="{{ route('trans_card', ['id'=>$item->id, 'idask'=>$iddemande]) }}"  class="text-primary fs-4" title="transférer">
                            <i class="bi bi-send-fill"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
