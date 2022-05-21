@extends('layouts.header')
@section('container')
    <div class="container-fluid">
        <div class="container">
            <div class="d-flex justify-content-center h-100">
                <div class="card px-2 py-2">
                    <div class="card-header">
                        <h3 class="text-center">@yield('title', $title)</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login.action') }}">
                            @csrf
                            <!-- Email input -->
                            <div class="form-outline">
                                @error('code_acteur')
                                    <i class="fas fa-exclamation-circle trailing text-danger"></i>
                                @enderror
                                <input type="number" id="code_acteur" name="code_acteur" class="form-control" value="{{ old('code_acteur') }}"/>
                                <label class="form-label" for="code_acteur">Code d'accès</label>
                            </div>
                            <span class="text-danger">@error('code_acteur'){{$message}} @enderror</span>
                            <div class="mb-4"></div>

                            <!-- Password input -->
                            <div class="form-outline">
                                @error('mdp_acteur')
                                    <i class="fas fa-exclamation-circle trailing text-danger"></i>
                                @enderror
                              <input type="password" id="mdp_acteur" name="mdp_acteur" class="form-control" value="{{ old('mdp_acteur') }}"/>
                              <label class="form-label" for="mdp_acteur">Mot de passe en attente</label>
                            </div>
                            <span class="text-danger">@error('mdp_acteur'){{$message}} @enderror</span>
                            <div class="mb-4"></div>

                            <!-- 2 column grid layout for inline styling -->
                            <div class="row mb-4">
                              <div class="col-12 text-center">
                                <!-- Simple link -->
                                <a href="#!">Mot de passe oublié ?</a>
                              </div>
                            </div>

                            <!-- Submit button -->
                            <div class="row">
                                <div class="col">
                                    <button class="btn btn-success btn-block mb-2">Connexion</button>
                                </div>
                                <div class="col">
                                    <button type="reset" class="btn btn-dark btn-block mb-2">Réinitialiser</button>
                                </div>
                            </div>
                          </form>
                    </div>
                    <div class="card-footer">
                    @if (session('fail'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            {{session('fail')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
