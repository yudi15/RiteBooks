/**
 * Edit User
 */

'use strict';
 let formValidation; // Declare a global variable for form validation
 
 
 //Generating credentials for the user
		async function generateCredentials() {
			
			// Validate the form first
  const validationStatus = await formValidation.validate();

  if (validationStatus === 'Valid') {
			// Validate email field

			const phoneCodeSpan = document.getElementById("phoneCode");
			const countrySelect = document.getElementById("select2-modalEditUserCountry-container");


			// Show the loading spinner
			const spinner = document.getElementById("loadingSpinner");
			spinner.style.display = "block";

			// Gather all input values for user details
			const selectedPhoneCode = document.getElementById("modalEditUserCountry").value;
			const phoneNumber = document.getElementById("modalEditUserPhone").value;
			const fullPhoneNumber = selectedPhoneCode ? `${selectedPhoneCode}${phoneNumber}` : phoneNumber;

			const userDetails = {
				email: document.getElementById("modalEditUserEmail").value,
				first_name: document.getElementById("modalEditUserFirstName").value,
				last_name: document.getElementById("modalEditUserLastName").value,
				username: document.getElementById("modalEditUserName").value,
				level: document.getElementById("modalEditUserStatus").value,
				tax_Id: document.getElementById("modalEditTaxID").value,
				Ph_no: fullPhoneNumber, // Phone number with country code
				country: document.getElementById("modalEditUserCountry").options[
				document.getElementById("modalEditUserCountry").selectedIndex
				].text, // Country name
				project: document.getElementById("modalEditUserProject").value,
			};

			try {
				// Send a POST request to your PHP file
				const response = await fetch("process_user.php", {
					method: "POST",
					headers: { "Content-Type": "application/json" },
					body: JSON.stringify(userDetails),
				});

				const result = await response.json();

				if (result.success) {
					alert(result.message); // Success message
					// Clear all inputs
					document.getElementById("modalEditUserEmail").value = "";
					document.getElementById("modalEditUserFirstName").value = "";
					document.getElementById("modalEditUserLastName").value = "";
					document.getElementById("modalEditUserName").value = "";
					document.getElementById("modalEditUserStatus").value = "";
					document.getElementById("modalEditTaxID").value = "";
					document.getElementById("modalEditUserPhone").value = "";
					
					
					countrySelect.value = "";
					$('#modalEditUserCountry').val("").trigger('change'); // Clear Select2 if used
					
					document.getElementById("modalEditUserProject").value = "";
					phoneCodeSpan.textContent = ""; 
				} else {
					alert(result.message || "An error occurred.");
				}
			} catch (error) {
				console.error("Error:", error);
				alert("Failed to submit form.");
			} finally {
				// Hide the loading spinner
				spinner.style.display = "none";
			}
			}else {
				alert('Please fix the errors in the form before submitting.');
			}
		}
		
 
  // Select2 Country
  $('#addUser').on('shown.bs.modal', function () {
  
  // Fetch and initialize dropdown here
    
   
    const countrySelect = $("#modalEditUserCountry"); // Use jQuery for Select2 initialization
    const phoneCodeSpan = document.getElementById("phoneCode");
 
 
    // Fetch country data from the API
    fetch("/Admin2 - Copy/get_countries.php")
      .then((response) => response.json())
      .then((data) => {
        if (data.status === "success") {
          // Populate the Select2 dropdown with country data
		    
          countrySelect.empty(); // Clear existing options
          countrySelect.append('<option value="" selected disabled>Select Country</option>');
          data.data.forEach((country) => {
            countrySelect.append(
              `<option value="${country.phone_code}">${country.name}</option>`
            );
          });

          // Initialize Select2 on the country dropdown
          countrySelect.select2({
            placeholder: "Select Country",
            dropdownParent: countrySelect.parent(), // Ensure dropdown stays within modal
          });

          // Listen for changes to the selected country
          countrySelect.on("change", function () {
            const selectedPhoneCode = $(this).val(); // Get the selected phone code
            phoneCodeSpan.textContent = `(${selectedPhoneCode})`;
            //console.log("Selected Country Code: " + selectedPhoneCode);
          });
        } else {
          console.error("Failed to fetch countries:", data.message);
        }
      })
      .catch((error) => {
        console.error("Error fetching countries:", error);
      });
  });





document.addEventListener('DOMContentLoaded', function (e) {
  (function () {
    // variables
    const modalEditUserTaxID = document.querySelector('.modal-edit-tax-id');
    const modalEditUserPhone = document.querySelector('.phone-number-mask');

    // Prefix
    if (modalEditUserTaxID) {
      new Cleave(modalEditUserTaxID, {
        prefix: 'TIN',
        blocks: [3, 3, 3, 4],
        uppercase: true
      });
    }

    // Phone Number Input Mask
   

    // Edit user form validation
    const form = document.getElementById('editUserForm');
  
  // Initialize form validation and assign it to the global variable
  formValidation = FormValidation.formValidation(form, {
    fields: {
        modalEditUserFirstName: {
          validators: {
            notEmpty: {
              message: 'Please enter your first name'
            },
            regexp: {
              regexp: /^[a-zA-Zs]+$/,
              message: 'The first name can only consist of alphabetical'
            }
          }
        },
        modalEditUserLastName: {
          validators: {
            notEmpty: {
              message: 'Please enter your last name'
            },
            regexp: {
              regexp: /^[a-zA-Zs]+$/,
              message: 'The last name can only consist of alphabetical'
            }
          }
        },
        modalEditUserName: {
          validators: {
            notEmpty: {
              message: 'Please enter your username'
            },
            stringLength: {
              min: 6,
              max: 30,
              message: 'The username must be more than 6 and less than 30 characters long'
            },
            regexp: {
              regexp: /^[a-zA-Z0-9 ]+$/,
              message: 'The username can only consist of alphabetical, number and space'
            }
          }
        },
		modalEditUserEmail: { // Added email validation
		  validators: {
            notEmpty: {
                message: 'Please enter your email address'
            },
            regexp: {
                regexp: /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/,
                message: 'Please enter a valid email address'
				}
			}
		},
		modalEditUserProject: {
			  validators: {
				notEmpty: {
				  message: 'Please select any one project'
				}
			  }
			},
	    modalEditUserCountry: {
                validators: {
                    notEmpty: {
                        message: 'Please select a country'
                    }
                }
            },
            modalEditUserPhone: {
                validators: {
                    notEmpty: {
                        message: 'Please enter a phone number'
                    }
                }
            }
        },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap5: new FormValidation.plugins.Bootstrap5({
          // Use this for enabling/changing valid/invalid class
          // eleInvalidClass: '',
          eleValidClass: '',
          rowSelector: '.col-12'
        }),
        submitButton: new FormValidation.plugins.SubmitButton(),
        // Submit the form when all fields are valid
        // defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
        autoFocus: new FormValidation.plugins.AutoFocus()
      }
    });
	 // Handle form submission
      form.addEventListener('submit', function (e) {
        e.preventDefault();

        formValidation.validate().then(function (status) {
          if (status === 'Valid') {
            generateCredentials();
          } else {
            alert('Please fix the errors in the form before submitting.');
          }
        });
      });
    })();
  });
