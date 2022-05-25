@extends('layouts.navbar')
@section('body-start')
<div class="container p-5 mb-4">
    <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('distributor') }}">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Demande carte</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('myask') }}">Mes demandes</a>
        </li>
    </ul>
    <div class="row">
        <div class="col-6 text-right p-5">


            <img src="{{ asset('img/addcard.png') }}" alt="" srcset="" class="">


        </div>
        <div class="col-6 mt-5">
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
                <form action="{{ route('opera_demande', ['acteurid'=>$InfoActeur['id'],'location'=>$InfoActeur['localisation']]) }}" method="post">
                    @csrf
                    <div class="row mb-4">
                        <div class="col">
                            <!-- Segment select -->
                            <select class="form-select" id="segment" name="segment" aria-label="Default select example">
                                <option selected disabled>Choisir le segment</option>
                                <option value="Segment1">Segment 1</option>
                                <option value="Segment2">Segment 2</option>
                                <option value="Segment3">Segment 3</option>
                            </select>
                            <span class="text-danger">@error('segment'){{$message}} @enderror</span>
                        </div>
                    </div>

                    <!-- num_bank input -->
                    <div class="form-outline">
                        <input type="number" id="nbre_card" name="nbre_card" class="form-control" min="0"/>
                        <label class="form-label" for="nbre_card">Nombre de carte</label>
                    </div>
                    <span class="text-danger">@error('nbre_card'){{$message}} @enderror</span>
                    <div class="mb-4"></div>

                    <div class="row">
                        <div class="col-8">
                            <h4><i class="bi bi-exclamation-triangle-fill text-danger mx-2"></i>Rassurer vous d'avoir pris le bon Segment</h4>
                        </div>
                    </div>
                    <hr />

                    <!-- Add button -->
                    <div class="row">
                        <div class="col">
                            <button class="btn btn-danger btn-block mb-2">Enregistrer</button>
                        </div>
                        <div class="col">
                            <button type="reset" class="btn btn-dark btn-block mb-2">Réinitialiser</button>
                        </div>
                    </div>
                </form>
        </div>
    </div>
</div>
@endsection
