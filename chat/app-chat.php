<?php
session_start();
require_once __DIR__ . '/../db_connection.php';

$userType = $_SESSION['user_type'] ?? null;
$loggedInId = $userType === 'admin' ? $_SESSION['admin_id'] : $_SESSION['user_id'];
//$receiverId = isset($_GET['receiverId']) ? intval($_GET['receiverId']) : null;

$projectId = $_POST['project_id'];
$receiverId = $_POST['receiver_id'];
//echo "Receiver for user  is ". $receiverId;

if (isset($_POST['project_id'])) {
    $_SESSION['project_id'] = $_POST['project_id'];
   // echo json_encode(["success" => "Project ID set in session"]);
}
if ($userType == 'user') {
    $userId = $_SESSION['user_id'] ?? null;
    $tableName = 'users';
    updateLastActivity($userId, $conn, $tableName);
} else {
    $userId = $_SESSION['admin_id'] ?? null;
    $tableName = 'admins';
    updateLastActivity($userId, $conn, $tableName);
}
/* Debugging: Print parameters (optional, for testing only)
echo "Project ID: $projectId<br>";
echo "User ID: $userId<br>";
echo "Receiver ID: $receiverId<br>";
*/


function updateLastActivity($userId, $conn, $tableName) {
    $allowedTables = ['admins', 'users'];
    if (!in_array($tableName, $allowedTables)) {
        die('Invalid table name');
    }

    $query = "UPDATE $tableName SET last_activity = NOW() WHERE id = ?";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        die('Query preparation failed: ' . $conn->error);
    }

    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $stmt->close();
}


if ($projectId) {
    // Prepare and execute query to fetch the user's email
    $stmt = $conn->prepare("SELECT u.email 
                            FROM users u 
                            JOIN projects p ON u.id = p.user_id 
                            WHERE p.id = ?");
    $stmt->bind_param("i", $projectId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch the result
    if ($row = $result->fetch_assoc()) {
        $email = $row['email'];
       // echo "User's Email: " . $email;
    } else {
        //echo "No email found for the given project ID.";
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Project ID is not provided.";
}
 

if ($projectId) {
    // Prepare and execute query to fetch the project name
    $stmt = $conn->prepare("SELECT name, description FROM projects WHERE id = ?");
    $stmt->bind_param("i", $projectId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the project name exists
    if ($result->num_rows > 0) {
        $project = $result->fetch_assoc();
        $projectName = $project['name'];
		$projectDescription = $project['description'];
    } else {
        $projectName = "Unknown Project"; // Fallback for invalid project ID
    }
    $stmt->close();
} else {
    $projectName = "No Project Selected"; // Fallback for missing project ID
}

// Fetch project messages
$query = "SELECT * FROM messages WHERE project_id = ? ORDER BY created_at ASC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $projectId);
$stmt->execute();
$result = $stmt->get_result();

$messages = [];
while ($row = $result->fetch_assoc()) {
    $messages[] = $row;
}
$stmt->close();

// Fetch files for the specific project
$query = "SELECT * FROM documents WHERE project_id = ? ORDER BY id DESC ";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $projectId);
$stmt->execute();
$result = $stmt->get_result();

$files = [];
while ($row = $result->fetch_assoc()) {
    $files[] = $row;
}
$stmt->close();
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
<?php 
    // Sidebar based on user type
    if ($userType === 'admin') {
        include '../includes/sidebar.php';
    } else {
        include '../includes/user-side.php';
    }
    ?>
          <!-- Content wrapper -->
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
      <?php foreach ($files as $file): ?>
        <li class="chat-contact-list-item mb-1" data-message-id="<?= htmlspecialchars($file['message_id']); ?>">
          <a class="d-flex align-items-center">
            <div class="chat-contact-info flex-grow-1 ms-4">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="chat-contact-name text-truncate m-0 fw-normal" >
                  <?= htmlspecialchars($file['document_name']); ?>
                </h6>
              </div>
              <small class="chat-contact-status text-truncate">
			  
			  Uploaded by: <?= htmlspecialchars($file['uploaded_by']); ?> 
			  
              </small>
			   <small class="chat-contact-status text-truncate">
			  
			  at <?= date('M d, Y h:i A', strtotime($file['created_at'])); ?>
              
			  </small>
            </div>
          </a>
        </li>
      <?php endforeach; ?>
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
                              <h6 class="m-0 fw-normal">Chat for Project Name:<?= htmlspecialchars($projectName . " ( " . $projectDescription . ")") ?></h6>
                              <small class="user-status text-body"><?= htmlspecialchars($email) ?></small>
                            </div>
                          </div>
						  </div>
    <div class="chat-history-body" style="max-height: 500px; overflow-y: auto;">
      <ul class="list-unstyled chat-history">
        <?php foreach ($messages as $message): ?>
          <li id="message-<?= htmlspecialchars($message['id']); ?>" class="chat-message <?= $message['sender_type'] === 'user' ? '' : 'chat-message-right'; ?>">
            <div class="d-flex overflow-hidden">
              <div class="chat-message-wrapper flex-grow-1">
                <div class="chat-message-text">
                  <p class="mb-0"><?= htmlspecialchars($message['message']); ?></p>
				  <?php if (!empty($message['document_path'])): ?>
							<br>
			                <a href="<?= htmlspecialchars($message['document_path']) ?>" download="<?= htmlspecialchars(basename($message['document_path'])) ?>" class="download-link">Download File</a>
						<?php endif; ?>
                </div>
                <div class="text-muted mt-1">
                  <small><?= htmlspecialchars($message['created_at']); ?></small>
                </div>
              </div>
            </div>
          </li>
        <?php endforeach; ?>
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
        <?php include '../includes/footer.php'?>



	<script>
    window.currentUserId = <?= json_encode($loggedInId ?? null) ?>;
    window.projectId = <?= json_encode($projectId ?? null) ?>;
    window.receiverId = <?= json_encode($receiverId ?? null) ?>;
    window.senderType = <?= json_encode($userType ?? null) ?>;
</script>    

    <!-- Vendors JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/3.0.6/purify.min.js"></script>

    <script src="../assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js"></script>


    <!-- Page JS -->
    <script src="/Admin2 - Copy/chat/assets/app-chat.js"></script>


  </body>
</html>
