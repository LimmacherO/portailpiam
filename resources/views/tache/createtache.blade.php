@extends('layouts.app')

@section('link-roadmap-active')
    class="active"
@endsection

@section('content')

	{!! Form::open(['url' => 'tache/store', 'method' => 'post', 'id' => 'createtache']) !!}

   <!-- En-tête page Web -->
    <div id="header" class="section-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Titre de la page Web -->
                    <h1>Ajouter une nouvelle tâche</h1>
                </div>

                <!-- Contrôles -->
                <div class="col-lg-12">

                    <div class="pull-right">

 						{!! Form::button('<i class="fa fa-check" aria-hidden="true"></i>&nbsp;Valider', ['class' => 'btn btn-default btn-success pull-right', 'type' => 'submit', 'id' => 'valider']) !!}

						<a href="{!! url('taches', $version->id); !!}" type="button" class="btn btn-default btn-cancel pull-right"><i class="fa fa-undo" aria-hidden="true"></i>&nbsp;Annuler</a>

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
                        <h3 class="panel-title">Description de la tâche</h3>
                    </div>

                    <!-- Contenu du panel -->
                    <div class="panel-body">
                        <div class="col-lg-12">

                            <!-- Contenu de la page -->
                            <div class="container-fluid tab-content clearfix">

                            	<div class="row section-default-page">
					            	<div class="col-lg-3 form-group {!! $errors->has('tachetype_id') ? 'has-error' : '' !!}">
						                <div class="label-title"><p>Catégorie :</p></div>
						                {!! Form::select('tachetype_id',
						                $tachetypes,
						                null,
						                ['class' => 'form-control', 'id' => 'tachetype_id']) !!}
						                {!! $errors->first('tachetype_id', '<small class="help-block">:message</small>') !!}
						            </div>

									<div class="col-lg-3 form-group {!! $errors->has('libelle') ? 'has-error' : '' !!}">
										<div class="label-title"><p>Libellé :</p></div>
					                	{!! Form::text('libelle', null, ['class' => 'form-control']) !!}
					                	{!! $errors->first('libelle', '<small class="help-block">:message</small>') !!}
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

					              <!--<div class="col-lg-3 form-group {!! $errors->has('debut') ? 'has-error' : '' !!}">
					                	<div class="label-title"><p>Date de début :</p></div>
					                	{!! Form::text('debut', null,  ['class' => 'form-control', 'id' => 'debut'] ); !!}
					                	{!! $errors->first('debut', '<small class="help-block">:message</small>') !!}
					            	</div>-->

                        <div class="col-lg-3 form-group {!! $errors->has('debut') ? 'has-error' : '' !!}" >
                          <div class="label-title"><p>Date de début :</p></div>
                          <div id="datepicker-debut" class="input-group date" data-provide="datepicker">
                            {!! Form::text('debut', null,  ['class' => 'form-control', 'id' => 'datepicker-debut', 'name' => 'debut', 'placeholder' => 'jj/mm/aaaa'] ); !!}
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </div>
                          </div>
                          {!! $errors->first('debut', '<small class="help-block">:message</small>') !!}
                        </div>

					            	<!--<div class="col-lg-3 form-group {!! $errors->has('fin') ? 'has-error' : '' !!}">
					                	<div class="label-title"><p>Date de fin :</p></div>
					                	{!! Form::text('fin', null,  ['class' => 'form-control', 'id' => 'fin'] ); !!}
					                	{!! $errors->first('fin', '<small class="help-block">:message</small>') !!}
					            	</div>-->

                        <div class="col-lg-3 form-group {!! $errors->has('fin') ? 'has-error' : '' !!}" >
                          <div class="label-title"><p>Date de fin :</p></div>
                          <div id="datepicker-fin" class="input-group date" data-provide="datepicker">
                            {!! Form::text('fin', null,  ['class' => 'form-control', 'id' => 'datepicker-fin', 'name' => 'fin', 'placeholder' => 'jj/mm/aaaa'] ); !!}
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </div>
                          </div>
                          {!! $errors->first('fin', '<small class="help-block">:message</small>') !!}
                        </div>


      									<div class="col-lg-3 form-group">
      					                	{!! Form::hidden('version_id', $version->id, ['class' => 'form-control', 'placeholder' => 'ID de la version']) !!}
      					                	{!! Form::hidden('jalon', 0, ['class' => 'form-control']) !!}
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

  <script type="text/javascript">
     $(document).ready(function(){
       $('#datepicker-debut').datepicker({
       format: 'dd/mm/yyyy',
       language: 'fr',
       container: '#datepicker-debut',
       todayHighlight: true,
       autoclose: true,
     });
   });
 </script>

 <script type="text/javascript">

    $(document).ready(function(){
      $('#datepicker-fin').datepicker({
      format: 'dd/mm/yyyy',
      language: 'fr',
      container: '#datepicker-fin',
      todayHighlight: true,
      autoclose: true,
    });

    //On cache le bouton de validation pour éviter les créations en double
    $('#valider').click(function () {
        $('#valider').attr('disabled', true);
        $('#createtache').submit();
        return true;
    });
  });
</script>

@endsection
