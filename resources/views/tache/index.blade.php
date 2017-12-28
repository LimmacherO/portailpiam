@extends('layouts.app')

@section('link-roadmap-active')
    class="active"
@endsection

@section('content')

	<!-- En-tête page Web -->
    <div id="header" class="section-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Titre de la page Web -->
                    <h1>Planning chantier "{{ $version->libelle }}"</h1>
                </div>

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
      			  				<li role="presentation">
      			  					  <a href="{!! url('version',$version->id); !!}" aria-controls="home" role="tab"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;Synthèse Version</a>
      			  				</li>
      			  				<li role="presentation" class="active">
      			  					<a href="{!! url('taches', $version->id); !!}" aria-controls="home" role="tab"><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp;Planning</a>
      			  				</li>
      						</ul>
      				    </div>

        					<div class="pull-right">
                      <a href="{!! url('tache/create', $version->id); !!}" type="button" class="btn btn-default btn-primary pull-right"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Tâche</a>
                      <a href="{!! url('jalon/create', $version->id); !!}" type="button" class="btn btn-default btn-primary btn-margin-right pull-right"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Jalon</a>
        					</div>

                </div>

            </div>
        </div>
    </div>


    <!-- Contenu de la page Web -->
    <div id="content">
        <!-- Afichage du contenu de la page -->
        <div class="container-fluid section-content">

	        <!-- Panel "Planning" -->
	        <div class="row">

				<div class="panel panel-default">

				  	<!-- Contenu du panel -->
				  	<div class="panel-body">
				    	<div class="col-lg-12">

			    			<div class="row section-default-page">
					        	<div class="portail-table panel panel-primary">
						            <table class="table">
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
                  												    {{ \Carbon\Carbon::parse($tache->debut)->format('d/m/Y') }}
                  											    @endif
                                        </td>

						                            <td>
                                           @if($tache->jalon == '1')
                                             &nbsp;
                                           @elseif($tache->fin == '')
                                             Non renseignée
                                           @else
                                             {{ \Carbon\Carbon::parse($tache->fin)->format('d/m/Y')}}</td>
                                           @endif
						                            <td>
                                          @if($tache->jalon == '1')
                                            <a href="{!! url('jalon/edit', $tache->id); !!}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                          @else
                                            <a href="{!! url('tache/edit', $tache->id); !!}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                          @endif

						                            </td>

						                            <td>
						                            	@if( $tache->deletable === true )
              															<a href="{!! url('tache/delete', $tache->id); !!}"><i class="fa fa-trash-o" aria-hidden="true" onclick="return confirm('Confirmez-vous la suppression de jalon/tâche ?')"></i></a>
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
