@extends('layouts.app')

@section('link-roadmap-active')
    class="active"
@endsection

@section('content')

    {!! Form::model($version, ['route' => ['version.update', $version->id], 'method' => 'put']) !!}

    <!-- En-tête page Web -->
    <div id="header" class="section-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Titre de la page Web -->
                    <h1>Modification de "{{ $version->libelle }}"</h1>
                </div>

                <!-- Contrôles -->
                <div class="col-lg-12">

                    <div class="pull-right">

                        {!! Form::button('<i class="fa fa-check" aria-hidden="true"></i>&nbsp;Valider', ['class' => 'btn btn-default btn-success pull-right', 'type' => 'submit']) !!}

                        <a href="{!! url('version', $version->id); !!}" type="button" class="btn btn-default btn-cancel pull-right"><i class="fa fa-undo" aria-hidden="true"></i>&nbsp;Annuler</a>

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
                        <h3 class="panel-title">Identification de la version</h3>
                    </div>

                    <!-- Contenu du panel -->
                    <div class="panel-body">
                        <div class="col-lg-12">

                            <!-- Contenu de la page -->
                            <div class="container-fluid tab-content clearfix">

                                <div class="row section-default-page">

                                    <!-- Choix de l'application associée -->
                                    <div class="col-lg-3 form-group">
                                        <div class="label-title"><p>Application :</p></div>
                                        {!! Form::select('application_id',
                                        $applications,
                                        null,
                                        ['class' => 'form-control', 'id' => 'application_id']) !!}
                                    </div>

                                    <!-- Libellé du chantier -->
                                    <div class="col-lg-6 form-group {!! $errors->has('libelle') ? 'has-error' : '' !!}">
                                        <div class="label-title"><p>Libellé :</p></div>
                                        {!! Form::text('libelle', null, ['class' => 'form-control']) !!}
                                        {!! $errors->first('libelle', '<small class="help-block">:message</small>') !!}
                                    </div>

                                </div>
                                <div class="row section-default-page">

                                    <!-- "Product Dimensions -->
                                    <div class="col-lg-3 form-group {!! $errors->has('product_dimensions') ? 'has-error' : '' !!}">
                                        <div class="label-title"><p>Product Dimensions :</p></div>
                                        {!! Form::text('product_dimensions', null, ['class' => 'form-control']) !!}
                                        {!! $errors->first('product_dimensions', '<small class="help-block">:message</small>') !!}
                                    </div>

                                    <!-- "Version MOE" du chantier -->
                                    <div class="col-lg-3 form-group {!! $errors->has('version') ? 'has-error' : '' !!}">
                                        <div class="label-title"><p>Version MOE :</p></div>
                                        {!! Form::text('version', null, ['class' => 'form-control']) !!}
                                        {!! $errors->first('version', '<small class="help-block">:message</small>') !!}
                                    </div>

                                    <!-- "Version Dimensions" du chantier -->
                                    <div class="col-lg-3 form-group {!! $errors->has('version_dimensions') ? 'has-error' : '' !!}">
                                        <div class="label-title"><p>Version Dimensions :</p></div>
                                        {!! Form::text('version_dimensions', null, ['class' => 'form-control']) !!}
                                        {!! $errors->first('version_dimensions', '<small class="help-block">:message</small>') !!}
                                    </div>

                                </div>


                                <div class="row section-default-page">

                                    <!-- Etat de la version -->
                                    <div class="col-lg-3 form-group">
                                        <div class="label-title"><p>Etat :</p></div>
                                        {!! Form::select('versionetat_id',
                                        $versionetats,
                                        null,
                                        ['class' => 'form-control', 'id' => 'versionetat_id']) !!}
                                    </div>

                                </div>

                                <div class="row section-default-page">

                                    <!-- "Référence ALFA" du chantier -->
                                    <div class="col-lg-3 form-group {!! $errors->has('referencealfa') ? 'has-error' : '' !!}">
                                        <div class="label-title"><p>Référence ALFA :</p></div>
                                        {!! Form::text('referencealfa', null, ['class' => 'form-control']) !!}
                                        {!! $errors->first('referencealfa', '<small class="help-block">:message</small>') !!}
                                    </div>

                                    <div class="col-lg-3 form-group {!! $errors->has('referencealfa_date') ? 'has-error' : '' !!}">
                                        <div class="label-title"><p>Date création ALFA :</p></div>
                                        {!! Form::date('referencealfa_date', null,  ['class' => 'form-control', 'id' => 'referencealfa_date'] ); !!}
                                        {!! $errors->first('referencealfa_date', '<small class="help-block">:message</small>') !!}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Panel "Scoring QOS" -->
                <div class="panel panel-default">

                    <!-- Titre du panel -->
                    <div class="panel-heading">
                        <h3 class="panel-title">Scoring QOS</h3>
                    </div>

                    <!-- Contenu du panel -->
                    <div class="panel-body">
                        <div class="col-lg-12">

                            <!-- Contenu de la page -->
                            <div class="container-fluid tab-content clearfix">
                                <div class="row section-default-page">

                                    <!-- QoS - Choix des enjeux métiers -->
                                    <div class="col-lg-3 form-group">
                                        <div class="label-title"><p>Enjeux métiers :</p></div>
                                        {!! Form::select('enjeuxmetier',
                                        array('1' => 'Faible', '2' => 'Moyen', '3' => 'Fort'),
                                        null,
                                        ['class' => 'form-control', 'id' => 'enjeuxmetier']) !!}
                                    </div>

                                    <!-- QoS - Choix des enjeux SI -->
                                    <div class="col-lg-3 form-group">
                                        <div class="label-title"><p>Enjeux SI :</p></div>
                                        {!! Form::select('enjeuxsi',
                                        array('1' => 'Faible', '2' => 'Moyen', '3' => 'Fort'),
                                        null,
                                        ['class' => 'form-control', 'id' => 'enjeuxsi']) !!}
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>


                <!-- Panel "Suivi des développements" -->
                <div class="panel panel-default">

                    <!-- Titre du panel -->
                    <div class="panel-heading">
                        <h3 class="panel-title">Suivi des développements</h3>
                    </div>

                    <!-- Contenu du panel -->
                    <div class="panel-body">
                        <div class="col-lg-12">

                            <!-- Contenu de la page -->
                            <div class="container-fluid tab-content clearfix">

                                <div class="row section-default-page">

                                    <!-- "Indicateur Nombre livraison TMA/DID" du chantier -->
                                    <div class="col-lg-3 form-group {!! $errors->has('inc_nblivtma') ? 'has-error' : '' !!}">
                                        <div class="label-title"><p>Nombre livraison TMA/DID :</p></div>
                                        {!! Form::text('inc_nblivtma', null, ['class' => 'form-control']) !!}
                                        {!! $errors->first('inc_nblivtma', '<small class="help-block">:message</small>') !!}
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>


                <!-- Panel "Suivi de la qualification/intégration" -->
                <div class="panel panel-default">

                    <!-- Titre du panel -->
                    <div class="panel-heading">
                        <h3 class="panel-title">Suivi de la qualification/intégration</h3>
                    </div>

                    <!-- Contenu du panel -->
                    <div class="panel-body">
                        <div class="col-lg-12">

                            <!-- Contenu de la page -->
                            <div class="container-fluid tab-content clearfix">

                                <div class="row section-default-page">

                                    <div class="col-lg-3 form-group">
                                        <div class="label-title"><p>Périmètre DQI :</p></div>
                                        {!! Form::select('perimetreqi', array('0' => 'Non', '1' => 'Oui'), null,
                                        ['class' => 'form-control', 'id' => 'perimetreqi']);
                                         !!}
                                    </div>

                                    <!-- Choix du référent qualification associé -->
                                    <div class="col-lg-3 form-group">
                                        <div class="label-title"><p>Référent qualification :</p></div>
                                        {!! Form::select('referentqi_id',
                                        $referentqis,
                                        null,
                                        ['class' => 'form-control', 'id' => 'referentqis']) !!}
                                    </div>

                                    <!-- "Indicateur Avancement QI" -->
                                    <div class="col-lg-3 form-group {!! $errors->has('avancementqi') ? 'has-error' : '' !!}">
                                        <div class="label-title"><p>Avancement QI :</p></div>
                                        {!! Form::text('avancementqi', null, ['class' => 'form-control']) !!}
                                        {!! $errors->first('avancementqi', '<small class="help-block">:message</small>') !!}
                                    </div>

                                </div>

                                <div class="row section-default-page">

                                    <!-- "Alertes et vigilances QI" du chantier -->
                                    <div class="col-lg-6 form-group {!! $errors->has('alerteqi') ? 'has-error' : '' !!}">
                                        <div class="label-title"><p>Alertes et vigilances :</p></div>
                                        {!! Form::text('alerteqi', null, ['class' => 'form-control']) !!}
                                        {!! $errors->first('alerteqi', '<small class="help-block">:message</small>') !!}
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>


                <!-- Panel "Suivi de la production" -->
                <div class="panel panel-default">

                    <!-- Titre du panel -->
                    <div class="panel-heading">
                        <h3 class="panel-title">Suivi de la production</h3>
                    </div>

                    <!-- Contenu du panel -->
                    <div class="panel-body">
                        <div class="col-lg-12">

                            <!-- Contenu de la page -->
                            <div class="container-fluid tab-content clearfix">

                                <div class="row section-default-page">

                                    <!-- Choix du référent production associé -->
                                    <div class="col-lg-3 form-group">
                                        <div class="label-title"><p>Référent production :</p></div>
                                        {!! Form::select('referentprd_id',
                                        $referentprds,
                                        null,
                                        ['class' => 'form-control', 'id' => 'referentprds']) !!}
                                    </div>

                                    <!-- Nombre reports production -->
                                    <div class="col-lg-3 form-group {!! $errors->has('prd_nbreports') ? 'has-error' : '' !!}">
                                        <div class="label-title"><p>Nombre report(s) production :</p></div>
                                        {!! Form::text('prd_nbreports', null, ['class' => 'form-control']) !!}
                                        {!! $errors->first('prd_nbreports', '<small class="help-block">:message</small>') !!}
                                    </div>

                                    <!-- Verison Dimensions livrée -->
                                    <div class="col-lg-3 form-group {!! $errors->has('prd_versiondimensions') ? 'has-error' : '' !!}">
                                        <div class="label-title"><p>Version Dimensions livrée :</p></div>
                                        {!! Form::text('prd_versiondimensions', null, ['class' => 'form-control']) !!}
                                        {!! $errors->first('prd_versiondimensions', '<small class="help-block">:message</small>') !!}
                                    </div>

                                  </div>
                                  <div class="row section-default-page">

                                    <!-- Estimation de la charge de pré-production -->
                                    <div class="col-lg-3 form-group {!! $errors->has('prp_estimationcharge') ? 'has-error' : '' !!}">
                                        <div class="label-title"><p>Estimation charge pré-production :</p></div>
                                        {!! Form::text('prp_estimationcharge', null, ['class' => 'form-control']) !!}
                                        {!! $errors->first('prp_estimationcharge', '<small class="help-block">:message</small>') !!}
                                    </div>

                                    <!-- Estimation de la charge de production -->
                                    <div class="col-lg-3 form-group {!! $errors->has('prd_estimationcharge') ? 'has-error' : '' !!}">
                                        <div class="label-title"><p>Estimation charge production :</p></div>
                                        {!! Form::text('prd_estimationcharge', null, ['class' => 'form-control']) !!}
                                        {!! $errors->first('prd_estimationcharge', '<small class="help-block">:message</small>') !!}
                                    </div>

                                </div>
                                <div class="row section-default-page">

                                    <!-- "Alertes et vigilances PRD" du chantier -->
                                    <div class="col-lg-6 form-group {!! $errors->has('alerteprd') ? 'has-error' : '' !!}">
                                        <div class="label-title"><p>Alertes et vigilances :</p></div>
                                        {!! Form::text('alerteprd', null, ['class' => 'form-control']) !!}
                                        {!! $errors->first('alerteprd', '<small class="help-block">:message</small>') !!}
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Panel "Commentaires" -->
                <div class="panel panel-default">

                    <!-- Titre du panel -->
                    <div class="panel-heading">
                        <h3 class="panel-title">Commentaires</h3>
                    </div>

                    <!-- Contenu du panel -->
                    <div class="panel-body">
                        <div class="col-lg-12">

                            <!-- Contenu de la page -->
                            <div class="container-fluid tab-content clearfix">

                                <div class="row section-default-page">

                                    <div class="col-lg-12 form-group {!! $errors->has('commentaire') ? 'has-error' : '' !!}">
                                        <div class="label-title"><p>Commentaires: </p></div>
                                        {!! Form::textarea('commentaire', null, ['class' => 'form-control']) !!}
                                        {!! $errors->first('commentaire', '<small class="help-block">:message</small>') !!}
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
