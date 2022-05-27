@extends('layouts.navbar')
@section('body-start')
<div class="container p-5 mb-4">
    <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('distributor') }}">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Attribuer carte</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('attribue') }}">Cartes attribuées</a>
        </li>
    </ul>
    <div class="row">
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
                <form action="{{ route('selling') }}" method="post">
                    @csrf
                    <div class="row mb-4">
                        <div class="col">
                            <!-- Segment select -->
                            <select data-url="{{url('/distributor/selected')}}" data-token="{{ csrf_token() }}" class="form-select @error('num_card') is-invalid @enderror" id="num_card" name="num_card" aria-label="Default select example">
                                <option selected disabled>Choisir une numéro de carte</option>
                                @foreach ($mystock as $item)
                                    <option value="{{$item->num_card}}">{{$item->num_card}}</option>
                                @endforeach

                            </select>
                            <span class="text-danger">@error('num_card'){{$message}} @enderror</span>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <input type="text"  readonly id="segment" name="segment" class="form-control" placeholder="Segment en attente"/>
                            </div>
                            <div class="mb-4"></div>
                        </div>
                    </div>

                    <!-- num_bank input -->
                    <div class="row">
                        <div class="col">
                            <div class="form-outline">
                                <input type="text" id="info_user" name="info_user" class="form-control @error('info_user') is-invalid @enderror"/>
                                <label class="form-label" for="info_user">Nom client</label>
                            </div>
                            <span class="text-danger">@error('info_user'){{$message}} @enderror</span>
                            <div class="mb-4"></div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <input type="number" id="phone_user" name="phone_user" class="form-control @error('phone_user') is-invalid @enderror" min="0" maxlength="9"/>
                                <label class="form-label" for="phone_user">N° Téléphone</label>
                            </div>
                            <span class="text-danger">@error('phone_user'){{$message}} @enderror</span>
                            <div class="mb-4"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-outline">
                                <input type="number" id="racine_user" name="racine_user" class="form-control @error('racine_user') is-invalid @enderror" min="0"/>
                                <label class="form-label" for="racine_user">Racine du compte</label>
                            </div>
                            <span class="text-danger">@error('racine_user'){{$message}} @enderror</span>
                            <div class="mb-4"></div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    Identifiant de la carte
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" value="" name="idsegment" id="idsegment" readonly>
                                </div>
                            </div>

                        </div>
                    </div>

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
        <div class="col-6 text-right p-5">
            <img src="{{ asset('img/addcard.png') }}" alt="" srcset="" class="">
        </div>
    </div>
</div>
@endsection
