@extends('layouts.app')

@section('link-roadmap-active')
    class="active"
@endsection

@section('page-header-title')
    Modification de la tâche "{{ $tache->label }}"
@endsection

@section('page-header-controls')



@endsection

@section('alerte')

	@if(session()->has('ok'))
		<div class="alert alert-success alert-dismissible">
		   	{!! session('ok') !!}
		</div>
    @endif

@endsection

@section('tabs')

    <div>
        <ul class="nav nav-tabs" role="tablist">
            <li class="active"><a href="#" aria-controls="home" role="tab"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Modification d'une tâche</a></li>
        </ul>
	</div>

@endsection

@section('content')

	<!-- Contenu de la page -->
    <div class="container-fluid tab-content clearfix">
		{!! Form::model($tache, ['route' => ['tache.update', $tache->id], 'method' => 'put']) !!}
        <!-- Section "Jalons/planning -->
        <div class="row tab-pane active">

        	@if( $tache->deletable === true )
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
		                {!! Form::select('tachetype_id', 
		                $tachetypes, 
		                null, 
		                ['class' => 'form-control', 'id' => 'tachetype_id']) !!}
		                {!! $errors->first('tachetype_id', '<small class="help-block">:message</small>') !!}
		            </div>

					<div class="col-lg-3 form-group {!! $errors->has('label') ? 'has-error' : '' !!}">
						<div class="label-title"><p>Libellé :</p></div>
	                	{!! Form::text('label', null, ['class' => 'form-control', 'placeholder' => 'Libellé']) !!}
	                	{!! $errors->first('label', '<small class="help-block">:message</small>') !!}
	            	</div>
	            </div>
	        </div>
	        @else
	        
		        <div class="col-lg-12">
	                <div class="row section-default-page">

		         		{!! Form::hidden('tachetype_id', null, ['class' => 'form-control']) !!}
		         		{!! Form::hidden('label', null, ['class' => 'form-control']) !!}

					</div>
				</div>
	        	
	        @endif

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

	            	<div class="col-lg-12 form-group">
						<div class="btn-action-right">{!! Form::button('<i class="fa fa-check" aria-hidden="true"></i>&nbsp;Valider', ['class' => 'btn btn-default btn-success pull-right', 'type' => 'submit']) !!}</div>

						<div class="btn-action-right"><a href="{!! url('taches', $tache->version_id); !!}" type="button" class="btn btn-default btn-cancel pull-right"><i class="fa fa-undo" aria-hidden="true"></i>&nbsp;Annuler</a></div>
	            	</div>

			    </div>
			</div>
		</div>
	{!! Form::close() !!}
	</div>		

@endsection