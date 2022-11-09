@extends('layouts.navbar')
@section('body-start')
    <div class="container px-5 py-3 mb-4">
        <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link " href="{{ route('marketing') }}">Accueil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active disabled" href="#">Enregistrement carte</a>
            </li>
          </ul>
        <div class="row mt-4">
            <div class="col-6">
                    <form action="{{ route('saving') }}" method="post">
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
                            <div class="col">
                                <!-- Email input -->
                                <div class="form-outline">
                                    @error('date_start')
                                        <i class="fas fa-exclamation-circle trailing text-danger"></i>
                                    @enderror
                                    <input type="date" id="date_start" name="date_start" class="form-control" />
                                    <label class="form-label" for="date_start">Date</label>
                                </div>
                                <span class="text-danger">@error('date_start'){{$message}} @enderror</span>
                            </div>
                        </div>

                        <!-- num_bank input -->
                        <div class="form-outline mb-4">
                            <input type="text" id="num_bank" name="num_bank" class="form-control" value="XXXX XXXX XXXX " readonly/>
                            <label class="form-label" for="num_bank">Numero Bancaire</label>
                        </div>

                        <!-- branch_partner input -->
                        <div class="form-outline">
                            @error('branch_partner')
                                <i class="fas fa-exclamation-circle trailing text-danger"></i>
                            @enderror
                            <input type="text" id="branch_partner" name="branch_partner" class="form-control" value="UBA House Branch 5207"/>
                            <label class="form-label" for="branch_partner">Branche UBA</label>
                        </div>
                        <span class="text-danger">@error('branch_partner'){{$message}} @enderror</span>
                        <div class="mb-4"></div>

                        <!-- branch_distri input -->
                        <div class="form-outline mb-4">
                            <input type="text" id="branch_distri" name="branch_distri" class="form-control" value="Cremincam - Distribution" readonly/>
                            <label class="form-label" for="branch_distri">Distributeur</label>
                        </div>

                        <div class="row">
                            <div class="col-8">
                                <h3>Entrez les numéro de carte</h3>
                            </div>
                            <div class="col-1">
                                <input class="inputid" type="text" id="idrespo" name="idrespo" value="{{$InfoActeur['id']}}" readonly>
                            </div>
                        </div>
                        <hr />

                        <div class="row mb-4">
                            <div class="col">
                                <!-- first_num input -->
                                <div class="form-outline">
                                    @error('first_num')
                                        <i class="fas fa-exclamation-circle trailing text-danger"></i>
                                    @enderror
                                    <input type="text" id="first_num" name="first_num" class="form-control"/>
                                    <label class="form-label" for="first_num">Premier Numéro</label>
                                </div>
                                <span class="text-danger">@error('first_num'){{$message}} @enderror</span>
                            </div>
                            <div class="col">
                                <!-- last_num input -->
                                <div class="form-outline">
                                    @error('last_num')
                                        <i class="fas fa-exclamation-circle trailing text-danger"></i>
                                    @enderror
                                    <input type="text" id="last_num" name="last_num" class="form-control"/>
                                    <label class="form-label" for="last_num">Dernier numéro</label>
                                </div>
                                <span class="text-danger">@error('last_num'){{$message}} @enderror</span>
                            </div>
                            <div class="col">
                                <!-- prix input -->
                                <div class="form-outline">
                                    @error('prix')
                                        <i class="fas fa-exclamation-circle trailing text-danger"></i>
                                    @enderror
                                    <input type="number" id="prix" name="prix" class="form-control"/>
                                    <label class="form-label" for="prix">Montant</label>
                                </div>
                                <span class="text-danger">@error('prix'){{$message}} @enderror</span>
                            </div>
                        </div>

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
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-emoji-smile-fill me-2"></i>
                        {{session('success')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <img src="{{ asset('img/addcard.png') }}" alt="" srcset="" class="">

                @if (session('fail'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        {{session('fail')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
