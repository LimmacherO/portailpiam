@extends('layouts.app')

@section('link-roadmap-active')
    class="active"
@endsection


@section('content')

    {!! Form::open(['url' => 'version/search', 'method' => 'get', 'id' => 'search']) !!}

    <!-- En-tête page Web -->
    <div id="header" class="section-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Titre de la page Web -->
                    <h1>Roadmap DSI</h1>
                </div>

                <!-- Message d'information -->
                <div class="col-lg-12">
                    @if(session()->has('ok'))
                        <div class="alert alert-success">
                            {!! session('ok') !!}
                        </div>
                    @endif
                </div>

                <!-- Contrôles -->
                <div class="col-lg-12">

                    <div class="pull-right">

                        <a href="{!! url('version/create/1'); !!}" type="button" class="btn btn-default btn-primary pull-right"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Ajouter</a>

                        <a href="{!! url('export/excel'); !!}" type="button" class="btn btn-default btn-cancel pull-right"><i class="fa fa-external-link-square" aria-hidden="true"></i>&nbsp;Exporter</a>
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

                <div class="panel panel-default">

                    <!-- Contenu du panel -->
                    <div class="panel-body">

                        <div class="col-lg-12">
                            <div class="row section-default-page pull-right">

                                <div class="col-lg-1 col-lg-offset-6 form-group">
                                        {!! Form::select('paginationselect',
                                          array('5' => '5', '10' => '10', '20' => '20'),
                                          $paginationselect,
                                          ['class' => 'form-control', 'id' => 'paginationselect'])
                                        !!}
                                </div>

                                <div class="col-lg-5  input-group">
                                      {!! Form::text('search', $query_search, ['class' => 'form-control']) !!}
                                      <span class="input-group-btn">
                                          <button class="btn btn-default btn-cancel" type="rechercher" id="search"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Rechercher</button>
                                      </span>
                                </div>

                            </div>
                        </div>

                            <div class="col-lg-12">
                                <div class="row section-default-page">

                                    <div class="portail-table">
                                        <table id="chantiers" class="table">
                                             <thead>
                                                <tr class="portail-table-header">
                                                    <th>Domaine</th>
                                                    <th>@sortablelink('application.libelle','Application')</th>
                                                    <th>@sortablelink('version')</th>
                                                    <th>Product Dimensions</th>
                                                    <th>@sortablelink('libelle','Libellé')</th>
                                                    <th>@sortablelink('referentqi.nom','Référent QI')</th>
                                                    <th><div class="center">@sortablelink('inc_nblivtma','# liv. TMA')</div></th>
                                                    <th>Avanc. QI</th>
                                                    <th><div class="center">QoS</div></th>
                                                    <th><div class="center">Date MEP</div></th>
                                                    <th><div class="center">Etat</div></th>
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
                                                                    <div class="progress">
                                                                      <div class="progress-bar" role="progressbar" aria-valuenow="{!! $version->avancementqi !!}" aria-valuemin="0" aria-valuemax="100" style="width: {!! $version->avancementqi !!}%;">
                                                                          <span>{!! $version->avancementqi !!}&nbsp;%</span>
                                                                      </div>
                                                                    </div>
                                                                @else
                                                                    0 %
                                                                @endif
                                                            </div>
                                                        </td>

                                                        <!-- Indicateur QoS -->
                                                        <td><div class="center">
                                                            @if( $version->qos == 1 )
                                                                <span class="label label-success">{!! $version->qos !!}</span>
                                                            @elseif( $version->qos == 9 )
                                                                <span class="label label-danger">{!! $version->qos !!}</span>
                                                            @else
                                                                <span class="label label-warning">{!! $version->qos !!}</span>
                                                            @endif
                                                         </div></td>

                                                        <!-- Affichage de la date de mise en service -->
                                                        <td><div class="center">{{ \Carbon\Carbon::parse($version->date_mep)->format('d/m/Y') }}</div></td>

                                                        <!-- Etat de la version -->
                                                        <td>
                                                          <div class="center">
                                                            @if( $version->versionetat->libelle == "Prévue" )
                                                              <span class="label label-default label-prevue">{!! $version->versionetat->libelle !!}</span>
                                                            @elseif( $version->versionetat->libelle == "En cours" )
                                                              <span class="label label-default label-encours">{!! $version->versionetat->libelle !!}</span>
                                                            @elseif( $version->versionetat->libelle == "QI terminée" )
                                                                <span class="label label-default label-qiterminee">{!! $version->versionetat->libelle !!}</span>
                                                            @elseif( $version->versionetat->libelle == "Clos" )
                                                                <span class="label label-default label-clos">{!! $version->versionetat->libelle !!}</span>
                                                            @else
                                                              <span class="label label-default">{!! $version->versionetat->libelle !!}</span>
                                                            @endif
                                                          </div>
                                                        </td>

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

    {!! Form::close() !!}

@endsection

@section('scripts')

  <!-- Script permettant directement d'ouvrir la synthèse de la version lors d'un clic sur une ligne
    du tableau contenant la liste des chantiers -->
  <script>
    $(document).ready(function() {

      $('#chantiers tbody tr').click(function() {
          var href = $(this).find("a").attr("href");
          if(href) {
              window.location = href;
          }
      });

      $('#paginationselect').on('change', function () {
        $("#search").submit();
      });

    });


  </script>

@endsection
