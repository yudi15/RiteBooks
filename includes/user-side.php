<script src="/Admin2 - Copy/assets/js/notify.js"></script>
<input type="hidden" id="userType" value="<?= htmlspecialchars($_SESSION['user_type'] ?? ''); ?>">
    <input type="hidden" id="loggedInUserId" value="<?= htmlspecialchars($_SESSION['admin_id'] ?? $_SESSION['user_id'] ?? ''); ?>">

<?php
require_once __DIR__ . '/../db_connection.php';

// Start session only if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (!isset($_SESSION['user_id'])) {
    header('Location: index.php'); // Redirect to login if not signed in
    exit;
}
$user_id = $_SESSION['user_id']; // Get logged-in admin ID

$sql = "SELECT first_name, last_name FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$userResult = $stmt->get_result();

if ($userResult->num_rows > 0) {
    $user = $userResult->fetch_assoc();
    $fullName = $user['first_name'] . ' ' . $user['last_name'];
	$role='User';
} else {
    $fullName = "Unknown User";
}

?>

   
<!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
			<div class="app-brand demo" style="padding-top: 15px;">
				<a class="logo-2" href="/Admin2 - Copy/User/user_dashboard.php"><img class="img-fluid" src="/Admin2 - Copy/assets/images/logo/logo-1.svg" alt="Logo"></a>    

				<a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
				  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path
					  d="M8.47365 11.7183C8.11707 12.0749 8.11707 12.6531 8.47365 13.0097L12.071 16.607C12.4615 16.9975 12.4615 17.6305 12.071 18.021C11.6805 18.4115 11.0475 18.4115 10.657 18.021L5.83009 13.1941C5.37164 12.7356 5.37164 11.9924 5.83009 11.5339L10.657 6.707C11.0475 6.31653 11.6805 6.31653 12.071 6.707C12.4615 7.09747 12.4615 7.73053 12.071 8.121L8.47365 11.7183Z"
					  fill-opacity="0.9" />
					<path
					  d="M14.3584 11.8336C14.0654 12.1266 14.0654 12.6014 14.3584 12.8944L18.071 16.607C18.4615 16.9975 18.4615 17.6305 18.071 18.021C17.6805 18.4115 17.0475 18.4115 16.657 18.021L11.6819 13.0459C11.3053 12.6693 11.3053 12.0587 11.6819 11.6821L16.657 6.707C17.0475 6.31653 17.6805 6.31653 18.071 6.707C18.4615 7.09747 18.4615 7.73053 18.071 8.121L14.3584 11.8336Z"
					  fill-opacity="0.4" />
				  </svg>
				</a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Apps & Pages -->
            <li class="menu-header mt-5">
              <span class="menu-header-text" data-i18n="Apps & Pages">Apps &amp; Pages</span>
            </li>
			 <li class="menu-item">
              <a href="/Admin2 - Copy/User/add_project_user.php" class="menu-link">
                <i class="menu-icon tf-icons ri-mail-open-line"></i>
                <div data-i18n="Assign New Project">Assign New Project</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="/Admin2 - Copy/projects.php" class="menu-link">
                <i class="menu-icon tf-icons ri-mail-open-line"></i>
                <div data-i18n="Projects">Projects</div>
              </a>
            </li>
			
		</ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar">
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
                <i class="ri-menu-fill ri-22px"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item navbar-search-wrapper mb-0">
                  <a class="nav-item nav-link search-toggler fw-normal px-0" href="javascript:void(0);">
                    <i class="ri-search-line ri-22px scaleX-n1-rtl me-3"></i>
                    <span class="d-none d-md-inline-block text-muted">Search (Ctrl+/)</span>
                  </a>
                </div>
              </div>
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">

                <!-- Style Switcher -->
                <li class="nav-item dropdown-style-switcher dropdown me-1 me-xl-0">
                  <a
                    class="nav-link btn btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow"
                    href="javascript:void(0);"
                    data-bs-toggle="dropdown">
                    <i class="ri-22px"></i>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
                    <li>
                      <a class="dropdown-item" href="javascript:void(0);" data-theme="light">
                        <span class="align-middle"><i class="ri-sun-line ri-22px me-3"></i>Light</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
                        <span class="align-middle"><i class="ri-moon-clear-line ri-22px me-3"></i>Dark</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="javascript:void(0);" data-theme="system">
                        <span class="align-middle"><i class="ri-computer-line ri-22px me-3"></i>System</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!-- / Style Switcher-->

                <!-- Notification -->
                <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-4 me-xl-1">
    <a
        class="nav-link btn btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow"
        href="javascript:void(0);"
        data-bs-toggle="dropdown"
        data-bs-auto-close="outside"
        aria-expanded="false">
        <i class="ri-notification-2-line ri-22px"></i>
        <span
            class="position-absolute top-0 start-50 translate-middle-y badge badge-dot bg-danger mt-2 border"></span>
    </a>
    <ul class="dropdown-menu dropdown-menu-end py-0">
        <li class="dropdown-menu-header border-bottom py-50">
            <div class="dropdown-header d-flex align-items-center py-2">
                <h6 class="mb-0 me-auto">Notifications</h6>
                <div class="d-flex align-items-center">
                    <span class="badge rounded-pill bg-label-primary fs-xsmall me-2" id="notification-count">0</span>
                    <a
                        href="javascript:void(0)"
                        class="btn btn-text-secondary rounded-pill btn-icon dropdown-notifications-all"
                        title="Mark all as read">
                        <i class="ri-mail-open-line text-heading ri-20px"></i>
                    </a>
                </div>
            </div>
        </li>
        <li class="dropdown-notifications-list scrollable-container">
            <ul class="list-group list-group-flush" id="notifications-list">
                <li class="list-group-item text-center">
                    <small>No new notifications</small>
                </li>
            </ul>
        </li>
        <li class="border-top">
            <div class="d-grid p-4">
                <a class="btn btn-primary btn-sm d-flex" href="javascript:void(0);">
                    <small class="align-middle">View all notifications</small>
                </a>
            </div>
        </li>
    </ul>
</li>
 <!--/ Notification -->

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="/Admin2 - Copy/assets/img/avatars/1.png" alt class="rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
    <a class="dropdown-item" href="pages-account-settings-account.html">
        <div class="d-flex">
            <div class="flex-shrink-0 me-2">
                <div class="avatar avatar-online">
                    <img src="/Admin2 - Copy/assets/img/avatars/1.png" alt class="rounded-circle" />
                </div>
            </div>
            <div class="flex-grow-1">
                <span class="fw-medium d-block small"><?php echo htmlspecialchars($fullName); ?></span>
                <small class="text-muted"><?php echo htmlspecialchars($role); ?></small>
            </div>
        </div>
    </a>
</li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="pages-profile-user.html">
                        <i class="ri-user-3-line ri-22px me-3"></i><span class="align-middle">My Profile</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="pages-account-settings-account.html">
                        <i class="ri-settings-4-line ri-22px me-3"></i><span class="align-middle">Settings</span>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                      <div class="d-grid px-4 pt-2 pb-1">
                        <a id="logoutButton" class="btn btn-sm btn-danger d-flex" href="auth-login-cover.html" target="_blank">
                          <small class="align-middle">Logout</small>
                          <i class="ri-logout-box-r-line ms-2 ri-16px"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>

            <!-- Search Small Screens -->
            <div class="navbar-search-wrapper search-input-wrapper d-none">
              <input
                type="text"
                class="form-control search-input container-xxl border-0"
                placeholder="Search..."
                aria-label="Search..." />
              <i class="ri-close-fill search-toggler cursor-pointer"></i>
            </div>
          </nav>

          <!-- / Navbar -->
		  
<script>
		  document.getElementById('logoutButton').addEventListener('click', function() {
			  // Confirm logout action
		  const confirmLogout = confirm('Are you sure you want to log out?');
		  if (confirmLogout) {
			  // Redirect to the logout.php script
			window.location.href = '/Admin2 - Copy/logout.php';
    }
});
</script>
<script src="/Admin2 - Copy/assets/js/notify.js"></script>