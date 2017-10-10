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
    <!--<link href="{{ asset('css/navbar.css') }}" rel="stylesheet">-->
    <link href="{{ asset('css/tabs.css') }}" rel="stylesheet">
    <link href="{{ asset('css/portail-table.css') }}" rel="stylesheet">


</head>

<body>

    <div class="wrapper">
        
        <!-- SideBar left: menu principal du portail PIAM-->
        <nav id="sidebar">

            <!-- Entête du portail PIAM -->
            <!--<div class="sidebar-header">
                <h1>Portail DQI/PIAM</h1>
            </div>-->

            <!-- Menu -->
            <ul class="list-unstyled components">
                <!--
                <li>
                    <a href="#"><i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp;&nbsp;Tableau de bord</a>
                </li>-->
                <li class="active">
                    <a href="{!! url('version'); !!}"><i class="fa fa-map-o" aria-hidden="true"></i>&nbsp;&nbsp;Roadmap DSI</a>
                </li>
            </ul>

        </nav>


        <!-- Barre de menu en haut de page -->
        <nav class="navbar navbar-default navbar-fixed-top navbar-menutop">
            <div class="container-fluid">
                <div class="row">
                    
                    <div class="col-sm-12 col-lg-12">
                        <h1>Portail DQI/PIAM</h1>
                    </div>

                </div>
            </div>
        </nav>

        <!-- Contenu de la page Web -->
        <div id="content">

            <!-- En-tête - sous forme de Navbar fixe en haut de la page -->
            <nav class="navbar navbar-default navbar-fixed-top section-header">
                <div class="container-fluid">
                    <div class="row">
                        
                        <div class="col-lg-6">
                            <h1>@yield('page-header-title')</h1>
                        </div>
                        <div class="col-lg-6 page-header-links">
                            @yield('page-header-links')
                        </div>

                        <div class="col-sm-12 col-lg-12">
                            @yield('alerte')
                        </div>
                        <!--
                        <div class="col-sm-12 col-lg-12">
                            <div class="container-fluid tab_line clearfix">
                                <div class="row">@yield('tabs')</div>
                            </div>
                        </div>
                        -->

                    </div>
                </div>
            </nav>

            <!-- Afichage du contenu de la page -->
            <div class="container-fluid section-content">
                <div class="row">
                    <div class="col-sm-12 col-lg-12">
                        @yield('content')
                    </div>
                </div>
            </div>

        </div>
    </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="{{ asset('lib/bootstrap-3.3.7-dist/js/bootstrap.min.js') }}"></script>

    <!--<script>
        var onResize = function() {
          $(".section-content").css("margin-top", $(".navbar-fixed-top").height());
        };

        $(window).resize(onResize);

        $(function() {
          onResize();
        });
    </script>-->

</body>

</html>