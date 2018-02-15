@extends('layouts.app')

@section('content')

    {!! Form::model($version, ['route' => ['version.update', $version->id], 'method' => 'put', 'id' => 'formEditVersion']) !!}

    <!-- En-tête page -->
    <div id="header" class="container-fluid section-header">
        <div class="row">
            <div class="col-lg-12">

              <div class="container">
                <div class="row">
                  <div class="col-lg-12">

                    <!-- Titre de la page Web -->
                    <h1 class="text-left">Modification de "{{ $version->libelle }}"</h1>

                    <!-- Button pour valider la saisie -->
                    <button id="valider" type="button" type="submit" class="btn btn-outline-success float-right btn-sm">
                      <i class="fa fa-check" aria-hidden="true"></i>&nbsp;Valider
                    </button>

                    <!-- Button annuler -->
                    <button id="annuler" type="button" type="submit" class="btn btn-outline-primary float-right btn-sm btn-margin-right" onclick="location.href = '{!! url('version', $version->id); !!}';">
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

          <!-- Panel "Identification de la version" -->
          <div class="col-lg-12">

            <div class="card">

                <!-- Titre du panel -->
                <div class="card-header">Identification de la version</div>

                <!-- Contenu du panel -->
                <div class="card-body">

                  <div class="container-fluid">

                    <div class="row">

                        <!-- Choix de l'application associée -->
                        <div class="col-lg-3 form-group">
                            <label>Application :</label>
                            {!! Form::select('application_id',
                            $applications,
                            null,
                            ['class' => 'form-control', 'id' => 'application_id']) !!}
                        </div>

                        <!-- Libellé du chantier -->
                        <div class="col-lg-6 form-group {!! $errors->has('libelle') ? 'has-error' : '' !!}">
                            <label>Libellé :</label>
                            {!! Form::text('libelle', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('libelle', '<small class="help-block">:message</small>') !!}
                        </div>

                    </div>
                    <div class="row">

                        <!-- "Product Dimensions -->
                        <div class="col-lg-3 form-group {!! $errors->has('product_dimensions') ? 'has-error' : '' !!}">
                            <label>Product Dimensions :</label>
                            {!! Form::text('product_dimensions', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('product_dimensions', '<small class="help-block">:message</small>') !!}
                        </div>

                        <!-- "Version MOE" du chantier -->
                        <div class="col-lg-3 form-group {!! $errors->has('version') ? 'has-error' : '' !!}">
                            <label>Version MOE :</label>
                            {!! Form::text('version', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('version', '<small class="help-block">:message</small>') !!}
                        </div>

                        <!-- "Version Dimensions" du chantier -->
                        <div class="col-lg-3 form-group {!! $errors->has('version_dimensions') ? 'has-error' : '' !!}">
                            <label>Version Dimensions :</label>
                            {!! Form::text('version_dimensions', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('version_dimensions', '<small class="help-block">:message</small>') !!}
                        </div>

                      </div>
                      <div class="row">

                        <!-- Etat de la version -->
                        <div class="col-lg-3 form-group">
                            <label>Etat :</label>
                            {!! Form::select('versionetat_id',
                            $versionetats,
                            null,
                            ['class' => 'form-control', 'id' => 'versionetat_id']) !!}
                        </div>

                      </div>
                      <div class="row">

                        <!-- "Référence ALFA" du chantier -->
                        <div class="col-lg-3 form-group {!! $errors->has('referencealfa') ? 'has-error' : '' !!}">
                            <label>Référence ALFA :</label>
                            {!! Form::text('referencealfa', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('referencealfa', '<small class="help-block">:message</small>') !!}
                        </div>

                        <div class="col-lg-3 form-group {!! $errors->has('alfadate') ? 'has-error' : '' !!}" >
                          <label>Date création ALFA :</label>
                          <div id="datepicker-alfadate" class="input-group input-daterange" data-provide="datepicker">
                            {!! Form::text('alfadate', null,  ['class' => 'form-control', 'name' => 'alfadate'] ); !!}
                            <div class="input-group-append">
                              <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                            </div>
                          </div>
                          {!! $errors->first('alfadate', '<small class="help-block">:message</small>') !!}
                        </div>

                      </div>
                    </div>

                </div>

            </div>

        </div> <!-- Fin Panel "Identification de la version" -->


        <!-- Panel "Scoring QOS" -->
        <div class="col-lg-12">

          <div class="card">

            <!-- Titre du panel -->
            <div class="card-header">Scoring QOS</div>

            <!-- Contenu du panel -->
            <div class="card-body">
              <div class="container-fluid">
                <div class="row">

                  <!-- QoS - Choix des enjeux métiers -->
                  <div class="col-lg-3 form-group">
                      <label>Enjeux métiers :</label>
                      {!! Form::select('enjeuxmetier',
                      array('1' => 'Faible', '2' => 'Moyen', '3' => 'Fort'),
                      null,
                      ['class' => 'form-control', 'id' => 'enjeuxmetier']) !!}
                  </div>

                  <!-- QoS - Choix des enjeux SI -->
                  <div class="col-lg-3 form-group">
                      <label>Enjeux SI :</label>
                      {!! Form::select('enjeuxsi',
                      array('1' => 'Faible', '2' => 'Moyen', '3' => 'Fort'),
                      null,
                      ['class' => 'form-control', 'id' => 'enjeuxsi']) !!}
                  </div>

                </div>
              </div>
            </div>

          </div>

        </div> <!-- Fin Panel "Scoring QOS" -->


        <!-- Panel "Suivi des livraisons" -->
        <div class="col-lg-12">

          <div class="card">

            <!-- Titre du panel -->
            <div class="card-header">Suivi des livraisons</div>

            <!-- Contenu du panel -->
            <div class="card-body">
              <div class="container-fluid">
                <div class="row">

                  <!-- "Indicateur Nombre livraison TMA/DID" du chantier -->
                  <div class="col-lg-3 form-group {!! $errors->has('inc_nblivtma') ? 'has-error' : '' !!}">
                      <label>Nombre livraison TMA/DID :</label>
                      {!! Form::text('inc_nblivtma', null, ['class' => 'form-control']) !!}
                      {!! $errors->first('inc_nblivtma', '<small class="help-block">:message</small>') !!}
                  </div>

                </div>
              </div>
            </div>

          </div>
        </div> <!-- Fin Panel "Suivi des livraisons" -->


        <!-- Panel "Suivi de la qualification/intégration" -->
        <div class="col-lg-12">

          <div class="card">

            <!-- Titre du panel -->
            <div class="card-header">Suivi de la qualification/intégration</div>

            <!-- Contenu du panel -->
            <div class="card-body">
              <div class="container-fluid">
                <div class="row">

                  <div class="col-lg-3 form-group">
                      <label>Périmètre DQI :</label>
                      {!! Form::select('perimetreqi', array('0' => 'Non', '1' => 'Oui'), null,
                      ['class' => 'form-control', 'id' => 'perimetreqi']);
                       !!}
                  </div>

                  <!-- Choix du référent qualification associé -->
                  <div class="col-lg-3 form-group">
                      <label>Référent qualification :</label>
                      {!! Form::select('referentqi_id',
                      $referentqis,
                      null,
                      ['class' => 'form-control', 'id' => 'referentqis']) !!}
                  </div>

                  <!-- "Indicateur Avancement QI" -->
                  <div class="col-lg-3 form-group {!! $errors->has('avancementqi') ? 'has-error' : '' !!}">
                      <label>Avancement QI (%) :</label>
                      {!! Form::text('avancementqi', null, ['class' => 'form-control']) !!}
                      {!! $errors->first('avancementqi', '<small class="help-block">:message</small>') !!}
                  </div>

                </div>
                <div class="row">

                  <!-- "Alertes et vigilances QI" du chantier -->
                  <div class="col-lg-6 form-group {!! $errors->has('alerteqi') ? 'has-error' : '' !!}">
                      <label>Alertes et vigilances :</label>
                      {!! Form::text('alerteqi', null, ['class' => 'form-control']) !!}
                      {!! $errors->first('alerteqi', '<small class="help-block">:message</small>') !!}
                  </div>

                </div>
              </div>
            </div>

          </div>
        </div> <!-- Fin Panel "Suivi de la qualification/intégration" -->


        <!-- Panel "Suivi de la production" -->
        <div class="col-lg-12">

          <div class="card">

            <!-- Titre du panel -->
            <div class="card-header">Suivi de la production</div>

            <!-- Contenu du panel -->
            <div class="card-body">
              <div class="container-fluid">
                <div class="row">

                  <!-- Choix du référent production associé -->
                  <div class="col-lg-3 form-group">
                      <label>Référent production :</label>
                      {!! Form::select('referentprd_id',
                      $referentprds,
                      null,
                      ['class' => 'form-control', 'id' => 'referentprds']) !!}
                  </div>

                  <!-- Nombre reports production -->
                  <div class="col-lg-3 form-group {!! $errors->has('prd_nbreports') ? 'has-error' : '' !!}">
                      <label>Nombre report(s) production :</label>
                      {!! Form::text('prd_nbreports', null, ['class' => 'form-control']) !!}
                      {!! $errors->first('prd_nbreports', '<small class="help-block">:message</small>') !!}
                  </div>

                  <!-- Verison Dimensions livrée -->
                  <div class="col-lg-3 form-group {!! $errors->has('prd_versiondimensions') ? 'has-error' : '' !!}">
                      <label>Version Dimensions livrée :</label>
                      {!! Form::text('prd_versiondimensions', null, ['class' => 'form-control']) !!}
                      {!! $errors->first('prd_versiondimensions', '<small class="help-block">:message</small>') !!}
                  </div>

                </div>
                <div class="row">

                  <!-- Estimation de la charge de pré-production -->
                  <div class="col-lg-3 form-group {!! $errors->has('prp_estimationcharge') ? 'has-error' : '' !!}">
                      <label>Estimation charge pré-production :</label>
                      {!! Form::text('prp_estimationcharge', null, ['class' => 'form-control']) !!}
                      {!! $errors->first('prp_estimationcharge', '<small class="help-block">:message</small>') !!}
                  </div>

                  <!-- Estimation de la charge de production -->
                  <div class="col-lg-3 form-group {!! $errors->has('prd_estimationcharge') ? 'has-error' : '' !!}">
                      <label>Estimation charge production :</label>
                      {!! Form::text('prd_estimationcharge', null, ['class' => 'form-control']) !!}
                      {!! $errors->first('prd_estimationcharge', '<small class="help-block">:message</small>') !!}
                  </div>

                </div>
                <div class="row">

                  <!-- "Alertes et vigilances PRD" du chantier -->
                  <div class="col-lg-6 form-group {!! $errors->has('alerteprd') ? 'has-error' : '' !!}">
                      <label>Alertes et vigilances :</label>
                      {!! Form::text('alerteprd', null, ['class' => 'form-control']) !!}
                      {!! $errors->first('alerteprd', '<small class="help-block">:message</small>') !!}
                  </div>

                </div>
              </div>
            </div>

          </div>
        </div> <!-- Fin Panel "Suivi de la production" -->


        <!-- Panel "Commentaires" -->
        <div class="col-lg-12">

          <div class="card">

            <!-- Titre du panel -->
            <div class="card-header">Commentaires</div>

            <!-- Contenu du panel -->
            <div class="card-body">
              <div class="container-fluid">
                <div class="row">

                  <div class="col-lg-12 form-group {!! $errors->has('commentaire') ? 'has-error' : '' !!}">
                      <label>Commentaires: </label>
                      {!! Form::textarea('commentaire', null, ['class' => 'form-control']) !!}
                      {!! $errors->first('commentaire', '<small class="help-block">:message</small>') !!}
                  </div>

                </div>
              </div>
            </div>

          </div>
        </div> <!-- Fin Panel "Commentaires" -->

      </div>
    </div> <!-- Fin de l'affichage du contenu de la page -->

    {!! Form::close() !!}

@endsection

@section('scripts')

<script type="text/javascript">

  $(document).ready(function(){
      $('#datepicker-alfadate').datepicker({
      format: 'dd/mm/yyyy',
      language: 'fr',
      container: '#datepicker-alfadate',
      todayHighlight: true,
      autoclose: true,
      allowInputToggle: true,
    });

    //On cache le bouton de validation pour éviter les créations en double
    $('#valider').click(function () {
        $('#valider').attr('disabled', true);
        $('#formEditVersion').submit();
        return true;
    });

  });
</script>

@endsection
