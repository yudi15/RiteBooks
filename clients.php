<?php
include_once 'db_connection.php';
session_start();

if (!isset($_SESSION['admin_id'])) {
    header('Location: index.php');
    exit;
}

$adminId = $_SESSION['admin_id'];

// Pagination settings
$records_per_page = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $records_per_page;

// Get total number of records
$total_query = "SELECT COUNT(*) as count FROM users";
$total_result = $conn->query($total_query);
$total_records = $total_result->fetch_assoc()['count'];
$total_pages = ceil($total_records / $records_per_page);

// Replace your existing query with this:
$query = "SELECT id, first_name, last_name, username, email FROM users LIMIT ? OFFSET ?";
$stmt = $conn->prepare($query);
if (!$stmt) {
    echo "Prepare failed: " . $conn->error . "<br>";
} else {
    $stmt->bind_param('ii', $records_per_page, $offset);
    if (!$stmt->execute()) {
        echo "Execute failed: " . $stmt->error . "<br>";
    } else {
        $result = $stmt->get_result();
        if (!$result) {
            echo "Get result failed: " . $stmt->error . "<br>";
        }
    }
}

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

    <title>Clients</title>

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

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="assets/vendor/js/template-customizer.js"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="assets/js/config.js"></script>
	<style>
.table td {
    vertical-align: middle;
}

.dropdown-toggle::after {
    display: none;
}

.badge {
    padding: 0.5em 0.75em;
    font-size: 0.75em;
    border-radius: 0.25rem;
}

.bg-success {
    background-color: #28a745!important;
    color: white;
}

.bg-danger {
    background-color: #dc3545!important;
    color: white;
}

.bg-warning {
    background-color: #ffc107!important;
    color: black;
}
</style>
  </head>
  
  
  

 <body>
    <?php include 'includes/sidebar.php'; ?>
    
    <!-- The sidebar.php already includes these opening tags:
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <aside>...</aside>
            <div class="layout-page">
                <nav>...</nav>
    -->
    
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <!-- Your table code here -->
            <div class="card">
			<h5 class="card-header">Table Basic</h5>
           <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
					<th>Projects</th>
					<th>Edit</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php
                // Debug the result object
                if (!$result) {
                    echo '<tr><td colspan="6">No result object found</td></tr>';
                } else {
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?= htmlspecialchars($row['id']) ?></td>
                                <td><?= htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) ?></td>
                                <td><?= htmlspecialchars($row['username'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars($row['email']) ?></td>
                                <td>
                        <a href="/Admin2 - Copy/projects.php?user_id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">
                            <i class="ri-eye-line me-1"></i> View
                        </a>
                    </td>
                    <td>
                        <a href="javascript:void(0);" class="btn btn-secondary btn-sm">
                            <i class="ri-pencil-line me-1"></i> Edit
                        </a>
                    </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo '<tr><td colspan="6" class="text-center">No users found</td></tr>';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
		  
		  <!-- Pagination -->
          <div class="card-footer">
            <div class="d-flex justify-content-between align-items-center">
              <div class="pagination-info">
                Showing <?= ($offset + 1) ?> to <?= min($offset + $records_per_page, $total_records) ?> of <?= $total_records ?> entries
              </div>
              <nav aria-label="Page navigation">
                <ul class="pagination mb-0">
                  <?php if ($page > 1): ?>
                    <li class="page-item">
                      <a class="page-link" href="?page=<?= ($page - 1) ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                      </a>
                    </li>
                  <?php endif; ?>
                  
                  <?php
                  // Display page numbers
                  $start_page = max(1, $page - 2);
                  $end_page = min($total_pages, $page + 2);
                  
                  if ($start_page > 1) {
                    echo '<li class="page-item"><a class="page-link" href="?page=1">1</a></li>';
                    if ($start_page > 2) {
                      echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                    }
                  }
                  
                  for ($i = $start_page; $i <= $end_page; $i++) {
                    echo '<li class="page-item ' . ($page == $i ? 'active' : '') . '">';
                    echo '<a class="page-link" href="?page=' . $i . '">' . $i . '</a>';
                    echo '</li>';
                  }
                  
                  if ($end_page < $total_pages) {
                    if ($end_page < $total_pages - 1) {
                      echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                    }
                    echo '<li class="page-item"><a class="page-link" href="?page=' . $total_pages . '">' . $total_pages . '</a></li>';
                  }
                  ?>
                  
                  <?php if ($page < $total_pages): ?>
                    <li class="page-item">
                      <a class="page-link" href="?page=<?= ($page + 1) ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                      </a>
                    </li>
                  <?php endif; ?>
                </ul>
              </nav>
            </div>
          </div>
            </div>
        </div>
        <!-- / Content -->

        <!-- Footer -->
       <?php include 'includes/footer.php'; ?>
        <!-- / Footer -->

        <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
    </div>
    <!-- / Layout wrapper -->
    </div>
</body>
</html>

