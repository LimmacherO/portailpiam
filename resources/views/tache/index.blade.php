@extends('layouts.app')

@section('content')

@include('tache.modal')


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
                    <a href="{!! url('version',$version->id); !!}" class="nav-link"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;Synthèse Version</a>
                  </li>
                  <li class="nav-item">
                    <a href="{!! url('taches', $version->id); !!}" class="nav-link active"><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp;Planning</a>
                  </li>

                  <!-- Bouton de droite -->
                  <li class="ml-auto">
                    <!-- Button pour éditer -->
                    <button id="editer" type="button" type="submit" class="btn btn-outline-primary float-right btn-sm btn-margin-right" onclick="location.href = '{!! url('tache/create', $version->id); !!}';">
                      <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Créer une tâche
                    </button>
                  </li>
                  <li>
                    <!-- Button pour Supprimer la version -->
                    <button id="supprimer" type="button" type="submit" class="btn btn-outline-primary float-right btn-sm" onclick="location.href = '{!! url('jalon/create', $version->id); !!}';">
                      <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Créer un jalon
                    </button>
                  </li>

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

                <table class="table" data-form="deleteForm">

                    <!-- En-tête du tableau -->
                    <thead>
                        <tr class="portail-table-header">
                            <th>&nbsp;</th>
                            <th>Catégorie</th>
                            <th>Tâche</th>
                            <th>Début</th>
                            <th>Fin</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>

                    <!-- Corps du tableau -->
                    <tbody>
                        @foreach ($taches as $tache)
                            <tr>

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

                                <td>
                                  @if( $tache->deletable === true )
                                    <button type="button" class="btn btn-outline-danger btn-sm form-delete" id="deletetache{!! $tache->id!!}">
                                      <i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp;Supprimer
                                    </button>
                                  @else
                                    <p>&nbsp;</p>
                                  @endif

                                </td>

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


@endsection

@section('scripts')

<script>

    //On cache le bouton de validation pour éviter les créations en double
    $('#valider').click(function () {
        $('#valider').attr('disabled', true);
        $('#createjalon').submit();
        return true;
    });

  $('table[data-form="deleteForm"]').on('click', '.form-delete', function(e){
      e.preventDefault();
      var $form=$(this);
      $('#confirm').modal({ backdrop: 'static', keyboard: false })
          .on('click', '#delete-btn', function(){
              $form.submit();
          });
  });

</script>
@endsection
