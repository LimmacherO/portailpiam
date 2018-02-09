@extends('layouts.app')

@section('content')

  <!-- En-tête page -->
  <div id="header" class="container-fluid section-header section-header-nopadding-bottom">
      <div class="row">
          <div class="col-lg-12">

              <!-- Titre de la page Web -->
              <h1 class="text-left">Chantier "{{ $version->libelle }}"</h1>

              <ul class="nav nav-tabs">
                <li class="nav-item">
                  <a href="{!! url('version',$version->id); !!}" class="nav-link active"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;Synthèse Version</a>
                </li>
                <li class="nav-item">
                  <a href="{!! url('taches', $version->id); !!}" class="nav-link"><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp;Planning</a>
                </li>
                <li class="ml-auto">
                  <!-- Button pour éditer -->
                  <button id="editer" type="button" type="submit" class="btn btn-outline-primary float-right btn-sm btn-margin-right" onclick="location.href = '{!! url('version/edit', $version->id); !!}';">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;Modifier
                  </button>
                </li>
                <li>
                  <!-- Button pour Supprimer la version -->
                  <button id="supprimer" type="button" type="submit" class="btn btn-outline-danger float-right btn-sm" onclick="return confirm('Confirmez-vous la suppression de cette version ?');location.href = '{!! url('version/destroy', $version->id); !!}';">
                    <i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp;Supprimer
                  </button>
                </li>

              </ul>

          </div>

      </div>
  </div>

  <!-- Affichage du message d'information (SUCCESS, etc.) -->
  <div class="container-fluid">
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
  <div class="container-fluid">
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

                <div class="col-lg-3 form-group">
                  <label>Etat :</label>
                  <div class="label-content">{{ $version->versionetat->libelle }}</div>
                </div>

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

    </div>
  </div> <!-- Fin de l'affichage du contenu de la page -->





					<!-- Panel "Scoring QoS" -->
					<div class="panel panel-default">
						<!-- Titre du panel -->
					  	<div class="panel-heading">
					    	<h3 class="panel-title">Scoring QOS</h3>
					  	</div>

					  	<!-- Contenu du panel -->
					  	<div class="panel-body">
					    	<div class="col-lg-12">
								<div class="row section-default-page">

				                    <div class="col-lg-3 label-div">
				                        <div class="label-title"><p>Enjeux métiers :</p></div>
				                        @if( $version->enjeuxmetier == 1 )
			                                <span class="label-content">Faible</span></p>
			                            @elseif( $version->enjeuxmetier == 2 )
			                                <span class="label-content">Moyen</span></p>
			                            @else
			                                <span class="label-content">Fort</span></p>
			                            @endif
				                    </div>

				                    <div class="col-lg-3 label-div">
				                        <div class="label-title"><p>Enjeux SI :</p></div>
				                        @if( $version->enjeuxsi == 1 )
			                                <span class="label-content">Faible</span></p>
			                            @elseif( $version->enjeuxsi == 2 )
			                                <span class="label-content">Moyen</span></p>
			                            @else
			                                <span class="label-content">Fort</span></p>
			                            @endif
				                    </div>

				                    <div class="col-lg-3 label-div">
				                        <div class="label-title"><p>QOS :</p></div>
			                           	@if( $version->qos == 1 )
			                                <span class="label label-success">{{ $version->qos }}</span></p>
			                            @elseif( $version->qos == 9 )
			                                <span class="label label-danger">{{ $version->qos }}</span></p>
			                            @else
			                                <span class="label label-warning">{{ $version->qos }}</span></p>
			                            @endif
				                    </div>
				                </div>
					    	</div>
					    </div>
					</div>

					<!-- Panel "Suivi des développements" -->
					<div class="panel panel-default">
						<!-- Titre du panel -->
					  	<div class="panel-heading">
					    	<h3 class="panel-title">Suivi des livraisons</h3>
					  	</div>

					  	<!-- Contenu du panel -->
					  	<div class="panel-body">
					    	<div class="col-lg-12">
								<div class="row section-default-page">

									<div class="col-lg-3 label-div">
										<div class="label-title"><p>Nombre livraison TMA/DID :</p></div>
										<span class="label-content">{{ $version->inc_nblivtma }}</span></p>
									</div>

				                </div>
					    	</div>
					    </div>
					</div>

					<!-- Panel "Suivi de la qualification/intégration" -->
					<div class="panel panel-default">
						<!-- Titre du panel -->
					  	<div class="panel-heading">
					    	<h3 class="panel-title">Suivi de la qualification/intégration</h3>
					  	</div>

					  	<!-- Contenu du panel -->
					  	<div class="panel-body">
					    	<div class="col-lg-12">
								<div class="row section-default-page">

									<div class="col-lg-3 label-div">
										<div class="label-title"><p>Périmètre DQI :</p></div>
											@if ($version->perimetreqi)
												<span class="label-content">Oui</span>
											@else
												<span class="label-content">Non</span>
											@endif
									</div>

									<div class="col-lg-3 label-div">
										<div class="label-title"><p>Référent qualification :</p></div>
										<span class="label-content">{!! $version->referentqi->nom !!}&nbsp;{!! $version->referentqi->prenom !!}</span></p>
									</div>

									<!-- "Indicateur Avancement QI" -->
				                    <div class="col-lg-3 label-div">
				                        <div class="label-title"><p>Avancement QI :</p></div>
										<span class="label-content">
											@if ($version->avancementqi >0 )
												{!! $version->avancementqi !!}&nbsp;%
											@else
												0 %
											@endif
										</span>
				                    </div>

								</div>
								<div class="row section-default-page">

									<div class="col-lg-6 label-div">
										<div class="label-title"><p>Alertes et vigilances :</p></div>
										<span class="label-content">
										@if (!empty($version->alerteqi))
											{!! $version->alerteqi !!}
										@else
											Pas d'alertes et vigilances QI
										@endif
										</span>
									</div>

								</div>
					    	</div>
					    </div>
					</div>

					<!-- Panel "Suivi de la production" -->
					<div class="panel panel-default">
						<!-- Titre du panel -->
					  	<div class="panel-heading">
					    	<h3 class="panel-title">Suivi de la production</h3>
					  	</div>

					  	<!-- Contenu du panel -->
					  	<div class="panel-body">
					    	<div class="col-lg-12">
								<div class="row section-default-page">

									<!-- Référent de production -->
									<div class="col-lg-3 label-div">
										<div class="label-title"><p>Référent production :</p></div>
										<span class="label-content">{!! $version->referentprd->nom !!}&nbsp;{!! $version->referentprd->prenom !!}</p></span>
									</div>

									<!-- Nombre de reports de production -->
									<div class="col-lg-3 label-div">
										<div class="label-title"><p>Nombre report(s) production :</p></div>
										<span class="label-content">
											@if($version->prd_nbreports == 0)
												Aucun report
											@elseif($version->prd_nbreports == 1)
												{!! $version->prd_nbreports !!} report
											@else
												{!! $version->prd_nbreports !!} reports
											@endif
										</span>
									</div>

                  <!-- Version Dimensions livrée -->
									<div class="col-lg-3 label-div">
										<div class="label-title"><p>Version Dimensions livrée :</p></div>
										<span class="label-content">
											@if($version->prd_versiondimensions == '')
												Non renseignée
											@else
												{!! $version->prd_versiondimensions !!}
											@endif
										</span>
									</div>

                </div>
								<div class="row section-default-page">

									<!-- Estimation de la charge de pré-production -->
									<div class="col-lg-3 label-div">
										<div class="label-title"><p>Estimation charge de pré-production :</p></div>
										<span class="label-content">
											@if($version->prp_estimationcharge == '')
												Non renseignée
											@else
												{!! $version->prp_estimationcharge !!}&nbsp;j/h
											@endif
										</span>
									</div>

									<!-- Estimation de la charge de production -->
									<div class="col-lg-3 label-div">
										<div class="label-title"><p>Estimation charge de production :</p></div>
										<span class="label-content">
											@if($version->prd_estimationcharge == '')
												Non renseignée
											@else
												{!! $version->prd_estimationcharge !!}&nbsp;j/h
											@endif
										</span>
									</div>

								</div>
								<div class="row section-default-page">

									<div class="col-lg-6 label-div">
										<div class="label-title"><p>Alertes et vigilances :</p></div>
											<span class="label-content">
											@if (!empty($version->alerteprd))
												{!! $version->alerteprd !!}
											@else
												Pas d'alertes et vigilances production
											@endif
											</span>
										</p>
									</div>

								</div>
					    	</div>
					    </div>
					</div>

					<!-- Panel "Commentaires" -->
					<div class="panel panel-default">
						<!-- Titre du panel -->
					  	<div class="panel-heading">
					    	<h3 class="panel-title">Commentaires</h3>
					  	</div>

					  	<!-- Contenu du panel -->
					  	<div class="panel-body">
					    	<div class="col-lg-12">
								<div class="row section-default-page">

									<div class="col-lg-12 label-div">
										<div class="label-title"><p>Commentaires :</p></div>
											<span class="label-content">
											@if (!empty($version->commentaire))
												{!! nl2br($version->commentaire) !!}
											@else
												Pas de commentaire(s)
											@endif
											</span>
										</p>
									</div>

								</div>
					    	</div>
					    </div>
					</div>

		        </div>
			</div>
		</div>

@endsection
