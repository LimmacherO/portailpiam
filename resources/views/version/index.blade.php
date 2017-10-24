@extends('layouts.app')

@section('link-roadmap-active')
    class="active"
@endsection

@section('page-header-title')
    Roadmap DSI
@endsection

@section('page-header-controls')

    <div class="btn-action-right"><a href="{!! url('version/create/1'); !!}" type="button" class="btn btn-default btn-primary pull-right"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Ajouter</a></div>
                    
    <div class="btn-action-right"><a href="{!! url('export/excel'); !!}" type="button" class="btn btn-default btn-cancel pull-right"><i class="fa fa-external-link-square" aria-hidden="true"></i>&nbsp;Exporter</a></div>

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
            <li class="active"><a href="{!! url('version'); !!}" aria-controls="home" role="tab"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;&nbsp;Liste des chantiers</a></li>
        </ul>
    </div>

@endsection

@section('content')

    <!-- Contenu de la page -->
    <div class="container-fluid tab-content clearfix">

        <div class="row tab-pane active">

            {!! Form::open(['url' => 'version', 'method' => 'get']) !!}
            
            <div class="col-lg-12">
                <div class="row section-default-page">      
                    <div class="col-lg-6">
                        <div class="row">
                            <p>&nbsp</p>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="row">
                            <div class="input-group">
                                {!! Form::text('search', $query_search, ['class' => 'form-control']) !!}
                                <span class="input-group-btn">
                                    <button class="btn btn-default btn-cancel" type="rechercher"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Rechercher</button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!} 

            <div class="col-lg-12">
                <div class="row section-default-page">

                    <div class="portail-table panel panel-primary">
                        <table class="table table-striped table-hover">
                             <thead>
                                <tr class="portail-table-header">
                                    <!--<th>Id</th>-->
                                    <th>Domaine</th>
                                    <th>@sortablelink('application.libelle','Application')</th>
                                    <th>@sortablelink('version')</th>
                                    <th>Product Dimensions</th>
                                    <th>@sortablelink('libelle','Libellé')</th>
                                    <th>@sortablelink('referentqi.nom','Référent QI')</th>
                                    <th>@sortablelink('inc_nblivtma','# liv. TMA')</th>
                                    <th>Avanc. QI</th>
                                    <th>QoS</th>
                                    <th>@sortablelink('date_mep','Date MEP')</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($versions as $version)
                                    <tr>

                                        <!-- Affichage du Domaine -->
                                        <td>{!! $version->application->domaine->libelle !!}</td>

                                        <!-- Affichage du Domaine -->
                                        <td>{!! $version->application->libelle !!}</td>

                                        <!-- Affichage du champ version -->
                                        <td>{!! $version->version !!}</td>

                                        <!-- Affichage du product Dimensions -->
                                        <td>{!! $version->product_dimensions !!}</td>

                                        <!-- Affichage du libellé de la version -->
                                        <td>{!! $version->libelle !!}</td>

                                        <!-- Affichage du nom et prénom du référent QI -->
                                        <td>{!! $version->referentqi->nom !!}&nbsp;{!! $version->referentqi->prenom !!}</td>

                                        <!-- Affichage du nombre de livraisons TMA -->
                                        <td><div class="center"><span class="badge">{!! $version->inc_nblivtma !!}</span></div></td>

                                        <td>{!! $version->avancementqi !!}&nbsp;%</td>

                                        <!-- Indicateur QoS -->
                                        <td><div class="center"> 
                                            @if( $version->qos == 1 )
                                                <span class="label label-success">
                                            @elseif( $version->qos == 9 )
                                                <span class="label label-danger">
                                            @else
                                                <span class="label label-warning">
                                            @endif
                                         {!! $version->qos !!}</span></div></td>

                                        <!-- Affichage de la date de mise en service -->
                                        <td>{{ \Carbon\Carbon::parse($version->date_mep)->format('d/m/Y')}}</td>
                                        
                                        <td>{!! Html::decode(link_to_route('version.show', '<i class="fa fa-search-plus"></i>', [$version->id], ['class' => 'small button'])) !!}</td>
                                        
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>

                    </div>

                    <!-- Pagination des données -->
                    {{ $versions->links() }}

                </div>
            </div>

        </div>
    </div>

@endsection
