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


// Fetch user projects
function fetchProjectsByStatus($admin_id, $status, $conn) {
    $stmt = $conn->prepare("SELECT p.*, u.email 
FROM projects p
JOIN users u ON p.user_id = u.id
WHERE p.admin_id = ? AND p.status = ?;");
    $stmt->bind_param('is', $admin_id, $status);
    $stmt->execute();
    return $stmt->get_result();
}
$resultActive = fetchProjectsByStatus($admin_id, 'Active', $conn);
$resultInActive = fetchProjectsByStatus($admin_id, 'InActive', $conn);
$resultCompleted = fetchProjectsByStatus($admin_id, 'Completed', $conn);

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
                    <h4 class="card-title mb-4">Hello <span class="fw-bold"><?php echo htmlspecialchars($admin_email); ?>!</span> 🎉</h4>
                    <p class="mb-0">Welcome to RiteBooks! 😎 </p>
                    <p>Let's Start your application</p>
                    <a href="clients.php" class="btn btn-primary">View Clients</a>
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

<?php

function renderProjectTable($result, $statusTitle) {
    if ($result->num_rows > 0) {
        echo '<div class="card">
                <h5 class="card-header">' . htmlspecialchars($statusTitle) . ' Projects</h5>
                <table class="table">';
        
        // Define table headers
        echo '<thead><tr><th>UserName</th><th>Project Name</th><th>Description</th><th>Status</th><th>Change Status</th>';
        
        if ($statusTitle === "Completed") {
            echo '<th>Old Chat</th>';
        }
        
        echo '</tr></thead>';
        echo '<tbody>';
        
        while ($project = $result->fetch_assoc()) {
            echo '<tr data-project-id="' . htmlspecialchars($project['id']) . '">
			<td>' . htmlspecialchars($project['email']) . '</td>
            <td>' . htmlspecialchars($project['name']) . '</td>
            <td>' . htmlspecialchars($project['description']) . '</td>
            <td><span id="project-status-' . $project['id'] . '">' . htmlspecialchars($project['status']) . '</span></td>
            <td>';
            
            // Change Status Buttons
            if ($statusTitle === "Completed") {
                echo '<button class="btn btn-success btn-sm" data-bs-toggle="modal" 
                        data-bs-target="#confirmModal"
                        data-href="/Admin2 - Copy/User/mark_project_complete.php?project_id=' . $project['id'] . '&status=Active"
                        data-message="Are you sure you want to mark this project as Active?">
                        Mark as Active
                      </button>
                      ||
                      <button class="btn btn-danger btn-sm" data-bs-toggle="modal" 
                        data-bs-target="#confirmModal"
                        data-href="/Admin2 - Copy/User/mark_project_complete.php?project_id=' . $project['id'] . '&status=Inactive"
                        data-message="Are you sure you want to mark this project as Inactive?">
                        Mark as Inactive
                      </button>';
            } elseif ($statusTitle === "InActive") {
                echo '<button class="btn btn-success btn-sm" data-bs-toggle="modal" 
                        data-bs-target="#confirmModal"
                        data-href="/Admin2 - Copy/User/mark_project_complete.php?project_id=' . $project['id'] . '&status=Active"
                        data-message="Are you sure you want to mark this project as Active?">
                        Mark as Active
                      </button>';
            } elseif ($statusTitle === "Active") {
                echo '<button class="btn btn-primary btn-sm" data-bs-toggle="modal" 
                        data-bs-target="#confirmModal"
                        data-href="/Admin2 - Copy/User/mark_project_complete.php?project_id=' . $project['id'] . '&status=Completed"
                        data-message="Are you sure you want to mark this project as Completed?">
                        Mark as Completed
                      </button>
                      ||
                      <button class="btn btn-danger btn-sm" data-bs-toggle="modal" 
                        data-bs-target="#confirmModal"
                        data-href="/Admin2 - Copy/User/mark_project_complete.php?project_id=' . $project['id'] . '&status=Inactive"
                        data-message="Are you sure you want to mark this project as Inactive?">
                        Mark as Inactive
                      </button>';
            }
            
            echo '</td>';
            
            // Old Chat Button for Completed Projects
            if ($statusTitle === "Completed") {
                $userType = isset($_SESSION['user_type']) ? $_SESSION['user_type'] : null;
                echo '<td>
                        <form action="/Admin2 - Copy/chat/app-chat.php" method="POST">
                            <input type="hidden" name="project_id" value="' . $project['id'] . '">
                            <input type="hidden" name="user_id" value="' . ($userType === 'admin' ? $project['admin_id'] : $_SESSION['user_id']) . '">
                            <input type="hidden" name="receiver_id" value="' . ($userType === 'admin' ? $project['user_id'] : $project['admin_id']) . '">
                            <button type="submit" class="btn btn-info btn-sm">Old Chat</button>
                        </form>
                      </td>';
            }
            
            echo '</tr>';
        }
        
        echo '</tbody></table></div>';
    } else {
        echo '<p>No projects found for ' . htmlspecialchars($statusTitle) . '.</p>';
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

		
								<!-- Modal for Completion -->
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
	
	
	<script>
// Listen for click on "Mark as Completed", "Mark as Active", and "Mark as Inactive" links
document.addEventListener("DOMContentLoaded", function () {
    const confirmModal = document.getElementById("confirmModal");
    const confirmBody = document.getElementById("confirmModalBody");
    const confirmMessage = document.getElementById("confirmMessage");
    const confirmButton = document.getElementById("confirmButton");

    let actionURL = "";
    let currentRow = null;

    // Event Delegation: Handle modal triggers for dynamically added buttons
    document.addEventListener("click", function (event) {
        if (event.target.matches("[data-bs-toggle='modal']")) {
            event.preventDefault();

            const button = event.target;
            actionURL = button.getAttribute("data-href");
            confirmBody.innerText = button.getAttribute("data-message");

            // Store the row that needs to be updated
            currentRow = button.closest("tr");

            // Initialize Bootstrap modal correctly
            let modalInstance = bootstrap.Modal.getOrCreateInstance(confirmModal);
            modalInstance.show();
        }
    });

    // Function to ensure a table exists before appending rows
    function ensureTable(status) {
        let containerId = `#${status.toLowerCase()}-projects-container`;
        let tableBody = document.querySelector(`${containerId} tbody`);

        if (!tableBody) {
            console.log(`⚠️ Creating ${status} Projects table dynamically...`);

            const container = document.querySelector(containerId) || document.body;
            container.innerHTML = `
                <div class="card" id="${status.toLowerCase()}-projects">
                    <h5 class="card-header">${status} Projects</h5>
                    <table class="table">
                        <thead>
                            <tr>
								<th>UserName</th>
                                <th>Project Name</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Change Status</th>
                                ${status === "Completed" ? "<th>Old Chat</th>" : ""}
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>`;
            
            tableBody = document.querySelector(`${containerId} tbody`);
        }

        return tableBody;
    }

    // Function to move a project row to the correct table
    function moveProjectRow(row, newStatus) {
        if (!row) return;

        const userName = row.querySelector("td:first-child").textContent; // Added for UserName ✅
		const projectName = row.querySelector("td:nth-child(2)").textContent;
		const projectDescription = row.querySelector("td:nth-child(3)").textContent; // Shifted due to extra column ✅
		const projectId = row.getAttribute("data-project-id"); 

		if (!projectId || projectId === "0" || projectId === "null") {
			console.error("❌ Invalid or missing project_id:", projectId);
			return;
		}

        // Remove row from the current table
        row.remove();

        // Ensure the target table exists
        let targetTableBody = ensureTable(newStatus);
        let newRow = document.createElement("tr");
		
		 // Ensure project_id is preserved in the new row
    newRow.setAttribute("data-project-id", projectId); 

        newRow.innerHTML = `
			<td>${userName}</td> 
            <td>${projectName}</td>
            <td>${projectDescription}</td>
            <td><span class="badge bg-${newStatus === 'Completed' ? 'success' : newStatus === 'Active' ? 'primary' : 'secondary'}">${newStatus}</span></td>
            <td>
                ${getActionButtons(newStatus, projectId)}
            </td>
            ${newStatus === "Completed" ? `<td>${getOldChatButton(projectId)}</td>` : ""}
        `;

        targetTableBody.appendChild(newRow);
    }

    // Function to generate action buttons based on status
    function getActionButtons(status, projectId) {
        if (status === "Completed") {
            return `
                <button class="btn btn-success btn-sm" data-bs-toggle="modal" 
                    data-href="/Admin2 - Copy/User/mark_project_complete.php?project_id=${projectId}&status=Active"
                    data-message="Are you sure you want to mark this project as Active?">
                    Mark as Active
                </button>
                ||
                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" 
                    data-href="/Admin2 - Copy/User/mark_project_complete.php?project_id=${projectId}&status=Inactive"
                    data-message="Are you sure you want to mark this project as Inactive?">
                    Mark as Inactive
                </button>
            `;
        } else if (status === "Inactive") {
            return `<button class="btn btn-success btn-sm" data-bs-toggle="modal" 
                data-href="/Admin2 - Copy/User/mark_project_complete.php?project_id=${projectId}&status=Active"
                data-message="Are you sure you want to mark this project as Active?">
                Mark as Active
            </button>`;
        } else {
            return `<button class="btn btn-primary btn-sm" data-bs-toggle="modal" 
                data-href="/Admin2 - Copy/User/mark_project_complete.php?project_id=${projectId}&status=Completed"
                data-message="Are you sure you want to mark this project as Completed?">
                Mark as Completed
            </button>
            ||
            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" 
                data-href="/Admin2 - Copy/User/mark_project_complete.php?project_id=${projectId}&status=Inactive"
                data-message="Are you sure you want to mark this project as Inactive?">
                Mark as Inactive
            </button>`;
        }
    }

    // Function to generate the Old Chat button for Completed projects
    function getOldChatButton(projectId) {
        return `
            <form action="/Admin2 - Copy/chat/app-chat.php" method="POST">
                <input type="hidden" name="project_id" value="${projectId}">
				<input type="hidden" name="user_id" value="' . ($userType === 'admin' ? $project['admin_id'] : $_SESSION['user_id']) . '">
                <input type="hidden" name="receiver_id" value="' . ($userType === 'admin' ? $project['user_id'] : $project['admin_id']) . '">
                <button type="submit" class="btn btn-info btn-sm">Old Chat</button>
            </form>
        `;
    }

    // Handle Confirm button click
    confirmButton.addEventListener("click", function (e) {
        e.preventDefault();
        confirmButton.disabled = true;
        confirmMessage.innerHTML = `<div class="alert alert-info">Processing...</div>`;

        fetch(actionURL, { method: "GET" })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    confirmMessage.innerHTML = `<div class="alert alert-success">${data.message}</div>`;

                    try {
                        let urlObj = new URL(actionURL, window.location.origin);
                        let projectId = urlObj.searchParams.get("project_id");
                        let newStatus = urlObj.searchParams.get("status");

                        console.log("Extracted project_id:", projectId);
                        console.log("Extracted status:", newStatus);

                        moveProjectRow(currentRow, newStatus); // Move project to the correct table
                    } catch (error) {
                        console.error("Invalid URL:", actionURL, error);
                    }
                } else {
                    confirmMessage.innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
                }

                setTimeout(() => {
                    let modalInstance = bootstrap.Modal.getOrCreateInstance(confirmModal);
                    modalInstance.hide();
                    confirmMessage.innerHTML = "";
                    confirmButton.disabled = false;
                }, 2000);
            })
            .catch(error => {
                confirmMessage.innerHTML = `<div class="alert alert-danger">An error occurred. Try again.</div>`;
                console.error("Error:", error);
                confirmButton.disabled = false;
            });
    });

    confirmModal.addEventListener("hidden.bs.modal", function () {
        confirmMessage.innerHTML = "";
        confirmButton.disabled = false;
    });
});


</script>

	
  </body>
</html>
