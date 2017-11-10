@extends('layouts.app')

@section('link-roadmap-active')
    class="active"
@endsection

@section('header-title')
	Chantier "{{ $version->libelle }}"
@endsection

@section('header-controls')
	
	<!-- Message d'information -->
	<div class="col-lg-12">
		@if(session()->has('ok'))
	        <div class="alert alert-success">
	            {!! session('ok') !!}
	        </div>
    	@endif
    </div>

    <!-- Contrôles -->
    <div class="col-lg-12">

	    <div class="pull-left">
	    	<ul class="nav nav-tabs list-inline">
  				<li role="presentation" class="active">
  					<a href="{!! url('version',$version->id); !!}" aria-controls="home"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;Synthèse Version</a>
  				</li>
  				<li role="presentation">
  					<a href="{!! url('taches', $version->id); !!}" aria-controls="home"><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp;Planning</a>
  				</li>
			</ul>	
	    </div>

	    <div class="pull-right">
	    	<a href="{!! url('version/edit', $version->id); !!}" type="button" class="btn btn-default btn-primary pull-right"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;Modifier</a>
	    	<a href="{!! url('version/destroy', $version->id); !!}" type="button" class="btn btn-default btn-danger pull-right" onclick="return confirm('Confirmez-vous la suppression de cette version ?')" /><i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp;Supprimer</a>
	    </div>

	</div>

@endsection

@section('content')

        <!-- Panel "Identification de la version" -->
        <div class="row">

			<div class="panel panel-default">
				<!-- Titre du panel -->
			  	<div class="panel-heading">
			    	<h3 class="panel-title">Identification de la version</h3>
			  	</div>

			  	<!-- Contenu du panel -->
			  	<div class="panel-body">
			    	<div class="col-lg-12">
						<div class="row section-default-page">

							<div class="col-lg-3 label-div">
								<div class="label-title"><p>Domaine :</p></div>
								<span class="label-content">{{ $version->application->domaine->libelle }}</span>
							</div>

							<div class="col-lg-3 label-div">
								<div class="label-title"><p>Application :</p></div>
								<span class="label-content">{{ $version->application->libelle }}</span>
							</div>

							<!-- Libellé du chantier -->
							<div class="col-lg-6 label-div">
								<div class="label-title"><p>Libellé :</p></div>
								<span class="label-content">{{ $version->libelle }}</span>
							</div>

						</div>
						<div class="row section-default-page">

							<div class="col-lg-3 label-div">
								<div class="label-title"><p>Product Dimensions :</p></div>
								<span class="label-content">{{ $version->product_dimensions }}</span>
							</div>

							<div class="col-lg-3 label-div">
								<div class="label-title"><p>Version MOE :</p></div>
								<span class="label-content">{{ $version->version }}</span>
							</div>

							<div class="col-lg-3 label-div">
								<div class="label-title"><p>Version Dimensions :</p></div>
								<span class="label-content">{{ $version->version_dimensions }}</span>
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
			        </div>
			  	</div>
			</div>

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
			    	<h3 class="panel-title">Suivi des développements</h3>
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
										{!! $version->commentaire !!}
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

@endsection
