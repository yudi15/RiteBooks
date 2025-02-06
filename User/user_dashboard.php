<?php
session_start();
require '../db_connection.php';

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}else{
	$userId=$_SESSION['user_id'];
}

function updateLastActivity($user_id, $conn) {
    $stmt = $conn->prepare("UPDATE users SET last_activity = NOW() WHERE id = ?");
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $stmt->close();
}

// Call this function in your authenticated pages:
if (isset($_SESSION['user_id'])) {
	updateLastActivity($_SESSION['user_id'], $conn);
}

// Fetch user projects
$sqlActive = "SELECT * FROM projects WHERE user_id = ? AND status = 'Active'";
$sqlCompleted = "SELECT * FROM projects WHERE user_id = ? AND status = 'Completed'";
$stmtActive = $conn->prepare($sqlActive);
$stmtCompleted = $conn->prepare($sqlCompleted);

$stmtActive->bind_param('i', $userId);
$stmtCompleted->bind_param('i', $userId);

$stmtActive->execute();
$resultActive = $stmtActive->get_result();

$stmtCompleted->execute();
$resultCompleted = $stmtCompleted->get_result();

?>

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

    <title>User-Dashboard- DjBooks</title>

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
    <link rel="stylesheet" href="../assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
    <link rel="stylesheet" href="../assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
    <link rel="stylesheet" href="../assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css" />
    <link rel="stylesheet" href="../assets/vendor/libs/apex-charts/apex-charts.css" />
    <link rel="stylesheet" href="../assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="../assets/vendor/js/template-customizer.js"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
  </head>

  <body>
        <!-- Sidebar -->
		<?php include '../includes/user-side.php'; ?>
		
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <!-- Hour chart  -->
              <div class="card bg-transparent shadow-none border-0 mb-6">
                <div class="card-body row g-6 p-0 pb-5">
                  <div class="col-12 col-md-8 card-separator">
                    <h5 class="mb-2">Welcome back,<span class="h4 fw-semibold"> <?= htmlspecialchars($_SESSION['email']); ?> 👋🏻</span></h5>
                    <div class="col-12 col-lg-5">
                      <p>Your progress this week is Awesome. let's keep it up and get a lot of points reward !</p>
                    </div>
                    <div class="d-flex justify-content-between flex-wrap gap-4 me-12">
                      <div class="d-flex align-items-center gap-4 me-6 me-sm-0">
                        <div class="avatar avatar-lg">
                          <div class="avatar-initial bg-label-primary rounded-3">
                            <div>
                              <img src="../assets/svg/icons/laptop.svg" alt="paypal" class="img-fluid" />
                            </div>
                          </div>
                        </div>
                        <div class="content-right">
                          <p class="mb-1 fw-medium">Hours Spent</p>
                          <span class="text-primary mb-0 h5">34h</span>
                        </div>
                      </div>
                      <div class="d-flex align-items-center gap-4">
                        <div class="avatar avatar-lg">
                          <div class="avatar-initial bg-label-info rounded-3">
                            <div>
                              <img src="../assets/svg/icons/lightbulb.svg" alt="Lightbulb" class="img-fluid" />
                            </div>
                          </div>
                        </div>
                        <div class="content-right">
                          <p class="mb-1 fw-medium">Test Results</p>
                          <span class="text-info mb-0 h5">82%</span>
                        </div>
                      </div>
                      <div class="d-flex align-items-center gap-4">
                        <div class="avatar avatar-lg">
                          <div class="avatar-initial bg-label-warning rounded-3">
                            <div>
                              <img src="../assets/svg/icons/check.svg" alt="Check" class="img-fluid" />
                            </div>
                          </div>
                        </div>
                        <div class="content-right">
                          <p class="mb-1 fw-medium">Course Completed</p>
                          <span class="text-warning mb-0 h5">14</span>
                        </div>
                      </div>
                    </div>
                  </div>
            
                </div>
              </div>
              <!-- Hour chart End  -->

              <!-- Topic and Instructors -->
              <div class="row mb-6 g-6">
                <!-- Topic you are interested in -->
                <div class="col-12 col-xxl-8">
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2">Topic you are interested in</h5>
                      <div class="dropdown">
                        <button
                          class="btn btn-text-secondary rounded-pill text-muted border-0 p-1"
                          type="button"
                          id="topic"
                          data-bs-toggle="dropdown"
                          aria-haspopup="true"
                          aria-expanded="false">
                          <i class="ri-more-2-line ri-20px"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="topic">
                          <a class="dropdown-item" href="javascript:void(0);">Highest Views</a>
                          <a class="dropdown-item" href="javascript:void(0);">See All</a>
                        </div>
                      </div>
                    </div>
                    <div class="card-body row g-3">
                      <div class="col-md-6">
                        <div id="horizontalBarChart"></div>
                      </div>
                      <div class="col-md-6 d-flex justify-content-around align-items-center">
                        <div>
                          <div class="d-flex align-items-baseline">
                            <span class="text-primary me-2"><i class="ri-circle-fill ri-12px"></i></span>
                            <div>
                              <p class="mb-0">UI Design</p>
                              <h5 class="mb-0">35%</h5>
                            </div>
                          </div>
                          <div class="d-flex align-items-baseline my-10">
                            <span class="text-success me-2"><i class="ri-circle-fill ri-12px"></i></span>
                            <div>
                              <p class="mb-0">Music</p>
                              <h5 class="mb-0">14%</h5>
                            </div>
                          </div>
                          <div class="d-flex align-items-baseline">
                            <span class="text-danger me-2"><i class="ri-circle-fill ri-12px"></i></span>
                            <div>
                              <p class="mb-0">React</p>
                              <h5 class="mb-0">10%</h5>
                            </div>
                          </div>
                        </div>

                        <div>
                          <div class="d-flex align-items-baseline">
                            <span class="text-info me-2"><i class="ri-circle-fill ri-12px"></i></span>
                            <div>
                              <p class="mb-0">UX Design</p>
                              <h5 class="mb-0">20%</h5>
                            </div>
                          </div>
                          <div class="d-flex align-items-baseline my-10">
                            <span class="text-secondary me-2"><i class="ri-circle-fill ri-12px"></i></span>
                            <div>
                              <p class="mb-0">Animation</p>
                              <h5 class="mb-0">12%</h5>
                            </div>
                          </div>
                          <div class="d-flex align-items-baseline">
                            <span class="text-warning me-2"><i class="ri-circle-fill ri-12px"></i></span>
                            <div>
                              <p class="mb-0">SEO</p>
                              <h5 class="mb-0">9%</h5>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!--/ Topic you are interested in -->
				
				
				<!-- Muddassar Active Projects -->
				<div class="content">
            <?php if (!empty($resultActive)): ?>
                <div class="card">
                    <h5 class="card-header">Active Projects</h5>
                    <table class="table" id="meetingTable" style="width: 100%; border-collapse: collapse; margin-top: 20px; font-family: Arial, sans-serif;">
                        <thead>
                            <tr style="background-color: #f4f4f4; text-align: left;">
                                <th>Project Name</th>
                                <th>Invitee Description</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <?php while ($project = $resultActive->fetch_assoc()): ?>
                            
                                <tr>
                                    <td><?= htmlspecialchars($project['name']); ?></td>
                                    <td><?php echo $project['description'];?></td>
                                    
                                    <td>
                                            <a href="#" class="mark-completed" data-href="/Admin2 - Copy/User/mark_project_complete.php?project_id=<?php echo $project['id']; ?>">Mark as Completed</a>  

                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p>No meetings scheduled.</p>
            <?php endif; ?>
        </div>
		
					<!-- Modal -->
				<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered"> <!-- Added modal-dialog-centered here -->
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="confirmModalLabel">Confirm Completion</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								Are you sure you want to mark this project as completed?
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
								<a href="" id="confirmLink" class="btn btn-primary">Yes, Mark as Completed</a>
							</div>
						</div>
					</div>
				</div>

				<!-- Modal END -->
		
				<!-- Completed Projects -->
				<div class="content">
            <?php if (!empty($resultCompleted)): ?>
                <div class="card">
                    <h5 class="card-header">Completed Projects</h5>
                    <table class="table" id="meetingTable" style="width: 100%; border-collapse: collapse; margin-top: 20px; font-family: Arial, sans-serif;">
                        <thead>
                            <tr style="background-color: #f4f4f4; text-align: left;">
                                <th>Project Name</th>
                                <th>Invitee Description</th>
                                <th>Status</th>
								<th>Old Chat<th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <?php while ($project = $resultCompleted->fetch_assoc()): ?>
                            <!-- Muddassar -->
                                <tr>
								 <td><?= htmlspecialchars($project['name']); ?></td>
								  <td><?php echo $project['description'];?></td>
                                        <td><?= htmlspecialchars($project['status']); ?></td>
										<td>
                                        <a href="/Admin2 - Copy/chat/app-chat.php?project_id=<?php echo $project['id']; ?>">HELLO</a>
                                    </td>
							</a>
						</li>
					<?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p>No meetings scheduled.</p>
            <?php endif; ?>
        </div>

				 <!-- Muddassar -->



                <!-- Upcoming Webinar -->
                <div class="col-12 col-xxl-4 col-md-6">
                  <div class="card h-100">
                    <div class="card-body">
                      <div class="bg-label-primary text-center mb-6 pt-2 rounded-3">
                        <img
                          class="img-fluid w-px-150"
                          src="../assets/img/illustrations/faq-illustration.png"
                          alt="Boy card image" />
                      </div>
                      <h5 class="mb-1">Upcoming Webinar</h5>
                      <p class="mb-6">
                        Next Generation Frontend Architecture Using Layout Engine And React Native Web.
                      </p>
                      <div class="row mb-6 g-4">
                        <div class="col-6">
                          <div class="d-flex">
                            <div class="avatar flex-shrink-0 me-4">
                              <span class="avatar-initial rounded-3 bg-label-primary"
                                ><i class="ri-calendar-line ri-24px"></i
                              ></span>
                            </div>
                            <div>
                              <h6 class="mb-0 text-nowrap fw-normal">17 Nov 23</h6>
                              <small>Date</small>
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="d-flex">
                            <div class="avatar flex-shrink-0 me-4">
                              <span class="avatar-initial rounded-3 bg-label-primary"
                                ><i class="ri-time-line ri-24px"></i
                              ></span>
                            </div>
                            <div>
                              <h6 class="mb-0 text-nowrap fw-normal">32 minutes</h6>
                              <small>Duration</small>
                            </div>
                          </div>
                        </div>
                      </div>
                      <a href="javascript:void(0);" class="btn btn-primary w-100">Join the event</a>
                    </div>
                  </div>
                </div>
                <!--/ Upcoming Webinar -->

             
              </div>
              <!--  Topic and Instructors  End-->
            </div>
            <!-- / Content -->

           <?php include '../includes/footer.php'; ?>

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
       


    <!-- Vendors JS -->
    <script src="../assets/vendor/libs/moment/moment.js"></script>
    <script src="../assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
    <script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>

  
	

    <!-- Page JS -->
    <script src="../assets/js/user-dashboard.js"></script>
	
	
	<script>
    // Listen for click on "Mark as Completed" link
    document.querySelectorAll('.mark-completed').forEach(function (link) {
        link.addEventListener('click', function (e) {
            e.preventDefault(); // Prevent the default action (navigating)

            // Get the link href and set it in the modal's "Yes" button
            var projectLink = this.getAttribute('data-href');
            document.getElementById('confirmLink').setAttribute('href', projectLink);

            // Show the modal
            var confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));
            confirmModal.show();
        });
    });
</script>


  </body>
</html>
