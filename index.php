<!doctype html>

<html
  lang="en"
  class="light-style layout-wide customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="assets/"
  data-template="vertical-menu-template"
  data-style="light">                                                    
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Login | RiteBooks</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap"
      rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="assets/vendor/fonts/remixicon/remixicon.css" />
    <link rel="stylesheet" href="assets/vendor/fonts/flag-icons.css" />

    <!-- Menu waves for no-customizer fix -->
    <link rel="stylesheet" href="assets/vendor/libs/node-waves/node-waves.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="assets/vendor/libs/typeahead-js/typeahead.css" />
    <!-- Vendor -->
    <link rel="stylesheet" href="assets/vendor/libs/@form-validation/form-validation.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="assets/vendor/css/pages/page-auth.css" />

    <!-- Helpers -->
    <script src="assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="assets/vendor/js/template-customizer.js"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="assets/js/config.js"></script>
  </head>

  <body>
	
	
    <!-- Content -->

    <div class="authentication-wrapper authentication-cover">
      <!-- Logo -->
      <a href="index.php" class="auth-cover-brand d-flex align-items-center gap-2">
    <span class="app-brand-logo demo">
        <img src="/Admin2 - Copy/assets/images/logo/logo-1.svg" alt="Logo" style="height: 100px; width: 300px;">
    </span>
</a>
      <!-- /Logo -->
      <div class="authentication-inner row m-0">
        <!-- /Left Section -->
        <div class="d-none d-lg-flex col-lg-7 col-xl-8 align-items-center justify-content-center p-12 pb-2">
          <img
            src="assets/img/illustrations/auth-login-illustration-light.png"
            class="auth-cover-illustration w-100"
            alt="auth-illustration"
            data-app-light-img="illustrations/auth-login-illustration-light.png"
            data-app-dark-img="illustrations/auth-login-illustration-dark.png" />
          <img
            src="assets/img/illustrations/auth-cover-login-mask-light.png"
            class="authentication-image"
            alt="mask"
            data-app-light-img="illustrations/auth-cover-login-mask-light.png"
            data-app-dark-img="illustrations/auth-cover-login-mask-dark.png" />
        </div>
        <!-- /Left Section -->

        <!-- Login -->
        <div
          class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg position-relative py-sm-12 px-12 py-6">
          <div class="w-px-400 mx-auto pt-5 pt-lg-0">
            <h4 class="mb-1">Welcome to DJ Books! 👋</h4>
            <p class="mb-5">Please sign-in to your account and start the adventure</p>

            <form id="formAuthentication" class="mb-5" method="POST">
              <div class="form-floating form-floating-outline mb-5">
                <input
                  type="text"
                  class="form-control"
                  id="email"
                  name="email"
                  placeholder="Enter your email or username"
                  autofocus />
                <label for="email">Email or Username</label>
              </div>
              <div class="mb-5">
                <div class="form-password-toggle">
                  <div class="input-group input-group-merge">
                    <div class="form-floating form-floating-outline">
                      <input
                        type="password"
                        id="password"
                        class="form-control"
                        name="password"
                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                        aria-describedby="password" />
                      <label for="password">Password</label>
                    </div>
                    <span class="input-group-text cursor-pointer"><i class="ri-eye-off-line"></i></span>
                  </div>
                </div>
              </div>
              <div class="mb-5 d-flex justify-content-between mt-5">
                <div class="form-check mt-2">
                  <input class="form-check-input" type="checkbox" id="remember-me" />
                  <label class="form-check-label" for="remember-me"> Remember Me </label>
                </div>
                <a href="auth-forgot-password-cover.html" class="float-end mb-1 mt-2">
                  <span>Forgot Password?</span>
                </a>
              </div>
			  <div id="error-message" class="text-danger" style="display:none;"></div>
              <button type="submit" class="btn btn-primary d-grid w-100">Sign in</button>
            </form>

        <!--    <div class="divider my-5">
              <div class="divider-text">or</div>
            </div>

            <div class="d-flex justify-content-center gap-2">  <!-- social icons ->
              <a href="javascript:;" class="btn btn-icon rounded-circle btn-text-facebook">
                <i class="tf-icons ri-facebook-fill"></i>
              </a>

              <a href="javascript:;" class="btn btn-icon rounded-circle btn-text-twitter">
                <i class="tf-icons ri-twitter-fill"></i>
              </a>

              <a href="javascript:;" class="btn btn-icon rounded-circle btn-text-github">
                <i class="tf-icons ri-github-fill"></i>
              </a>

              <a href="javascript:;" class="btn btn-icon rounded-circle btn-text-google-plus">
                <i class="tf-icons ri-google-fill"></i>
              </a>
            </div>	social icons end			-->
          </div>
        </div>
        <!-- /Login -->
      </div>
    </div>

    <!-- / Content -->
	
	
	<?php include 'includes/footer.php'?>

   
    <!-- Vendors JS -->
    <script src="assets/vendor/libs/@form-validation/popular.js"></script>
    <script src="assets/vendor/libs/@form-validation/bootstrap5.js"></script>
    <script src="assets/vendor/libs/@form-validation/auto-focus.js"></script>

    <!-- Page JS -->
    <script src="assets/js/pages-auth.js"></script>
  </body>
</html>

<!--
<script defer>
    $(document).ready(function () {
        $('#formAuthentication').on('submit', function (e) {
            e.preventDefault(); // Prevent default form submission

            console.log('Form submission intercepted.');

            const email = $('#email').val();
            const password = $('#password').val();

            $('#error-message').hide().text('');

            $.ajax({
                url: 'LoginCheck.php',
                type: 'POST',
                data: { email: email, password: password },
                dataType: 'json',
                success: function (response) {
                    console.log('AJAX success:', response);
                    if (response.status === 'error') {
                        $('#error-message').text(response.message).show();
                    } else if (response.status === 'success') {
                        window.location.href = response.redirect;
                    }
                },
                error: function (xhr, status, error) {
                    console.error('AJAX error:', status, error);
                    $('#error-message').text('An unexpected error occurred. Please try again.').show();
                }
            });
        });
    });
</script>
!-->