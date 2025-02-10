<?php
session_start();
require_once '../db_connection.php';

// Handle AJAX requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = ['success' => false, 'message' => ''];
    
    if (isset($_POST['clear_announcement'])) {
        $query = "UPDATE announcements SET is_active = 0";
        if ($conn->query($query)) {
            $response['success'] = true;
            $response['message'] = "Announcement cleared successfully!";
        } else {
            $response['message'] = "Failed to clear announcement.";
        }
    } elseif (isset($_POST['submit_announcement'])) {
        $announcementType = $_POST['announcement_type'];
        $announcementText = $_POST['announcement_text'] ?? '';
        $announcementImage = '';

        if ($announcementType === 'image' && isset($_FILES['announcement_image']['tmp_name']) && !empty($_FILES['announcement_image']['tmp_name'])) {
            $targetDir = $_SERVER['DOCUMENT_ROOT'] . "/danial/uploads/"; //change url
            $targetFile = $targetDir . basename($_FILES["announcement_image"]["name"]);
            
            if (move_uploaded_file($_FILES["announcement_image"]["tmp_name"], $targetFile)) {
                $announcementImage = "/danial/uploads/". basename($_FILES["announcement_image"]["name"]);
                $content = $announcementImage;
            } else {
                $response['message'] = "Failed to upload image.";
                echo json_encode($response);
                exit;
            }
        } else {
            $content = $announcementText;
        }

        $query = "INSERT INTO announcements (type, content, is_active) VALUES (?, ?, 1) 
                  ON DUPLICATE KEY UPDATE type = VALUES(type), content = VALUES(content), is_active = 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $announcementType, $content);

        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = "Announcement updated successfully!";
        } else {
            $response['message'] = "Failed to update announcement.";
        }
    }
    
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

// Fetch current announcement
$currentAnnouncement = null;
$query = "SELECT * FROM announcements WHERE is_active = 1 LIMIT 1";
$result = $conn->query($query);
if ($result && $result->num_rows > 0) {
    $currentAnnouncement = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template" data-style="light">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Announcements</title>
    <meta name="description" content="" />
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/vendor/fonts/remixicon/remixicon.css" />
    <link rel="stylesheet" href="../assets/vendor/fonts/flag-icons.css" />
    <link rel="stylesheet" href="../assets/vendor/libs/node-waves/node-waves.css" />
    <link rel="stylesheet" href="../assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="../assets/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="../assets/vendor/libs/select2/select2.css" />
    <link rel="stylesheet" href="../assets/vendor/libs/tagify/tagify.css" />
    <link rel="stylesheet" href="../assets/vendor/libs/@form-validation/form-validation.css" />
    <link rel="stylesheet" href="../assets/vendor/libs/bs-stepper/bs-stepper.css" />

    <script src="../assets/vendor/js/helpers.js"></script>
    <script src="../assets/vendor/js/template-customizer.js"></script>
    <script src="../assets/js/config.js"></script>
    
    <style>
    .spinner {
        border: 4px solid #f3f3f3;
        border-top: 4px solid #3498db;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        animation: spin 1s linear infinite;
        margin: 20px auto;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
	
	.alert {
    padding: 15px;
    margin-bottom: 20px;
    border: 1px solid transparent;
    border-radius: 4px;
    position: relative;
    z-index: 1000;
}

.alert-success {
    color: #155724;
    background-color: #d4edda;
    border-color: #c3e6cb;
}

.alert-danger {
    color: #721c24;
    background-color: #f8d7da;
    border-color: #f5c6cb;
}
    </style>
</head>

<body style="background-color: #282A42;">
    <?php include '../includes/sidebar.php'; ?>

    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-12 col-sm-6 col-lg-12 mb-6">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="ri-36px ri-file-pdf-line text-heading"></i>
                            <h5 class="mt-4 fw-medium">Make an Announcement</h5>
                            <p>Make a new Announcement</p>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#shareProject">
                                Show
                            </button>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="shareProject" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-simple modal-enable-otp modal-dialog-centered">
                        <div class="modal-content">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                            <div class="modal-body p-0">
                                <div class="text-center">
                                    <h4 class="mb-2">Announcements</h4>
                                    <p class="mb-6">Add an announcement on your Website</p>
                                </div>
                            </div>

                            <div class="modal-body">
                                <div class="form-container" style="background-color: #30334e;">
                                    <h2 class="text-center mb-4" style="color: #b2b3ca;">Manage Announcements</h2>

                                    <form id="announcementForm" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label for="announcementType" class="form-label" style="color: #b2b3ca;">
                                                Announcement Type
                                            </label>
                                            <select class="form-select" id="announcementType" name="announcement_type" required>
                                                <option value="text" <?= isset($currentAnnouncement['type']) && $currentAnnouncement['type'] === 'text' ? 'selected' : ''; ?>>Text</option>
                                                <option value="image" <?= isset($currentAnnouncement['type']) && $currentAnnouncement['type'] === 'image' ? 'selected' : ''; ?>>Image</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="announcementText" class="form-label" style="color: #b2b3ca;">
                                                Announcement Text
                                            </label>
                                            <textarea class="form-control" id="announcementText" name="announcement_text" rows="3"><?= isset($currentAnnouncement['type']) && $currentAnnouncement['type'] === 'text' ? htmlspecialchars($currentAnnouncement['content']) : ''; ?></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="announcementImage" class="form-label" style="color: #b2b3ca;">
                                                Announcement Image
                                            </label>
                                            <input class="form-control" type="file" id="announcementImage" name="announcement_image" accept="image/*" />
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <button type="submit" class="btn btn-primary" name="submit_announcement">
                                                Submit Announcement
                                            </button>
                                            <button type="submit" class="btn btn-danger" name="clear_announcement">
                                                No Announcement
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include '../includes/footer.php'; ?>
    
    <script src="../assets/js/modal-share-project.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('announcementForm');
    const modal = document.getElementById('shareProject');
    const announcementType = document.getElementById("announcementType");
    const announcementText = document.getElementById("announcementText");
    const announcementImage = document.getElementById("announcementImage");

    // Function to toggle fields based on announcement type
    function toggleFields() {
        if (announcementType.value === "text") {
            announcementText.disabled = false;
            announcementImage.disabled = true;
        } else if (announcementType.value === "image") {
            announcementText.disabled = true;
            announcementImage.disabled = false;
        }
    }

    // Initial toggle and event listener
    toggleFields();
    announcementType.addEventListener("change", toggleFields);

    // Function to show alert
    function showAlert(message, isSuccess) {
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert ${isSuccess ? 'alert-success' : 'alert-danger'} mt-3`;
        alertDiv.textContent = message;
        alertDiv.style.display = 'block';
        
        const formContainer = document.querySelector('.form-container');
        formContainer.insertBefore(alertDiv, formContainer.firstChild);
        
        setTimeout(() => {
            if (alertDiv && alertDiv.parentNode) {
                alertDiv.remove();
            }
        }, 30000);
    }

    // Form submission handler
    form.addEventListener('submit', function(e) {
       e.preventDefault();
        
        // Get the clicked button
        const submitter = e.submitter;

        // If it's the clear announcement button, proceed without validation
        if (submitter && submitter.name === 'clear_announcement') {
            // Proceed with form submission for clear announcement
        } else {
            // Validate based on announcement type
            if (announcementType.value === 'text') {
                if (!announcementText.value.trim()) {
                    showAlert('Please enter announcement text', false);
                    return;
                }
            } else if (announcementType.value === 'image') {
                if (!announcementImage.files || !announcementImage.files[0]) {
                    showAlert('Please select an image', false);
                    return;
                }
            }
        }
		
		
        const formData = new FormData(this);
        
        // Add the clicked button's name to formData
        if (submitter && submitter.name) {
            formData.append(submitter.name, submitter.value || 'true');
        }
        
        // Show loading spinner
        const spinner = document.createElement('div');
        spinner.className = 'spinner';
        form.appendChild(spinner);
        
        // Disable submit buttons
        const buttons = form.querySelectorAll('button[type="submit"]');
        buttons.forEach(button => button.disabled = true);
        
        fetch('announcements.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            console.log('Server response:', data);  // Debug log
            
            // Remove spinner and enable buttons
            spinner.remove();
            buttons.forEach(button => button.disabled = false);
            
            // Show success/error message
            showAlert(data.message || 'Operation completed', data.success);
            
            // If successful, reset form
            if (data.success) {
                form.reset();
                toggleFields(); // Reset field states
            }
        })
        .catch(error => {
            console.error('Error:', error);
            spinner.remove();
            buttons.forEach(button => button.disabled = false);
            showAlert('An error occurred. Please try again.', false);
        });
    });
});


</script>


  </body>
</html>