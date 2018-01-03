@extends('layouts.app')

@section('link-roadmap-active')
    class="active"
@endsection

@section('content')

	{!! Form::model($tache, ['route' => ['tache.update', $tache->id], 'method' => 'put']) !!}

   <!-- En-tête page Web -->
    <div id="header" class="section-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Titre de la page Web -->
                    <h1>Modification de la tâche "{{ $tache->libelle }}"</h1>
                </div>

                <!-- Contrôles -->
                <div class="col-lg-12">

                    <div class="pull-right">

                        {!! Form::button('<i class="fa fa-check" aria-hidden="true"></i>&nbsp;Valider', ['class' => 'btn btn-default btn-success pull-right', 'type' => 'submit']) !!}

						<a href="{!! url('taches', $tache->version_id); !!}" type="button" class="btn btn-default btn-cancel pull-right"><i class="fa fa-undo" aria-hidden="true"></i>&nbsp;Annuler</a>

                    </div>

                </div>

            </div>
        </div>
    </div>

    <!-- Contenu de la page Web -->
    <div id="content">
        <!-- Afichage du contenu de la page -->
        <div class="container-fluid section-content">

            <div class="row">

                <!-- Panel "Identification de la version" -->
                <div class="panel panel-default">

                    <!-- Titre du panel -->
                    <div class="panel-heading">
                        <h3 class="panel-title">Description du jalon/tâche</h3>
                    </div>

                    <!-- Contenu du panel -->
                    <div class="panel-body">
                        <div class="col-lg-12">

                            <!-- Contenu de la page -->
                            <div class="container-fluid tab-content clearfix">

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


									<div class="col-lg-3 form-group {!! $errors->has('libelle') ? 'has-error' : '' !!}">
										<div class="label-title"><p>Libellé :</p></div>
										@if( $tache->deletable === true )
					                		{!! Form::text('libelle', null, ['class' => 'form-control', 'placeholder' => 'Libellé']) !!}
					                		{!! $errors->first('libelle', '<small class="help-block">:message</small>') !!}
					                	@else
					                		{!! Form::text('libelle', null, ['class' => 'form-control', 'placeholder' => 'Libellé', 'readonly' => 'true']) !!}
					                	@endif
					            	</div>
					            </div>

                            </div>
                        </div>
                    </div>
                </div>


				<div class="panel panel-default">

                    <!-- Titre du panel -->
                    <div class="panel-heading">
                        <h3 class="panel-title">Dates de début et fin</h3>
                    </div>

                    <!-- Contenu du panel -->
                    <div class="panel-body">
                        <div class="col-lg-12">

                            <!-- Contenu de la page -->
                            <div class="container-fluid tab-content clearfix">

								<div class="row section-default-page">

					                <div class="col-lg-3 form-group {!! $errors->has('debut') ? 'has-error' : '' !!}">
					                	<div class="label-title"><p>Date de début :</p></div>
					                	{!! Form::text('debut', null,  ['class' => 'form-control', 'id' => 'debut'] ); !!}
					                	{!! $errors->first('debut', '<small class="help-block">:message</small>') !!}
					            	</div>

					            	<div class="col-lg-3 form-group {!! $errors->has('fin') ? 'has-error' : '' !!}">
					            		<div class="label-title"><p>Date de fin :</p></div>
					                	{!! Form::text('fin', null,  ['class' => 'form-control', 'id' => 'fin'] ); !!}
					                	{!! $errors->first('fin', '<small class="help-block">:message</small>') !!}
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

    </div>

	{!! Form::close() !!}

@endsection
