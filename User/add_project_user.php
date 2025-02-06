<?php
session_start();
require '../db_connection.php'; // Include your DB connection script


if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php"); // Redirect if not logged in
    exit();
}
else{
	$userId= $_SESSION['user_id'];
}

// Fetch users and documents from the database
$users = $conn->query("SELECT * FROM users")->fetch_all(MYSQLI_ASSOC);
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

    <title>Add User</title>

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
    <link rel="stylesheet" href="../assets/vendor/libs/select2/select2.css" />
    <link rel="stylesheet" href="../assets/vendor/libs/tagify/tagify.css" />
    <link rel="stylesheet" href="../assets/vendor/libs/@form-validation/form-validation.css" />
    <link rel="stylesheet" href="../assets/vendor/libs/bs-stepper/bs-stepper.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="../assets/vendor/js/template-customizer.js"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
	
	<style>
.spinner {
    border: 4px solid #f3f3f3;
    border-top: 4px solid #3498db;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>
  </head>

  <body>
  
  <?php include '../includes/user-side.php'; ?>
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <!--  Add Project Modal-->
                <div class="col-12 col-sm-6 col-lg-12 mb-6">
                  <div class="card">
                    <div class="card-body text-center">
                      <i class="ri-36px ri-file-pdf-line text-heading"></i>
                      <h5 class="mt-4 fw-medium">Create New Project</h5>
                      <p>Create a new project for yourself.</p>
                      <button
                        type="button"
                        class="btn btn-primary"
                        data-bs-toggle="modal"
                        data-bs-target="#shareProject">
                        Show
                      </button>
                    </div>
                  </div>
                </div>
                <!--/  Add Project Modal -->

              <!-- All Modals ended-->
			  
	
          </div>
            </div>
            <!-- / Content -->

    
          </div>
          <!-- Content wrapper -->
       
  

    <!-- Vendors JS -->
    <script src="../assets/vendor/libs/cleavejs/cleave.js"></script>
    <script src="../assets/vendor/libs/tagify/tagify.js"></script>
    <script src="../assets/vendor/libs/cleavejs/cleave-phone.js"></script>
    <script src="../assets/vendor/libs/select2/select2.js"></script>
    <script src="../assets/vendor/libs/@form-validation/popular.js"></script>
    <script src="../assets/vendor/libs/@form-validation/bootstrap5.js"></script>
    <script src="../assets/vendor/libs/@form-validation/auto-focus.js"></script>
    <script src="../assets/vendor/libs/bs-stepper/bs-stepper.js"></script>

   

    <!-- Page JS -->
    <script src="../assets/js/modal-share-project.js"></script>

	
	

<script>
// Dynamically add fields based on the description dropdown
document.getElementById('descriptionDropdown').addEventListener('change', function () {
  const selectedValue = this.value;
  const dynamicFields = document.getElementById('dynamicFields');

  // Clear existing dynamic fields
  dynamicFields.innerHTML = '';

  // Add specific input fields based on the selected value
  if (selectedValue === 'Relative') {
    dynamicFields.innerHTML = `
      <label for="relationInput">Relation</label>
      <input id="relationInput" type="text" class="form-control" placeholder="Enter relation (e.g., Brother, Sister)">
    `;
  } else if (selectedValue === 'Friend') {
    dynamicFields.innerHTML = `
      <label for="friendNameInput">Name</label>
      <input id="friendNameInput" type="text" class="form-control" placeholder="Enter friend's name">
    `;
  }
});

// Handle project assignment on button click
document.getElementById('assignProjectBtn').addEventListener('click', function () {
	// Show the loading spinner
    const spinner = document.getElementById('loadingSpinner2');
    spinner.style.display = 'block';
	console.log("Spinner loading ");
  const userId = document.getElementById('select2Basic').value;
  const projectName = document.getElementById('projectsDropdown').value;
  const description = document.getElementById('descriptionDropdown').value;

  let extraInput = '';
  if (description === 'Relative') {
    extraInput = document.getElementById('relationInput')?.value || '';
  } else if (description === 'Friend') {
    extraInput = document.getElementById('friendNameInput')?.value || '';
  }

  // Concatenate the description and extra input
  const finalDescription = extraInput ? `${description} (${extraInput})` : description;

  if (!userId || !projectName || !description) {
    alert('Please select a user, project, and description.');
    return;
  }
  
  

  fetch('../assign_project.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ user_id: userId, project_name: projectName, description: finalDescription })
  })
    .then(response => response.json())
    .then(data => {
      if (data.exists) {
        alert(`You are already registered with this project as ${finalDescription}.`);
      } else if (data.success) {
        alert('Project assigned successfully!');
      } else {
        alert('Failed to assign project.');
      }
	  // Hide the loading spinner
        spinner.style.display = 'none';
		console.log("Spinner loading stopped ");
    })
    .catch(error => console.error('Error assigning project:', error));
	
        
    
});

</script>
<?php include '../includes/footer.php'; ?>
  </body>
</html>
