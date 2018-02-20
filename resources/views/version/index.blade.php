@extends('layouts.app')

@section('content')

    {!! Form::open(['url' => 'version/search', 'method' => 'get', 'id' => 'search']) !!}

    <!-- En-tête page -->
    <div id="header" class="container-fluid section-header">
        <div class="row">
            <div class="col-lg-12">

                <!-- Titre de la page Web -->
        				<h1 class="text-left">Roadmap DSI</h1>

        				<!-- Button pour ajouter/créer une nouvelle version -->
        				<button id="ajouter" type="button" type="submit" class="btn btn-outline-primary float-right btn-sm" onclick="location.href = '{!! url('version/create/1'); !!}';">
        					<i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Ajouter
        				</button>

                <!-- Button pour exporter la roadmap -->
        				<button id="exporter" type="button" type="submit" class="btn btn-outline-primary float-right btn-sm btn-margin-right" onclick="location.href = '{!! url('export/excel'); !!}';">
        					<i class="fa fa-file-excel-o" aria-hidden="true"></i>&nbsp;Exporter
        				</button>

                <!-- On cache l'URL pour qu'elle ne soit pas accessible -->
                <!--<a href="{!! url('import/roadmap/index'); !!}" type="button" class="btn btn-default btn-cancel pull-right"><i class="fa fa-arrow-circle-o-down" aria-hidden="true"></i>&nbsp;Importer</a> -->

            </div>

        </div>
    </div>

    <!-- Affichage du message d'information (SUCCESS, etc.) -->
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
            @if(session()->has('ok'))
              <div class="alert alert-success">
                  {!! session('ok') !!}
              </div>
            @endif
        </div>
      </div>
    </div>

    <!-- Afichage du contenu de la page -->
    <div class="container-fluid">
            <div class="row">

              <div class="col-lg-12">

                <!-- Contenu du panel -->
                <div class="card">

                  <!-- Titre du panel -->
                  <div class="card-header">Liste des chantiers</div>

                  <div class="card-body">

                    <!-- Critères de filtrage de la liste -->
                    <div class="col-lg-12">
                      <div class="row">

                        <!-- Liste des référents QI -->
                        <div>
                          <label for="referentqisselect">Référent QI:&nbsp;</label>
                          {!! Form::select('referentqisselect',
                              $referentqis_array,
                              $referentqisselect,
                              ['class' => 'form-control', 'id' => 'referentqisselect']) !!}
                        </div>

                        <!-- Liste déroulante pour sélection du nombre de chantiers à afficher -->
                        <div class="ml-3">
                          <label for="paginationselect">Nombre de résultats:&nbsp;</label>
                          {!! Form::select('paginationselect',
                                array('Tous' => 'Tous', '10' => '10', '20' => '20'),
                                $paginationselect,
                                ['class' => 'form-control', 'id' => 'paginationselect'])
                              !!}
                        </div>

                      </div>
                    </div>

                    <!-- Affichage du tableau contenant les chantiers de la Roadmap -->
                    <div class="col-lg-12">
                        <div class="row">

                                <table id="chantiers" class="table table-striped">

                                    <!-- En-tête du tableau -->
                                     <thead>
                                        <tr>
                                            <th class="align-middle">Domaine</th>
                                            <th class="align-middle">Application</th>
                                            <th class="align-middle">@sortablelink('version', 'Version')</th>
                                            <th class="align-middle">@sortablelink('libelle','Libellé')</th>
                                            <th class="align-middle">@sortablelink('referentqi.nom','Référent QI')</th>
                                            <th class="align-middle"><div class="center">@sortablelink('inc_nblivtma','Nb liv. TMA')</div></th>
                                            <th class="align-middle">Avanc. QI</th>
                                            <th class="align-middle"><div class="center">@sortablelink('qos','QoS')</div></th>
                                            <th class="align-middle"><div class="center">Date prév. MES</div></th>
                                            <th class="align-middle"><div class="center">Etat</div></th>
                                            <th>&nbsp;</th> <!-- Espace pour bouton "Consulter" -->
                                        </tr>
                                    </thead>

                                    <!-- Contenu du tableau -->
                                    <tbody>
                                        @foreach ($versions as $version)
                                            <tr>

                                                <!-- Affichage du Domaine -->
                                                <td><span class="align-middle">{!! $version->application->domaine->libelle !!}</span></td>

                                                <!-- Affichage du Domaine -->
                                                <td><span class="align-middle">{!! $version->application->libelle !!}</span></td>

                                                <!-- Affichage du champ version -->
                                                <td>{!! $version->version !!}</td>

                                                <!-- Affichage du libellé de la version -->
                                                <td>{!! $version->libelle !!}</td>

                                                <!-- Affichage du nom et prénom du référent QI -->
                                                <td>{!! $version->referentqi->nom !!}&nbsp;{!! $version->referentqi->prenom !!}</td>

                                                <!-- Affichage du nombre de livraisons TMA -->
                                                <td><div class="center"><span class="badge badge-secondary">{!! $version->inc_nblivtma !!}</span></div></td>

                                                <!-- Affichage de l'avancement QI -->
                                                <td><div class="center align-middle">
                                                      <div class="progress position-relative">
														<div class="justify-content-center d-flex position-absolute w-100 progress-text">{!! $version->avancementqi !!}&nbsp;%</div>
                                                        <div class="progress-bar" role="progressbar" style="width: {!! $version->avancementqi !!}%" aria-valuenow="{!! $version->avancementqi !!}" aria-valuemin="0" aria-valuemax="100"></div>
                                                      </div>
                                                    </div>
                                                </td>

                                                <!-- Indicateur QoS -->
                                                <td><div class="center">
                                                    @if( $version->qos == 1 )
                                                        <span class="badge badge-success">{!! $version->qos !!}</span>
                                                    @elseif( $version->qos == 9 )
                                                        <span class="badge badge-danger">{!! $version->qos !!}</span>
                                                    @else
                                                        <span class="badge badge-warning">{!! $version->qos !!}</span>
                                                    @endif
                                                 </div></td>

                                                <!-- Affichage de la date de mise en service prévisionnelle -->
                                                <td><div class="center">{{ App\Version::getDateJalonByString($version, '7', 'Date prévisionnelle de MES') }}</div></td>

                                                <!-- Etat de la version -->
                                                <td>
                                                  <div class="center">
                                                    @if( $version->versionetat->libelle == "Prévue" )
                                                      <span class="badge badge-secondary label-prevue">{!! $version->versionetat->libelle !!}</span>
                                                    @elseif( $version->versionetat->libelle == "En cours" )
                                                      <span class="badge badge-secondary label-encours">{!! $version->versionetat->libelle !!}</span>
                                                    @elseif( $version->versionetat->libelle == "QI terminée" )
                                                        <span class="badge badge-secondary label-qiterminee">{!! $version->versionetat->libelle !!}</span>
                                                    @elseif( $version->versionetat->libelle == "Clos" )
                                                        <span class="badge badge-secondary label-clos">{!! $version->versionetat->libelle !!}</span>
                                                    @else
                                                      <span class="badge badge-secondary">{!! $version->versionetat->libelle !!}</span>
                                                    @endif
                                                  </div>
                                                </td>

                                                <td>
                                                  <button type="button" class="btn btn-outline-secondary btn-sm" onclick="location.href = '{!! url('version', $version->id); !!}';">
                																		<i class="fa fa-search-plus"></i>&nbsp;Consulter
                																	</button>

                                                  <!-- Lien Web identique au boutton - Utilisé pour le javascript click sur la ligne -->
                                                  <a href="{!! url('version', $version->id); !!}" style="display: none;">Consulter</a>
                                                </td>

                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>

                            </div>

                            <!-- Pagination des données -->
                            {{ $versions->links('vendor.pagination.bootstrap-4') }}

                        </div>

                  </div>
              </div>

            </div>

        </div>
    </div>

    {!! Form::close() !!}

@endsection

@section('scripts')

  <script>

    $(document).ready(function() {

      //Script permettant directement d'ouvrir la synthèse de la version lors d'un clic sur une ligne
      // du tableau contenant la liste des chantiers
      $('#chantiers tbody tr').click(function() {
          console.log('Click...');
          var href = $(this).find("a").attr("href");
          console.log(href);
          if(href) {

              window.location = href;
          }
      });

      $('#paginationselect').on('change', function () {
        $("#search").submit();
      });

      $('#referentqisselect').on('change', function () {
        $("#search").submit();
      });

    });

  </script>

@endsection
