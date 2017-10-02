@extends('layouts.app')

@section('link-roadmap-active')
    class="active"
@endsection

@section('page-header-title')
    Ajouter une nouvelle tâche/jalon
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
	        <li id="selected"><a href="#"><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp;Ajout d'une tâche</a></li>
	    </ul>
    </div>

@endsection

@section('content')

	<!-- Contenu de la page -->
    <div class="container-fluid tab-content clearfix">
		{!! Form::open(['url' => 'tache/store', 'method' => 'post']) !!}
        <!-- Section "Jalons/planning -->
        <div class="row tab-pane active">
        	<div class="col-lg-12">
                <div class="row section-default-page">
                	
                	<div class="btn-action-right">{!! Form::button('<i class="fa fa-check" aria-hidden="true"></i>&nbsp;Valider', ['class' => 'btn btn-default btn-success pull-right', 'type' => 'submit']) !!}</div>

                	<div class="btn-action-right"><a href="{!! url('taches', $version->id); !!}" type="button" class="btn btn-default btn-cancel pull-right"><i class="fa fa-undo" aria-hidden="true"></i>&nbsp;Annuler</a></div>
                    
                    <h2 class="section-default-page-titre">Description</h2>
                    <div class="section-default-page-border"></div>
                    <div class="section-default-page-space">&nbsp;</div>

				</div>
			</div>
			<div class="col-lg-12">
				<div class="row section-default-page">	
	            	<div class="col-lg-4 form-group {!! $errors->has('tachetype_id') ? 'has-error' : '' !!}">
		                <div class="label-title"><p>Type :</p></div>
		                {!! Form::select('tachetype_id', 
		                $tachetypes, 
		                null, 
		                ['class' => 'form-control', 'id' => 'tachetype_id']) !!}
		                {!! $errors->first('tachetype_id', '<small class="help-block">:message</small>') !!}
		            </div>

					<div class="col-lg-8 form-group {!! $errors->has('label') ? 'has-error' : '' !!}">
						<div class="label-title"><p>Libellé :</p></div>
	                	{!! Form::text('label', null, ['class' => 'form-control', 'placeholder' => 'Libellé']) !!}
	                	{!! $errors->first('label', '<small class="help-block">:message</small>') !!}
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

	                <div class="col-lg-4 form-group {!! $errors->has('start') ? 'has-error' : '' !!}">
	                	<div class="label-title"><p>Date de début :</p></div>
	                	{!! Form::date('start', \Carbon\Carbon::now(),  ['class' => 'form-control', 'id' => 'start'] ); !!}
	                	{!! $errors->first('start', '<small class="help-block">:message</small>') !!}
	            	</div>

	            	<div class="col-lg-4 form-group {!! $errors->has('end') ? 'has-error' : '' !!}">
	                	<div class="label-title"><p>Date de fin :</p></div>
	                	{!! Form::date('end', \Carbon\Carbon::now(),  ['class' => 'form-control', 'id' => 'end'] ); !!}
	                	{!! $errors->first('end', '<small class="help-block">:message</small>') !!}
	            	</div>


					<div class="col-lg-4 form-group {!! $errors->has('version_id') ? 'has-error' : '' !!}">
	                	{!! Form::hidden('version_id', $version->id, ['class' => 'form-control', 'placeholder' => 'ID de la version']) !!}
	                	{!! $errors->first('version_id', '<small class="help-block">:message</small>') !!}
	            	</div>

	            	<div class="section-default-page-space">&nbsp;</div>

			    </div>
			</div>
		</div>
	{!! Form::close() !!}
	</div>		

@endsection