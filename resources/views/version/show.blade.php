@extends('layouts.app')

@section('link-roadmap-active')
    class="active"
@endsection

@section('page-header-title')
    {{ $version->application->libelle }}&nbsp;{{ $version->version }}
@endsection

@section('alerte')

	@if(session()->has('ok'))
		<div class="alert alert-success alert-dismissible">
		   	{!! session('ok') !!}
		</div>
    @endif

@endsection

@section('tabs')

	<div class="tabs">
	    <ul>
	        <li id="selected"><a href="{!! url('version',$version->id); !!}"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;Synthèse Version</a></li>
	        <li><a href="{!! url('taches', $version->id); !!}"><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp;Planning</a></li>
	    </ul>

	</div>

@endsection

@section('content')

		<!-- Détail des onglets -->
		<div class="container-fluid tab-content clearfix">

			<!-- Onglet "Identication" -->
			<div class="row tab-pane active">
		        <div class="col-lg-12">
					<div class="row section-default-page">
								
						<div class="btn-action-right"><a href="{!! url('version/edit', $version->id); !!}" type="button" class="btn btn-default btn-primary pull-right"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;Modifier</a></div>

						<div class="btn-action-right"><a href="{!! url('version/destroy', $version->id); !!}" type="button" class="btn btn-default btn-danger pull-right"><i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp;Supprimer</a></div>

						<h2 class="section-default-page-titre">Identification de la version</h2>
						<div class="section-default-page-border"></div>
						<div class="section-default-page-space">&nbsp;</div>
								

								<!-- Libellé du chantier -->
								<div class="col-lg-12">
									<div class="label-title"><p>Libellé :</p></div>
									<span class="label-content">{{ $version->libelle }}</span></p>
								</div>

								<div class="col-lg-4">
									<div class="label-title"><p>Domaine :</p></div>
									<span class="label-content">{{ $version->application->domaine->libelle }}</span></p>
								</div>

								<div class="col-lg-4">
									<div class="label-title"><p>Application :</p></div>
									<span class="label-content">{{ $version->application->libelle }}</span></p>
								</div>

								<div class="col-lg-4">
									<div class="label-title"><p>Version :</p></div>
									<span class="label-content">{{ $version->version }}</span></p>
								</div>

								<div class="col-lg-4">
									<div class="label-title"><p>Référence ALFA :</p></div>
									<span class="label-content">{{ $version->referencealfa }}</span></p>
								</div>

								<div class="col-lg-4">
									<p>&nbsp;</p>
								</div>

								<div class="col-lg-4">
									<p>&nbsp;</p>
								</div>



								<div class="section-default-page-space">&nbsp;</div>

								<h2 class="section-default-page-titre">Indicateurs</h2>
								<div class="section-default-page-border"></div>
								<div class="section-default-page-space">&nbsp;</div>

									<div class="col-lg-4">
										<div class="label-title"><p>Nombre livraison TMA/DID :</p></div>
										<span class="label-content">{{ $version->inc_nblivtma }}</span></p>
									</div>

									<div class="col-lg-4">
										<p>&nbsp;</p>
									</div>

									<div class="col-lg-4">
										<p>&nbsp;</p>
									</div>


								<div class="section-default-page-space">&nbsp;</div>
								<div class="section-default-page-space">&nbsp;</div>


								<h2 class="section-default-page-titre">Suivi de la qualification/intégration</h2>
								<div class="section-default-page-border"></div>
								<div class="section-default-page-space">&nbsp;</div>

								<div class="col-lg-4">
									<div class="label-title"><p>Référent qualification :</p></div>
									<span class="label-content">{!! $version->referentqi->nom !!}&nbsp;{!! $version->referentqi->prenom !!}</span></p>
								</div>

								<div class="col-lg-8">
									<div class="label-title"><p>Alertes et vigilances :</p></div>
									<span class="label-content">
									@if (!empty($version->alerteqi)) 
										{!! $version->alerteqi !!}
									@else
										Pas d'alertes et vigilances QI
									@endif
									</span>
								</div>

								<div class="section-default-page-space">&nbsp;</div>
								<div class="section-default-page-space">&nbsp;</div>

								<h2 class="section-default-page-titre">Suivi de la production</h2>
								<div class="section-default-page-border"></div>
								<div class="section-default-page-space">&nbsp;</div>

								<div class="col-lg-4">
									<div class="label-title"><p>Référent production :</p></div>
									<span class="label-content">{!! $version->referentprd->nom !!}&nbsp;{!! $version->referentprd->prenom !!}</p></span>
								</div>

								<div class="col-lg-8">
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

								<div class="section-default-page-space">&nbsp;</div>
								<div class="section-default-page-space">&nbsp;</div>


								<h2 class="section-default-page-titre">Commentaires</h2>
								<div class="section-default-page-border"></div>
								<div class="section-default-page-space">&nbsp;</div>

								<div class="col-lg-12">
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



								<div class="section-default-page-space">&nbsp;</div>
								<div class="section-default-page-space">&nbsp;</div>

								<h2 class="section-default-page-titre">Suivi des modifications</h2>
								<div class="section-default-page-border"></div>
								<div class="section-default-page-space">&nbsp;</div>
								
								<div class="col-lg-6">
									<div class="label-title"><p>Date de création :</p></div>
									<span class="label-content">{{ date('d/m/Y - H:i:s', strtotime($version->created_at)) }}</p></span>
								</div>

								<div class="col-lg-6">
									<div class="label-title"><p>Date de dernière modification :</p></div>
									<span class="label-content">{{ date('d/m/Y - H:i:s', strtotime($version->updated_at)) }}</p></span>
								</div>

								<div class="section-default-page-space">&nbsp;</div>

							</div>

						</div>
					</div>
		</div>
</div>


@endsection
