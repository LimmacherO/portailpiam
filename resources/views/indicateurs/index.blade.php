@extends('layouts.app')

@section('content')

    <!-- En-tête page -->
    <div id="header" class="container-fluid section-header">
        <div class="row">
            <div class="col-lg-12">

                <!-- Titre de la page Web -->
        				<h1 class="text-left">Indicateurs</h1>

            </div>

        </div>
    </div>

    <!-- Afichage du contenu de la page -->
    <div class="container-fluid">
      <div class="row">

        @foreach ($domaines as $domaine)
          <div class="col-lg-4">
            <div class="card">

              <!-- Titre du panel -->
              <div class="card-header">{{ $domaine->libelle }}</div>

              <div class="card-body">
              Indicateurs
              </div>
            </div>


          </div>
        @endforeach

      </div>
    </div>

@endsection
