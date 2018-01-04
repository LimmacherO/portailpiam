@extends('layouts.app')

@section('link-roadmap-active')
    class="active"
@endsection

@section('content')

    <!-- En-tête page Web -->
    <div id="header" class="section-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Titre de la page Web -->
                    <h1>Import de la Roadmap DQI PIAM</h1>
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
                      <a href="{!! url('version'); !!}" type="button" class="btn btn-default btn-cancel pull-right"><i class="fa fa-undo" aria-hidden="true"></i>&nbsp;Annuler</a>
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
                            <div class="row section-default-page">

                                <div class="col-lg-12 form-group">

                                  <form action="{{ URL::to('import/roadmap/importexcel') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <input type="file" name="import_file" />
                                  			<button class="btn btn-primary">Importer la roadmap</button>
                                  		</form>

                                </div>

                            </div>
                        </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>



@endsection
