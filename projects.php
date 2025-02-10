<?php
include_once 'db_connection.php';
// Start session only if it's not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Determine user type
$userType = isset($_SESSION['user_type']) ? $_SESSION['user_type'] : null;
if ($userType === 'admin') {
    $userId = $_SESSION['admin_id'];
} elseif ($userType === 'user') {
    $userId = $_SESSION['user_id'];
} else {
    // Redirect to login if neither user type is set
    header('Location: index.php');
    exit;
}

// Check if 'user_id' is set in the URL
if (isset($_GET['user_id'])) {
    $fetchedUserId = intval($_GET['user_id']); // Sanitize the input
}


// Fetch projects based on user type
$query = $userType === 'admin' ? 
    "SELECT * FROM projects WHERE admin_id = ? AND user_id = ?" : 
    "SELECT * FROM projects WHERE user_id = ?";

$stmt = $conn->prepare($query);

if ($userType === 'admin') {
    // Bind both `admin_id` and `user_id` for the admin query
    $stmt->bind_param("ii", $userId, $fetchedUserId);
} else {
    // Bind only `user_id` for the non-admin query
    $stmt->bind_param("i", $userId);
}
$stmt->execute();
$result = $stmt->get_result();


// Fetch unread counts from fetchUsersWithUnread.php
$unreadQuery = "
    SELECT 
        p.id AS project_id,
        COUNT(m.id) AS unread_count
    FROM projects p
    LEFT JOIN messages m 
        ON p.id = m.project_id 
        AND m.receiver_id = ?
        AND m.read_status = 0
    GROUP BY p.id
";

$unreadStmt = $conn->prepare($unreadQuery);
$unreadStmt->bind_param("i", $userId);
$unreadStmt->execute();
$unreadResult = $unreadStmt->get_result();

$unreadCounts = [];
while ($row = $unreadResult->fetch_assoc()) {
    $unreadCounts[$row['project_id']] = $row['unread_count'];
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

    <title>Rite-Books---Projects</title>

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
  </head>

  <body>
	<?php 
    // Sidebar based on user type
    if ($userType === 'admin') {
        include 'includes/sidebar.php';
    } else {
        include 'includes/user-side.php';
    }
    ?>
   <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <!-- Basic Bootstrap Table -->
              <div class="card">
                <h5 class="card-header">Table Basic</h5>
                <div class="table-responsive text-nowrap">
                 <table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            
            <th>Actions</th>
        </tr>
    </thead>
    <tbody class="table-border-bottom-0">
        <?php if ($result->num_rows === 0): ?>
            <tr>
                <td colspan="4" class="text-center">No projects found for this user.</td>
            </tr>
        <?php else: ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['name'] . " ( " . ($row['description']) . " )") ?></td>
                  
                    <td>
                        <form action="/Admin2 - Copy/chat/app-chat.php" method="POST" style="display: inline;">
                            <input type="hidden" name="project_id" value="<?= $row['id'] ?>">
                            <input type="hidden" name="user_id" value="<?= $userType === 'admin' ? $row['user_id'] : $_SESSION['user_id'] ?>">
                            <input type="hidden" name="receiver_id" value="<?= $userType === 'admin' ? $row['user_id'] : $row['admin_id'] ?>">
                            <button type="submit" class="btn rounded-pill btn-primary waves-effect waves-light">
                                <span class="tf-icons ri-mail-close-fill ri-16px me-2">
                                    <?= isset($unreadCounts[$row['id']]) && $unreadCounts[$row['id']] > 0 
                                        ? "(" . $unreadCounts[$row['id']] . ")" 
                                        : "" ?>
                                </span>
                                Open Chat
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php endif; ?>
    </tbody>
</table>

                </div>
              </div>
              <!--/ Basic Bootstrap Table -->
            </div>
            <!-- / Content -->

            

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
		   <?php include 'includes/footer.php'; ?>
    <!-- Page JS -->
  </body>
</html>
