@extends('layouts.app')

@section('content')

	{!! Form::model($tache, ['route' => ['tache.update', $tache->id], 'method' => 'put', 'id' => 'editjalon']) !!}

  <!-- En-tête page -->
  <div id="header" class="container-fluid section-header">
      <div class="row">
          <div class="col-lg-12">

              <!-- Titre de la page Web -->
              <h1 class="text-left">Modification du jalon "{{ $tache->libelle }}"</h1>

              <!-- Button pour validation -->
              <button id="valider" type="button" type="submit" class="btn btn-outline-success float-right btn-sm">
                <i class="fa fa-check" aria-hidden="true"></i>&nbsp;Valider
              </button>

              <!-- Button annulation -->
              <button id="annuler" type="button" type="submit" class="btn btn-outline-primary float-right btn-sm btn-margin-right" onclick="location.href = '{!! url('taches', $tache->version_id); !!}';">
                <i class="fa fa-undo" aria-hidden="true"></i>&nbsp;Annuler
              </button>

          </div>

      </div>
  </div>

  <!-- Afichage du contenu de la page -->
  <div class="container-fluid">
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

                  <!-- Selection de la catégorie -->
                  <div class="col-lg-3 form-group {!! $errors->has('tachetype_id') ? 'has-error' : '' !!}">
                      <label>Type :</label>
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

                  <!-- Champs libellé -->
                  <div class="col-lg-3 form-group {!! $errors->has('libelle') ? 'has-error' : '' !!}">
    									<label>Libellé :</label>
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

                   <!-- Date du jalon -->
                   <div class="col-lg-3 form-group {!! $errors->has('debut') ? 'has-error' : '' !!}" >
                     <label>Date du jalon :</label>
                     <div id="datepicker-debut" class="input-group date" data-provide="datepicker">
                       {!! Form::text('debut', null,  ['class' => 'form-control', 'id' => 'datepicker-debut', 'name' => 'debut', 'placeholder' => 'jj/mm/aaaa'] ); !!}
                       <div class="input-group-addon">
                           <span class="glyphicon glyphicon-calendar"></span>
                       </div>
                     </div>
                     {!! $errors->first('debut', '<small class="help-block">:message</small>') !!}
                   </div>


                   <div class="col-lg-4 form-group {!! $errors->has('version_id') ? 'has-error' : '' !!}">
                             {!! Form::hidden('version_id', $tache->version_id, ['class' => 'form-control', 'placeholder' => 'ID de la version']) !!}
                             {!! $errors->first('version_id', '<small class="help-block">:message</small>') !!}
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

@section('scripts')

  <script type="text/javascript">
     $(document).ready(function(){
       $('#datepicker-debut').datepicker({
       format: 'dd/mm/yyyy',
       language: 'fr',
       container: '#datepicker-debut',
       todayHighlight: true,
       autoclose: true,
     });

     //On cache le bouton de validation pour éviter les créations en double
     $('#valider').click(function () {
         $('#valider').attr('disabled', true);
         $('#editjalon').submit();
         return true;
     });

   });
  </script>

@endsection
