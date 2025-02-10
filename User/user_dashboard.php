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
function fetchProjectsByStatus($userId, $status, $conn) {
    $stmt = $conn->prepare("SELECT * FROM projects WHERE user_id = ? AND status = ?");
    $stmt->bind_param('is', $userId, $status);
    $stmt->execute();
    return $stmt->get_result();
}
$resultActive = fetchProjectsByStatus($userId, 'Active', $conn);
$resultInActive = fetchProjectsByStatus($userId, 'InActive', $conn);
$resultCompleted = fetchProjectsByStatus($userId, 'Completed', $conn);


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

    <title>User-Dashboard- RiteBooks</title>

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
                  <div class="col-12 col-md-8">
                    <h5 class="mb-2">Welcome back,<span class="h4 fw-semibold"> <?= htmlspecialchars($_SESSION['email']); ?> 👋🏻</span></h5>
                    <div class="col-12 col-lg-5">
                      <p>Your progress this week is Awesome. let's keep it up and get a lot of points reward !</p>
                    </div>
                  </div>            
                </div>
              </div>
              <!-- Hour chart End  -->

              <!-- Topic and Instructors -->
              <div class="row mb-6 g-6">
			  
			  <?php

function renderProjectTable($result, $statusTitle) {
    if ($result->num_rows > 0) {
        echo '<div class="card">
                <h5 class="card-header">' . $statusTitle . ' Projects</h5>
                <table class="table" id="' . strtolower($statusTitle) . '-projects">
                    <thead><tr><th>Project Name</th><th>Description</th><th>Status</th>';
        
        if ($statusTitle === "Completed") {
            echo '<th>Old Chat</th>';
        } elseif ($statusTitle === "Active") {
            echo '<th>Action</th>';
        }
        
        echo '</tr></thead><tbody>';
        
        while ($project = $result->fetch_assoc()) {
            echo '<tr>
                    <td>' . htmlspecialchars($project['name']) . '</td>
                    <td>' . htmlspecialchars($project['description']) . '</td>
                    <td>' . htmlspecialchars($project['status']) . '</td>';
            
            if ($statusTitle === "Completed") {
                $userType = $_SESSION['user_type'] ?? null;
                echo '<td>
                        <form action="/Admin2 - Copy/chat/app-chat.php" method="POST">
                            <input type="hidden" name="project_id" value="' . $project['id'] . '">
                            <input type="hidden" name="user_id" value="' . ($userType === 'admin' ? $project['admin_id'] : $_SESSION['user_id']) . '">
                            <input type="hidden" name="receiver_id" value="' . ($userType === 'admin' ? $project['user_id'] : $project['admin_id']) . '">
                            <button type="submit" class="btn btn-info btn-sm">Old Chat</button>
                        </form>
                      </td>';
            }

            if ($statusTitle === "Active") {
                echo '<td>
                        <button class="btn btn-success btn-sm" 
                            data-bs-toggle="modal" 
                            data-bs-target="#confirmModal"
                            data-href="/Admin2 - Copy/User/mark_project_complete.php?project_id=' . $project['id'] . '&status=Completed"
                            data-message="Are you sure you want to mark this project as Completed?"
                            data-project-id="' . $project['id'] . '">
                            Mark as Completed
                        </button>
                      </td>';
            }
            
            echo '</tr>';
        }
        
        echo '</tbody></table></div>';
    } else {
        echo '<p>No projects found for ' . $statusTitle . '.</p>';
    }
}


?>
				
<div id="active-projects-container">				
<?php renderProjectTable($resultActive, "Active"); ?>
</div>

<div id="completed-projects-container">
    <?php renderProjectTable($resultCompleted, "Completed"); ?>
</div>


<div id="inactive-projects-container">				
<?php renderProjectTable($resultInActive, "InActive"); ?>
</div>
				
		
	<!-- Confirmation Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Confirm Action</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="confirmModalBody">Are you sure?</p>
                <div id="confirmMessage" class="mt-2"></div> <!-- This will show success/error message -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" id="confirmButton" class="btn btn-primary">Confirm</button>
            </div>
        </div>
    </div>
</div>

			<!-- Modal for Completion END -->
				  		
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
   document.addEventListener("DOMContentLoaded", function () {
    const confirmModal = document.getElementById("confirmModal");
    const confirmMessage = document.getElementById("confirmMessage");
    const confirmButton = document.getElementById("confirmButton");

    let actionUrl = "";
    let currentRow = null; // Stores the row that triggered the action

    // Attach event listener to all "Mark as Completed" buttons
    document.querySelectorAll('[data-bs-toggle="modal"]').forEach(button => {
        button.addEventListener("click", function (event) {
            event.preventDefault();
            actionUrl = this.getAttribute("data-href");
            confirmMessage.textContent = this.getAttribute("data-message");

            // Store the row that needs to be removed
            currentRow = this.closest("tr");
        });
    });

    // Function to ensure the "Completed Projects" table exists
    function ensureCompletedTable() {
        let completedSection = document.getElementById("completed-projects-container");
        let completedTableBody = document.querySelector("#completed-projects tbody");

        if (!completedTableBody) {
            console.log("⚠️ Creating Completed Projects table dynamically...");
            completedSection.innerHTML = `
                <div class="card" id="completed-projects">
                    <h5 class="card-header">Completed Projects</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Project Name</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Old Chat</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>`;
            completedTableBody = document.querySelector("#completed-projects tbody");
        }

        return completedTableBody;
    }

    // Function to move a project row to the "Completed Projects" table
    function moveToCompletedTable(row) {
        if (!row) return;
        
        const projectName = row.querySelector("td:first-child").textContent;
        const projectDescription = row.querySelector("td:nth-child(2)").textContent;
        const projectId = row.querySelector("[data-project-id]")?.getAttribute("data-project-id");

        const completedTableBody = ensureCompletedTable();
        const newRow = document.createElement("tr");

        newRow.innerHTML = `
            <td>${projectName}</td>
            <td>${projectDescription}</td>
            <td><span class="badge bg-success">Completed</span></td>
            <td>
                <form action="/Admin2 - Copy/chat/app-chat.php" method="POST">
                    <input type="hidden" name="project_id" value="${projectId}">
                    <input type="hidden" name="user_id" value="${document.body.dataset.userId}">
                    <input type="hidden" name="receiver_id" value="${document.body.dataset.receiverId}">
                    <button type="submit" class="btn btn-info btn-sm">Old Chat</button>
                </form>
            </td>
        `;

        completedTableBody.appendChild(newRow);
        row.remove();
    }

    // Handle Confirm button click
    confirmButton.addEventListener("click", function (event) {
        event.preventDefault();

        if (actionUrl && currentRow) {
            fetch(actionUrl, { method: "GET" })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        confirmMessage.textContent = "✅ Project marked as completed successfully!";
                        moveToCompletedTable(currentRow);

                        // Close modal after success
                        setTimeout(() => {
                            let modalInstance = bootstrap.Modal.getInstance(confirmModal);
                            if (modalInstance) {
                                modalInstance.hide();
                            }
                        }, 1000);
                    } else {
                        confirmMessage.textContent = "⚠️ An error occurred. Please try again.";
                    }
                })
                .catch(error => {
                    console.error("❌ Error:", error);
                    confirmMessage.textContent = "❌ A network error occurred. Try again.";
                });
        } else {
            console.error("No action URL found or missing project row!");
        }
    });
});





</script>


  </body>
</html>
