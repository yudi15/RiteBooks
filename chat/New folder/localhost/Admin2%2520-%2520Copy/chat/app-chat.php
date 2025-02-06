

<!doctype html>

<html
  lang="en"
  class="light-style layout-navbar-fixed layout-menu-fixed layout-compact"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template"
  data-style="light">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Rite-Books---Chat</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap"
      rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="../assets/vendor/fonts/remixicon/remixicon.css" />
    <link rel="stylesheet" href="../assets/vendor/fonts/flag-icons.css" />

    <!-- Menu waves for no-customizer fix -->
    <link rel="stylesheet" href="../assets/vendor/libs/node-waves/node-waves.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="../assets/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="../assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.css" />

    <!-- Page CSS -->

    <link rel="stylesheet" href="../assets/vendor/css/pages/app-chat.css" />

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="../assets/vendor/js/template-customizer.js"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
	
	
	<style>
	
	/* Specific styling for links inside .message-right */
	
	.chat-message-right a {
	
		
		color: darkturquoise !important; /* Adjust text color for contrast */
	
	}
	
	/* Hover effect for better feedback */
	.chat-message-right a:hover {
		
		background-color: blue; /* Highlight color */
		color: cyan; /* Invert text color for better visibility */
}



.progress-bar {
    height: 40px;
    background-color: #4CAF50;
    transition: width 0.3s ease;
}

.progress{
	height: 40px;
    background-color: #4CAF50;
    transition: width 0.3s ease;
	
}

/* Toast Container */
.toast {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: rgba(0, 0, 0, 0.85);
    color: white;
    padding: 15px 25px;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 500;
    text-align: center;
    z-index: 1000;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
    opacity: 0;
    transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out;
}

/* Show animation */
.toast.show {
    opacity: 1;
    transform: translate(-50%, -50%) scale(1);
}

/* Success Style */
.toast-success {
    background: #4CAF50; /* Green */
}

/* Error Style */
.toast-error {
    background: #F44336; /* Red */
}

/* Fade Out Effect */
.toast.hide {
    opacity: 0;
    transform: translate(-50%, -50%) scale(0.9);
}


	</style>
	
  </head>

  <body>
<script src="/Admin2 - Copy/assets/js/notify.js"></script>

   <input type="hidden" id="userType" value="admin">
    <input type="hidden" id="loggedInUserId" value="1">

<!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme" style= "padding-top: 10px;">
			<div class="app-brand demo" style="padding-top: 15px;">
				<a class="logo-2" href="/Admin2 - Copy/Admin_Dashboard.php"><img class="img-fluid" src="/Admin2 - Copy/assets/images/logo/logo-1.svg" alt="Logo"></a> 

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
              <a href="/Admin2 - Copy/add_user.php" class="menu-link">
                <i class="menu-icon tf-icons ri-mail-open-line"></i>
                <div data-i18n="Add User">Add USER</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="/Admin2 - Copy/clients.php" class="menu-link">
                <i class="menu-icon tf-icons ri-drag-drop-line"></i>
                <div data-i18n="Clients">Clients</div>
              </a>
            </li>
			
			 <li class="menu-item">
              <a href="/Admin2 - Copy/Announce/announcements.php" class="menu-link">
                <i class="menu-icon tf-icons ri-calendar-line"></i>
                <div data-i18n="Website Announcements">Website Announcements</div>
              </a>
            </li>
			
            
            <li class="menu-item">
              <a href="/Admin2 - Copy/meetings.php" class="menu-link">
                <i class="menu-icon tf-icons ri-shopping-bag-3-line"></i>
                <div data-i18n="Meeting with Clients">Meeting with Clients</div>
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
                <!-- Language -->
                <li class="nav-item dropdown-language dropdown">
                  <a
                    class="nav-link btn btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow"
                    href="javascript:void(0);"
                    data-bs-toggle="dropdown">
                    <i class="ri-translate-2 ri-22px"></i>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="javascript:void(0);" data-language="en" data-text-direction="ltr">
                        <span class="align-middle">English</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ Language -->

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

                <!-- Quick links  -->
                <li class="nav-item dropdown-shortcuts navbar-dropdown dropdown me-1 me-xl-0">
                  <a
                    class="nav-link btn btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow"
                    href="javascript:void(0);"
                    data-bs-toggle="dropdown"
                    data-bs-auto-close="outside"
                    aria-expanded="false">
                    <i class="ri-star-smile-line ri-22px"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-end py-0">
                    <div class="dropdown-menu-header border-bottom py-50">
                      <div class="dropdown-header d-flex align-items-center py-2">
                        <h6 class="mb-0 me-auto">Shortcuts</h6>
                        <a
                          href="javascript:void(0)"
                          class="btn btn-text-secondary rounded-pill btn-icon dropdown-shortcuts-add text-heading"
                          data-bs-toggle="tooltip"
                          data-bs-placement="top"
                          title="Add shortcuts"
                          ><i class="ri-add-line ri-24px"></i
                        ></a>
                      </div>
                    </div>
                    <div class="dropdown-shortcuts-list scrollable-container">
                      <div class="row row-bordered overflow-visible g-0">
                        <div class="dropdown-shortcuts-item col">
                          <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                            <i class="ri-calendar-line ri-26px text-heading"></i>
                          </span>
                          <a href="app-calendar.html" class="stretched-link">Calendar</a>
                          <small class="mb-0">Appointments</small>
                        </div>
                        <div class="dropdown-shortcuts-item col">
                          <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                            <i class="ri-file-text-line ri-26px text-heading"></i>
                          </span>
                          <a href="app-invoice-list.html" class="stretched-link">Invoice App</a>
                          <small class="mb-0">Manage Accounts</small>
                        </div>
                      </div>
                      <div class="row row-bordered overflow-visible g-0">
                        <div class="dropdown-shortcuts-item col">
                          <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                            <i class="ri-pie-chart-2-line ri-26px text-heading"></i>
                          </span>
                          <a href="index.html" class="stretched-link">Dashboard</a>
                          <small class="mb-0">Analytics</small>
                        </div>
                        <div class="dropdown-shortcuts-item col">
                          <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                            <i class="ri-settings-4-line ri-26px text-heading"></i>
                          </span>
                          <a href="pages-account-settings-account.html" class="stretched-link">Setting</a>
                          <small class="mb-0">Account Settings</small>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                <!-- Quick links -->

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
                            <span class="fw-medium d-block small">John Doe</span>
                            <small class="text-muted">Admin</small>
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
                      <a class="dropdown-item" href="pages-account-settings-billing.html">
                        <span class="d-flex align-items-center align-middle">
                          <i class="flex-shrink-0 ri-file-text-line ri-22px me-3"></i>
                          <span class="flex-grow-1 align-middle">Billing</span>
                          <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger">4</span>
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
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
</script>          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="app-chat card" id="extendUploadWindow" style="overflow:hidden">
                <div class="row g-0">
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
<!-- /MUDDASSAR STARTTTT -->      
<!-- Files Uploaded -->
<div class="col app-chat-contacts app-sidebar flex-grow-0 overflow-hidden border-end" id="app-chat-contacts">
  <div class="sidebar-header h-px-75 px-5 border-bottom d-flex align-items-center">
    <div class="d-flex align-items-center me-6 me-lg-0">
      <div class="flex-shrink-0 avatar avatar-online me-4">
        <img class="user-avatar rounded-circle cursor-pointer" src="../assets/img/avatars/1.png" alt="Avatar" />
      </div>
      <div class="flex-grow-1 input-group input-group-sm input-group-merge rounded-pill">
        <span class="input-group-text"><i class="ri-search-line lh-1 ri-20px"></i></span>
        <input type="text" class="form-control chat-search-input" placeholder="Search..." />
      </div>
    </div>
  </div>
  <div class="sidebar-body" style="overflow-y: auto; max-height: 600px;">
    <ul class="list-unstyled chat-contact-list py-2 mb-0" id="files">
      <li class="chat-contact-list-item-title mt-0">
        <h5 class="text-primary mb-0">FILES</h5>
      </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1658">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  xemu-win-release.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 26, 2025 11:51 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1658">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  IntelPowerGadget64-bit_3.0.7.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 26, 2025 11:51 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1658">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  productsliderforwoocommerce305.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 26, 2025 11:51 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1658">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  platform-tools_r16-windows.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 26, 2025 11:51 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1658">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  xenia-master.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 26, 2025 11:51 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1657">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  Camera Uploads.rar                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 26, 2025 11:49 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1657">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  main_files mobile business app free flyer template.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 26, 2025 11:49 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1657">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  scrcpy-win64-v1.24.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 26, 2025 11:49 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1657">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  Stock-v2.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 26, 2025 11:49 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1657">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  tweaking.com_windows_repair_aio.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 26, 2025 11:49 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1656">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  wordpress-6.4.3.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 26, 2025 11:43 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1656">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  CSS_ChapterWise_Notes.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 26, 2025 11:43 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1656">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  Amlogic_USB_Burning_Tool_v3.1.0.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 26, 2025 11:43 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1656">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  AndroidGestureSHA1.rar                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 26, 2025 11:43 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1655">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  Blackmagic_Desktop_Video_Windows_12.3.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 26, 2025 11:40 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1655">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  Blackmagic_Desktop_Video_Windows_12.8.1.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 26, 2025 11:40 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1655">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  Backlighting Sun and Flash.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 26, 2025 11:40 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1654">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  AndroidPatternCrack.tar.gz                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 26, 2025 11:38 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1654">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  Blackmagic_Desktop_Video_Windows_12.3.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 26, 2025 11:38 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1654">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  Blackmagic_Desktop_Video_Windows_12.8.1.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 26, 2025 11:38 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1654">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  Backlighting Sun and Flash.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 26, 2025 11:38 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1653">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  codecanyon-0nv1smKf-laraclassified-geo-classified-ads-cms.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 26, 2025 10:55 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1653">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  103895_smartsliderpack3320_2.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 26, 2025 10:55 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1653">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  divi-photo-marketplace-layout-pack-images.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 26, 2025 10:55 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1652">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  C Basics - For Complete Beginners.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 26, 2025 10:40 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1652">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  codecanyon-0nv1smKf-laraclassified-geo-classified-ads-cms.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 26, 2025 10:40 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1652">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  103895_smartsliderpack3320_2.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 26, 2025 10:40 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1651">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  20240331_alilimoservices_f4ff7972421022bc8802_20240331153335_archive.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 26, 2025 10:00 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1650">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  divi-layouts.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 26, 2025 09:56 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1650">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  gparted-live-1.5.0-6-i686.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 26, 2025 09:56 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1649">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  Java_ChapterWise_Notes.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 26, 2025 09:46 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1649">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  themeforest-gAkYtswo-pannonia-fully-responsive-admin-template.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 26, 2025 09:46 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1649">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  themeforest-trcZ0sR6-textron-industrial-wordpress-theme-woocommerce.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 26, 2025 09:46 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1649">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  HeadFirst-OOAD-master.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 26, 2025 09:46 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1648">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  Install_usb_disk_Debian11(OMV6)(GPL_MCH_Monarch_8.7.0-107_20220623).zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 26, 2025 09:38 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1648">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  LG_SmartShare_WAL_33_2.3.1511.1201.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 26, 2025 09:38 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1648">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  Intel-FORCED-10x64-RTM-HD5000_20.19.15.5171-drp.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 26, 2025 09:38 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1647">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  LG_SmartShare_WAL_33_2.3.1511.1201.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 26, 2025 08:37 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1647">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  Intel-FORCED-10x64-RTM-HD5000_20.19.15.5171-drp.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 26, 2025 08:37 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1646">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  divi-layouts.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 26, 2025 08:24 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1646">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  gparted-live-1.5.0-6-i686.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 26, 2025 08:24 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1645">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  Photographing_kids_Karl_Taylor_Education.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 26, 2025 08:06 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1645">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  20240331_alilimoservices_f4ff7972421022bc8802_20240331153335_archive.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 26, 2025 08:06 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1644">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  20240331_alilimoservices_f4ff7972421022bc8802_20240331153335_archive.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 26, 2025 07:42 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1643">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  divi-layouts.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 26, 2025 07:35 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1642">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67958cde04847_divi-layouts.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 26, 2025 06:16 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1642">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67958cde04691_gparted-live-1.5.0-6-i686.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 26, 2025 06:16 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1641">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67958c8760df3_LG_SmartShare_WAL_33_2.3.1511.1201.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 26, 2025 06:14 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1640">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6795796633636_VSX-832-UserManual1.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 26, 2025 04:53 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1640">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6795796633176_mob.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 26, 2025 04:53 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1640">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  679579663301b_slides-students-C04.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 26, 2025 04:53 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1640">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6795796632e2b_Android_CompleteNotes.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 26, 2025 04:53 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1635">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67956959ec402_BatteryTechSpecification.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 26, 2025 03:44 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1634">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67956574361a8_Documents-Upload-Guideline-PakID.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 26, 2025 03:28 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1628">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6794517756c94_betheme_v26.7.5.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 25, 2025 07:50 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1628">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6794517756b56_betheme_v26.7.3.1.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 25, 2025 07:50 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1628">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67945177569f2_Camera Uploads.rar                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 25, 2025 07:50 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1628">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6794517756896_divi-modules.rar                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 25, 2025 07:50 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1628">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6794517756747_wordpress-6.1.1.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 25, 2025 07:50 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1628">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6794517756572_leather-texture-samples-realistic-set.jpg.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 25, 2025 07:50 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1626">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67944e82af5d0_HeadFirst-CSharp-master.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 25, 2025 07:37 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1625">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67944e589d5f4_gparted-live-1.5.0-6-i686.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 25, 2025 07:37 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1624">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67944e094c069_flip-html5.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 25, 2025 07:35 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1623">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67944d0064ebe_divi-layouts.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 25, 2025 07:31 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1622">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67944ccf47fd2_divi-layouts.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 25, 2025 07:30 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1621">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67944b76a2398_geopos preinstalled.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 25, 2025 07:24 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1620">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67944b6336d19_LG_SmartShare_WAL_33_2.3.1511.1201.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 25, 2025 07:24 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1619">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67944a0fbfceb_LAN_Killer_1.6.1893_W10x64_A.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 25, 2025 07:18 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1619">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67944a0fbfb65_APK_Swapper_Beta_11.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 25, 2025 07:18 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1619">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67944a0fbf9f3_Amlogic_Burn_Card_Maker_v2.0.2.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 25, 2025 07:18 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1619">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67944a0fbf876_STMicro-FORCED-7x64-Accelerometer_2.2.3.11-drp.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 25, 2025 07:18 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1619">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67944a0fbf6b7_vecteezy_young-woman-with-a-mask-taking-care-of-an-old-woman_1249400.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 25, 2025 07:18 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1619">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67944a0fbf501_grocery-crud-codeigniter-4-2.0.1.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 25, 2025 07:18 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1619">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67944a0fbf31f_vecteezy_physician-and-nurse-taking-care-of-an-elderly-patient-vector-illustration_1249291.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 25, 2025 07:18 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1619">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67944a0fbf123_WinDFT095.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 25, 2025 07:18 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1618">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6794488752ac0_grocery-crud-codeigniter-4-2.0.1.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 25, 2025 07:12 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1618">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6794488752931_vecteezy_physician-and-nurse-taking-care-of-an-elderly-patient-vector-illustration_1249291.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 25, 2025 07:12 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1618">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67944887526fd_WinDFT095.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 25, 2025 07:12 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1617">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67944868bf8eb_05_Notifications.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 25, 2025 07:11 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1617">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67944868bf446_Detect karta hai KTS ko KRT_CLUB_3.1.0.29.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 25, 2025 07:11 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1616">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67944833ba730_Blackmagic_Desktop_Video_Windows_12.8.1.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 25, 2025 07:10 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1616">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67944833ba55d_Backlighting Sun and Flash.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 25, 2025 07:10 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1614">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6794411f333ea_divi-layouts.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 25, 2025 06:40 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1613">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67943ab3f19d4_M&#039;n&#039;M Conversions[1490].zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 25, 2025 06:13 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1609">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67942d23c2c85_muddassarL502x.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 25, 2025 05:15 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1609">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67942d23c2af2_DSDT.aml.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 25, 2025 05:15 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1609">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67942d23c294e_E6220_A13.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 25, 2025 05:15 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1609">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67942d23c279d_E6220.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 25, 2025 05:15 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1609">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67942d23c25ea_Patched_AICPUPM_10.12.3.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 25, 2025 05:15 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1609">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67942d23c2382_Chameleon-2.2svn-r2404-binaries.tar.gz                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 25, 2025 05:15 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1601">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  679421c239688_gparted-live-1.5.0-6-i686.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 25, 2025 04:26 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1600">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67941a93e10cb_Chameleon-2.2svn-r2404-binaries.tar.gz                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 25, 2025 03:56 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1598">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6793548261f35_gparted-live-1.5.0-6-i686.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 24, 2025 01:51 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1593">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67932e8fc6698_Data Structures Notes - TutorialsDuniya.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 24, 2025 11:09 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1591">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  679327e234ff8_Wi-Fi Module and WatchPower APP User Mnaul 20191129.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 24, 2025 10:40 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1590">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6793242875ad7_solarpowermanual3-phase_20201214.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 24, 2025 10:24 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1590">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  679324287588c_HYBRID V-3P.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 24, 2025 10:24 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1590">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  679324287561e_Energy-Mate APP User Manual-20230628.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 24, 2025 10:24 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1590">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67932428753a0_WatchPower user manual.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 24, 2025 10:24 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1590">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  679324287503b_SolarPower user manual for Grid-tie 3KW 5KW Inverter_20220207.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 24, 2025 10:24 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1590">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6793242874cdd_ResumeFaheemEjaz.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 24, 2025 10:24 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1590">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6793242874943_BatteryTechSpecification.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 24, 2025 10:24 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1590">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67932428745bc_Wi-Fi Module and WatchPower APP User Mnaul 20191129.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 24, 2025 10:24 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1590">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67932428742d3_2023-09-8-Parcel-Tariff-Rates.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 24, 2025 10:24 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1590">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  679324287403c_optiplex-5060-desktop_specifications3_en-us.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 24, 2025 10:24 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1590">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6793242873d2d_Mirza Muddassar Hussain 2024 CV.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 24, 2025 10:24 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1590">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67932428739c2_Documents-Upload-Guideline-PakID.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 24, 2025 10:24 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1589">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6793232ea6218_WatchPower user manual.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 24, 2025 10:20 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1588">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67931c6537d54_Firmware_Update_VSX-832_02-02-2022.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 24, 2025 09:51 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1588">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67931c6537ad0_dat-zip-zone-directory.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 24, 2025 09:51 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1588">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67931c65377ad_dat-zip-zone-directory_2.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 24, 2025 09:51 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1588">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67931c65374c9_Invoice-A5D23D47-0002.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 24, 2025 09:51 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1588">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67931c653711b_Invoice #21878.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 24, 2025 09:51 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1587">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67931c4d0f4cb_Invoice #21877.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 24, 2025 09:51 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1586">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  679315000a726_2023-09-8-Parcel-Tariff-Rates.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 24, 2025 09:20 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1583">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6792ba60d994e_Invoice #21878.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 24, 2025 02:53 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1582">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6792b76a4df61_ARH7110A.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 24, 2025 02:40 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1580">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67928656cc64b_SolarPower user manual for Grid-tie 3KW 5KW Inverter_20220207.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 23, 2025 11:11 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1551">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6791c9a116182_HYBRID V-3P.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 23, 2025 09:46 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1550">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6791c984857d8_ResumeFaheemEjaz.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 23, 2025 09:45 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1549">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6791c96da0c1e_ResumeFaheemEjaz.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 23, 2025 09:45 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1519">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  679111166cdd4_BatteryTechSpecification.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 08:39 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1518">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6791104f0ad87_Energy-Mate APP User Manual-20230628.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 08:35 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1516">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67910ffa625a3_R-52C_Spec-Sheet_v01.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 08:34 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1514">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67910a4e9bec0_14.8 2-Interviews-What-not-to-say.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 08:10 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1513">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790fa9371d70_14.4 Module-10.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 07:02 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1510">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790f7b2d281c_14.5 6-Redhat Certifications.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 06:50 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1506">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790f6eae1185_14.3 3-Interview-Tips.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 06:47 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1505">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790f6a002c6b_14.4 Module-10.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 06:46 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1504">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790f65be761d_14.7 5-Post Resume and What to Expect.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 06:44 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1503">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790f6365eaba_14.7 5-Post Resume and What to Expect.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 06:44 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1502">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790f56084fa0_14.6 1-Interview Workshop.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 06:40 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1501">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790f385bb67a_14.7 5-Post Resume and What to Expect.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 06:32 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1500">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790f32116648_14.2 In-Person Interview Tip.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 06:31 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1499">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790f2d294ac7_20.5 Oracle Virtual Box User Manual.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 06:29 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1498">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790f22e8c0bb_20.5 Oracle Virtual Box User Manual.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 06:27 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1497">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790f1975e7fb_19.1 Module-2-Homework.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 06:24 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1496">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790f195a857d_19.1 Module-2-Homework.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 06:24 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1495">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790f18eadda5_19.1 Module-2-Homework.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 06:24 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1494">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790f11608131_20.5 Oracle Virtual Box User Manual.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 06:22 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1494">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790f11607e5c_20.4 Changing-from-32-to-64bit.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 06:22 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1492">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790f03fabcbe_20.3 Red_Hat_Enterprise_Linux-7-Installation_Guide-en-US.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 06:18 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1492">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790f03fabae0_20.2 CentOS Installation Guide.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 06:18 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1491">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790efd15696b_7.4 Hard Disk and Disk Cache.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 06:17 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1491">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790efd156658_7.3 Operating system.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 06:17 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1491">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790efd1563cb_7.2 Parts of OS.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 06:17 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1490">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790eee1ad09d_7.5 Virtual memory.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 06:13 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1490">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790eee1aceb6_7.4 Hard Disk and Disk Cache.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 06:13 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1490">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790eee1acc2f_7.3 Operating system.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 06:13 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1489">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790eea481c14_7.2 Parts of OS.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 06:12 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1485">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  679074f067ff0_24.4 15-Red_Hat_Enterprise_Linux-8-Configuring_basic_system_settings-en-US.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 09:32 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1484">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67905eeba9c7a_28.13 9-Unix Programs.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 07:58 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1483">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67905def0d0d7_3. Difference between vi and vim Editors.mp4                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 07:54 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1479">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67904afc68cb2_4. sed Command.mp4                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 06:33 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1478">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790469d23641_CV for web development.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 06:15 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1472">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790389f361ec_13. Creating gradient backgrounds.mp4                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 05:15 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1472">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790389f35e84_12. Creating clean white backgrounds.mp4                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 05:15 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1472">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790389f35b0e_11. Studio backgrounds.mp4                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 05:15 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1472">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790389f35756_10. Grips and clamps.mp4                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 05:15 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1471">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790375327a73_SLIMBOX-AOSP-VONTAR-ver8.1.7z                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 05:09 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1470">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  679034aaa37c3_SLIMBOX-AOSP-VONTAR-ver8.1.7z                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 04:58 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1469">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790335d9bd17_Pcsx-1.5-218.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 04:53 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1469">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790335d9b998_IntelPowerGadget64-bit_3.0.7.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 04:53 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1469">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790335d9b660_Fall 2015_CS502_1.rar                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 04:53 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1469">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790335d9b33c_wPrime210.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 04:53 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1469">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790335d9afde_CV for web development.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 04:53 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1469">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790335d9ab95_Windows 7 Start Orb Changer.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 04:53 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1468">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  679031e4c68ab_H96 MAX M9 Upgrade Tool.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 04:46 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1467">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  679031e4c26da_H96 MAX M9 Upgrade Tool.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 04:46 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1466">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67903087b1d0a_Rockchip Upgrade Tool.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 04:40 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1465">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67902ebf2e45e_openvpn-connect-3.6.0.4074_signed.msi                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 04:33 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1464">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67902e6b26fb6_add_user.php                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 04:31 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1463">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67902d5d0716d_Admin_Dashboard.php                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 04:27 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1462">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67902d519ccb5_Admin_Dashboard.php                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 04:27 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1461">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67902cf88a267_Admin_Dashboard.php                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 04:25 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1460">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67902ae054b31_assign_project.php                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 04:16 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1459">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67902a9fa5c9e_smtp_config.php                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 04:15 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1459">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67902a9fa581f_cron_meeting_notifications.php                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 04:15 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1458">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  679029268987c_smtp_config.php                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 04:09 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1458">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790292689515_cron_meeting_notifications.php                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 04:09 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1458">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790292689178_credentials.txt                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 04:09 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1458">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790292688d40_calendly_functions.php                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 04:09 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1457">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790261f445b4_smtp_config.php                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 03:56 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1457">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790261f44232_cron_meeting_notifications.php                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 03:56 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1457">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790261f43f4e_credentials.txt                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 03:56 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1457">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790261f43b96_calendly_functions.php                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 03:56 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1456">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  679021db72014_user-side.php                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 03:38 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1456">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  679021db71e20_sidebar.php                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 03:38 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1456">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  679021db71b82_footer.php                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 03:38 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1455">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790215b6d70c_LoginCheck.php                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 03:36 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1455">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790215b6d4e1_index.php                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 03:36 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1455">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790215b6d2d1_get_countries.php                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 03:36 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1455">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790215b6d115_db_connection.php                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 03:36 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1455">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790215b6cf2e_composer.lock                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 03:36 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1455">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790215b6cc66_composer.json                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 03:36 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1455">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790215b6c0d1_clients.php                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 03:36 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1455">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790215b6b784_calendaly key.txt                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 03:36 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1455">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790215b6b3d2_assign_project.php                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 03:36 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1455">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790215b6b02c_Admin_Dashboard.php                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 03:36 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1455">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790215b6a8da_add_user.php                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 03:36 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1454">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67901ff4946ec_RITE BOOKS REVISION FILE.ai                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 03:30 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1454">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67901ff494440_RITE BOOKS REVISION FILE 2.svg                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 03:30 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1454">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67901ff494144_RB REVISION.psd                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 03:30 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1453">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  679018ba96b7d_lim.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 02:59 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1452">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790188041fd2_openvpn-connect-3.5.1.3946_signed.msi                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 02:58 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1452">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790188041da0_com-mod-emby-for-android-mod-apk-unlocked-3-4-20-300004203.apk                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 02:58 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1451">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  679016b23fe37_com-mod-emby-for-android-mod-apk-unlocked-3-4-20-300004203.apk                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 02:50 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1450">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6790166cd91e3_htmlpad2025.exe                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 22, 2025 02:49 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1448">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  677de5437333b_app-calendar.js                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 08, 2025 07:38 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1447">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  677de08532ef2_app-logistics-fleet.js                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Jan 08, 2025 07:18 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1426">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6759c0503d51d_id front.jpg                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 11, 2024 09:39 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1426">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6759c0503d235_id back.jpg                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 11, 2024 09:39 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1425">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6759c028bd9c9_20211212_224807.jpg                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 11, 2024 09:39 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1422">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  675963cf61b1d_How-to-Filter-Locations-on-the-Map.jpg                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: user 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 11, 2024 03:05 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1421">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67596390a1dc0_Industry-Update-January-8-2020.jpg                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: user 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 11, 2024 03:04 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1420">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  675962f728916_call.jpg                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: user 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 11, 2024 03:01 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1419">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67596268eeea8_2023-05-23_15-54-03.png                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: user 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 11, 2024 02:59 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1418">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6759620d148cd_passport.jpg                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: user 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 11, 2024 02:57 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1417">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6759613c07cb9_WUDFUpdate_01009.dll                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: user 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 11, 2024 02:54 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1417">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6759613c07b93_winusbcoinstaller2.dll                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: user 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 11, 2024 02:54 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1417">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6759613c079a6_WdfCoInstaller01009.dll                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: user 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 11, 2024 02:54 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1416">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  675960e986a5e_source.properties                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: user 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 11, 2024 02:52 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1416">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  675960e985b66_androidwinusba64.cat                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: user 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 11, 2024 02:52 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1416">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  675960e985988_androidwinusb86.cat                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: user 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 11, 2024 02:52 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1416">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  675960e9856f4_android_winusb.inf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: user 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 11, 2024 02:52 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1415">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6759609a9e0f7_Sanet.st_4. Write another program using while loop - Find sum of numbers using while..mp4                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: user 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 11, 2024 02:51 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1415">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6759609a9df86_Sanet.st_3. While loop example - C++ program to find factorial of a number..mp4                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: user 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 11, 2024 02:51 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1415">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6759609a9ddfc_Sanet.st_2. While Loop Test1.html                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: user 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 11, 2024 02:51 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1414">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67595df66866a_My EFI.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: user 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 11, 2024 02:40 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1414">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67595df668538_apfs.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: user 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 11, 2024 02:40 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1414">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67595df6683fe_macOS High Sierra Basic Kexts.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: user 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 11, 2024 02:40 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1414">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67595df6682cd_OSInstaller(MBR)10.13.1.17B48.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: user 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 11, 2024 02:40 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1414">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67595df668179_OSInstaller(MBR)10.12.6.16G29.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: user 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 11, 2024 02:40 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1414">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67595df66803c_BDU_v2.1.2017.021b.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: user 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 11, 2024 02:40 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1414">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67595df667e8c_muddassarL502x.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: user 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 11, 2024 02:40 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1413">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67595bb12be80_HeadFirst-CSharp-master.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: user 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 11, 2024 02:30 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1413">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67595bb12b028_HeadFirst-OOAD-master.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: user 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 11, 2024 02:30 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1413">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67595bb12ae6d_[Guru3D.com]-MSIAfterburnerSetup462Build15745.zip                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: user 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 11, 2024 02:30 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1412">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67595b0407807_VideoJquery Fullcalandar Integration with PHP and Mysql.mp4                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: user 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 11, 2024 02:27 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1412">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67595b0407704_logiclike-brain-training-v1_2_82-mod.apk                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: user 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 11, 2024 02:27 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1412">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67595b040757c_Emby-for-Android-TV-MOD-2_1_21g.apk                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: user 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 11, 2024 02:27 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1411">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  67595adb3492c_MGC_6_1_021_xcam6_beta11.apk                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: user 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 11, 2024 02:26 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1410">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  675958eb86dd1_passport.jpg                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: user 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 11, 2024 02:18 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1410">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  675958eb86cb9_mycloud home adapter.png                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: user 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 11, 2024 02:18 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1410">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  675958eb86ba7_IMG_20180922_163717.jpg                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: user 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 11, 2024 02:18 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1410">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  675958eb869e3_IMG_20180922_163628.jpg                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: user 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 11, 2024 02:18 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1409">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6758cb0b81a5e_123.xlsx                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 11, 2024 04:13 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1408">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6758c8143517a_attempt.htm                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 11, 2024 04:00 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1407">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6758c28589f4e_SEOCheatSheet_2-2013.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 11, 2024 03:36 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1406">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6758bac78ba72_3.2 Create a Github Account.html                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 11, 2024 03:03 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1406">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6758bac78b8e8_31INVI~1.HTM                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 11, 2024 03:03 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1406">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6758bac78aa10_3STEP1~1.VTT                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 11, 2024 03:03 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1404">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6758b5b7002a2_7STEP5~1.MP4                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 11, 2024 02:42 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1403">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6758b43c42e7d_1. What are the Coding Challenges.vtt                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 11, 2024 02:35 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1403">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6758b43c42ce8_1. What are the Coding Challenges.mp4                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 11, 2024 02:35 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1402">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6758b1174c1d6_Exercises 2.docx                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 11, 2024 02:22 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1402">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  6758b1174c032_Assign_1.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 11, 2024 02:22 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1401">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  Java Programming Tutorial - 1 - Installing the JDK-1.flv                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 11, 2024 02:15 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1400">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  Exercises 2.docx                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 11, 2024 02:15 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1386">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  link .txt                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 11, 2024 12:39 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1372">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  Watch - Discover_2.mp4                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 10, 2024 07:43 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1371">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  Watch - Discover_2.mp4                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 10, 2024 07:40 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1369">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  Top.jpg                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 10, 2024 07:02 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1368">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  Bus EK Chaadar - Irfan Haider - 2019 - 1441 - YouTube.mp4                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 10, 2024 07:00 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1365">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  7af6530f-84fa-4df8-963f-42e05d7517a2.apk                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 10, 2024 06:47 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1364">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  style.css                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 10, 2024 06:46 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1343">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  logo.png                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 09, 2024 03:09 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1293">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  calendaly key.txt                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 01, 2024 10:35 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1289">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  WinRAR_DarkMatter_Subspace_32x32.theme.rar                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: user 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 01, 2024 04:46 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1278">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  1732884614_admin_panel.sql                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Dec 01, 2024 11:47 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1272">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  Notification for Parents.pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Nov 30, 2024 01:43 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1265">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  image.png                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Nov 29, 2024 07:15 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1247">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  Apharan.S02.COMPLETE.1080p.VOOT.10bit.2CH.x265.[HashMiner].torrent                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Nov 29, 2024 06:33 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1246">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  qrcode.png                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Nov 29, 2024 06:32 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1214">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  mycloud home adapter.png                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: admin 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Nov 17, 2024 05:18 PM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="1160">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  submit_meeting.php                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: user 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Nov 04, 2024 06:29 AM              
			  </small>
            </div>
          </a>
        </li>
              <li class="chat-contact-list-item mb-1" data-message-id="18">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  Mirza Muddassar Hussain[1288].pdf                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: user 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at Nov 02, 2024 04:44 AM              
			  </small>
            </div>
          </a>
        </li>
          </ul>
  </div>
</div>
<!-- /Chat Contacts -->

<!-- Chat History -->
<div class="col app-chat-history">
  <div class="chat-history-wrapper">
  <div class="chat-history-header border-bottom">
  <div class="d-flex overflow-hidden align-items-center">
                            <i
                              class="ri-menu-line ri-24px cursor-pointer d-lg-none d-block me-4"
                              data-bs-toggle="sidebar"
                              data-overlay
                              data-target="#app-chat-contacts"></i>
                            <div class="flex-shrink-0 avatar avatar-online">
                              <img
                                src="../assets/img/avatars/1.png"
                                alt="Avatar"
                                class="rounded-circle"
                                data-bs-toggle="sidebar"
                                data-overlay
                                data-target="#app-chat-sidebar-right" />
                            </div>
                            <div class="chat-contact-info flex-grow-1 ms-4">
                              <h6 class="m-0 fw-normal">Chat for Project Name:T1 ( Self)</h6>
                              <small class="user-status text-body">beenishnmuddassar@gmail.com</small>
                            </div>
                          </div>
						  </div>
    <div class="chat-history-body" style="max-height: 500px; overflow-y: auto;">
      <ul class="list-unstyled chat-history">
                  <li id="message-4" class="chat-message ">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">how are you?</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-11-02 03:13:22</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-18" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">adfasdfasdfasdfasdfasfasfd</p>
				  							<br>
			                <a href="uploads/Mirza Muddassar Hussain[1288].pdf" download="Mirza Muddassar Hussain[1288].pdf" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2024-11-02 04:44:25</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1101" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">database message check</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-11-03 21:49:47</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1160" class="chat-message ">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">documents table check</p>
				  							<br>
			                <a href="uploads/submit_meeting.php" download="submit_meeting.php" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2024-11-04 06:29:24</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1214" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">cloud home</p>
				  							<br>
			                <a href="uploads/mycloud home adapter.png" download="mycloud home adapter.png" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2024-11-17 17:18:20</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1241" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">jdsjfa</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-11-29 18:00:43</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1242" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">my admin sql file</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-11-29 18:03:58</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1243" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">23nd file</p>
				  							<br>
			                <a href="uploads/1732885531_admin_panel.sql" download="1732885531_admin_panel.sql" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2024-11-29 18:05:31</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1244" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">latest cv</p>
				  							<br>
			                <a href="uploads/1732886198_Mirza Muddassar Hussain 2024 CV (1).pptx" download="1732886198_Mirza Muddassar Hussain 2024 CV (1).pptx" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2024-11-29 18:16:38</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1245" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">HGlloworld</p>
				  							<br>
			                <a href="uploads/1732887080_index.js" download="1732887080_index.js" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2024-11-29 18:31:20</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1246" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">chak dy phattay</p>
				  							<br>
			                <a href="uploads/1732887142_qrcode.png" download="1732887142_qrcode.png" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2024-11-29 18:32:22</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1247" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">chawani 100 baar</p>
				  							<br>
			                <a href="uploads/1732887209_Apharan.S02.COMPLETE.1080p.VOOT.10bit.2CH.x265.[HashMiner].torrent" download="1732887209_Apharan.S02.COMPLETE.1080p.VOOT.10bit.2CH.x265.[HashMiner].torrent" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2024-11-29 18:33:29</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1248" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">2sadf</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-11-29 18:35:37</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1249" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">asdf</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-11-29 18:43:56</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1250" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">f</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-11-29 18:48:09</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1251" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">k</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-11-29 18:49:08</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1252" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">danial</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-11-29 18:49:27</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1253" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">mm</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-11-29 18:51:09</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1254" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">adhi raat</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-11-29 18:52:30</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1255" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">puir</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-11-29 18:52:48</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1256" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">jaati hun mai</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-11-29 19:00:56</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1257" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">aja</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-11-29 19:01:32</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1258" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">kuch</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-11-29 19:02:12</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1259" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">jasdjf</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-11-29 19:04:27</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1262" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">kal</p>
				  							<br>
			                <a href="uploads/1732889466_logo.svg" download="1732889466_logo.svg" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2024-11-29 19:11:06</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1263" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">kkasdfk</p>
				  							<br>
			                <a href="uploads/1732889517_hosts.txt" download="1732889517_hosts.txt" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2024-11-29 19:11:57</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1265" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">bkd</p>
				  							<br>
			                <a href="uploads/1732889719_image.png" download="1732889719_image.png" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2024-11-29 19:15:19</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1266" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">hello</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-11-30 00:54:19</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1267" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">hasdf</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-11-30 01:01:28</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1268" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">asjd</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-11-30 01:01:33</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1269" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">hi</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-11-30 01:09:19</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1270" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">checking layout 2nd time</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-11-30 01:12:18</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1271" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">casi</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-11-30 01:16:22</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1272" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">notification</p>
				  							<br>
			                <a href="uploads/1732912991_Notification for Parents.pdf" download="1732912991_Notification for Parents.pdf" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2024-11-30 01:43:11</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1273" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">something is going great</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-11-30 02:10:42</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1274" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">jj</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-11-30 02:31:59</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1275" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">hello world</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-01 11:45:45</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1276" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">pichkaari</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-01 11:45:58</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1277" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">Enter is pressed</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-01 11:47:22</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1278" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">Enter is pressed with file</p>
				  							<br>
			                <a href="uploads/1733035658_1732884614_admin_panel.sql" download="1733035658_1732884614_admin_panel.sql" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2024-12-01 11:47:38</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1279" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">adf</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-01 14:12:36</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1280" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">kjjk</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-01 14:18:39</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1281" class="chat-message ">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">sgsdfg</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-01 15:31:46</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1282" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">shikar</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-01 15:32:47</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1283" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">sfvxv</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-01 15:43:36</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1284" class="chat-message ">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">cxxv</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-01 15:44:05</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1285" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">d</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-01 15:50:21</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1286" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">shak</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-01 16:34:13</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1287" class="chat-message ">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">idher</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-01 16:34:41</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1288" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">udhar</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-01 16:34:49</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1289" class="chat-message ">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">winrar setup</p>
				  							<br>
			                <a href="uploads/1733053575_WinRAR_DarkMatter_Subspace_32x32.theme.rar" download="1733053575_WinRAR_DarkMatter_Subspace_32x32.theme.rar" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2024-12-01 16:46:15</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1290" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">hello</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-01 16:51:07</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1291" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">chalo</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-01 22:26:14</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1292" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">chaloo</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-01 22:35:32</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1293" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">challoooo</p>
				  							<br>
			                <a href="uploads/1733074552_calendaly key.txt" download="1733074552_calendaly key.txt" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2024-12-01 22:35:52</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1294" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">jjk</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-02 01:36:49</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1295" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">sadfj</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-02 02:12:26</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1296" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">nhe</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-02 02:12:34</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1297" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">jk</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-02 02:27:22</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1298" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">padsaf</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-02 02:33:17</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1299" class="chat-message ">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">ajaon kya?</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-03 21:04:53</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1300" class="chat-message ">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">ads</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-03 21:05:06</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1301" class="chat-message ">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">chalo phuto</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-03 21:07:10</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1302" class="chat-message ">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">sath do</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-03 21:09:38</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1303" class="chat-message ">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">ioi</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-03 21:18:11</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1304" class="chat-message ">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">pichhhh</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-03 21:19:03</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1305" class="chat-message ">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">hd</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-03 23:48:53</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1306" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">hhasdf</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-04 00:05:19</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1307" class="chat-message ">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">jjj</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-04 00:05:26</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1328" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">last message for materialize framework</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-08 16:48:57</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1329" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">first message from materialize sending test</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-09 03:03:06</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1330" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">sending</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-09 03:05:06</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1331" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">ikloti sending chaal</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-09 03:08:55</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1332" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">jns</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-09 03:27:26</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1333" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">sexist</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-09 03:33:52</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1334" class="chat-message ">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">jasd</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-09 04:00:34</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1335" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">jk</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-09 04:45:16</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1337" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">vbvc</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-09 14:10:21</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1338" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">2nd</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-09 14:11:37</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1339" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">jghjf</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-09 14:14:00</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1340" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">mxma</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-09 14:50:43</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1341" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">mx</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-09 15:01:58</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1342" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">xc</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-09 15:06:48</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1343" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">dj logo</p>
				  							<br>
			                <a href="uploads/1733738941_logo.png" download="1733738941_logo.png" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2024-12-09 15:09:01</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1344" class="chat-message ">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">samandar</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-09 15:31:57</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1345" class="chat-message ">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">user</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-10 01:14:38</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1346" class="chat-message ">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">user</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-10 13:55:15</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1364" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0"></p>
				  							<br>
			                <a href="uploads/1733838419_style.css" download="1733838419_style.css" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2024-12-10 18:46:59</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1365" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">apk file</p>
				  							<br>
			                <a href="uploads/1733838437_7af6530f-84fa-4df8-963f-42e05d7517a2.apk" download="1733838437_7af6530f-84fa-4df8-963f-42e05d7517a2.apk" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2024-12-10 18:47:17</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1366" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">send button click check</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-10 18:48:53</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1367" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">hop</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-10 19:00:38</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1368" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">bus ek chaddar</p>
				  							<br>
			                <a href="uploads/1733839251_Bus EK Chaadar - Irfan Haider - 2019 - 1441 - YouTube.mp4" download="1733839251_Bus EK Chaadar - Irfan Haider - 2019 - 1441 - YouTube.mp4" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2024-12-10 19:00:51</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1369" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">top</p>
				  							<br>
			                <a href="uploads/1733839330_Top.jpg" download="1733839330_Top.jpg" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2024-12-10 19:02:10</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1370" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">asdfasdf</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-10 19:39:44</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1371" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0"></p>
				  							<br>
			                <a href="uploads/1733841601_Watch - Discover_2.mp4" download="1733841601_Watch - Discover_2.mp4" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2024-12-10 19:40:01</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1372" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0"></p>
				  							<br>
			                <a href="uploads/1733841792_Watch - Discover_2.mp4" download="1733841792_Watch - Discover_2.mp4" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2024-12-10 19:43:12</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1373" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">ju</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-10 20:15:31</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1374" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">hds</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-10 20:15:37</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1375" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">asdflk</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-10 20:17:19</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1376" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">hello</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-10 20:17:47</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1377" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">8:18</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-10 20:18:20</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1378" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">8:10</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-10 20:18:50</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1379" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">askdfa</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-10 20:21:53</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1380" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">kiran is good girl</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-10 20:23:01</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1381" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">jhj</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-10 23:55:39</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1382" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">jkkhjk</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-10 23:55:43</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1383" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">hello</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-11 00:05:47</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1384" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">link file</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-11 00:05:58</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1385" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">hi how are you?</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-11 00:39:32</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1386" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">links file</p>
				  							<br>
			                <a href="uploads/1733859585_link .txt" download="1733859585_link .txt" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2024-12-11 00:39:45</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1387" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0"></p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-11 01:34:56</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1388" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">hello</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-11 01:43:10</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1389" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0"></p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-11 01:43:34</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1390" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">multiple files testing</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-11 01:47:15</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1391" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">single file test</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-11 01:47:39</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1392" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">check only message</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-11 01:57:24</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1393" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">check single file upload with message</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-11 01:57:51</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1394" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0"></p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-11 01:58:07</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1395" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">without upload</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-11 02:07:02</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1396" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">one</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-11 02:07:11</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1397" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">one file upload</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-11 02:07:22</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1398" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">assignment 1</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-11 02:11:06</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1399" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">ex</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-11 02:11:51</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1400" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">exercise 2 single file upload check</p>
				  							<br>
			                <a href="uploads/Exercises 2.docx" download="Exercises 2.docx" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2024-12-11 02:15:20</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1401" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">multiple file upload check</p>
				  							<br>
			                <a href="uploads/Java Programming Tutorial - 1 - Installing the JDK-1.flv" download="Java Programming Tutorial - 1 - Installing the JDK-1.flv" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2024-12-11 02:15:59</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1402" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">hello world with 2 files</p>
				  							<br>
			                <a href="uploads/6758b1174c032_Assign_1.pdf,uploads/6758b1174c1d6_Exercises 2.docx" download="6758b1174c1d6_Exercises 2.docx" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2024-12-11 02:22:31</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1403" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">files</p>
				  							<br>
			                <a href="uploads/6758b43c42ce8_1. What are the Coding Challenges.mp4,uploads/6758b43c42e7d_1. What are the Coding Challenges.vtt" download="6758b43c42e7d_1. What are the Coding Challenges.vtt" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2024-12-11 02:35:56</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1404" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0"></p>
				  							<br>
			                <a href="uploads/6758b5b7002a2_7STEP5~1.MP4" download="6758b5b7002a2_7STEP5~1.MP4" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2024-12-11 02:42:15</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1405" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">hello</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-11 02:42:40</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1406" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0"></p>
				  							<br>
			                <a href="uploads/6758bac78aa10_3STEP1~1.VTT,uploads/6758bac78b8e8_31INVI~1.HTM,uploads/6758bac78ba72_3.2 Create a Github Account.html" download="6758bac78ba72_3.2 Create a Github Account.html" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2024-12-11 03:03:51</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1407" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">seo</p>
				  							<br>
			                <a href="uploads/6758c28589f4e_SEOCheatSheet_2-2013.pdf" download="6758c28589f4e_SEOCheatSheet_2-2013.pdf" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2024-12-11 03:36:53</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1408" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">attem</p>
				  							<br>
			                <a href="uploads/6758c8143517a_attempt.htm" download="6758c8143517a_attempt.htm" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2024-12-11 04:00:36</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1409" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">456</p>
				  							<br>
			                <a href="uploads/6758cb0b81a5e_123.xlsx" download="6758cb0b81a5e_123.xlsx" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2024-12-11 04:13:15</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1410" class="chat-message ">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">sent 4 file</p>
				  							<br>
			                <a href="uploads/675958eb869e3_IMG_20180922_163628.jpg,uploads/675958eb86ba7_IMG_20180922_163717.jpg,uploads/675958eb86cb9_mycloud home adapter.png,uploads/675958eb86dd1_passport.jpg" download="675958eb86dd1_passport.jpg" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2024-12-11 14:18:35</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1411" class="chat-message ">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">apk file</p>
				  							<br>
			                <a href="uploads/67595adb3492c_MGC_6_1_021_xcam6_beta11.apk" download="67595adb3492c_MGC_6_1_021_xcam6_beta11.apk" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2024-12-11 14:26:51</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1412" class="chat-message ">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">4 files</p>
				  							<br>
			                <a href="uploads/67595b040757c_Emby-for-Android-TV-MOD-2_1_21g.apk,uploads/67595b0407704_logiclike-brain-training-v1_2_82-mod.apk,uploads/67595b0407807_VideoJquery Fullcalandar Integration with PHP and Mysql.mp4" download="67595b0407807_VideoJquery Fullcalandar Integration with PHP and Mysql.mp4" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2024-12-11 14:27:32</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1413" class="chat-message ">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">books</p>
				  							<br>
			                <a href="uploads/67595bb12ae6d_[Guru3D.com]-MSIAfterburnerSetup462Build15745.zip,uploads/67595bb12b028_HeadFirst-OOAD-master.zip,uploads/67595bb12be80_HeadFirst-CSharp-master.zip" download="67595bb12be80_HeadFirst-CSharp-master.zip" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2024-12-11 14:30:25</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1414" class="chat-message ">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">dksa</p>
				  							<br>
			                <a href="uploads/67595df667e8c_muddassarL502x.zip,uploads/67595df66803c_BDU_v2.1.2017.021b.zip,uploads/67595df668179_OSInstaller(MBR)10.12.6.16G29.zip,uploads/67595df6682cd_OSInstaller(MBR)10.13.1.17B48.zip,uploads/67595df6683fe_macOS High Sierra Basic Kexts.zip,u" download="67595df6683fe_macOS High Sierra Basic Kexts.zip,u" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2024-12-11 14:40:06</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1415" class="chat-message ">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">checking files section if it gets updated dynamically</p>
				  							<br>
			                <a href="uploads/6759609a9ddfc_Sanet.st_2. While Loop Test1.html,uploads/6759609a9df86_Sanet.st_3. While loop example - C++ program to find factorial of a number..mp4,uploads/6759609a9e0f7_Sanet.st_4. Write another program using while loop - Find sum of numbers us" download="6759609a9e0f7_Sanet.st_4. Write another program using while loop - Find sum of numbers us" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2024-12-11 14:51:22</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1416" class="chat-message ">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">checking files section if it gets updated dynamically 2nd time</p>
				  							<br>
			                <a href="uploads/675960e9856f4_android_winusb.inf,uploads/675960e985988_androidwinusb86.cat,uploads/675960e985b66_androidwinusba64.cat,uploads/675960e986a5e_source.properties" download="675960e986a5e_source.properties" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2024-12-11 14:52:41</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1417" class="chat-message ">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">checking files section if it gets updated dynamically 3rd time</p>
				  							<br>
			                <a href="uploads/6759613c079a6_WdfCoInstaller01009.dll,uploads/6759613c07b93_winusbcoinstaller2.dll,uploads/6759613c07cb9_WUDFUpdate_01009.dll" download="6759613c07cb9_WUDFUpdate_01009.dll" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2024-12-11 14:54:04</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1418" class="chat-message ">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">my best picture</p>
				  							<br>
			                <a href="uploads/6759620d148cd_passport.jpg" download="6759620d148cd_passport.jpg" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2024-12-11 14:57:33</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1419" class="chat-message ">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">beautiful girl</p>
				  							<br>
			                <a href="uploads/67596268eeea8_2023-05-23_15-54-03.png" download="67596268eeea8_2023-05-23_15-54-03.png" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2024-12-11 14:59:04</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1420" class="chat-message ">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">hello 2o</p>
				  							<br>
			                <a href="uploads/675962f728916_call.jpg" download="675962f728916_call.jpg" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2024-12-11 15:01:27</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1421" class="chat-message ">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">beautiful RED TRUCK</p>
				  							<br>
			                <a href="uploads/67596390a1dc0_Industry-Update-January-8-2020.jpg" download="67596390a1dc0_Industry-Update-January-8-2020.jpg" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2024-12-11 15:04:00</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1422" class="chat-message ">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">american map</p>
				  							<br>
			                <a href="uploads/675963cf61b1d_How-to-Filter-Locations-on-the-Map.jpg" download="675963cf61b1d_How-to-Filter-Locations-on-the-Map.jpg" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2024-12-11 15:05:03</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1423" class="chat-message ">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">check</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-11 15:05:18</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1424" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">checking with header footer</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-11 21:38:46</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1425" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">check 2 with 1 file</p>
				  							<br>
			                <a href="uploads/6759c028bd9c9_20211212_224807.jpg" download="6759c028bd9c9_20211212_224807.jpg" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2024-12-11 21:39:04</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1426" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">check 3 with multiple files</p>
				  							<br>
			                <a href="uploads/6759c0503d235_id back.jpg,uploads/6759c0503d51d_id front.jpg" download="6759c0503d51d_id front.jpg" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2024-12-11 21:39:44</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1427" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">adsf</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2024-12-12 01:04:03</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1430" class="chat-message ">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">t1 ka notification check</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-02 09:29:48</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1431" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">admin se notification check</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-02 09:37:37</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1432" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">askdf</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-02 09:41:16</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1433" class="chat-message ">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">hdsa</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-02 09:54:28</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1434" class="chat-message ">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">hcalo</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-02 09:55:08</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1435" class="chat-message ">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">check 5</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-02 09:59:11</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1436" class="chat-message ">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">ssss</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-02 10:21:52</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1437" class="chat-message ">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">samabdar</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-02 10:35:01</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1438" class="chat-message ">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">kkk</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-03 22:18:00</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1439" class="chat-message ">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">click check</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-03 22:26:02</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1447" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0"></p>
				  							<br>
			                <a href="uploads/677de08532ef2_app-logistics-fleet.js" download="677de08532ef2_app-logistics-fleet.js" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-08 07:18:45</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1448" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">calendar</p>
				  							<br>
			                <a href="uploads/677de5437333b_app-calendar.js" download="677de5437333b_app-calendar.js" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-08 07:38:59</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1449" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">hello world scroll check on message sending</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 02:48:57</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1450" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">large file check</p>
				  							<br>
			                <a href="uploads/6790166cd91e3_htmlpad2025.exe" download="6790166cd91e3_htmlpad2025.exe" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 02:49:32</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1451" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">again large file</p>
				  							<br>
			                <a href="uploads/679016b23fe37_com-mod-emby-for-android-mod-apk-unlocked-3-4-20-300004203.apk" download="679016b23fe37_com-mod-emby-for-android-mod-apk-unlocked-3-4-20-300004203.apk" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 02:50:42</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1452" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0"></p>
				  							<br>
			                <a href="uploads/6790188041da0_com-mod-emby-for-android-mod-apk-unlocked-3-4-20-300004203.apk,uploads/6790188041fd2_openvpn-connect-3.5.1.3946_signed.msi" download="6790188041fd2_openvpn-connect-3.5.1.3946_signed.msi" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 02:58:24</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1453" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">lim zip</p>
				  							<br>
			                <a href="uploads/679018ba96b7d_lim.zip" download="679018ba96b7d_lim.zip" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 02:59:22</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1454" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0"></p>
				  							<br>
			                <a href="uploads/67901ff494144_RB REVISION.psd,uploads/67901ff494440_RITE BOOKS REVISION FILE 2.svg,uploads/67901ff4946ec_RITE BOOKS REVISION FILE.ai" download="67901ff4946ec_RITE BOOKS REVISION FILE.ai" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 03:30:12</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1455" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">multiple files</p>
				  							<br>
			                <a href="uploads/6790215b6a8da_add_user.php,uploads/6790215b6b02c_Admin_Dashboard.php,uploads/6790215b6b3d2_assign_project.php,uploads/6790215b6b784_calendaly key.txt,uploads/6790215b6c0d1_clients.php,uploads/6790215b6cc66_composer.json,uploads/6790215b6cf2e_compo" download="6790215b6cf2e_compo" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 03:36:11</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1456" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">3 file</p>
				  							<br>
			                <a href="uploads/679021db71b82_footer.php,uploads/679021db71e20_sidebar.php,uploads/679021db72014_user-side.php" download="679021db72014_user-side.php" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 03:38:19</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1457" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0"></p>
				  							<br>
			                <a href="uploads/6790261f43b96_calendly_functions.php,uploads/6790261f43f4e_credentials.txt,uploads/6790261f44232_cron_meeting_notifications.php,uploads/6790261f445b4_smtp_config.php" download="6790261f445b4_smtp_config.php" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 03:56:31</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1458" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">4 files</p>
				  							<br>
			                <a href="uploads/6790292688d40_calendly_functions.php,uploads/6790292689178_credentials.txt,uploads/6790292689515_cron_meeting_notifications.php,uploads/679029268987c_smtp_config.php" download="679029268987c_smtp_config.php" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 04:09:26</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1459" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">2 dfi</p>
				  							<br>
			                <a href="uploads/67902a9fa581f_cron_meeting_notifications.php,uploads/67902a9fa5c9e_smtp_config.php" download="67902a9fa5c9e_smtp_config.php" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 04:15:43</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1460" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0"></p>
				  							<br>
			                <a href="uploads/67902ae054b31_assign_project.php" download="67902ae054b31_assign_project.php" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 04:16:48</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1461" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">admin</p>
				  							<br>
			                <a href="uploads/67902cf88a267_Admin_Dashboard.php" download="67902cf88a267_Admin_Dashboard.php" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 04:25:44</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1462" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">admin</p>
				  							<br>
			                <a href="uploads/67902d519ccb5_Admin_Dashboard.php" download="67902d519ccb5_Admin_Dashboard.php" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 04:27:13</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1463" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">admin</p>
				  							<br>
			                <a href="uploads/67902d5d0716d_Admin_Dashboard.php" download="67902d5d0716d_Admin_Dashboard.php" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 04:27:25</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1464" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">add</p>
				  							<br>
			                <a href="uploads/67902e6b26fb6_add_user.php" download="67902e6b26fb6_add_user.php" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 04:31:55</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1465" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">cpn</p>
				  							<br>
			                <a href="uploads/67902ebf2e45e_openvpn-connect-3.6.0.4074_signed.msi" download="67902ebf2e45e_openvpn-connect-3.6.0.4074_signed.msi" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 04:33:19</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1466" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0"></p>
				  							<br>
			                <a href="uploads/67903087b1d0a_Rockchip Upgrade Tool.zip" download="67903087b1d0a_Rockchip Upgrade Tool.zip" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 04:40:55</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1467" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">upgrade</p>
				  							<br>
			                <a href="uploads/679031e4c26da_H96 MAX M9 Upgrade Tool.zip" download="679031e4c26da_H96 MAX M9 Upgrade Tool.zip" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 04:46:44</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1468" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">upgrade</p>
				  							<br>
			                <a href="uploads/679031e4c68ab_H96 MAX M9 Upgrade Tool.zip" download="679031e4c68ab_H96 MAX M9 Upgrade Tool.zip" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 04:46:44</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1469" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">hello</p>
				  							<br>
			                <a href="uploads/6790335d9ab95_Windows 7 Start Orb Changer.zip,uploads/6790335d9afde_CV for web development.zip,uploads/6790335d9b33c_wPrime210.zip,uploads/6790335d9b660_Fall 2015_CS502_1.rar,uploads/6790335d9b998_IntelPowerGadget64-bit_3.0.7.zip,uploads/6790335d9" download="6790335d9" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 04:53:01</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1470" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">hello</p>
				  							<br>
			                <a href="uploads/679034aaa37c3_SLIMBOX-AOSP-VONTAR-ver8.1.7z" download="679034aaa37c3_SLIMBOX-AOSP-VONTAR-ver8.1.7z" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 04:58:34</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1471" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">vontar file</p>
				  							<br>
			                <a href="uploads/6790375327a73_SLIMBOX-AOSP-VONTAR-ver8.1.7z" download="6790375327a73_SLIMBOX-AOSP-VONTAR-ver8.1.7z" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 05:09:55</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1472" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0"></p>
				  							<br>
			                <a href="uploads/6790389f35756_10. Grips and clamps.mp4,uploads/6790389f35b0e_11. Studio backgrounds.mp4,uploads/6790389f35e84_12. Creating clean white backgrounds.mp4,uploads/6790389f361ec_13. Creating gradient backgrounds.mp4" download="6790389f361ec_13. Creating gradient backgrounds.mp4" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 05:15:27</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1473" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">great</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 05:37:19</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1474" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">dddd</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 05:42:20</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1475" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">mo</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 05:48:41</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1476" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">hie</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 05:52:41</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1477" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">hello</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 05:57:22</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1478" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">cv and orb</p>
				  							<br>
			                <a href="uploads/6790469d23641_CV for web development.zip" download="6790469d23641_CV for web development.zip" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 06:15:09</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1479" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">video</p>
				  							<br>
			                <a href="uploads/67904afc68cb2_4. sed Command.mp4" download="67904afc68cb2_4. sed Command.mp4" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 06:33:48</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1480" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">got</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 07:52:42</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1481" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">djsl</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 07:53:33</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1482" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0"></p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 07:53:45</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1483" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">got it</p>
				  							<br>
			                <a href="uploads/67905def0d0d7_3. Difference between vi and vim Editors.mp4" download="67905def0d0d7_3. Difference between vi and vim Editors.mp4" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 07:54:39</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1484" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">pdf faltu</p>
				  							<br>
			                <a href="uploads/67905eeba9c7a_28.13 9-Unix Programs.pdf" download="67905eeba9c7a_28.13 9-Unix Programs.pdf" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 07:58:51</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1485" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">hello</p>
				  							<br>
			                <a href="uploads/679074f067ff0_24.4 15-Red_Hat_Enterprise_Linux-8-Configuring_basic_system_settings-en-US.pdf" download="679074f067ff0_24.4 15-Red_Hat_Enterprise_Linux-8-Configuring_basic_system_settings-en-US.pdf" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 09:32:48</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1486" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">d</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 10:32:07</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1487" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">yyyy</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 11:00:17</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1488" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">afasdf</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 11:00:30</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1489" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">send parts of OS</p>
				  							<br>
			                <a href="uploads/6790eea481c14_7.2 Parts of OS.pdf" download="6790eea481c14_7.2 Parts of OS.pdf" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 18:12:04</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1490" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">3 files</p>
				  							<br>
			                <a href="uploads/6790eee1acc2f_7.3 Operating system.pdf,uploads/6790eee1aceb6_7.4 Hard Disk and Disk Cache.pdf,uploads/6790eee1ad09d_7.5 Virtual memory.pdf" download="6790eee1ad09d_7.5 Virtual memory.pdf" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 18:13:05</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1491" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">complete</p>
				  							<br>
			                <a href="uploads/6790efd1563cb_7.2 Parts of OS.pdf,uploads/6790efd156658_7.3 Operating system.pdf,uploads/6790efd15696b_7.4 Hard Disk and Disk Cache.pdf" download="6790efd15696b_7.4 Hard Disk and Disk Cache.pdf" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 18:17:05</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1492" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0"></p>
				  							<br>
			                <a href="uploads/6790f03fabae0_20.2 CentOS Installation Guide.pdf,uploads/6790f03fabcbe_20.3 Red_Hat_Enterprise_Linux-7-Installation_Guide-en-US.pdf" download="6790f03fabcbe_20.3 Red_Hat_Enterprise_Linux-7-Installation_Guide-en-US.pdf" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 18:18:55</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1493" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">hello</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 18:19:56</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1494" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">go for it</p>
				  							<br>
			                <a href="uploads/6790f11607e5c_20.4 Changing-from-32-to-64bit.pdf,uploads/6790f11608131_20.5 Oracle Virtual Box User Manual.pdf" download="6790f11608131_20.5 Oracle Virtual Box User Manual.pdf" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 18:22:30</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1495" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">fg</p>
				  							<br>
			                <a href="uploads/6790f18eadda5_19.1 Module-2-Homework.pdf" download="6790f18eadda5_19.1 Module-2-Homework.pdf" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 18:24:30</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1496" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">fg</p>
				  							<br>
			                <a href="uploads/6790f195a857d_19.1 Module-2-Homework.pdf" download="6790f195a857d_19.1 Module-2-Homework.pdf" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 18:24:37</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1497" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">fg\</p>
				  							<br>
			                <a href="uploads/6790f1975e7fb_19.1 Module-2-Homework.pdf" download="6790f1975e7fb_19.1 Module-2-Homework.pdf" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 18:24:39</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1498" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">u</p>
				  							<br>
			                <a href="uploads/6790f22e8c0bb_20.5 Oracle Virtual Box User Manual.pdf" download="6790f22e8c0bb_20.5 Oracle Virtual Box User Manual.pdf" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 18:27:10</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1499" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">yhm</p>
				  							<br>
			                <a href="uploads/6790f2d294ac7_20.5 Oracle Virtual Box User Manual.pdf" download="6790f2d294ac7_20.5 Oracle Virtual Box User Manual.pdf" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 18:29:54</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1500" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">interview tip</p>
				  							<br>
			                <a href="uploads/6790f32116648_14.2 In-Person Interview Tip.pdf" download="6790f32116648_14.2 In-Person Interview Tip.pdf" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 18:31:13</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1501" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">post resume</p>
				  							<br>
			                <a href="uploads/6790f385bb67a_14.7 5-Post Resume and What to Expect.pdf" download="6790f385bb67a_14.7 5-Post Resume and What to Expect.pdf" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 18:32:53</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1502" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">interview workshop</p>
				  							<br>
			                <a href="uploads/6790f56084fa0_14.6 1-Interview Workshop.pdf" download="6790f56084fa0_14.6 1-Interview Workshop.pdf" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 18:40:48</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1503" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">POST RESUME</p>
				  							<br>
			                <a href="uploads/6790f6365eaba_14.7 5-Post Resume and What to Expect.pdf" download="6790f6365eaba_14.7 5-Post Resume and What to Expect.pdf" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 18:44:22</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1504" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">POST RESUME</p>
				  							<br>
			                <a href="uploads/6790f65be761d_14.7 5-Post Resume and What to Expect.pdf" download="6790f65be761d_14.7 5-Post Resume and What to Expect.pdf" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 18:44:59</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1505" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">module10</p>
				  							<br>
			                <a href="uploads/6790f6a002c6b_14.4 Module-10.pdf" download="6790f6a002c6b_14.4 Module-10.pdf" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 18:46:08</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1506" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">tips</p>
				  							<br>
			                <a href="uploads/6790f6eae1185_14.3 3-Interview-Tips.pdf" download="6790f6eae1185_14.3 3-Interview-Tips.pdf" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 18:47:22</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1507" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">helllo</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 18:48:09</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1508" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">dsasd</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 18:48:14</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1509" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">dasd</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 18:48:18</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1510" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">certification</p>
				  							<br>
			                <a href="uploads/6790f7b2d281c_14.5 6-Redhat Certifications.pdf" download="6790f7b2d281c_14.5 6-Redhat Certifications.pdf" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 18:50:42</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1511" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">hello world</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 18:59:54</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1512" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">hellod</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 19:02:29</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1513" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">ndansd</p>
				  							<br>
			                <a href="uploads/6790fa9371d70_14.4 Module-10.pdf" download="6790fa9371d70_14.4 Module-10.pdf" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 19:02:59</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1514" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">Not to say</p>
				  							<br>
			                <a href="uploads/67910a4e9bec0_14.8 2-Interviews-What-not-to-say.pdf" download="67910a4e9bec0_14.8 2-Interviews-What-not-to-say.pdf" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 20:10:06</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1515" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">message id confirmed</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 20:33:50</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1516" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">Spec sheet</p>
				  							<br>
			                <a href="uploads/67910ffa625a3_R-52C_Spec-Sheet_v01.pdf" download="67910ffa625a3_R-52C_Spec-Sheet_v01.pdf" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 20:34:18</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1517" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">hello 2</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 20:35:21</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1518" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">file upload cleaning check</p>
				  							<br>
			                <a href="uploads/6791104f0ad87_Energy-Mate APP User Manual-20230628.pdf" download="6791104f0ad87_Energy-Mate APP User Manual-20230628.pdf" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 20:35:43</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1519" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">battery Tech</p>
				  							<br>
			                <a href="uploads/679111166cdd4_BatteryTechSpecification.pdf" download="679111166cdd4_BatteryTechSpecification.pdf" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 20:39:02</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1520" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">chak dy</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 21:57:45</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1521" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">chaaaaaa</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 21:58:32</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1522" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">sikkkkaaaaaa</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 21:59:26</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1523" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">nnn</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 21:59:43</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1524" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">pooooppppppppppppp</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 22:01:38</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1525" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">samay</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 22:03:03</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1526" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">vc</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 22:14:23</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1527" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">askjdf</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 22:15:16</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1528" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">jads</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 22:19:49</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1529" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">nhda</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 22:23:30</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1530" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">hdnx</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 22:24:46</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1531" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">hello world</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 22:32:03</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1532" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">ha</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 22:32:09</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1533" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">alsdkf</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 22:32:14</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1534" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">samandari</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 22:32:36</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1535" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">jackal</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 22:32:41</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1536" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">jads</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 22:38:56</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1537" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">ye dua hai meri rab se</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 22:40:35</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1538" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">asdf</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 22:41:43</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1539" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">jdn</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 22:42:29</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1540" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">hye</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 22:43:05</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1541" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">sach to bata</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 22:43:14</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1542" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">kuch to bata</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 22:43:22</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1543" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">chaye vaye</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 22:44:28</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1544" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">koi nahi</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 22:44:31</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1545" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">sach muhc</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 22:44:35</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1546" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">pyare</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-22 22:44:38</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1547" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">nasdnas</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-23 09:42:41</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1548" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">chal bay</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-23 09:42:52</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1549" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">faheem</p>
				  							<br>
			                <a href="uploads/6791c96da0c1e_ResumeFaheemEjaz.pdf" download="6791c96da0c1e_ResumeFaheemEjaz.pdf" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-23 09:45:33</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1550" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">faheem2</p>
				  							<br>
			                <a href="uploads/6791c984857d8_ResumeFaheemEjaz.pdf" download="6791c984857d8_ResumeFaheemEjaz.pdf" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-23 09:45:56</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1551" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">hybridv3</p>
				  							<br>
			                <a href="uploads/6791c9a116182_HYBRID V-3P.pdf" download="6791c9a116182_HYBRID V-3P.pdf" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-23 09:46:25</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1552" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">daana paani</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-23 09:49:51</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1553" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">chakdyyyyy</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-23 09:55:18</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1554" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">nxm</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-23 09:56:19</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1555" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">ankhain</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-23 10:01:34</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1556" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">mar gayi</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-23 10:03:31</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1557" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">lollllll</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-23 10:04:10</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1558" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">njdx</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-23 10:05:32</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1559" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">numxb</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-23 10:11:42</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1560" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">hello world meri sunlo zara</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-23 10:12:19</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1561" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">mxnz</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-23 10:13:32</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1562" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">admi jo kehta hai</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-23 10:15:37</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1563" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">awaaz do humko</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-23 10:22:07</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1564" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">hum kho gaye</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-23 10:24:52</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1565" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">kab neend se jaagay</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-23 10:27:18</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1566" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">kab so gaye</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-23 10:28:34</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1567" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">mar jayen gain hum agar</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-23 10:30:30</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1568" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">door tumse ho gaye</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-23 10:31:30</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1569" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">dnannn</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-23 10:33:34</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1570" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">aja tujheneend</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-23 10:34:17</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1571" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">jackal</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-23 10:53:26</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1572" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">kill</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-23 10:59:08</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1573" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">lpo</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-23 11:01:19</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1574" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">halxo</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-23 12:15:47</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1575" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">nikaljao</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-23 12:21:30</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1576" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">nopeeppsa</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-23 12:29:08</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1577" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">last message</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-23 22:15:30</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1578" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">last message again successful</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-23 22:28:52</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1579" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">sending check</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-23 23:11:22</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1580" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0"></p>
				  							<br>
			                <a href="uploads/67928656cc64b_SolarPower user manual for Grid-tie 3KW 5KW Inverter_20220207.pdf" download="67928656cc64b_SolarPower user manual for Grid-tie 3KW 5KW Inverter_20220207.pdf" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-23 23:11:34</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1581" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">number dy jaa</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-24 02:18:40</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1582" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">mango</p>
				  							<br>
			                <a href="uploads/6792b76a4df61_ARH7110A.pdf" download="6792b76a4df61_ARH7110A.pdf" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-24 02:40:58</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1583" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0"></p>
				  							<br>
			                <a href="uploads/6792ba60d994e_Invoice #21878.pdf" download="6792ba60d994e_Invoice #21878.pdf" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-24 02:53:36</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1586" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">ProgressBar Check</p>
				  							<br>
			                <a href="uploads/679315000a726_2023-09-8-Parcel-Tariff-Rates.pdf" download="679315000a726_2023-09-8-Parcel-Tariff-Rates.pdf" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-24 09:20:16</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1587" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">invoice going up</p>
				  							<br>
			                <a href="uploads/67931c4d0f4cb_Invoice #21877.pdf" download="67931c4d0f4cb_Invoice #21877.pdf" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-24 09:51:25</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1588" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0"></p>
				  							<br>
			                <a href="uploads/67931c653711b_Invoice #21878.pdf,uploads/67931c65374c9_Invoice-A5D23D47-0002.pdf,uploads/67931c65377ad_dat-zip-zone-directory_2.pdf,uploads/67931c6537ad0_dat-zip-zone-directory.pdf,uploads/67931c6537d54_Firmware_Update_VSX-832_02-02-2022.pdf" download="67931c6537d54_Firmware_Update_VSX-832_02-02-2022.pdf" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-24 09:51:49</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1589" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0"></p>
				  							<br>
			                <a href="uploads/6793232ea6218_WatchPower user manual.pdf" download="6793232ea6218_WatchPower user manual.pdf" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-24 10:20:46</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1590" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0"></p>
				  							<br>
			                <a href="uploads/67932428739c2_Documents-Upload-Guideline-PakID.pdf,uploads/6793242873d2d_Mirza Muddassar Hussain 2024 CV.pdf,uploads/679324287403c_optiplex-5060-desktop_specifications3_en-us.pdf,uploads/67932428742d3_2023-09-8-Parcel-Tariff-Rates.pdf,uploads/6793" download="6793" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-24 10:24:56</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1591" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">shown filenamedispklay</p>
				  							<br>
			                <a href="uploads/679327e234ff8_Wi-Fi Module and WatchPower APP User Mnaul 20191129.pdf" download="679327e234ff8_Wi-Fi Module and WatchPower APP User Mnaul 20191129.pdf" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-24 10:40:50</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1592" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">sample</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-24 10:54:02</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1593" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0"></p>
				  							<br>
			                <a href="uploads/67932e8fc6698_Data Structures Notes - TutorialsDuniya.pdf" download="67932e8fc6698_Data Structures Notes - TutorialsDuniya.pdf" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-24 11:09:19</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1594" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">new uploia</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-24 11:19:54</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1595" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">pak id</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-24 11:33:38</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1596" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">b</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-24 11:34:49</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1597" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">hellll</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-24 13:50:40</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1598" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">hello mmmee</p>
				  							<br>
			                <a href="uploads/6793548261f35_gparted-live-1.5.0-6-i686.zip" download="6793548261f35_gparted-live-1.5.0-6-i686.zip" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-24 13:51:14</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1599" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">hv</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-25 03:50:35</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1600" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0"></p>
				  							<br>
			                <a href="uploads/67941a93e10cb_Chameleon-2.2svn-r2404-binaries.tar.gz" download="67941a93e10cb_Chameleon-2.2svn-r2404-binaries.tar.gz" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-25 03:56:19</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1601" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0"></p>
				  							<br>
			                <a href="uploads/679421c239688_gparted-live-1.5.0-6-i686.zip" download="679421c239688_gparted-live-1.5.0-6-i686.zip" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-25 04:26:58</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1602" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">message sending file updating check</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-25 04:48:42</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1603" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">hello worldmmxmz</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-25 04:58:24</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1604" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">message check update</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-25 04:58:38</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1605" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">x</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-25 04:58:55</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1606" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">ir</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-25 04:59:02</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1607" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">uuuuu</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-25 04:59:22</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1608" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">b</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-25 05:02:08</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1609" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">getting scrolling check</p>
				  							<br>
			                <a href="uploads/67942d23c2382_Chameleon-2.2svn-r2404-binaries.tar.gz,uploads/67942d23c25ea_Patched_AICPUPM_10.12.3.zip,uploads/67942d23c279d_E6220.zip,uploads/67942d23c294e_E6220_A13.zip,uploads/67942d23c2af2_DSDT.aml.zip,uploads/67942d23c2c85_muddassarL502x.zip" download="67942d23c2c85_muddassarL502x.zip" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-25 05:15:31</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1610" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">another scrolling twice check</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-25 05:17:14</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1611" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">3rd check for last message view in scrolltobottom</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-25 05:21:08</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1612" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">m*m sq conversion file</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-25 06:12:24</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1613" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">m*m sq conversion file</p>
				  							<br>
			                <a href="uploads/67943ab3f19d4_M&#039;n&#039;M Conversions[1490].zip" download="67943ab3f19d4_M&#039;n&#039;M Conversions[1490].zip" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-25 06:13:23</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1614" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0"></p>
				  							<br>
			                <a href="uploads/6794411f333ea_divi-layouts.zip" download="6794411f333ea_divi-layouts.zip" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-25 06:40:47</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1615" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0"></p>
				  							<br>
			                <a href="uploads/679448268d882_Backlighting Sun and Flash.zip,uploads/679448268da56_Blackmagic_Desktop_Video_Windows_12.8.1.zip" download="679448268da56_Blackmagic_Desktop_Video_Windows_12.8.1.zip" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-25 07:10:46</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1616" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0"></p>
				  							<br>
			                <a href="uploads/67944833ba55d_Backlighting Sun and Flash.zip,uploads/67944833ba730_Blackmagic_Desktop_Video_Windows_12.8.1.zip" download="67944833ba730_Blackmagic_Desktop_Video_Windows_12.8.1.zip" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-25 07:10:59</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1617" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0"></p>
				  							<br>
			                <a href="uploads/67944868bf446_Detect karta hai KTS ko KRT_CLUB_3.1.0.29.zip,uploads/67944868bf8eb_05_Notifications.zip" download="67944868bf8eb_05_Notifications.zip" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-25 07:11:52</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1618" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0"></p>
				  							<br>
			                <a href="uploads/67944887526fd_WinDFT095.zip,uploads/6794488752931_vecteezy_physician-and-nurse-taking-care-of-an-elderly-patient-vector-illustration_1249291.zip,uploads/6794488752ac0_grocery-crud-codeigniter-4-2.0.1.zip" download="6794488752ac0_grocery-crud-codeigniter-4-2.0.1.zip" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-25 07:12:23</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1619" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0"></p>
				  							<br>
			                <a href="uploads/67944a0fbf123_WinDFT095.zip,uploads/67944a0fbf31f_vecteezy_physician-and-nurse-taking-care-of-an-elderly-patient-vector-illustration_1249291.zip,uploads/67944a0fbf501_grocery-crud-codeigniter-4-2.0.1.zip,uploads/67944a0fbf6b7_vecteezy_young-woman-" download="67944a0fbf6b7_vecteezy_young-woman-" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-25 07:18:55</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1620" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0"></p>
				  							<br>
			                <a href="uploads/67944b6336d19_LG_SmartShare_WAL_33_2.3.1511.1201.zip" download="67944b6336d19_LG_SmartShare_WAL_33_2.3.1511.1201.zip" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-25 07:24:35</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1621" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0"></p>
				  							<br>
			                <a href="uploads/67944b76a2398_geopos preinstalled.zip" download="67944b76a2398_geopos preinstalled.zip" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-25 07:24:54</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1622" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0"></p>
				  							<br>
			                <a href="uploads/67944ccf47fd2_divi-layouts.zip" download="67944ccf47fd2_divi-layouts.zip" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-25 07:30:39</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1623" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0"></p>
				  							<br>
			                <a href="uploads/67944d0064ebe_divi-layouts.zip" download="67944d0064ebe_divi-layouts.zip" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-25 07:31:28</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1624" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">adfa</p>
				  							<br>
			                <a href="uploads/67944e094c069_flip-html5.zip" download="67944e094c069_flip-html5.zip" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-25 07:35:53</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1625" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0"></p>
				  							<br>
			                <a href="uploads/67944e589d5f4_gparted-live-1.5.0-6-i686.zip" download="67944e589d5f4_gparted-live-1.5.0-6-i686.zip" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-25 07:37:12</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1626" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0"></p>
				  							<br>
			                <a href="uploads/67944e82af5d0_HeadFirst-CSharp-master.zip" download="67944e82af5d0_HeadFirst-CSharp-master.zip" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-25 07:37:54</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1627" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">sdfaad</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-25 07:39:23</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1628" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">Go</p>
				  							<br>
			                <a href="uploads/6794517756572_leather-texture-samples-realistic-set.jpg.zip,uploads/6794517756747_wordpress-6.1.1.zip,uploads/6794517756896_divi-modules.rar,uploads/67945177569f2_Camera Uploads.rar,uploads/6794517756b56_betheme_v26.7.3.1.zip,uploads/6794517756c94" download="6794517756c94" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-25 07:50:31</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1629" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">new progressbar</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-25 08:53:55</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1630" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">hellommmm</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-25 18:28:23</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1631" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">ccc</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-25 18:28:37</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1632" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">indoor photography</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-25 18:29:18</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1633" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0"></p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-25 18:34:36</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1634" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0"></p>
				  							<br>
			                <a href="uploads/67956574361a8_Documents-Upload-Guideline-PakID.pdf" download="67956574361a8_Documents-Upload-Guideline-PakID.pdf" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-26 03:28:04</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1635" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">receiver type being uploaded or not check</p>
				  							<br>
			                <a href="uploads/67956959ec402_BatteryTechSpecification.pdf" download="67956959ec402_BatteryTechSpecification.pdf" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-26 03:44:41</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1636" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">receiver type being uploaded or not check 2</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-26 03:47:45</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1637" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">receiver type being uploaded or not check 3</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-26 03:49:11</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1638" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">jsad</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-26 03:49:46</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1639" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">receiver type being uploaded or not check  finally</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-26 03:53:16</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1640" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">4 files together new interface</p>
				  							<br>
			                <a href="uploads/6795796632e2b_Android_CompleteNotes.pdf,uploads/679579663301b_slides-students-C04.pdf,uploads/6795796633176_mob.pdf,uploads/6795796633636_VSX-832-UserManual1.pdf" download="6795796633636_VSX-832-UserManual1.pdf" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-26 04:53:10</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1641" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">multiple files</p>
				  							<br>
			                <a href="uploads/67958c8760df3_LG_SmartShare_WAL_33_2.3.1511.1201.zip" download="67958c8760df3_LG_SmartShare_WAL_33_2.3.1511.1201.zip" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-26 06:14:47</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1642" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0"></p>
				  							<br>
			                <a href="uploads/67958cde04691_gparted-live-1.5.0-6-i686.zip,uploads/67958cde04847_divi-layouts.zip" download="67958cde04847_divi-layouts.zip" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-26 06:16:14</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1643" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0"></p>
				  							<br>
			                <a href="uploads/67959f58cbb5c_divi-layouts.zip" download="67959f58cbb5c_divi-layouts.zip" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-26 07:35:04</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1644" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0"></p>
				  							<br>
			                <a href="uploads/6795a0fed55ef_20240331_alilimoservices_f4ff7972421022bc8802_20240331153335_archive.zip" download="6795a0fed55ef_20240331_alilimoservices_f4ff7972421022bc8802_20240331153335_archive.zip" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-26 07:42:06</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1645" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0"></p>
				  							<br>
			                <a href="uploads/6795a6a713ee7_20240331_alilimoservices_f4ff7972421022bc8802_20240331153335_archive.zip,uploads/6795a6a726f49_Photographing_kids_Karl_Taylor_Education.zip" download="6795a6a726f49_Photographing_kids_Karl_Taylor_Education.zip" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-26 08:06:15</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1646" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0"></p>
				  							<br>
			                <a href="uploads/6795aadcb59ec_gparted-live-1.5.0-6-i686.zip,uploads/6795aadcb5db4_divi-layouts.zip" download="6795aadcb5db4_divi-layouts.zip" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-26 08:24:12</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1647" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0"></p>
				  							<br>
			                <a href="uploads/6795adfe5b385_Intel-FORCED-10x64-RTM-HD5000_20.19.15.5171-drp.zip,uploads/6795adfe5b706_LG_SmartShare_WAL_33_2.3.1511.1201.zip" download="6795adfe5b706_LG_SmartShare_WAL_33_2.3.1511.1201.zip" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-26 08:37:34</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1648" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0"></p>
				  							<br>
			                <a href="uploads/6795bc53465ce_Intel-FORCED-10x64-RTM-HD5000_20.19.15.5171-drp.zip,uploads/6795bc534679b_LG_SmartShare_WAL_33_2.3.1511.1201.zip,uploads/6795bc5346950_Install_usb_disk_Debian11(OMV6)(GPL_MCH_Monarch_8.7.0-107_20220623).zip" download="6795bc5346950_Install_usb_disk_Debian11(OMV6)(GPL_MCH_Monarch_8.7.0-107_20220623).zip" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-26 09:38:43</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1649" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0"></p>
				  							<br>
			                <a href="uploads/6795be0ad2519_HeadFirst-OOAD-master.zip,uploads/6795be0ad2750_themeforest-trcZ0sR6-textron-industrial-wordpress-theme-woocommerce.zip,uploads/6795be0ad2978_themeforest-gAkYtswo-pannonia-fully-responsive-admin-template.zip,uploads/6795be0ad2b70_Jav" download="6795be0ad2b70_Jav" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-26 09:46:02</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1650" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0"></p>
				  							<br>
			                <a href="uploads/6795c08918202_gparted-live-1.5.0-6-i686.zip,uploads/6795c089183f8_divi-layouts.zip" download="6795c089183f8_divi-layouts.zip" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-26 09:56:41</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1651" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0"></p>
				  							<br>
			                <a href="uploads/6795c16678427_20240331_alilimoservices_f4ff7972421022bc8802_20240331153335_archive.zip" download="6795c16678427_20240331_alilimoservices_f4ff7972421022bc8802_20240331153335_archive.zip" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-26 10:00:22</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1652" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0"></p>
				  							<br>
			                <a href="uploads/6795cad0b4dff_103895_smartsliderpack3320_2.zip,uploads/6795cad0b4fc4_codecanyon-0nv1smKf-laraclassified-geo-classified-ads-cms.zip,uploads/6795cad0b5146_C Basics - For Complete Beginners.zip" download="6795cad0b5146_C Basics - For Complete Beginners.zip" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-26 10:40:32</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1653" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0"></p>
				  							<br>
			                <a href="uploads/6795ce5401ff0_divi-photo-marketplace-layout-pack-images.zip,uploads/6795ce54021b2_103895_smartsliderpack3320_2.zip,uploads/6795ce54026d8_codecanyon-0nv1smKf-laraclassified-geo-classified-ads-cms.zip" download="6795ce54026d8_codecanyon-0nv1smKf-laraclassified-geo-classified-ads-cms.zip" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-26 10:55:32</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1654" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0"></p>
				  							<br>
			                <a href="uploads/6795d861b22a5_Backlighting Sun and Flash.zip,uploads/6795d861b248f_Blackmagic_Desktop_Video_Windows_12.8.1.zip,uploads/6795d861b262f_Blackmagic_Desktop_Video_Windows_12.3.zip,uploads/6795d861b278b_AndroidPatternCrack.tar.gz" download="6795d861b278b_AndroidPatternCrack.tar.gz" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-26 11:38:25</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1655" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0"></p>
				  							<br>
			                <a href="uploads/6795d8cc00101_Backlighting Sun and Flash.zip,uploads/6795d8cc0035d_Blackmagic_Desktop_Video_Windows_12.8.1.zip,uploads/6795d8cc00604_Blackmagic_Desktop_Video_Windows_12.3.zip" download="6795d8cc00604_Blackmagic_Desktop_Video_Windows_12.3.zip" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-26 11:40:12</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1656" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">mko</p>
				  							<br>
			                <a href="uploads/6795d9742801d_AndroidGestureSHA1.rar,uploads/6795d974281a0_Amlogic_USB_Burning_Tool_v3.1.0.zip,uploads/6795d974282da_CSS_ChapterWise_Notes.zip,uploads/6795d9742840b_wordpress-6.4.3.zip" download="6795d9742840b_wordpress-6.4.3.zip" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-26 11:43:00</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1657" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0"></p>
				  							<br>
			                <a href="uploads/6795daf333945_tweaking.com_windows_repair_aio.zip,uploads/6795daf333aec_Stock-v2.zip,uploads/6795daf333c3b_scrcpy-win64-v1.24.zip,uploads/6795daf333dc7_main_files mobile business app free flyer template.zip,uploads/6795daf333f25_Camera Uploads.rar" download="6795daf333f25_Camera Uploads.rar" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-26 11:49:23</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1658" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0"></p>
				  							<br>
			                <a href="uploads/6795db7db9c82_xenia-master.zip,uploads/6795db7db9e49_platform-tools_r16-windows.zip,uploads/6795db7db9fd0_productsliderforwoocommerce305.zip,uploads/6795db7dba144_IntelPowerGadget64-bit_3.0.7.zip,uploads/6795db7dba323_xemu-win-release.zip" download="6795db7dba323_xemu-win-release.zip" class="download-link">Download File</a>
						                </div>
                <div class="text-muted mt-1">
                  <small>2025-01-26 11:51:41</small>
                </div>
              </div>
            </div>
          </li>
                  <li id="message-1659" class="chat-message chat-message-right">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0">hd,x</p>
				                  </div>
                <div class="text-muted mt-1">
                  <small>2025-01-26 12:19:48</small>
                </div>
              </div>
            </div>
          </li>
              </ul>
    </div>
    <!-- Chat Input -->
    <div class="chat-history-footer">
      <form class="form-send-message d-flex justify-content-between align-items-center">
        <input type="text" name="message" class="form-control message-input me-4 shadow-none" placeholder="Type your message here..." />
        <div class="message-actions d-flex align-items-center">
		<div class="upload-container container-xxl flex-grow-1 container-p-y">
  
  
  <!-- File Upload Button -->
  <div class="row">
			   <div class="col-12">
    <!-- Upload Button -->
    <label for="fileInput" class="btn btn-info" id="uploadButton">
        <i class="ri-attachment-2 ri-20px cursor-pointer"></i>
    </label>


    <!-- File Input (Hidden) -->
    <input type="file" id="fileInput" hidden multiple />


	    <!-- File Name Display-->
     <!-- Multiple File Name Display -->
      <div id="fileNameDisplay" class="mt-2">
        <!-- Dynamically populated file list -->
      </div>

    <!-- Upload Progress Bar -->
   <!-- Multiple File Progress Bars -->
      <div id="multipleFileProgress" class="mt-3">
        <!-- Dynamically populated progress bars -->
</div>
  </div>
  <!-- File Upload Button End-->
</div>

         
		 <button type="submit" class="btn btn-primary btn-send-message" >Send</button>
		 </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- /Chat History -->


                  <div class="app-overlay"></div>
                </div>
              </div>
            </div>
            <!-- / Content -->


          </div>
          <!-- Content wrapper -->
        
            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl">
                <div
                  class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
                  <div class="text-body mb-2 mb-md-0">

					&copy; <span id="currentYear"></span> Rite-Books
					
					<script>
					document.getElementById('currentYear').textContent = new Date().getFullYear();
					</script>
					
                    , made with <span class="text-danger"><i class="tf-icons ri-heart-fill"></i></span> by
                    <a href="https://pixinvent.com" target="_blank" class="footer-link">Pixinvent</a>
                  </div>
                  <div class="d-none d-lg-inline-block">
                    <a href="https://themeforest.net/licenses/standard" class="footer-link me-4" target="_blank"
                      >License</a
                    >
                    <a href="https://1.envato.market/pixinvent_portfolio" target="_blank" class="footer-link me-4"
                      >More Themes</a
                    >

                    <a
                      href="https://demos.pixinvent.com/materialize-html-admin-template/documentation/"
                      target="_blank"
                      class="footer-link me-4"
                      >Documentation</a
                    >

                    <a href="https://pixinvent.ticksy.com/" target="_blank" class="footer-link d-none d-sm-inline-block"
                      >Support</a
                    >
                  </div>
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
			
			<!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>




<!-- Drag Target Area To SlideIn Menu On Small Screens -->
      <div class="drag-target"></div>

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="/Admin2 - Copy/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="/Admin2 - Copy/assets/vendor/libs/popper/popper.js"></script>
    <script src="/Admin2 - Copy/assets/vendor/js/bootstrap.js"></script>
    <script src="/Admin2 - Copy/assets/vendor/libs/node-waves/node-waves.js"></script>
    <script src="/Admin2 - Copy/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="/Admin2 - Copy/assets/vendor/libs/hammer/hammer.js"></script>
    <script src="/Admin2 - Copy/assets/vendor/libs/i18n/i18n.js"></script>
    <script src="/Admin2 - Copy/assets/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="/Admin2 - Copy/assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="/Admin2 - Copy/assets/js/main.js"></script>

    <!-- Page JS -->


	<script>
    window.currentUserId = 1;
    window.projectId = "1";
    window.receiverId = "16";
    window.senderType = "admin";
</script>    

    <!-- Vendors JS -->
    <script src="../assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js"></script>
<script src="https://cdn.jsdelivr.net/npm/dompurify@2.3.7/dist/purify.min.js"></script>

    <!-- Page JS -->
    <script src="/Admin2 - Copy/chat/assets/app-chat.js"></script>


  </body>
</html>
