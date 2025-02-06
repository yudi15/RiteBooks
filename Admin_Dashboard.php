<?php
session_start();
require 'db_connection.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit();
}

$admin_id = $_SESSION['admin_id'];


// Fetch admin name
$stmt = $conn->prepare("SELECT email FROM admins WHERE id = ?");
$stmt->bind_param('i', $admin_id);
$stmt->execute();
$stmt->bind_result($admin_email);
$stmt->fetch();
$stmt->close();

// Update admin's last activity
function updateLastActivity($admin_id, $conn) {
    $stmt = $conn->prepare("UPDATE admins SET last_activity = NOW() WHERE id = ?");
    $stmt->bind_param('i', $admin_id);
    $stmt->execute();
    $stmt->close();
}

updateLastActivity($admin_id, $conn);
?>

<!doctype html>

<html
  lang="en"
  class="light-style layout-navbar-fixed layout-menu-fixed layout-compact"
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

    <title>Admin Dashboard</title>

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
    <link rel="stylesheet" href="assets/vendor/libs/apex-charts/apex-charts.css" />
    <link rel="stylesheet" href="assets/vendor/libs/swiper/swiper.css" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="assets/vendor/css/pages/cards-statistics.css" />
    <link rel="stylesheet" href="assets/vendor/css/pages/cards-analytics.css" />

    <!-- Helpers -->
    <script src="assets/vendor/js/helpers.js"></script>
    
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="assets/vendor/js/template-customizer.js"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="assets/js/config.js"></script>
  </head>

  <body>
   <?php include 'includes/sidebar.php'; ?>
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row g-6">
                <!-- Gamification Card -->
                <div class="col-md-12 col-xxl-8">
    <div class="card">
        <div class="d-flex align-items-end row">
            <div class="col-md-6 order-2 order-md-1">
                <div class="card-body">
                    <h4 class="card-title mb-4">Congratulations <span class="fw-bold"><?php echo htmlspecialchars($admin_email); ?>!</span> 🎉</h4>
                    <p class="mb-0">You have done 68% 😎 more sales today.</p>
                    <p>Check your new badge in your profile.</p>
                    <a href="javascript:;" class="btn btn-primary">View Profile</a>
                </div>
            </div>
            <div class="col-md-6 text-center text-md-end order-1 order-md-2">
                <div class="card-body pb-0 px-0 pt-2">
                    <img
                        src="assets/img/illustrations/illustration-john-light.png"
                        height="186"
                        class="scaleX-n1-rtl"
                        alt="View Profile"
                        data-app-light-img="illustrations/illustration-john-light.png"
                        data-app-dark-img="illustrations/illustration-john-dark.png" />
                </div>
            </div>
        </div>
    </div>
</div>

                <!--/ Gamification Card -->


           
               
                <!-- Sales Country Chart -->
                <div class="col-12 col-xxl-4 col-md-6">
                  <div class="card h-100">
                    <div class="card-header">
                      <div class="d-flex justify-content-between">
                        <h5 class="mb-1">Sales Country</h5>
                        <div class="dropdown">
                          <button
                            class="btn btn-text-secondary rounded-pill text-muted border-0 p-1"
                            type="button"
                            id="salesCountryDropdown"
                            data-bs-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false">
                            <i class="ri-more-2-line ri-20px"></i>
                          </button>
                          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="salesCountryDropdown">
                            <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                            <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                            <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                          </div>
                        </div>
                      </div>
                      <p class="mb-0 card-subtitle">Total $42,580 Sales</p>
                    </div>
                    <div class="card-body pb-1 px-0">
                      <div id="salesCountryChart"></div>
                    </div>
                  </div>
                </div>
                <!--/ Sales Country Chart -->
              </div>
            </div>
            <!-- / Content -->

		<?php include 'includes/footer.php'; ?>
            

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
    
	<input type="hidden" id="userType" value="<?= htmlspecialchars($_SESSION['user_type'] ?? ''); ?>">
    <input type="hidden" id="loggedInUserId" value="<?= htmlspecialchars($_SESSION['admin_id'] ?? $_SESSION['user_id'] ?? ''); ?>">

    

    <!-- Vendors JS -->
    <script src="assets/vendor/libs/apex-charts/apexcharts.js"></script>
    <script src="assets/vendor/libs/swiper/swiper.js"></script>

    <!-- Main JS -->
	<script src="assets/js/notify.js"></script>

    <!-- Page JS -->
    <script src="assets/js/dashboards-analytics.js"></script>
  </body>
</html>
