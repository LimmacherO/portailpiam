@extends('layouts.app')

@section('link-roadmap-active')
    class="active"
@endsection

@section('page-header-title')
    Modification de la version {{ $version->version }}
@endsection

@section('tabs')

    <div>
        <ul class="nav nav-tabs" role="tablist">
            <li class="active"><a href="#" aria-controls="home" role="tab"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Modification d'une version</a></li>
        </ul>
    </div>

@endsection

@section('content')

    <!-- Contenu de la page -->
    <div class="container-fluid tab-content clearfix">
        {!! Form::model($version, ['route' => ['version.update', $version->id], 'method' => 'put']) !!}
        <!-- Section "Jalons/planning -->
        <div class="row tab-pane active">
            <div class="col-lg-12">
                <div class="row section-default-page">
                    
                    <div class="btn-action-right">{!! Form::button('<i class="fa fa-check" aria-hidden="true"></i>&nbsp;Valider', ['class' => 'btn btn-default btn-success pull-right', 'type' => 'submit']) !!}</div>

                    <div class="btn-action-right"><a href="{!! url('version', $version->id); !!}" type="button" class="btn btn-default btn-cancel pull-right"><i class="fa fa-undo" aria-hidden="true"></i>&nbsp;Annuler</a></div>
                    
                    <h2 class="section-default-page-titre">Identification de la version</h2>
                    <div class="section-default-page-border"></div>
                    <div class="section-default-page-space">&nbsp;</div>


                    <!-- Libellé du chantier -->
                    <div class="col-lg-12 form-group {!! $errors->has('libelle') ? 'has-error' : '' !!}">
                        <div class="label-title"><p>Libellé :</p></div>
                        {!! Form::text('libelle', null, ['class' => 'form-control', 'placeholder' => 'Libellé']) !!}
                        {!! $errors->first('libelle', '<small class="help-block">:message</small>') !!}
                    </div>

                                        <!-- Choix de l'application associée -->
                    <div class="col-lg-4 form-group">
                        <div class="label-title"><p>Application :</p></div>
                        {!! Form::select('application_id', 
                        $applications, 
                        null, 
                        ['class' => 'form-control', 'id' => 'application_id']) !!}
                    </div>

                    <!-- "Version" du chantier -->
                    <div class="col-lg-4 form-group {!! $errors->has('version') ? 'has-error' : '' !!}">
                        <div class="label-title"><p>Version :</p></div>
                        {!! Form::text('version', null, ['class' => 'form-control', 'placeholder' => 'Version']) !!}
                        {!! $errors->first('version', '<small class="help-block">:message</small>') !!}
                    </div>

                    <!-- "Référence ALFA" du chantier -->
                    <div class="col-lg-4 form-group {!! $errors->has('referencealfa') ? 'has-error' : '' !!}">
                        <div class="label-title"><p>Référence ALFA :</p></div>
                        {!! Form::text('referencealfa', null, ['class' => 'form-control', 'placeholder' => 'Référence ALFA']) !!}
                        {!! $errors->first('referencealfa', '<small class="help-block">:message</small>') !!}
                    </div>

                    <div class="section-default-page-space">&nbsp;</div>

                    <h2 class="section-default-page-titre">Indicateurs</h2>
                    <div class="section-default-page-border"></div>
                    <div class="section-default-page-space">&nbsp;</div>

                    <!-- "Indicateur Nombre livraison TMA/DID" du chantier -->
                    <div class="col-lg-4 form-group {!! $errors->has('inc_nblivtma') ? 'has-error' : '' !!}">
                        <div class="label-title"><p>Nombre livraison TMA/DID :</p></div>
                        {!! Form::text('inc_nblivtma', null, ['class' => 'form-control', 'placeholder' => 'Nombre livraison TMA/DID']) !!}
                        {!! $errors->first('inc_nblivtma', '<small class="help-block">:message</small>') !!}
                    </div>

                    <div class="col-lg-4">
                        <p>&nbsp;</p>
                    </div>

                    <div class="col-lg-4">
                        <p>&nbsp;</p>
                    </div>

                    <div class="section-default-page-space">&nbsp;</div>
                    <div class="section-default-page-space">&nbsp;</div>

                    <h2 class="section-default-page-titre">Suivi de la qualification/intégration</h2>
                    <div class="section-default-page-border"></div>
                    <div class="section-default-page-space">&nbsp;</div>

                    <!-- Choix du référent qualification associé -->
                    <div class="col-lg-4 form-group">
                        <div class="label-title"><p>Référent qualification :</p></div>
                        {!! Form::select('referentqi_id', 
                        $referentqis, 
                        null, 
                        ['class' => 'form-control', 'id' => 'referentqis']) !!}
                    </div>

                    <!-- "Alertes et vigilances QI" du chantier -->
                    <div class="col-lg-8 form-group {!! $errors->has('alerteqi') ? 'has-error' : '' !!}">
                        <div class="label-title"><p>Alertes et vigilances :</p></div>
                        {!! Form::textarea('alerteqi', null, ['class' => 'form-control', 'placeholder' => 'Alertes et vigilances']) !!}
                        {!! $errors->first('alerteqi', '<small class="help-block">:message</small>') !!}
                    </div>

                    <div class="section-default-page-space">&nbsp;</div>
                    <div class="section-default-page-space">&nbsp;</div>

                    <h2 class="section-default-page-titre">Suivi de la production</h2>
                    <div class="section-default-page-border"></div>
                    <div class="section-default-page-space">&nbsp;</div>

                    <!-- Choix du référent production associé -->
                    <div class="col-lg-4 form-group">
                        <div class="label-title"><p>Référent production :</p></div>
                        {!! Form::select('referentprd_id', 
                        $referentprds, 
                        null, 
                        ['class' => 'form-control', 'id' => 'referentprds']) !!}
                    </div>

                    <!-- "Alertes et vigilances PRD" du chantier -->
                    <div class="col-lg-8 form-group {!! $errors->has('alerteprd') ? 'has-error' : '' !!}">
                        <div class="label-title"><p>Alertes et vigilances :</p></div>
                        {!! Form::textarea('alerteprd', null, ['class' => 'form-control', 'placeholder' => 'Alertes et vigilances']) !!}
                        {!! $errors->first('alerteprd', '<small class="help-block">:message</small>') !!}
                    </div>

                    <div class="col-lg-4 form-group {!! $errors->has('date_mep') ? 'has-error' : '' !!}">
                        <div class="label-title"><p>Date de MEP :</p></div>
                        {!! Form::date('date_mep', null,  ['class' => 'form-control', 'id' => 'date_mep'] ); !!}
                        {!! $errors->first('date_mep', '<small class="help-block">:message</small>') !!}
                    </div>

                    <div class="col-lg-8">
                        <p>&nbsp;</p>
                    </div>

                    <div class="section-default-page-space">&nbsp;</div>
                    <div class="section-default-page-space">&nbsp;</div>

                    <h2 class="section-default-page-titre">Commentaires</h2>
                    <div class="section-default-page-border"></div>
                    <div class="section-default-page-space">&nbsp;</div>

                    <div class="col-lg-8 form-group {!! $errors->has('commentaire') ? 'has-error' : '' !!}">
                        <div class="label-title"><p>Commentaires: </p></div>
                        {!! Form::textarea('commentaire', null, ['class' => 'form-control', 'placeholder' => 'Commentaires']) !!}
                        {!! $errors->first('commentaire', '<small class="help-block">:message</small>') !!}
                    </div>

                </div>
            </div>

        </div>
    {!! Form::close() !!}
    </div>      

@endsection