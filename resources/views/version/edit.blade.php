@extends('layouts.app')

@section('link-roadmap-active')
    class="active"
@endsection

@section('page-header-title')
    Modification de "{{ $version->application->libelle }} {{ $version->version }}"
@endsection

@section('page-header-controls')

    <div class="btn-action-right">{!! Form::button('<i class="fa fa-check" aria-hidden="true"></i>&nbsp;Valider', ['class' => 'btn btn-default btn-success pull-right', 'type' => 'submit']) !!}</div>

    <div class="btn-action-right"><a href="{!! url('version', $version->id); !!}" type="button" class="btn btn-default btn-cancel pull-right"><i class="fa fa-undo" aria-hidden="true"></i>&nbsp;Annuler</a></div>

@endsection

@section('page-top-form')
    {!! Form::model($version, ['route' => ['version.update', $version->id], 'method' => 'put']) !!}
@endsection

@section('page-bottom-form')
    {!! Form::close() !!}
@endsection

@section('tabs')

    <div>
        <ul class="nav nav-tabs" role="tablist">
            <li class="active"><a href="#" aria-controls="home" role="tab"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Modification d'un chantier</a></li>
        </ul>
    </div>

@endsection

@section('content')

    <!-- Contenu de la page -->
    <div class="container-fluid tab-content clearfix">
        <!-- Section "Jalons/planning -->
        <div class="row tab-pane active">
            <div class="col-lg-12">
                <div class="row section-default-page">
                    
                    <h2 class="section-default-page-titre">Identification de la version</h2>
                    <div class="section-default-page-border"></div>
                    <div class="section-default-page-space">&nbsp;</div>

                </div>
                <div class="row section-default-page">

                    <!-- Libellé du chantier -->
                    <div class="col-lg-6 form-group {!! $errors->has('libelle') ? 'has-error' : '' !!}">
                        <div class="label-title"><p>Libellé :</p></div>
                        {!! Form::text('libelle', $version->libelle, ['class' => 'form-control']) !!}
                        {!! $errors->first('libelle', '<small class="help-block">:message</small>') !!}
                    </div>

                </div>
                <div class="row section-default-page">
                    <!-- Choix de l'application associée -->
                    <div class="col-lg-3 form-group">
                        <div class="label-title"><p>Application :</p></div>
                        {!! Form::select('application_id', 
                        $applications, 
                        null, 
                        ['class' => 'form-control', 'id' => 'application_id']) !!}
                    </div>

                    <!-- "Version" du chantier -->
                    <div class="col-lg-3 form-group {!! $errors->has('version') ? 'has-error' : '' !!}">
                        <div class="label-title"><p>Version :</p></div>
                        {!! Form::text('version', $version->version, ['class' => 'form-control']) !!}
                        {!! $errors->first('version', '<small class="help-block">:message</small>') !!}
                    </div>

                    <!-- "Product Dimensions -->
                    <div class="col-lg-3 form-group {!! $errors->has('product_dimensions') ? 'has-error' : '' !!}">
                        <div class="label-title"><p>Product Dimensions :</p></div>
                        {!! Form::text('product_dimensions', $version->product_dimensions, ['class' => 'form-control']) !!}
                        {!! $errors->first('product_dimensions', '<small class="help-block">:message</small>') !!}
                    </div>

                    <!-- "Référence ALFA" du chantier -->
                    <div class="col-lg-3 form-group {!! $errors->has('referencealfa') ? 'has-error' : '' !!}">
                        <div class="label-title"><p>Référence ALFA :</p></div>
                        {!! Form::text('referencealfa', null, ['class' => 'form-control']) !!}
                        {!! $errors->first('referencealfa', '<small class="help-block">:message</small>') !!}
                    </div>

                </div>
                <div class="row section-default-page">

                    <div class="section-default-page-space">&nbsp;</div>
                    <h2 class="section-default-page-titre">Suivi des développements</h2>
                    <div class="section-default-page-border"></div>
                    <div class="section-default-page-space">&nbsp;</div>

                </div>
                <div class="row section-default-page">

                    <!-- "Indicateur Nombre livraison TMA/DID" du chantier -->
                    <div class="col-lg-3 form-group {!! $errors->has('inc_nblivtma') ? 'has-error' : '' !!}">
                        <div class="label-title"><p>Nombre livraison TMA/DID :</p></div>
                        {!! Form::text('inc_nblivtma', null, ['class' => 'form-control']) !!}
                        {!! $errors->first('inc_nblivtma', '<small class="help-block">:message</small>') !!}
                    </div>

                </div>
                <div class="row section-default-page">

                    <div class="section-default-page-space">&nbsp;</div>
                    <h2 class="section-default-page-titre">Scoring QOS</h2>
                    <div class="section-default-page-border"></div>
                    <div class="section-default-page-space">&nbsp;</div>

                </div>
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
                        </select>
                    </div>

                </div>
                <div class="row section-default-page">

                    <div class="section-default-page-space">&nbsp;</div>
                    <h2 class="section-default-page-titre">Suivi de la qualification/intégration</h2>
                    <div class="section-default-page-border"></div>
                    <div class="section-default-page-space">&nbsp;</div>

                </div>
                <div class="row section-default-page">

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
                <div class="row section-default-page">

                    <div class="section-default-page-space">&nbsp;</div>
                    <h2 class="section-default-page-titre">Suivi de la production</h2>
                    <div class="section-default-page-border"></div>
                    <div class="section-default-page-space">&nbsp;</div>

                </div>
                <div class="row section-default-page">

                    <!-- Choix du référent production associé -->
                    <div class="col-lg-3 form-group">
                        <div class="label-title"><p>Référent production :</p></div>
                        {!! Form::select('referentprd_id', 
                        $referentprds, 
                        null, 
                        ['class' => 'form-control', 'id' => 'referentprds']) !!}
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
                <div class="row section-default-page">

                    <div class="section-default-page-space">&nbsp;</div>
                    <h2 class="section-default-page-titre">Commentaires</h2>
                    <div class="section-default-page-border"></div>
                    <div class="section-default-page-space">&nbsp;</div>

                </div>
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

@endsection