@extends('layouts.header')
@section('container')
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top"  style="background-color: rgb(0, 0, 0);">
        <!-- Container wrapper -->
        <div class="container">
        <!-- Toggle button -->
        <button
            class="navbar-toggler"
            type="button"
            data-mdb-toggle="collapse"
            data-mdb-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <i class="fas fa-bars text-light"></i>
        </button>

        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Navbar brand -->
            <a class="navbar-brand mt-2 mt-lg-0" href="/{{$InfoActeur['role_acteur']}}">
                <img src="{{asset('img/cremincam.png')}}" height="40" loading="lazy" />
            </a>
        </div>
        <!-- Collapsible wrapper -->

        <!-- Right elements -->
        <div class="d-flex align-items-center">
            <!-- Avatar -->
            <div class="dropdown  me-3 ">
            <a class="dropdown-toggle d-flex align-items-center hidden-arrow text-white text-uppercase"
                href="#"
                id="navbarDropdownMenuAvatar"
                role="button"
                data-mdb-toggle="dropdown"
                aria-expanded="false"
            >

            <span class="text-white">{{$InfoActeur['name_acteur']}} - {{$InfoActeur['role_acteur']}} {{$InfoActeur['localisation']}}</span>
            </a>
            <ul
                class="dropdown-menu dropdown-menu-end"
                aria-labelledby="navbarDropdownMenuAvatar"
            >
                <li>
                <a class="dropdown-item" href="{{$InfoActeur['role_acteur']}}/profile">Mon profil</a>
                </li>
                <li>
                <a class="dropdown-item" href="{{$InfoActeur['role_acteur']}}/setting">Paramètres</a>
                </li>
                <li>
                <a class="dropdown-item" href="{{ route('login.logout') }}">Se deconnecter</a>
                </li>
            </ul>
            </div>

            <!-- Notifications -->
            <a
                class="text-reset dropdown-toggle hidden-arrow"
                href="#"
            >
                <i class="bi bi-bell text-light"></i>
                <span class="badge rounded-pill badge-notification bg-danger">1</span>
            </a>
        </div>
        <!-- Right elements -->
        </div>
        <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
    @yield('body-start')

<footer class="text-center text-white fixed-bottom">

    <!-- Copyright -->
    <div class="text-center p-2" style="background-color: rgb(0, 0, 0);">
      © {{date('Y')}} Copyright : ADMIN | VISA CARD
    </div>
    <!-- Copyright -->
  </footer>
@endsection
