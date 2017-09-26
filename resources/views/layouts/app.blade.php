<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Import - Bootstrap -->
    <link href="{{ asset('lib/bootstrap-3.3.7-dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Import - Font Awesome -->
    <link href="{{ asset('css/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/tabs.css') }}" rel="stylesheet">
    <link href="{{ asset('css/portail-table.css') }}" rel="stylesheet">


    <link href="{{ asset('css/gantt/gantt.css') }}" rel="stylesheet" type="text/css">

</head>
<body>
    <div id="app">
        <nav id="navigation" class="navbar navbar-default navbar-static-top">
            <div class="container-fluid">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-left">

                        <!-- Lien vers la page de Roadmap -->
                        <!--<li @yield('link-roadmap-active')><a href="{!! url('version'); !!}"><i class="fa fa-map-o" aria-hidden="true"></i>&nbsp;&nbsp;Roadmap</a></li>-->

                        <li @yield('link-roadmap-active')><a href="{!! url('version'); !!}"><i class="fa fa-map-o" aria-hidden="true"></i>&nbsp;&nbsp;Roadmap</a></li>


                    </ul>

                </div>
            </div>
        </nav>

        <!-- Header des pages par défaut -->
        <div class="container-fluid section-header">
          <div class="row">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-lg-12">
                        
                        <!-- titre de la page - en-tête -->
                        <h1>@yield('page-header-title')</h1>

                        <!-- Contrôles - optionnels -->
                        <div>
                            @yield('page-header-controls')
                        </div>
                        
                    </div>
                </div>
            </div>
          </div>
        </div>

        <!-- Afichage du contenu de la page -->
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-12 col-lg-12">
                @yield('content')
            </div>
          </div>
        </div>
        
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="{{ asset('lib/bootstrap-3.3.7-dist/js/bootstrap.min.js') }}"></script>

    @yield('scripts')

</body>
</html>
