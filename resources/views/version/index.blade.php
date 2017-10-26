@extends('layouts.app')

@section('link-roadmap-active')
    class="active"
@endsection

@section('content')

    <!-- En-tête - sous forme de Navbar fixe en haut de la page -->
    <nav class="navbar navbar-default navbar-fixed-top section-header">
        <div class="container-fluid">
            <div class="row container-noborder">
                
                <div class="col-lg-12">
                    <h1>Roadmap DSI</h1>
                </div>

                <div class="col-lg-12 container-noborder">
                    <div class="row container-fluid tab_line tab_line-btn">
                        <div class="btn-action-right"><a href="{!! url('version/create/1'); !!}" type="button" class="btn btn-default btn-primary pull-right"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Ajouter</a></div>
                    
                        <div class="btn-action-right"><a href="{!! url('export/excel'); !!}" type="button" class="btn btn-default btn-cancel pull-right"><i class="fa fa-external-link-square" aria-hidden="true"></i>&nbsp;Exporter</a></div>
                    </div>
                </div>

            </div>
        </div>
    </nav>

    <!-- Afichage du contenu de la page -->
    <div class="container-fluid section-content">
        <div class="row">

            <div class="col-lg-12">
                @if(session()->has('ok'))
                    <div class="alert alert-success alert-dismissible">
                        {!! session('ok') !!}
                    </div>
                @endif
            </div>

            <div class="col-sm-12 col-lg-12">
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
                                                <th>Domaine</th>
                                                <th>@sortablelink('application.libelle','Application')</th>
                                                <th>@sortablelink('version')</th>
                                                <th>Product Dimensions</th>
                                                <th>@sortablelink('libelle','Libellé')</th>
                                                <th>@sortablelink('referentqi.nom','Référent QI')</th>
                                                <th>@sortablelink('inc_nblivtma','# liv. TMA')</th>
                                                <th>Avanc. QI</th>
                                                <th>QoS</th>
                                                <th>Date MEP</th>
                                                <th>&nbsp;</th>
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

                                                    <td><div class="center">
                                                            @if( $version->avancementqi > 0)
                                                                {!! $version->avancementqi !!}&nbsp;%
                                                            @else
                                                                0 %
                                                            @endif
                                                        </div>
                                                    </td>

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
            </div>
        </div>
    </div>

@endsection
