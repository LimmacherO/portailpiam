@extends('layouts.app')

@section('link-roadmap-active')
    class="active"
@endsection

@section('content')

	{!! Form::model($tache, ['route' => ['tache.update', $tache->id], 'method' => 'put']) !!}

    <!-- En-tête - sous forme de Navbar fixe en haut de la page -->
    <nav class="navbar navbar-default navbar-fixed-top section-header">
        <div class="container-fluid">
            <div class="row container-noborder">
                
                <div class="col-lg-12">
                    <h1>Modification de la tâche "{{ $tache->label }}"</h1>
                </div>

                <div class="col-lg-12 container-noborder">
                    <div class="row container-fluid tab_line tab_line-btn">

                        <div class="btn-action-right">{!! Form::button('<i class="fa fa-check" aria-hidden="true"></i>&nbsp;Valider', ['class' => 'btn btn-default btn-success pull-right', 'type' => 'submit']) !!}</div>

						<div class="btn-action-right"><a href="{!! url('taches', $tache->version_id); !!}" type="button" class="btn btn-default btn-cancel pull-right"><i class="fa fa-undo" aria-hidden="true"></i>&nbsp;Annuler</a></div>

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
			    <div class="container-fluid tab-content clearfix">
					
			        <!-- Section "Jalons/planning -->
			        <div class="row tab-pane active">

			        	
			        	<div class="col-lg-12">
			                <div class="row section-default-page">
			                	                        
			                    <h2 class="section-default-page-titre">Description</h2>
			                    <div class="section-default-page-border"></div>
			                    <div class="section-default-page-space">&nbsp;</div>

							</div>
						</div>

						<div class="col-lg-12">
							<div class="row section-default-page">
				            	<div class="col-lg-3 form-group {!! $errors->has('tachetype_id') ? 'has-error' : '' !!}">
					                <div class="label-title"><p>Type :</p></div>
					                @if( $tache->deletable === true )
						                {!! Form::select('tachetype_id', 
						                $tachetypes, 
						                null, 
						                ['class' => 'form-control', 'id' => 'tachetype_id']) !!}
						                {!! $errors->first('tachetype_id', '<small class="help-block">:message</small>') !!}
					                @else
						                {!! Form::select('tachetype_id', 
						                $tachetypes, 
						                null, 
						                ['class' => 'form-control', 'id' => 'tachetype_id', 'disabled' => true]) !!}
					                @endif

					            </div>


								<div class="col-lg-3 form-group {!! $errors->has('label') ? 'has-error' : '' !!}">
									<div class="label-title"><p>Libellé :</p></div>
									@if( $tache->deletable === true )
				                		{!! Form::text('label', null, ['class' => 'form-control', 'placeholder' => 'Libellé']) !!}
				                		{!! $errors->first('label', '<small class="help-block">:message</small>') !!}
				                	@else
				                		{!! Form::text('label', null, ['class' => 'form-control', 'placeholder' => 'Libellé', 'readonly' => 'true']) !!}
				                	@endif
				            	</div>
				            </div>
				        </div>

			 			<div class="col-lg-12">
			                <div class="row section-default-page">
			                		<div class="section-default-page-space">&nbsp;</div>
			                        <h2 class="section-default-page-titre">Dates de début et fin</h2>
			                        <div class="section-default-page-border"></div>
			                        <div class="section-default-page-space">&nbsp;</div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="row section-default-page">

				                <div class="col-lg-3 form-group {!! $errors->has('start') ? 'has-error' : '' !!}">
				                	<div class="label-title"><p>Date de début :</p></div>
				                	{!! Form::date('start', null,  ['class' => 'form-control', 'id' => 'start'] ); !!}
				                	{!! $errors->first('start', '<small class="help-block">:message</small>') !!}
				            	</div>

				            	<div class="col-lg-3 form-group {!! $errors->has('end') ? 'has-error' : '' !!}">
				            		<div class="label-title"><p>Date de fin :</p></div>
				                	{!! Form::date('end', null,  ['class' => 'form-control', 'id' => 'end'] ); !!}
				                	{!! $errors->first('end', '<small class="help-block">:message</small>') !!}
				            	</div>


								<div class="col-lg-4 form-group {!! $errors->has('version_id') ? 'has-error' : '' !!}">
				                	{!! Form::hidden('version_id', $tache->version_id, ['class' => 'form-control', 'placeholder' => 'ID de la version']) !!}
				                	{!! $errors->first('version_id', '<small class="help-block">:message</small>') !!}
				            	</div>
						    </div>
						</div>
					</div>
				
				</div>
			</div>
		</div>
	</div>

	{!! Form::close() !!}

@endsection