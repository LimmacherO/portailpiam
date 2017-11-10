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

    <!-- En-tête page Web -->
    <div id="header" class="section-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>@yield('header-title')</h1>
                </div>
                @yield('header-controls')
            </div>
        </div>
    </div>

    <!-- Contenu de la page Web -->
    <div id="content">
        <!-- Afichage du contenu de la page -->
        <div class="container section-content">
            @yield('content')
        </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="{{ asset('lib/bootstrap-3.3.7-dist/js/bootstrap.min.js') }}"></script>

</body>

</html>