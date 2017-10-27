@extends('layouts.app')

@section('link-roadmap-active')
    class="active"
@endsection

@section('content')

    <!-- En-tête - sous forme de Navbar fixe en haut de la page -->
    <nav class="navbar navbar-default navbar-fixed-top section-header">
        <div class="container-fluid">
            <div class="row container-noborder">
                
                <div class="col-lg-12">
                    <h1>{{ $version->application->libelle }}&nbsp;{{ $version->version }}</h1>
                </div>

                <div class="col-lg-6 container-noborder">
                    <div class="row container-fluid tab_line">
                    	<div>
						    <ul class="nav nav-tabs" role="tablist">

						    	<!-- Lien vers la synthèse de la version -->
						        <li class="active"><a href="{!! url('version',$version->id); !!}" aria-controls="home" role="tab"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;Synthèse Version</a></li>

						        <!-- Lien vers le planning -->
						        <li><a href="{!! url('taches', $version->id); !!}" aria-controls="home" role="tab"><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp;Planning</a></li>

						    </ul>
						</div>
                    </div>
                </div>

                <div class="col-lg-6 container-noborder">
                    <div class="row container-fluid tab_line tab_line-btn">

                        <div class="btn-action-right"><a href="{!! url('version/edit', $version->id); !!}" type="button" class="btn btn-default btn-primary pull-right"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;Modifier</a></div>

						<div class="btn-action-right"><a href="{!! url('version/destroy', $version->id); !!}" type="button" class="btn btn-default btn-danger pull-right" onclick="return confirm('Confirmez-vous la suppression de cette version ?')" /><i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp;Supprimer</a></div>

                    </div>
                </div>

            </div>
        </div>
    </nav>

<!-- Afichage du contenu de la page -->
    <div class="container-fluid section-content">
        <div class="row">

            <div class="col-lg-12">
                @if(session()->has('ok'))
                    <div class="alert alert-success alert-dismissible">
                        {!! session('ok') !!}
                    </div>
                @endif
            </div>

            <div class="col-sm-12 col-lg-12">
                <!-- Contenu de la page -->

					<!-- Détail des onglets -->
					<div class="container-fluid tab-content clearfix">

						<!-- Onglet "Identication" -->
						<div class="row tab-pane active">
					        <div class="col-lg-12">
								<div class="row section-default-page">
											
									<h2 class="section-default-page-titre">Identification de la version</h2>
									<div class="section-default-page-border"></div>
									<div class="section-default-page-space">&nbsp;</div>
								</div>
								<div class="row section-default-page">

									<!-- Libellé du chantier -->
									<div class="col-lg-6 label-div">
										<div class="label-title"><p>Libellé :</p></div>
										<span class="label-content">{{ $version->libelle }}</span>
									</div>

								</div>
								<div class="row section-default-page">

									<div class="col-lg-3 label-div">
										<div class="label-title"><p>Domaine :</p></div>
										<span class="label-content">{{ $version->application->domaine->libelle }}</span>
									</div>

									<div class="col-lg-3 label-div">
										<div class="label-title"><p>Application :</p></div>
										<span class="label-content">{{ $version->application->libelle }}</span>
									</div>

								</div>
								<div class="row section-default-page">

									<div class="col-lg-3 label-div">
										<div class="label-title"><p>Version MOE :</p></div>
										<span class="label-content">{{ $version->version }}</span>
									</div>

									<div class="col-lg-3 label-div">
										<div class="label-title"><p>Version Dimensions :</p></div>
										<span class="label-content">{{ $version->version_dimensions }}</span>
									</div>

									<div class="col-lg-3 label-div">
										<div class="label-title"><p>Product Dimensions :</p></div>
										<span class="label-content">{{ $version->product_dimensions }}</span>
									</div>

								</div>
								<div class="row section-default-page">


									<div class="col-lg-3 label-div">
										<div class="label-title"><p>Référence ALFA :</p></div>
										<span class="label-content">
											@if($version->referencealfa == '')
												Non renseignée
											@else
												{{ $version->referencealfa }}
											@endif
										</span>
									</div>

									<div class="col-lg-3 label-div">
										<div class="label-title"><p>Date création ALFA :</p></div>
										<span class="label-content">
											@if($version->referencealfa_date == '')
												Non renseignée
											@else
												{{ \Carbon\Carbon::parse($version->referencealfa_date)->format('d/m/Y')}}
											@endif
										</span>
									</div>

			                	</div>

				                <div class="row section-default-page">

				                    <div class="section-default-page-space">&nbsp;</div>
				                    <h2 class="section-default-page-titre">Scoring QOS</h2>
				                    <div class="section-default-page-border"></div>
				                    <div class="section-default-page-space">&nbsp;</div>

				                </div>
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

			                	<div class="row section-default-page">

									<div class="section-default-page-space">&nbsp;</div>
									<h2 class="section-default-page-titre">Suivi des développements</h2>
									<div class="section-default-page-border"></div>
									<div class="section-default-page-space">&nbsp;</div>

								</div>
								<div class="row section-default-page">

									<div class="col-lg-3 label-div">
										<div class="label-title"><p>Nombre livraison TMA/DID :</p></div>
										<span class="label-content">{{ $version->inc_nblivtma }}</span></p>
									</div>

				                </div>

				                <div class="row section-default-page">

									<div class="section-default-page-space">&nbsp;</div>
									<h2 class="section-default-page-titre">Suivi de la qualification/intégration</h2>
									<div class="section-default-page-border"></div>
									<div class="section-default-page-space">&nbsp;</div>

								</div>
								<div class="row section-default-page">

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
				                <div class="row section-default-page">

									<div class="section-default-page-space">&nbsp;</div>
									<h2 class="section-default-page-titre">Suivi de la production</h2>
									<div class="section-default-page-border"></div>
									<div class="section-default-page-space">&nbsp;</div>

								</div>
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
				                <div class="row section-default-page">

									<div class="section-default-page-space">&nbsp;</div>
									<h2 class="section-default-page-titre">Commentaires</h2>
									<div class="section-default-page-border"></div>
									<div class="section-default-page-space">&nbsp;</div>

								</div>
								<div class="row section-default-page">

									<div class="col-lg-12 label-div">
										<div class="label-title"><p>Commentaires :</p></div>
											<span class="label-content">
											@if (!empty($version->commentaire)) 
												{!! $version->commentaire !!}
											@else
												Pas de commentaire(s)
											@endif
											</span>
										</p>
									</div>

								</div>
				                <div class="row section-default-page">

									<div class="section-default-page-space">&nbsp;</div>
									<h2 class="section-default-page-titre">Suivi des modifications</h2>
									<div class="section-default-page-border"></div>
									<div class="section-default-page-space">&nbsp;</div>
								
								</div>
								<div class="row section-default-page">

									<div class="col-lg-4 label-div">
										<div class="label-title"><p>Date de création du chantier :</p></div>
										<span class="label-content">{{ date('d/m/Y - H:i:s', strtotime($version->created_at)) }}</p></span>
									</div>

									<div class="col-lg-4 label-div">
										<div class="label-title"><p>Date de dernière modification du chantier :</p></div>
										<span class="label-content">{{ date('d/m/Y - H:i:s', strtotime($version->updated_at)) }}</p></span>
									</div>

									<div class="section-default-page-space">&nbsp;</div>

								</div>

							</div>
						</div>
					</div>
			</div>
        </div>
    </div>

@endsection
