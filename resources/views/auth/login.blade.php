<!doctype html>
<html lang="{{ app()->getLocale() }}">

<!-- En-tête - header -->
<head>
  <meta charset="UTF-8">

  <title>Authentification portial PIAM</title>

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Import - Bootstrap -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>

<body class="bg-dark">

  <div class="container py-5">
      <div class="row">
          <div class="col-md-12">
              <div class="row">
                  <div class="col-md-6 mx-auto">

                      <!-- form card login -->
                      <div class="card rounded-1">
                          <div class="card-header">
                              <h3 class="mb-0">Authentification</h3>
                          </div>
                          <div class="card-body">

                              <form action="{{ route('login') }}" method="POST" class="form" role="form" autocomplete="off" id="formLogin">
                                  {{ csrf_field() }}

                                  <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                      <label for="username">Identifiant</label>
                                      <input class="form-control form-control-lg rounded-0" id="username" name="username" required autofocus>
                                      @if ($errors->has('username'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('username') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                                  <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                      <label for="password">Mot de passe</label>
                                      <input type="password" class="form-control form-control-lg rounded-0" id="password"  name="password" required>
                                      @if ($errors->has('password'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('password') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                                  <button id="connexion" type="button" type="submit" class="btn btn-success float-right">Se connecter</button>
                              </form>
                          </div>
                          <!--/card-block-->
                      </div>
                      <!-- /form card login -->

                  </div>

              </div>
              <!--/row-->

          </div>
          <!--/col-->
      </div>
      <!--/row-->
  </div>
  <!--/container-->

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  <script type="text/javascript">

      $(document).ready(function(){
         //On cache le bouton de validation pour éviter les créations en double
         $('#connexion').click(function () {
             $('#connexion').attr('disabled', true);
             $('#formLogin').submit();
             return true;
         });

      });
   </script>

</body>

</html>
