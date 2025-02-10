<?php
session_start();
require 'db_connection.php'; // Include your DB connection script


if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php"); // Redirect if not logged in
    exit();
}
else{
	$adminId= $_SESSION['admin_id'];
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
  data-assets-path="assets/"
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
    <link rel="stylesheet" href="assets/vendor/libs/select2/select2.css" />
    <link rel="stylesheet" href="assets/vendor/libs/tagify/tagify.css" />
    <link rel="stylesheet" href="assets/vendor/libs/@form-validation/form-validation.css" />
    <link rel="stylesheet" href="assets/vendor/libs/bs-stepper/bs-stepper.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="assets/vendor/js/template-customizer.js"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="assets/js/config.js"></script>
	
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
  
  <?php include 'includes/sidebar.php'; ?>
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <!--  Add User Modal-->
                <div class="col-12 col-sm-6 col-lg-12 mb-6">
                  <div class="card modal-dialog-centered">
                    <div class="card-body text-center">
                      <i class="ri-36px ri-user-line text-heading"></i>
                      <h5 class="mt-4 fw-medium">Add New User</h5>
                      <p>Add a new user data.</p>
                      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUser">
                        Show
                      </button>
                    </div>
                  </div>
                </div>
                <!--/  Add User Modal-->
				

                <!--  Add Project Modal-->
                <div class="col-12 col-sm-6 col-lg-12 mb-6">
                  <div class="card">
                    <div class="card-body text-center">
                      <i class="ri-36px ri-file-pdf-line text-heading"></i>
                      <h5 class="mt-4 fw-medium">Assign New Project</h5>
                      <p>Assign new project to a user.</p>
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
  
              <!-- Add User Modal details-->
              <div class="modal fade" id="addUser" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-simple modal-edit-user">
                  <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-body p-0">
                      <div class="text-center mb-6">
                        <h4 class="mb-2">Add New User Information</h4>
                        <!--<p class="mb-6">Updating user details will receive a privacy audit.</p>!-->
                      </div>
                      <form id="editUserForm" action="process_user.php" class="row g-5" method="POST">
                        <div class="col-12 col-md-6">
                          <div class="form-floating form-floating-outline">
                            <input
                              type="text"
                              id="modalEditUserFirstName"
                              name="modalEditUserFirstName"
                              class="form-control"
                              value=""
                              placeholder="Enter First Name" />
                            <label for="modalEditUserFirstName">First Name</label>
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="form-floating form-floating-outline">
                            <input
                              type="text"
                              id="modalEditUserLastName"
                              name="modalEditUserLastName"
                              class="form-control"
                              value=""
                              placeholder="Enter Last Name" />
                            <label for="modalEditUserLastName">Last Name</label>
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="form-floating form-floating-outline">
                            <input
                              type="text"
                              id="modalEditUserName"
                              name="modalEditUserName"
                              class="form-control"
                              value=""
                              placeholder="Enter a username" />
                            <label for="modalEditUserName">Username</label>
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="form-floating form-floating-outline">
                            <input
                              type="text"
                              id="modalEditUserEmail"
                              name="modalEditUserEmail"
                              class="form-control"
                              value=""
                              placeholder="Enter an email address" />
                            <label for="modalEditUserEmail">Email</label>
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="form-floating form-floating-outline">
                            <input
                              type="text"
                              id="modalEditTaxID"
                              name="modalEditTaxID"
                              class="form-control modal-edit-tax-id"
                              placeholder="123 456 7890" />
                            <label for="modalEditTaxID">Tax ID</label>
                          </div>
                        </div>
                        
						
						<div class="col-12 col-md-6">
							<div class="form-floating form-floating-outline">
								<select
									id="modalEditUserCountry"
									name="modalEditUserCountry"
									class="select2 form-select"
									data-allow-clear="true"
									required
								>
									<option value="" selected disabled>Loading...</option>
								</select>
								<label for="modalEditUserCountry">Country</label>
							</div>
						</div>
						
						<div class="col-12 col-md-6">
							<div class="input-group">
								<span id="phoneCode" class="input-group-text"></span>
								<div class="form-floating form-floating-outline">
                              <input
                                type="text"
                                id="modalEditUserPhone"
                                name="modalEditUserPhone"
                                class="form-control phone-number-mask"
                                value=""
                                placeholder="+1 609 933 4422" />
                              <label for="modalEditUserPhone">Phone Number</label>
								</div>
							</div>
       					</div>
						
						 <div class="col-12 col-md-6">
                          <div class="form-floating form-floating-outline">
                            <select
                              id="modalEditUserStatus"
                              name="modalEditUserStatus"
                              class="form-select"
                              aria-label="Default select example">
                              <option value="Active" selected>Active</option>
                              <option value="Inactive">Inactive</option>
                              <option value="Suspended">Suspended</option>
                            </select>
                            <label for="modalEditUserStatus">Status</label>
                         </div>
                        </div>						
                           <div class="col-12 col-md-6">
                          <div class="form-floating form-floating-outline">
                            <select
                              id="modalEditUserProject"
                              name="modalEditUserProject"
                              class="form-select"
							  value=""
                              aria-label="Default select example">
							  <option value="" selected disabled>Select a Project</option>
                              <option value="T1">T1</option>
                              <option value="T2">T2</option>
                              <option value="T3">T3</option>
                            </select>
                            <label for="modalEditUserProject">Project Assigned</label>
                          </div>
                        </div>
                        <div class="col-12 text-center d-flex flex-wrap justify-content-center gap-4 row-gap-4">
                          <button type="button" id="submitBtn" class="btn btn-primary" onclick="generateCredentials()">Submit</button>
                          <button
                            type="reset"
                            class="btn btn-outline-secondary"
                            data-bs-dismiss="modal"
                            aria-label="Close">
                            Cancel
                          </button>
                        </div>
						<div id="loadingSpinner" style="display: none; text-align: -webkit-center;">
							<div class="spinner"></div>
							<p>Processing...</p>
					   </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!--/ Add User Modal details -->
			  
			  
		<!-- Share Project Modal details-->
		<div class="modal fade" id="shareProject" tabindex="-1" aria-hidden="true">
		  <div
			class="modal-dialog modal-lg modal-simple modal-enable-otp modal-dialog-centered"
		  >
			<div class="modal-content">
			  <button
				type="button"
				class="btn-close"
				data-bs-dismiss="modal"
				aria-label="Close"
			  ></button>
			  
			  <div class="modal-body p-0">
				<div class="text-center">
				  <h4 class="mb-2">Assign Project</h4>
				  <p class="mb-6">Assign a new project to a user</p>
				</div>
			  </div>
			  <div class="mb-6">
				<div class="form-floating form-floating-outline">
				  <select
					id="select2Basic"
					class="select2 form-select share-project-select"
					data-allow-clear="true"
				  >
						<?php
						// Fetch users
						$sql = "SELECT id, first_name, last_name, email FROM users";
						$result = $conn->query($sql);
					
						if ($result->num_rows > 0) {
							// Output data for each user
							while ($row = $result->fetch_assoc()) {
							$fullName = htmlspecialchars($row['first_name'] . " " . $row['last_name']);
							$email = htmlspecialchars($row['email']);
							echo "<option data-name='$fullName' value='{$row['id']}'>$fullName</option>";
							}
						} else {
							echo "<option>No users found</option>";
						}
				  ?>
				  </select>
				  <label for="select2Basic">Select User</label>
				</div>
			  </div>

			  <div class="mb-6">
				<label for="descriptionDropdown">Description</label>
				<select id="descriptionDropdown" class="form-select">
				  <option value="Self">Self</option>
				  <option value="Relative">Relative</option>
				  <option value="Friend">Friend</option>
				  <option value="Business">Business</option>
				</select>
			  </div>

				<!-- Placeholder for dynamic fields -->
			  <div id="dynamicFields" class="mb-6"></div>

			  <div class="mb-6">
				<label for="projectsDropdown">Project</label>
				<select id="projectsDropdown" class="form-select">
				<option value="" selected disabled>Select a Project</option>
				  <option value="T1">T1</option>
				  <option value="T2">T2</option>
				  <option value="T3">T3</option>
				</select>
			  </div>

			  <button id="assignProjectBtn" class="btn btn-primary mt-3">
				Assign Project
			  </button>
			  <div
				id="loadingSpinner2"
				style="display: none; text-align: -webkit-center"
			  >
				<div class="spinner"></div>
				<p>Processing...</p>
			  </div>
			</div>
		  </div>
		</div>

<!--/ Share Project Modal details-->

          </div>
            </div>
            <!-- / Content -->

    
          </div>
          <!-- Content wrapper -->
		  <?php include 'includes/footer.php'; ?>
       <script src="assets/js/modal-edit-user.js"></script>
  

    <!-- Vendors JS -->
    <script src="assets/vendor/libs/cleavejs/cleave.js"></script>
    <script src="assets/vendor/libs/tagify/tagify.js"></script>
    <script src="assets/vendor/libs/cleavejs/cleave-phone.js"></script>
    <script src="assets/vendor/libs/select2/select2.js"></script>
    <script src="assets/vendor/libs/@form-validation/popular.js"></script>
    <script src="assets/vendor/libs/@form-validation/bootstrap5.js"></script>
    <script src="assets/vendor/libs/@form-validation/auto-focus.js"></script>
    <script src="assets/vendor/libs/bs-stepper/bs-stepper.js"></script>

   

    <!-- Page JS -->
    
    <script src="assets/js/modal-share-project.js"></script>






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
  else if (selectedValue === 'Business') {
    dynamicFields.innerHTML = `
      <label for="businessNameInput">Name</label>
      <input id="businessNameInput" type="text" class="form-control" placeholder="Enter Business's name">
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
	else if (description === 'Business') {
    extraInput = document.getElementById('businessNameInput')?.value || '';
	}
  // Concatenate the description and extra input
  const finalDescription = extraInput ? `${description} (${extraInput})` : description;

  if (!userId || !projectName || !description) {
    alert('Please select a user, project, and description.');
	spinner.style.display = 'none';
    return;
  }
  
  

  fetch('assign_project.php', {
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
		  spinner.style.display = 'none';
        alert('Failed to assign project.');
      }
	  // Hide the loading spinner
        spinner.style.display = 'none';
		console.log("Spinner loading stopped ");
    })
    .catch(error => console.error('Error assigning project:', error));
	
        
    
});

</script>

  </body>
</html>
