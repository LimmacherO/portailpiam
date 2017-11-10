<!-- En-tête - sous forme de Navbar fixe en haut de la page -->
    <nav class="navbar navbar-default navbar-fixed-top section-header">
        <div class="container-fluid">
            <div class="row container-noborder">
                
                <div class="col-lg-12">
                    <h1>Chantier "{{ $version->libelle }}"</h1>
                </div>

                <div class="col-lg-6 container-noborder">
                    <div class="row container-fluid tab_line">
                    	<div>
						    <ul class="nav nav-tabs" role="tablist">

						    	<!-- Lien vers la synthèse de la version -->
						        <li class="active"><a href="{!! url('version',$version->id); !!}" aria-controls="home" role="tab"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;Synthèse Version</a></li>

						        <!-- Lien vers le planning -->
						        <li><a href="{!! url('taches', $version->id); !!}" aria-controls="home" role="tab"><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp;Planning</a></li>

						    </ul>
						</div>
                    </div>
                </div>

                <div class="col-lg-6 container-noborder">
                    <div class="row container-fluid tab_line tab_line-btn">



                    </div>
                </div>

            </div>
        </div>
    </nav>