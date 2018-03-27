<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

  <!-- Header de la page -->
  <head>

      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">

      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">

      <!-- Titre de la page -->
      <title>{{ config('app.name', 'Laravel') }}</title>

      <!-- Import - Bootstrap -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

      <!-- Import - Font Awesome -->
      <link href="{{ asset('css/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet">

      <!-- Imports styles CSS -->
      <link href="{{ asset('css/app.css') }}" rel="stylesheet">
      <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
      <link href="{{ asset('css/portail-table.css') }}" rel="stylesheet">

      <!-- Bootstrap Date-Picker Plugin -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker3.css"/>

  </head>

  <body>

    <!-- Barre de navigation "top" -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-light navbar-custom">

      <!-- Titre de la barre de navigation -->
      <a class="navbar-brand" href="{!! url('version'); !!}">Portail DQI/PIAM</a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">

            <!-- Lien vers la roadmap -->
            <li  class="nav-item active"> <!-- Par défaut actif en attendant les autres menus -->
              <a class="nav-link" href="{!! url('version'); !!}">Roadmap opérationnelle DSI</span></a>
            </li>

            @if (Auth::guest())

              <!-- Lien vers la page d'indentification -->
              <li class="nav-item @if(Request::is('login')) active @endif">
                <a class="nav-link" href="{{ route('login') }}">S'identifier</a>
              </li>

            @else

              <!-- Lien vers la page de déconnexion -->
              <li  class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}">Se déconnecter</span></a>
              </li>

            @endif

        </ul>

      </div>
    </nav>

    <!-- Affichage du contenu -->
    @yield('content')

    <!-- Import des librairies JS associées à Bootstrap  -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- Bootstrap "bootstrap-datepicker"-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/locales/bootstrap-datepicker.fr.min.js"></script>

    <!-- Permet d'ajouter des scripts JS spécifique dans chaque page/vues -->
    @yield('scripts')

  </body>

</html>
