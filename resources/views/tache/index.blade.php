@extends('layouts.app')

@section('content')

  <!-- En-tête page -->
  <div id="header" class="container-fluid section-header section-header-nopadding-bottom">
    <div class="row">
        <div class="col-lg-12">

          <div class="container">
            <div class="row">
              <div class="col-lg-12">

                <!-- Titre de la page Web -->
                <h1 class="text-left">Planning chantier "{{ $version->libelle }}"</h1>

                <!-- Onglets -->
                <ul class="nav nav-tabs">
                  <li class="nav-item">
                    <a href="{!! url('version',$version->id); !!}" class="nav-link"><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp;&nbsp;Synthèse Version</a>
                  </li>
                  <li class="nav-item">
                    <a href="{!! url('taches', $version->id); !!}" class="nav-link active"><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp;Planning</a>
                  </li>

                  <!-- Boutons de droite -->
                  <li class="ml-auto">
                    <!-- Button pour retour à l'accueil/liste des chantiers -->
                    <button id="editer" type="button" type="submit" class="btn btn-outline-primary float-right btn-sm" onclick="location.href = '{!! url('version'); !!}';">
                      <i class="fa fa-reorder" aria-hidden="true"></i>&nbsp;Liste chantiers
                    </button>
                    <!-- Button pour éditer -->
                  <!--  <button id="editer" type="button" type="submit" class="btn btn-outline-primary float-right btn-sm btn-margin-right" onclick="location.href = '{!! url('tache/create', $version->id); !!}';">
                      <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Créer une tâche
                    </button>-->
                  </li>
                  <!--<li>-->
                    <!-- Button pour Supprimer la version -->
                    <!--<button id="supprimer" type="button" type="submit" class="btn btn-outline-primary float-right btn-sm" onclick="location.href = '{!! url('jalon/create', $version->id); !!}';">
                      <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Créer un jalon
                    </button>
                  </li>-->

                </ul>

              </div>
            </div>
          </div>

        </div>

    </div>
</div>

<!-- Affichage du message d'information (SUCCESS, etc.) -->
<div class="container">
  <div class="row">
    <div class="col-lg-12">
        @if(session()->has('ok'))
          <div class="alert alert-success">
              {!! session('ok') !!}
          </div>
        @endif
    </div>
  </div>
</div>

  <!-- Afichage du contenu de la page -->
  <div class="container">
    <div class="row">

      <div class="col-lg-12">

        <!-- Contenu du panel -->
        <div class="card">

          <!-- Titre du panel -->
          <div class="card-header">Planning</div>

          <div class="card-body">

            <!-- Affichage du tableau contenant les tâches/jalons-->
            <div class="col-lg-12">
              <div class="row">

                <table class="table table-striped" data-form="deleteForm">

                    <!-- En-tête du tableau -->
                    <thead>
                        <tr class="portail-table-header">
                            <!--<th>&nbsp;</th>
                            <th>&nbsp;</th>-->
                            <th>&nbsp;</th>
                            <th>Catégorie</th>
                            <th>Tâche</th>
                            <th>Début</th>
                            <th>Fin</th>
                            <th>&nbsp;</th>
                            <!--
                            <th>&nbsp;</th>
                            -->
                        </tr>
                    </thead>

                    <!-- Corps du tableau -->
                    <tbody>
                        @foreach ($taches as $tache)
                            <tr>

                                <!--
                                <td>
                                  <button type="button" type="submit" class="btn btn-outline-success float-right btn-sm" onclick="location.href = '{!! url('tache/create', $version->id); !!}';">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                  </button>
                                </td>

                                <td>
                                  <button type="button" type="submit" class="btn btn-outline-primary float-right btn-sm btn-margin-right move-tache">
                                    <i class="fa fa-exchange" aria-hidden="true"></i>
                                  </button>
                                </td>
                              -->

                                <!-- Type de la tâche -->
                                <td>
                                  @if($tache->jalon == '1')
                                    <i class="fa fa-map-marker align-center" aria-hidden="true">
                                  @else
                                    <i class="fa fa-tasks align-center" aria-hidden="true">
                                  @endif
                                </td>

                                <!-- Catégorie de la tâche -->
                                <td>{!! $tache->tachetype->libelle !!}</td>

                                <td>{!! $tache->libelle !!}</td>

                                <td>
                                    @if($tache->debut == '')
                                      Non renseignée
                                    @else
                                      {{ $tache->debut }}
                                    @endif
                                </td>

                                <td>
                                   @if($tache->jalon == '1')
                                     &nbsp;
                                   @elseif($tache->fin == '')
                                     Non renseignée
                                   @else
                                     {{ $tache->fin }}</td>
                                   @endif
                                <td>
                                  @if($tache->jalon == '1')
                                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="location.href = '{!! url('jalon/edit', $tache->id); !!}';">
                                      <i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;Editer
                                    </button>
                                  @else
                                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="location.href = '{!! url('tache/edit', $tache->id); !!}';">
                                      <i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;Editer
                                    </button>
                                  @endif

                                </td>

                                <!--
                                <td>
                                  @if( $tache->deletable === true )
                                    <button type="button" class="btn btn-outline-danger btn-sm confirm-delete" data-id="{{ $tache->id }}">
                                      <i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp;Supprimer
                                    </button>
                                  @else
                                    <p>&nbsp;</p>
                                  @endif

                                </td>
                              -->

                            </tr>
                        @endforeach
                    </tbody>
                </table>

              </div>
           </div>

         </div>
       </div> <!-- Fin panel -->

     </div>

   </div>
 </div> <!-- Fin affichage du contenu de la page Web -->

   <!-- Fenêtre modal pour déplacement d'une tâche ou d'un jalon -->
   @include('tache/modal-move')

   <!-- Modal - pour confirmation suppression d'une tâche -->
   <div id="myModal" class="modal hide" tabindex="-1" role="dialog">
     <div class="modal-dialog" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title">Confirmation de suppression</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
           <p>Souhaitez-vous supprimer cette tâche/jalon ?</p>
         </div>
         <div class="modal-footer">
           <button id="btnYes" type="button" class="btn btn-outline-danger">Oui</button>
           <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Non</button>
         </div>
       </div>
     </div>
   </div>

@endsection

@section('scripts')

<script>

    //On cache le bouton de validation pour éviter les créations en double
    $('#valider').click(function () {
        $('#valider').attr('disabled', true);
        $('#createjalon').submit();
        return true;
    });

    //Code pour gestion de la fenêtre modal de déplacement d'une tâche
    $(document).ready(function(){

      $('.move-tache').on('click', function(e) {
          e.preventDefault();

          var id = $(this).data('id');
          $('#modalmovetache').data('id', id).modal('show');
      });

    });

    //Code pour gestion de la fenêtre modal de confirmation de suppression
    $(document).ready(function(){
      $('#myModal').on('show', function() {
          var id = $(this).data('id'),
              removeBtn = $(this).find('.danger');
      })

      $('.confirm-delete').on('click', function(e) {
          e.preventDefault();

          var id = $(this).data('id');
          $('#myModal').data('id', id).modal('show');
      });

      $('#btnYes').click(function() {
          // handle deletion here
        	var id = $('#myModal').data('id');

          //A améliorer...
          url = "/portailpiam/public/tache/destroy/" + id;
          window.location = url;
      });
    });

</script>

@endsection
