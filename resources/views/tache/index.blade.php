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
					            <li><a href="{!! url('version',$version->id); !!}" aria-controls="home" role="tab"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;Synthèse Version</a></li>

					            <!-- Lien vers le planning -->
					            <li class="active"><a href="{!! url('taches', $version->id); !!}" aria-controls="home" role="tab"><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp;Planning</a></li>

					        </ul>
						</div>
                    </div>
                </div>

                <div class="col-lg-6 container-noborder">
                    <div class="row container-fluid tab_line tab_line-btn">

                        <div class="btn-action-right"><a href="{!! url('tache/create', $version->id); !!}" type="button" class="btn btn-default btn-primary pull-right"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Ajouter</a></div>

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

			    <div class="container-fluid tab-content clearfix">

			    	<!-- Section "Jalons/planning -->
			        <div class="row tab-pane active">

				    	<div class="col-lg-12">

					        <div class="row section-default-page">
					        	<div class="portail-table panel panel-primary">
					            <table class="table table-striped table-hover">
					                <thead>
					                    <tr class="portail-table-header">
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
					                        	
					                            <td>{!! $tache->tachetype->libelle !!}</td>

					                            <td>{!! $tache->label !!}</td>

					                            <td>{{ \Carbon\Carbon::parse($tache->start)->format('d/m/Y')}}</td>

					                            <td>{{ \Carbon\Carbon::parse($tache->end)->format('d/m/Y')}}</td>

					                            <td>
					                            	<a href="{!! url('tache/edit', $tache->id); !!}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
					                            </td>

					                            <td>
					                            	@if( $tache->deletable === true )
														<a href="{!! url('tache/delete', $tache->id); !!}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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
				    </div>

				</div>
			</div>
		</div>
	</div>

@endsection
