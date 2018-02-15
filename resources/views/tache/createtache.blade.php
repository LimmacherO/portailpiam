@extends('layouts.app')

@section('content')

	{!! Form::open(['url' => 'tache/store', 'method' => 'post', 'id' => 'createtache']) !!}

  <!-- En-tête page -->
  <div id="header" class="container-fluid section-header">
      <div class="row">
          <div class="col-lg-12">

						<div class="container">
	            <div class="row">
	              <div class="col-lg-12">

		              <!-- Titre de la page Web -->
		              <h1 class="text-left">Ajouter une nouvelle tâche</h1>

		              <!-- Button pour validation -->
		              <button id="valider" type="button" type="submit" class="btn btn-outline-success float-right btn-sm" onclick="location.href = '{!! url('version/create/1'); !!}';">
		                <i class="fa fa-check" aria-hidden="true"></i>&nbsp;Valider
		              </button>

		              <!-- Button annulation -->
		              <button id="annuler" type="button" type="submit" class="btn btn-outline-primary float-right btn-sm btn-margin-right" onclick="location.href = '{!! url('taches', $version->id); !!}';">
		                <i class="fa fa-undo" aria-hidden="true"></i>&nbsp;Annuler
		              </button>

								</div>
							</div>
						</div>

          </div>

      </div>
  </div>

  <!-- Afichage du contenu de la page -->
  <div class="container">
     <div class="row">

       <!-- Panel "Description de la tâche" -->
       <div class="col-lg-12">

         <div class="card">

             <!-- Titre du panel -->
             <div class="card-header">Description de la tâche</div>

             <!-- Contenu du panel -->
             <div class="card-body">

               <div class="container-fluid">
                <div class="row">

                  <!-- Liste déroulante "catérogie" -->
                  <div class="col-lg-3 form-group {!! $errors->has('tachetype_id') ? 'has-error' : '' !!}">
                      <label>Catégorie :</label>
                      {!! Form::select('tachetype_id',
                      $tachetypes,
                      null,
                      ['class' => 'form-control', 'id' => 'tachetype_id']) !!}
                      {!! $errors->first('tachetype_id', '<small class="help-block">:message</small>') !!}
                  </div>

                  <div class="col-lg-3 form-group {!! $errors->has('libelle') ? 'has-error' : '' !!}">
										<label>Libellé :</label>
		                	{!! Form::text('libelle', null, ['class' => 'form-control']) !!}
		                	{!! $errors->first('libelle', '<small class="help-block">:message</small>') !!}
		            	</div>

                </div>
              </div>
            </div>
          </div> <!-- Fin affichage du panel de description de la tâche -->

        </div>

        <!-- Panel "Dates de début et fin" -->
        <div class="col-lg-12">

          <div class="card">

              <!-- Titre du panel -->
              <div class="card-header">Dates de début et fin</div>

              <!-- Contenu du panel -->
              <div class="card-body">

                <div class="container-fluid">
                 <div class="row">

                   <!-- Date de début -->
                   <div class="col-lg-3 form-group {!! $errors->has('debut') ? 'has-error' : '' !!}" >
                     <label>Date de début :</label>
                     <div id="datepicker-debut" class="input-group date" data-provide="datepicker">
                       {!! Form::text('debut', null,  ['class' => 'form-control', 'id' => 'datepicker-debut', 'name' => 'debut', 'placeholder' => 'jj/mm/aaaa'] ); !!}
                       <div class="input-group-addon">
                           <span class="glyphicon glyphicon-calendar"></span>
                       </div>
                     </div>
                     {!! $errors->first('debut', '<small class="help-block">:message</small>') !!}
                   </div>

                   <!-- Date de fin -->
                   <div class="col-lg-3 form-group {!! $errors->has('fin') ? 'has-error' : '' !!}" >
                     <label>Date de fin :</label>
                     <div id="datepicker-fin" class="input-group date" data-provide="datepicker">
                       {!! Form::text('fin', null,  ['class' => 'form-control', 'id' => 'datepicker-fin', 'name' => 'fin', 'placeholder' => 'jj/mm/aaaa'] ); !!}
                       <div class="input-group-addon">
                           <span class="glyphicon glyphicon-calendar"></span>
                       </div>
                     </div>
                     {!! $errors->first('fin', '<small class="help-block">:message</small>') !!}
                   </div>

                   <!-- Champs cachés -->
                   <div class="col-lg-3 form-group">
                      {!! Form::hidden('version_id', $version->id, ['class' => 'form-control', 'placeholder' => 'ID de la version']) !!}
                      {!! Form::hidden('jalon', 0, ['class' => 'form-control']) !!}
                   </div>

                </div>
              </div>

            </div>

          </div> <!-- Fin du panel des dates de début et de fin -->
        </div>

      </div>
    </div> <!-- Fin affichage du contenu de la page -->

	{!! Form::close() !!}

@endsection

@section ('scripts')

  <script type="text/javascript">

    $(document).ready(function(){

      $('#datepicker-debut').datepicker({
      format: 'dd/mm/yyyy',
      language: 'fr',
      container: '#datepicker-debut',
      todayHighlight: true,
      autoclose: true,
    });

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
