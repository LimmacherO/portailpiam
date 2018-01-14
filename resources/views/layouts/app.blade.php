<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<!-- Header -->
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
    <link href="{{ asset('lib/bootstrap-3.3.7-dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Import - Font Awesome -->
    <link href="{{ asset('css/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet">

    <!-- Imports styles CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/portail-table.css') }}" rel="stylesheet">


    <!--  jQuery -->
  <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

  <!-- Bootstrap Date-Picker Plugin -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>


</head>

<body>

    <!-- Barre de menu en haut de page -->
    <nav id="navbar" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Portail DQI/PIAM</a>
            </div>

            <div class="collapse navbar-collapse">
              <ul class="nav navbar-nav navbar-right">
                <li>
                    <!-- Lien vers la RoadMap DSI -->
                    <a href="{!! url('version'); !!}"><i class="fa fa-map-o" aria-hidden="true"></i>&nbsp;&nbsp;Roadmap DSI</a>
                </li>
              </ul>
            </div>
        </div>
    </nav>


    @yield('content')

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="{{ asset('lib/bootstrap-3.3.7-dist/js/bootstrap.min.js') }}"></script>

    <!-- Vue.js -->
    <script src="/js/vue.min.js"></script>

    <!-- Bootstrap "bootstrap-datepicker"-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('lib/bootstrap-datepicker/dist/locales/bootstrap-datepicker.fr.min.js') }}"></script>

    @yield('scripts')

</body>

</html>
