@extends('layouts.navbar')
@section('body-start')
    <div class="container p-5">
        <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link " href="{{ route('marketing') }}">Accueil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active disabled" href="#">Liste utilisateurs</a>
            </li>
          </ul>
        <div class="row mt-4">
            <div class="col-12">
                <table id="dtBasicExample" class="table" width="100%">
                    <thead>
                    <tr>
                        <th scope="col">N°</th>
                        <th scope="col">Noms & Prenoms</th>
                        <th scope="col">Role</th>
                        <th scope="col">code</th>
                        <th scope="col">localisation</th>
                        <th scope="col">Actif</th>
                        <th scope="col">Date creation</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $item)
                        <tr class="text-center">
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $item->name_acteur }}</td>
                            <td>{{ $item->role_acteur }}</td>
                            <td>{{ $item->code_acteur }}</td>
                            <td>{{ $item->localisation }}</td>
                            <td>{{ $item->start }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td><a href="/marketing/share/{{$item->id}}" title="Transmettre" style="font-size: 20px;"><i class="bi bi-arrow-clockwise"></i></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
