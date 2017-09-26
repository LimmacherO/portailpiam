@extends('layouts.app')

@section('link-roadmap-active')
    class="active"
@endsection

@section('page-header-title')
    {{ $version->application->libelle }}&nbsp;{{ $version->version }}
@endsection

@section('content')
	
	@if(session()->has('ok'))
	<div class="container-fluid tab-line-background">
		<div class="row">
			<div class="container">
				<div class="row">
		    		<div class="alert alert-success alert-dismissible">{!! session('ok') !!}</div>
		    	</div>
		    </div>
		</div>
	</div>
    @endif

    <!-- Onglets pour faciliter et catégoriser la présentation -->
	<div class="tab_line">

		<!-- Onglets -->
		<!-- Container fluid pour le fond -->
		<div class="container-fluid tab-line-background">
			<div class="row">
				<!-- Container standar pour les onglets -->
				<div class="container">
					<div class="row">

						<div class="tabs">
						    <ul>
						        <li><a href="{!! url('version', $version->id); !!}"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;Synthèse Version</a></li>
						        
						        <li id="selected"><a href="{!! url('taches', $version->id); !!}"><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp;Planning</a></li>
						    </ul>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Contenu de la page -->
    <div class="tabbable-panel">

        <div class="container tab-content clearfix">

        	<!-- Section "Jalons/planning -->
            <div class="row tab-pane active">
            	<div class="col-lg-12">
                    <div class="row section-default-page">
                    	<div class="btn-action-right"><a href="{!! url('tache/create', $version->id); !!}" type="button" class="btn btn-default btn-primary pull-right"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Ajouter</a></div>
                        <h2 class="section-default-page-titre">Jalons/planning</h2>
                        <div class="section-default-page-border"></div>
                        <div class="section-default-page-space">&nbsp;</div>
    				</div>
    			</div>		
		    	<div class="col-lg-12">

			        <div class="row section-default-page">
			        	<div class="portail-table panel panel-primary">
			            <table class="table">
			                <thead>
			                    <tr class="portail-table-header">
			                        <th>&nbsp;</th>
			                        <th>Type</th>
			                        <th>Tâche</th>
			                        <th>Début</th>
			                        <th>Fin</th>
			                        <th>&nbsp;</th>
			                        <th>&nbsp;</th>
			                    </tr>
			                </thead>
			                <tbody>
			                    @foreach ($taches as $tache)
			                        <tr>
			                            <td>
											@if ($tache->tachetype->id === 1)
											    <!-- C'est un jalon -->
											    <a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i></a>
											@else
											    <!-- C'est une tâche -->
											    <a href="#"><i class="fa fa-tasks" aria-hidden="true"></i></a>
											    
											@endif
			                            </td>
			                            <td>{!! $tache->tachetype->libelle !!}</td>

			                            <td>{!! $tache->label !!}</td>

			                            <td>{{ \Carbon\Carbon::parse($tache->start)->format('d/m/Y')}}</td>

			                            <td>{{ \Carbon\Carbon::parse($tache->end)->format('d/m/Y')}}</td>

			                            <td>
			                            	<a href="{!! url('tache/edit', $tache->id); !!}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
			                            </td>

			                            <td>
											<a href="{!! url('tache/delete', $tache->id); !!}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
			                            </td>
			                            
			                        </tr>
			                    @endforeach
			                </tbody>
			            </table>
			        </div>
			        </div>
		        </div>
		    </div>

		</div>
	</div>

@endsection
