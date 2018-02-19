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
                  <h1 class="text-left">Chantier "{{ $version->libelle }}"</h1>

                  <ul class="nav nav-tabs">
                    <li class="nav-item">
                      <a href="{!! url('version',$version->id); !!}" class="nav-link active"><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp;&nbsp;Synthèse Version</a>
                    </li>
                    <li class="nav-item">
                      <a href="{!! url('taches', $version->id); !!}" class="nav-link"><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp;Planning</a>
                    </li>
                    <li class="ml-auto">
                      <!-- Button pour retour à l'accueil/liste des chantiers -->
                      <button id="editer" type="button" type="submit" class="btn btn-outline-primary float-right btn-sm btn-margin-right" onclick="location.href = '{!! url('version'); !!}';">
                        <i class="fa fa-reorder" aria-hidden="true"></i>&nbsp;Liste chantiers
                      </button>
                    </li>
                    <li>
                      <!-- Button pour éditer -->
                      <button id="editer" type="button" type="submit" class="btn btn-outline-primary float-right btn-sm btn-margin-right" onclick="location.href = '{!! url('version/edit', $version->id); !!}';">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;Modifier
                      </button>
                    </li>
                    <li>
                      <!-- Button pour Supprimer la version -->
                      <button id="supprimer" type="button" type="submit" class="btn btn-outline-danger float-right btn-sm" data-id="{{ $version->id }}">
                        <i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp;Supprimer
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

      <!-- Panel "Identification de la version" -->
      <div class="col-lg-12">

        <div class="card">

          <!-- Titre du panel -->
          <div class="card-header">Identification de la version</div>

          <!-- Contenu du panel -->
          <div class="card-body">
            <div class="container-fluid">
              <div class="row">

                <div class="col-lg-3 form-group">
                  <label>Domaine :</label>
                  <div class="label-content">{{ $version->application->domaine->libelle }}</div>
                </div>

                <div class="col-lg-3 form-group">
                  <label>Application :</label>
                  <div class="label-content">{{ $version->application->libelle }}</div>
                </div>

                <!-- Libellé du chantier -->
                <div class="col-lg-6 form-group">
                  <label>Libellé :</label>
                  <div class="label-content">{{ $version->libelle }}</div>
                </div>

              </div>
              <div class="row">

                <div class="col-lg-3 form-group">
                  <label>Product Dimensions :</label>
                  <div class="label-content">{{ $version->product_dimensions }}</div>
                </div>

                <div class="col-lg-3 form-group">
                  <label>Version MOE :</label>
                  <div class="label-content">{{ $version->version }}</div>
                </div>

                <div class="col-lg-3 form-group">
                  <label>Version Dimensions :</label>
                  <div class="label-content">{{ $version->version_dimensions }}</div>
                </div>

              </div>
              <div class="row">

                <div class="col-lg-3 form-group">
                  <label>Etat :</label>
                  <div class="label-content">{{ $version->versionetat->libelle }}</div>
                </div>

              </div>
              <div class="row">

                <div class="col-lg-3 form-group">
                  <label>Référence ALFA :</label>
                  <div class="label-content">
                    @if($version->referencealfa == '')
                      Non renseignée
                    @else
                      {{ $version->referencealfa }}
                    @endif
                  </div>
                </div>

                <div class="col-lg-3 form-group">
                  <label>Date création ALFA :</label>
                  <div class="label-content">
                    @if($version->alfadate == '')
                      Non renseignée
                    @else
                      {{ $version->alfadate }}
                    @endif
                  </div>
                </div>

              </div>
            </div>

          </div>

        </div>

      </div> <!-- Fin Panel "Identification de la version" -->


      <!-- Panel "Scoring QOS" -->
      <div class="col-lg-12">

        <div class="card">

          <!-- Titre du panel -->
          <div class="card-header">Scoring QOS</div>

          <!-- Contenu du panel -->
          <div class="card-body">
            <div class="container-fluid">
              <div class="row">

                <div class="col-lg-3 form-group">
                    <label>Enjeux métiers :</label>
                    @if( $version->enjeuxmetier == 1 )
                        <div class="label-content">Faible</div>
                    @elseif( $version->enjeuxmetier == 2 )
                        <div class="label-content">Moyen</div>
                    @else
                        <div class="label-content">Fort</div>
                    @endif
                </div>

                <div class="col-lg-3 form-group">
                    <label>Enjeux SI :</label>
                    @if( $version->enjeuxsi == 1 )
                        <div class="label-content">Faible</div>
                    @elseif( $version->enjeuxsi == 2 )
                        <div class="label-content">Moyen</div>
                    @else
                        <div class="label-content">Fort</div>
                    @endif
                </div>

                <div class="col-lg-3 form-group">
                    <label>QOS :</label>
                      @if( $version->qos == 1 )
                          <div class="label label-success">{{ $version->qos }}</div>
                      @elseif( $version->qos == 9 )
                          <div class="label label-danger">{{ $version->qos }}</div>
                      @else
                          <div class="label label-warning">{{ $version->qos }}</div>
                      @endif
                </div>

              </div>
            </div>
          </div>

        </div>

      </div> <!-- Fin Panel "Scoring QOS" -->


      <!-- Panel "Suivi des livraisons" -->
      <div class="col-lg-12">

        <div class="card">

          <!-- Titre du panel -->
          <div class="card-header">Suivi des livraisons</div>

          <!-- Contenu du panel -->
          <div class="card-body">
            <div class="container-fluid">
              <div class="row">

                <div class="col-lg-3 form-group">
                  <label>Nombre livraison TMA/DID :</label>
                  <div class="label-content">{{ $version->inc_nblivtma }}</div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div> <!-- Fin Panel "Suivi des livraisons" -->


      <!-- Panel "Suivi de la qualification/intégration" -->
      <div class="col-lg-12">

        <div class="card">

          <!-- Titre du panel -->
          <div class="card-header">Suivi de la qualification/intégration</div>

          <!-- Contenu du panel -->
          <div class="card-body">
            <div class="container-fluid">
              <div class="row">

                <div class="col-lg-3 form-group">
                  <label>Périmètre DQI :</label>
                    @if ($version->perimetreqi)
                      <div class="label-content">Oui</div>
                    @else
                      <div class="label-content">Non</div>
                    @endif
                </div>

                <div class="col-lg-3 form-group">
                  <label>Référent qualification :</label>
                  <div class="label-content">{!! $version->referentqi->nom !!}&nbsp;{!! $version->referentqi->prenom !!}</div>
                </div>

                <!-- "Indicateur Avancement QI" -->
                <div class="col-lg-3 form-group">
                  <label>Avancement QI :</label>
                  <div class="label-content">
                    @if ($version->avancementqi >0 )
                      {!! $version->avancementqi !!}&nbsp;%
                    @else
                      0 %
                    @endif
                  </div>
                </div>

                <div class="col-lg-6 form-group">
                  <label>Alertes et vigilances :</label>
                  <div class="label-content">
                    @if (!empty($version->alerteqi))
                      {!! $version->alerteqi !!}
                    @else
                      Pas d'alertes et vigilances QI
                    @endif
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div> <!-- Fin Panel "Suivi de la qualification/intégration" -->


      <!-- Panel "Suivi de la production" -->
      <div class="col-lg-12">

        <div class="card">

          <!-- Titre du panel -->
          <div class="card-header">Suivi de la production</div>

          <!-- Contenu du panel -->
          <div class="card-body">
            <div class="container-fluid">
              <div class="row">

                <!-- Référent de production -->
                <div class="col-lg-3 form-group">
                  <label>Référent production :</label>
                  <div class="label-content">{!! $version->referentprd->nom !!}&nbsp;{!! $version->referentprd->prenom !!}</div>
                </div>

                <!-- Nombre de reports de production -->
                <div class="col-lg-3 form-group">
                  <label>Nombre report(s) production :</label>
                  <div class="label-content">
                    @if($version->prd_nbreports == 0)
                      Aucun report
                    @elseif($version->prd_nbreports == 1)
                      {!! $version->prd_nbreports !!} report
                    @else
                      {!! $version->prd_nbreports !!} reports
                    @endif
                  </div>
                </div>

                <!-- Version Dimensions livrée -->
                <div class="col-lg-3 form-group">
                  <label>Version Dimensions livrée :</label>
                  <div class="label-content">
                    @if($version->prd_versiondimensions == '')
                      Non renseignée
                    @else
                      {!! $version->prd_versiondimensions !!}
                    @endif
                  </div>
                </div>

                <!-- Estimation de la charge de pré-production -->
                <div class="col-lg-3 form-group">
                  <label>Estimation charge de pré-production :</label>
                  <div class="label-content">
                    @if($version->prp_estimationcharge == '')
                      Non renseignée
                    @else
                      {!! $version->prp_estimationcharge !!}&nbsp;j/h
                    @endif
                  </div>
                </div>

                <!-- Estimation de la charge de production -->
                <div class="col-lg-3 form-group">
                  <label>Estimation charge de production :</label>
                  <div class="label-content">
                    @if($version->prd_estimationcharge == '')
                      Non renseignée
                    @else
                      {!! $version->prd_estimationcharge !!}&nbsp;j/h
                    @endif
                  </div>
                </div>

                <div class="col-lg-6 form-group">
                  <label>Alertes et vigilances :</label>
                    <div class="label-content">
                      @if (!empty($version->alerteprd))
                        {!! $version->alerteprd !!}
                      @else
                        Pas d'alertes et vigilances production
                      @endif
                    </div>
                </div>

              </div>
            </div>
          </div>

        </div>
      </div> <!-- Fin Panel "Suivi de la production" -->


      <!-- Panel "Commentaires" -->
      <div class="col-lg-12">

        <div class="card">

          <!-- Titre du panel -->
          <div class="card-header">Commentaires</div>

          <!-- Contenu du panel -->
          <div class="card-body">
            <div class="container-fluid">
              <div class="row">

                <div class="col-lg-12 form-group">
                  <label>Commentaires :</label>
                    <div class="label-content">
                      @if (!empty($version->commentaire))
                        {!! nl2br($version->commentaire) !!}
                      @else
                        Pas de commentaire(s)
                      @endif
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div> <!-- Fin Panel "Commentaires" -->

    </div>
  </div> <!-- Fin de l'affichage du contenu de la page -->


  <!-- Modal - pour confirmation suppression d'une version -->
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
          <p>Souhaitez-vous supprimer cette version ?</p>
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

    //Code pour gestion de la fenêtre modal
    $(document).ready(function(){
      $('#myModal').on('show', function() {
          var id = $(this).data('id'),
              removeBtn = $(this).find('.danger');
      })

      $('#supprimer').on('click', function(e) {
          e.preventDefault();

          var id = $(this).data('id');
          $('#myModal').data('id', id).modal('show');
      });

      $('#btnYes').click(function() {
          // handle deletion here
        	var id = $('#myModal').data('id');

          //A améliorer...
          url = "/portailpiam/public/version/destroy/" + id;
          window.location = url;
      });
    });

</script>

@endsection
