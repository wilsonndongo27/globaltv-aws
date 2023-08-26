<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta name="description" content="Global TV Analytics Center.">
    <meta name="keywords" content="Analytics Global TV">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Global TV | Analytics | Login</title>
    <link rel="icon" type="image/png" sizes="100x100" href="{{ asset ('images/logo.png') }}">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="{{ asset ('auth/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset ('auth/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset ('auth/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset ('auth/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset ('auth/css/toastr.min.css') }}">
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100 m-0">
          <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
            <div class="card col-lg-4 mx-auto blocklogininterface">
              <div class="card-body px-5 py-5">
                <h3 class="card-title text-left mb-3">{{ __('Global TV Admin') }}</h3>
                <form id="LoginSubmit" method="post" enctype="multipart/form-data"  action="{{ route('adminauth')}}">
                  @csrf
                  <div class="form-group">
                    <label>{{ __('Votre adresse email') }} <span>*</span></label>
                    <input type="email" name="email" class="form-control p_input" placeholder="Adresse email">
                  </div>
                  <div class="form-group">
                    <label>{{ __('Votre mot de passe') }} <span>*</span></label>
                    <input type="password" name="password" class="form-control p_input" placeholder="Mot de passe">
                  </div>
                  <div class="form-group d-flex align-items-center justify-content-between">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input"> Se souvenir de moi </label>
                    </div>
                    <a href="#" class="forgot-pass">Mot de passe oublié</a>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-block enter-btn adminloginbtn">{{ __('Connexion') }}</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- row ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <script src="{{ asset ('auth/js/jquery.min.js') }}"></script>
    <script src="{{ asset ('auth/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset ('auth/js/script.js') }}"></script>
    <script src="{{ asset ('auth/js/toastr.min.js') }}"></script>
  </body>
</html>