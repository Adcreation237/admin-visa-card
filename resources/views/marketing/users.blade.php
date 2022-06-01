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
            <div class="col-12 mb-4">
                <div class="row">
                    <div class="col">
                       @error('name_acteur')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="bi bi-emoji-smile-fill me-2"></i>
                                {{$message}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @enderror
                        @error('role_acteur')
                             <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                 <i class="bi bi-emoji-smile-fill me-2"></i>
                                 {{$message}}
                                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                             </div>
                         @enderror
                          @error('agence')
                               <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                   <i class="bi bi-emoji-smile-fill me-2"></i>
                                   {{$message}}
                                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                               </div>
                           @enderror
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
                    <div class="col text-right">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-blue" data-mdb-toggle="modal" data-mdb-target="#exampleModal">
                            <i class="bi bi-person-plus-fill me-2"></i> utilisateur
                        </button>
                    </div>
                </div>

            </div>

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

     <!-- Modal -->
     <div class="modal top fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-mdb-backdrop="static" data-mdb-keyboard="true">
        <div class="modal-dialog  ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajout d'un utilisateur</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form action="{{ route('add_users') }}" method="post">
                        @csrf
                        <!-- 2 column grid layout with text inputs for the first and last names -->
                        <div class="row mb-4">
                          <div class="col">
                            <div class="form-outline">
                              <input type="text" id="name_acteur" name="name_acteur" class="form-control" />
                              <label class="form-label" for="name_acteur">Nom responsable</label>
                            </div>
                          </div>
                          <div class="col">
                            <select class="form-select" aria-label="Default select example" id="role_acteur" name="role_acteur">
                                <option selected disabled>Selectionner le rôle</option>
                                @foreach ($roles as $item)
                                    @if ($item->statut != $item->limite)
                                        <option value="{{$item->name}}">{{$item->name}}</option>
                                    @endif
                                @endforeach
                              </select>
                          </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col">
                              <div class="form-outline">
                                <input type="text" id="code_acteur" value="{{$code}}" name="code_acteur" class="form-control" readonly/>
                                <label class="form-label" for="code_acteur">Code utilisateur</label>
                              </div>
                            </div>
                            <div class="col">
                                <select class="form-select" aria-label="Default select example" id="agence" name="agence">
                                    <option selected disabled>Selectionner l'agence</option>
                                    <option value="Direction">Direction</option>
                                    <option value="Yaounde">Yaounde</option>
                                    <option value="Douala">Douala</option>
                                    <option value="Garoua">Garoua</option>
                                  </select>
                            </div>
                          </div>

                        <!-- Submit button -->
                        <div class="row mt-5">
                            <div class="col">
                                <button type="submit" class="btn btn-danger btn-block mb-4">Ajouter</button>
                            </div>
                            <div class="col">
                                <button type="reset" class="btn btn-black btn-block mb-4">Réinitialiser</button>
                            </div>
                        </div>
                      </form>
                </div>
            </div>
        </div>
    </div>
@endsection
