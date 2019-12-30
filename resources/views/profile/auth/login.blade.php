<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Teacherudte Login</title>

  <!-- Custom fonts for this template-->
  <link href="/admin_assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="/admin_assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container" id="app">
    <error v-if="Error.visible" v-bind="Error"
    v-on:dismiss-error-modal="resetErrorModal()"></error>
    <success v-if="Success.visible" v-bind="Success"
    v-on:dismiss-success-modal="resetSuccesModal()"></success>
    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-6 d-none d-lg-block">
                    <img src="/admin_assets/img/undraw_posting_photo.svg"  height="200px" alt=""
                    style="margin-top:120px">
                </div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-2">Login </h1>
                    <p class="mb-4">
                        You can only login if you have registered
                    </p>
                  </div>
                  <form class="user">
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" name="user_email"
                      v-model="User.email" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" name="user_password"
                      v-model="User.password"  aria-describedby="emailHelp" placeholder="Enter Password...">
                    </div>
                    <a href="#" class="btn btn-primary btn-user btn-block"  @click.prevent="LoginUser"
                  :disabled="requestLoading" :class="{disabled: requestLoading}">
                        Log in 
                    </a>
                  </form>
                  <hr>
                  <div class="text-center">
                    {{-- <a class="small" href="register.html">Create an Account!</a> --}}
                  </div>
                  <div class="text-center">
                    {{-- <a class="small" href="login.html">Already have an account? Login!</a> --}}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="/admin_assets/vendor/jquery/jquery.min.js"></script>
  <script src="/admin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="/admin_assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="/admin_assets/js/sb-admin-2.min.js"></script>
  <script src="/js/login_config.js"></script>

</body>

</html>
