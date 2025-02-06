/**
 *  Pages Authentication
 */

'use strict';
const formAuthentication = document.querySelector('#formAuthentication');

document.addEventListener('DOMContentLoaded', function (e) {
  (function () {
    // Form validation for Add new record
    if (formAuthentication) {
      const fv = FormValidation.formValidation(formAuthentication, {
        fields: {
          username: {
            validators: {
              notEmpty: {
                message: 'Please enter username'
              },
              stringLength: {
                min: 6,
                message: 'Username must be more than 6 characters'
              }
            }
          },
          email: {
            validators: {
              notEmpty: {
                message: 'Please enter email / username'
              },
              stringLength: {
                min: 6,
                message: 'Username must be more than 6 characters'
              }
            }
          },
          password: {
            validators: {
              notEmpty: {
                message: 'Please enter your password'
              },
              stringLength: {
                min: 5,
                message: 'Password must be more than 5 characters'
              }
            }
          }
        },
        plugins: {
          trigger: new FormValidation.plugins.Trigger(),
          bootstrap5: new FormValidation.plugins.Bootstrap5({
            eleValidClass: '',
            rowSelector: '.mb-5'
          }),
          autoFocus: new FormValidation.plugins.AutoFocus()
        },
        init: instance => {
          instance.on('plugins.message.placed', function (e) {
            if (e.element.parentElement.classList.contains('input-group')) {
              e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
            }
          });
        }
      });

      // Custom form submission after validation
      formAuthentication.addEventListener('submit', function (e) {
        e.preventDefault(); // Prevent default form submission
        fv.validate().then(function (status) {
          if (status === 'Valid') {
            // Trigger your custom AJAX logic here
            console.log('Form is valid. Submitting via AJAX...');
            
            const email = document.querySelector('#email').value;
            const password = document.querySelector('#password').value;

            // Hide error message
            const errorMessage = document.querySelector('#error-message');
            errorMessage.style.display = 'none';

            // Perform AJAX
            fetch('LoginCheck.php', {
              method: 'POST',
              headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
              body: new URLSearchParams({ email: email, password: password })
            })
              .then(response => response.json())
              .then(data => {
                if (data.status === 'error') {
                  errorMessage.textContent = data.message;
                  errorMessage.style.display = 'block';
                } else if (data.status === 'success') {
                  window.location.href = data.redirect;
                }
              })
              .catch(error => {
                console.error('Error:', error);
                errorMessage.textContent = 'An unexpected error occurred. Please try again.';
                errorMessage.style.display = 'block';
              });
          }
        });
      });
    }
  })();
});