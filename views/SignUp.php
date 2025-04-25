<?php
session_start();
$loginSession = $_SESSION['session'] ?? null;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <!-- Bootstrap Icons -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css"
      rel="stylesheet"
    />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="styles.css" />
  <!-- Add to head section -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Add to the head section of your PHP files -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</head>
<body>
    <header id = "header"></header>

    <main>
    <div class="container">
        <div class="row">
          <div class="col-sm-7 col-md-7 col-lg-5 mx-auto mt-5">
            <div class="card card-signin my-5 shadow-yellow">
              <div class="card-body">
                <h1 class="card-title text-center h5">REGISTER <i class="bi bi-person-plus-fill"></i></h1>
                <form action="../controller/signUpController.php" method="post" enctype="multipart/form-data">
                  <div class="container">
                    <div class="tab-content">
                      <div id="home" class="container tab-pane active"><br>
                      <div class="row mb-3">
                          <!-- First Name -->
                          <div class="col-md-4 form-floating">
                              <input
                                  type="text"
                                  id="firstName"
                                  name="firstName"
                                  class="form-control"
                                  placeholder="First Name"
                                  required
                              />
                              <label for="firstName">First Name</label>
                          </div>

                          <!-- Middle Name -->
                          <div class="col-md-4 form-floating">
                              <input
                                  type="text"
                                  id="middleName"
                                  name="middleName"
                                  class="form-control"
                                  placeholder="Middle Name"
                              />
                              <label for="middleName">Middle Name</label>
                          </div>

                          <!-- Last Name -->
                          <div class="col-md-4 form-floating">
                              <input
                                  type="text"
                                  id="lastName" 
                                  name="lastName"
                                  class="form-control"
                                  placeholder="Last Name"
                                  required
                              />
                              <label for="lastName">Last Name</label>
                          </div>
                      </div>
                        <div class="form-label-group">
                        
                      </div>
                        <h4 class="h4">RESIDENCE:</h4>
                        <div class="row">
                          <div class="col">
                            <div class="form-floating mb-3">
                              <input
                                type="text"
                                id="inputBldg"
                                name="bldg"
                                class="form-control"
                                placeholder="HOUSE/BLDG/Floor no."
                                required
                              />
                              <label for="inputBldg">HOUSE/BLDG/Floor no.:</label>
                            </div>
                          </div>
                          <div class="col">
                            <div class="form-floating mb-3">
                              <input
                                type="text"
                                id="street"
                                name="street"
                                class="form-control"
                                placeholder="Street"
                                required
                              />
                              <label for="street">Street:</label>
                            </div>
                          </div>
                        </div>
                        
                        <h4 class="h4">RESIDENT OF THE BARANGAY</h4>
                        <div class="row">
                          <h5 class="note">Ex. Resident of Barangay since From : 1/16/2025 To: 3/16/2025</h5>
                          <div class="col">
                            <div class="form-floating mb-3">
                              <input
                                type="date"
                                id="from"
                                name="From"
                                class="form-control"
                                placeholder="From"
                                required
                              />
                              <label for="from">From:</label>
                            </div>
                          </div>
                          <div class="col">
                            <div class="form-floating mb-3">
                              <input
                                type="date"
                                id="to"
                                name="to"
                                class="form-control"
                                placeholder="To"
                                required
                              />
                              <label for="to">To:</label>
                            </div>
                          </div>
                        </div>
                        
                        <div class="row">
                          <div class="col">
                            <div class="form-floating mb-3">
                              <input
                                type="date"
                                id="date"
                                name="date"
                                class="form-control"
                                placeholder="Date of Birth"
                                required
                              />
                              <label for="date">Date of Birth:</label>
                            </div>
                          </div>
                          <div class="col">
                            <div class="form-floating mb-3">
                              <input
                                type="text"
                                id="Age"
                                name="Age"
                                class="form-control"
                                placeholder="Age"
                                required
                              />
                              <label for="Age">Age:</label>
                            </div>
                          </div>
                        </div>
                        
                        <div class="form-floating mb-3">
                          <input
                            type="text"
                            id="placeofbirth"
                            name="placeofbirth"
                            class="form-control"
                            placeholder="Place of Birth"
                            required
                          />
                          <label for="placeofbirth">Place of Birth:</label>
                        </div>
                        
                        <div class="form-floating mb-3">
                          <input
                            type="text"
                            id="Contactnumber"
                            name="Contactnumber"
                            class="form-control"
                            placeholder="Contact Number"
                            required
                          />
                          <label for="Contactnumber">Contact No: <i class="bi bi-telephone-plus"></i></label>
                          <span class="text-danger" id="contactNumberError"></span>
                        </div>
                         <div class="form-floating mb-3">
                          <input
                            type="text"
                            id="Email"
                            name="Email"
                            class="form-control"
                            placeholder="Email"
                            required
                          />
                          <label for="Email">Email: <i class="bi bi-envelope"></i></label>
                          <span class="text-danger" id="emailError"></span>
                        </div>
                      <div class="row">
                        <div class="col">
                          <span><b class="h2">Sex: </b></span>
                          <div class="form-check">
                            <input
                              type="radio"
                              id="Male"
                              name="sex"
                              value="Male"
                              class="form-check-input main-radio"
                              required
                            />
                            <label class="form-check-label" for="Male">Male</label>
                          </div>
                          <div class="form-check">
                            <input
                              type="radio"
                              id="Female"
                              name="sex"
                              value="Female"
                              class="form-check-input main-radio"
                              required
                            />
                            <label class="form-check-label" for="Female">Female</label>
                          </div>
                        </div>
                        
                        <div class="col">
                          <span><b class="h2">Civil Status:</b></span>
                          <div class="form-check">
                            <input
                              type="radio"
                              id="Single"
                              name="Civilstatus"
                              value="single"
                              class="form-check-input main-radio"
                              required
                            />
                            <label class="form-check-label" for="Single">Single</label>
                          </div>
                          <div class="form-check">
                            <input
                              type="radio"
                              id="Separated"
                              name="Civilstatus"
                              value="separated"
                              class="form-check-input main-radio"
                              required
                            />
                            <label class="form-check-label" for="Separated">Separated</label>
                          </div>
                          <div class="form-check">
                            <input
                              type="radio"
                              id="Married"
                              name="Civilstatus"
                              value="Married"
                              class="form-check-input main-radio main-radio"
                              required
                            />
                            <label class="form-check-label" for="Married">Married</label>
                          </div>
                          <div class="form-check">
                            <input
                              type="radio"
                              id="Widow"
                              name="Civilstatus"
                              value="Widow"
                              class="form-check-input main-radio"
                              required
                            />
                            <label class="form-check-label" for="Widow">Widow</label>
                          </div>
                        </div>
                      </div>

                    <!-- Type of ID -->
                    <div class="form-floating mb-3 mt-3">
                                        <select id="typeOfId" name="typeOfId" class="form-select" required>
                                            <option value="" disabled selected>Select Type of ID</option>
                                            <option value="Passport">Passport</option>
                                            <option value="Driver's License">Driver's License</option>
                                            <option value="National ID">National ID</option>
                                            <option value="Voter's ID">Voter's ID</option>
                                            <option value="School ID">School ID</option>
                                        </select>
                                        <label for="typeOfId">Type of ID</label>
                                    </div>
                                    <div class="mb-3">
                          <label for="id" class="form-label">Upload ID picture:</label>
                          <input class="form-control" type="file" id="id" name="id" accept="image/*" required>
                        </div>
                                    <!-- Vehicle Ownership -->
                                    <div class="mb-3">
                                        <span><b class="h2">Do you own a vehicle?</b></span>
                                        <div class="form-check">
                                            <input type="radio" id="vehicleYes" name="vehicle" value="Yes" class="form-check-input" required />
                                            <label class="form-check-label" for="vehicleYes">Yes</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" id="vehicleNo" name="vehicle" value="No" class="form-check-input" required />
                                            <label class="form-check-label" for="vehicleNo">No</label>
                                        </div>
                                    </div>

                                    <!-- How Many Vehicles -->
                                    <div class="form-floating mb-3">
                                        <input type="number" id="howManyVehicles" name="howManyVehicles" class="form-control" placeholder="How Many Vehicles" min="0" disabled />
                                        <label for="howManyVehicles">How Many Vehicles</label>
                                        <input type="hidden" id="noOfVehicales" name="noOfVehicales"  />
                                    </div>

                                    <!-- How Many Floors -->
                                    <div class="form-floating mb-3">
                                        <input type="number" id="houseFloors" name="houseFloors" class="form-control" placeholder="How Many Floors" min="0" required />
                                        <label for="houseFloors">House Floors</label>
                                    </div>


                      <div class="mb-3">
                          <label for="profilePicture" class="form-label">Picture:</label>
                          <input class="form-control" type="file" id="profilePicture" name="user_picture" accept="image/*" required>
                        </div>
                        <div class="mb-3">
                          <img id="profilePicturePreview" src="#" alt="Profile Picture Preview" class="img-fluid" style="display: none; max-width: 100%; height: auto;">
                        </div>

                        <div class="form-floating mb-3">
                          <input
                            type="text"
                            id="username"
                            name="username"
                            class="form-control"
                            placeholder="Username"
                            required
                          />
                          <label for="username">Username:</label>
                          <span class="text-danger" id="usernameError"></span>
                        </div>
                        
                        <div class="form-floating mb-3 position-relative">
                      <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control"
                        placeholder="Password"
                        required
                      />
                      <label for="password">Password</label>
                      <i
                        class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y pe-3 toggle-password fs-5"
                        style="cursor: pointer;"
                      ></i>
                    </div>
                    <a href="login.php" class="d-block mb-3 text-center login-link">Already have an account? Login here</a>
                        <div class="login-btn-container">
                          <button
                            class="btn btn-lg btn-primary btn-block text-uppercase button-main register-btn"
                            type="submit"
                            id="submitBtn"
                          >
                            Register <i class="bi bi-person-plus"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
     <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Logout</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <h4>Are you sure you want to logout?</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
        <a href="../controller/logoutController.php" class = "btn btn-danger">Logout</a>
      </div>
    </div>
  </div>
</div>
 <!-- Bootstrap JS and dependencies -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </main>
    <script src="header.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
    <script type="module">
      import {header} from './header.js';
      header(<?= $loginSession?>);
     const dateOfBirth = document.getElementById("date"); 
      const clear = document.querySelector(".clear");
      const Age = document.getElementById("Age");
      const form = document.querySelector("form");
      const submit = document.getElementById("submitBtn");
      const sex = document.querySelector("input[name=sex]:checked");
      const civilStatus = document.querySelector("input[name=Civilstatus]:checked");
    
      dateOfBirth.addEventListener("input", function() { 
        const today = new Date();
        const birthDate = new Date(dateOfBirth.value);
        if(birthDate > today) {
          alert("Date of birth cannot be in the future");
          dateOfBirth.value = "";
          Age.value = "";
          return;
        }
        
        let age = today.getFullYear() - birthDate.getFullYear();
        const monthDiff = today.getMonth() - birthDate.getMonth();
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
          age--;
        }
        if(age > 100) {
          alert("Invalid date of birth");
          dateOfBirth.value = "";
          Age.value = "";
          return;
        }
        document.getElementById("Age").value = age;
      });
    </script>
    <script>
      document.querySelector('.toggle-password').addEventListener('click', function () {
        const passwordInput = document.getElementById('password');
        const icon = this;

        // Toggle the password field type
        if (passwordInput.type === 'password') {
          passwordInput.type = 'text';
          icon.classList.remove('bi-eye-slash');
          icon.classList.add('bi-eye');
        } else {
          passwordInput.type = 'password';
          icon.classList.remove('bi-eye');
          icon.classList.add('bi-eye-slash');
        }
      });

      // JavaScript for image preview
      document.getElementById('profilePicture').addEventListener('change', function(event) {
        const [file] = event.target.files;
        if (file) {
          const preview = document.getElementById('profilePicturePreview');
          preview.src = URL.createObjectURL(file);
          preview.style.display = 'block';
        }
      });


      // Add to your existing script section
document.addEventListener('DOMContentLoaded', function() {
    // Config for FROM date
    flatpickr("#from", {
        maxDate: "today",
        dateFormat: "Y-m-d",
        onChange: function(selectedDates, dateStr) {
            // Update TO date min date when FROM changes
            toPicker.set('minDate', dateStr);
        }
    });

    // Config for TO date
    const toPicker = flatpickr("#to", {
        maxDate: "today",
        dateFormat: "Y-m-d"
    });

    // Config for birthday/date of birth
    flatpickr("#date", {
        maxDate: "today",
        dateFormat: "Y-m-d",
        onChange: function(selectedDates) {
            // Calculate age
            const today = new Date();
            const birthDate = selectedDates[0];
            let age = today.getFullYear() - birthDate.getFullYear();
            const monthDiff = today.getMonth() - birthDate.getMonth();
            
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            
            // Update age input
            document.getElementById('Age').value = age;
        }
    });
});


// Replace your existing form submit handling with this:
  document.querySelector('form').addEventListener('submit', function(e) {
    e.preventDefault();

    Swal.fire({
        title: 'Confirm Information',
        text: 'Are all the information correct?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes, submit',
        cancelButtonText: 'No, let me check',
        confirmButtonColor: '#0d6efd',
        cancelButtonColor: '#6c757d',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            // Show loading state
            Swal.fire({
                title: 'Submitting...',
                html: 'Please wait while we process your registration',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            // Submit the form
            this.submit();
        }
    });
});
function debounce(func, wait) {
    let timeout;
    return function(...args) {
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(this, args), wait);
    };
}

const username = document.getElementById('username');
const email = document.getElementById('Email');

username.addEventListener('input', debounce(async function() {
    const usernameValue = username.value;
    const submit = document.getElementById('submitBtn');

        const check = await fetch(`../controller/checkDuplicateController.php?username=${usernameValue}`);
        const response = await check.json();
        if (response.status === 'error') {
            document.getElementById('usernameError').textContent = response.message;
            submit.disabled = true;
        } else {
            document.getElementById('usernameError').textContent = '';
            submit.disabled = false;
        }
}, 300));

email.addEventListener('input', debounce(async function() {
    const emailValue = email.value;
    const submit = document.getElementById('submitBtn');

        const check = await fetch(`../controller/checkEmailDuplicate.php?email=${emailValue}`);
        const response = await check.json();
        if (response.status === 'error') {
            document.getElementById('emailError').textContent = response.message;
            submit.disabled = true;
        } else {
            document.getElementById('emailError').textContent = '';
            submit.disabled = false;
        }
}, 300));



document.addEventListener('DOMContentLoaded', function () {
    const vehicleYes = document.getElementById('vehicleYes');
    const vehicleNo = document.getElementById('vehicleNo');
    const howManyVehicles = document.getElementById('howManyVehicles');
    howManyVehicles.addEventListener('input', function () {
        const noOfVehicles = howManyVehicles.value;
        document.getElementById('noOfVehicales').value = noOfVehicles || 0;
    });

    vehicleYes.addEventListener('change', function () {
        if (vehicleYes.checked) {
            howManyVehicles.disabled = false;
        }
    });

    vehicleNo.addEventListener('change', function () {
        if (vehicleNo.checked) {
            howManyVehicles.disabled = true;
            howManyVehicles.value = ''; // Clear the value when disabled
        }
    });
});


// Add this code to your existing JavaScript in SignUp.php

// Form validation function
function validateForm() {
    // Get all required form elements
    const requiredFields = document.querySelectorAll('[required]');
    const form = document.querySelector('form');
    const submit = document.getElementById('submitBtn');
    
    // Create error message container if it doesn't exist
    let errorContainer = document.getElementById('formErrorContainer');
    if (!errorContainer) {
        errorContainer = document.createElement('div');
        errorContainer.id = 'formErrorContainer';
        errorContainer.className = 'alert alert-danger mt-3';
        errorContainer.style.display = 'none';
        form.prepend(errorContainer);
    }
    
    // Check if any required field is empty
    let isValid = true;
    let errorMessages = [];
    
    requiredFields.forEach(field => {
        // Special handling for radio buttons
        if (field.type === 'radio') {
            const radioGroup = document.querySelectorAll(`[name="${field.name}"]`);
            const isChecked = Array.from(radioGroup).some(radio => radio.checked);
            
            if (!isChecked) {
                const fieldLabel = field.name === 'sex' ? 'Sex' : 
                                  field.name === 'Civilstatus' ? 'Civil Status' : 
                                  field.name === 'vehicle' ? 'Vehicle Ownership' : field.name;
                                  
                if (!errorMessages.includes(`Please select your ${fieldLabel}`)) {
                    errorMessages.push(`Please select your ${fieldLabel}`);
                    isValid = false;
                }
            }
        }
        // Special handling for file inputs
        else if (field.type === 'file') {
            if (!field.files || field.files.length === 0) {
                const fieldLabel = field.id === 'id' ? 'ID Picture' : 
                                  field.id === 'profilePicture' ? 'Profile Picture' : field.name;
                errorMessages.push(`Please upload your ${fieldLabel}`);
                isValid = false;
            }
        }
        // Check if other fields are empty
        else if (!field.value.trim()) {
            const fieldName = field.labels && field.labels[0] ? 
                             field.labels[0].textContent.replace(':', '') : field.name;
            errorMessages.push(`Please fill in ${fieldName} field`);
            isValid = false;
        }
    });
    
    // Additional validation for vehicles
    const vehicleYes = document.getElementById('vehicleYes');
    if (vehicleYes && vehicleYes.checked) {
        const howManyVehicles = document.getElementById('howManyVehicles');
        if (!howManyVehicles.value) {
            errorMessages.push('Please specify how many vehicles you own');
            isValid = false;
        }
    }
    
    // Additional validation for date fields
    const fromDate = document.getElementById('from');
    const toDate = document.getElementById('to');
    if (fromDate && toDate && fromDate.value && toDate.value) {
        if (new Date(fromDate.value) > new Date(toDate.value)) {
            errorMessages.push('The "From" date cannot be later than the "To" date');
            isValid = false;
        }
    }
    
    // Display error messages if any
    if (!isValid) {
        errorContainer.innerHTML = errorMessages.map(msg => `<div>• ${msg}</div>`).join('');
        errorContainer.style.display = 'block';
        // Scroll to top to see errors
        window.scrollTo({ top: 0, behavior: 'smooth' });
    } else {
        errorContainer.style.display = 'none';
    }
    
    return isValid;
}

// Update form submission event
document.querySelector('form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // First validate the form
    if (!validateForm()) {
        return false; // Stop if validation fails
    }
    
    // Then show confirmation dialog
    Swal.fire({
        title: 'Confirm Information',
        text: 'Are all the information correct?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes, submit',
        cancelButtonText: 'No, let me check',
        confirmButtonColor: '#0d6efd',
        cancelButtonColor: '#6c757d',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            // Show loading state
            Swal.fire({
                title: 'Submitting...',
                html: 'Please wait while we process your registration',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            // Submit the form
            this.submit();
        }
    });
});

// Run validation on all fields when they change
document.querySelectorAll('input, select, textarea').forEach(field => {
    field.addEventListener('change', function() {
        // Clear individual field errors
        const fieldId = this.id;
        const errorSpan = document.getElementById(`${fieldId}Error`);
        if (errorSpan) {
            errorSpan.textContent = '';
        }
    });
});

// Add live validation for email format
const emailField = document.getElementById('Email');
if (emailField) {
    emailField.addEventListener('blur', function() {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const errorSpan = document.getElementById('emailError');
        
        if (!emailRegex.test(this.value) && this.value.trim()) {
            if (errorSpan) {
                errorSpan.textContent = 'Please enter a valid email address';
            }
        }
    });
}

// Add live validation for contact number
const contactNumberField = document.getElementById('Contactnumber');
if (contactNumberField) {
    // Add error span if it doesn't exist yet
    let errorSpan = document.getElementById('contactNumberError');
    if (!errorSpan) {
        errorSpan = document.createElement('span');
        errorSpan.id = 'contactNumberError';
        errorSpan.className = 'text-danger';
        contactNumberField.parentNode.appendChild(errorSpan);
    }

    contactNumberField.addEventListener('blur', function() {
        // Philippines phone number format (can start with +63 or 0, followed by 10 digits)
        const phoneRegex = /^(\+63|0)[0-9]{10}$/;
        
        if (!phoneRegex.test(this.value) && this.value.trim()) {
            errorSpan.textContent = 'Please enter a valid Philippine phone number (e.g., 09XXXXXXXXX or +639XXXXXXXXX)';
            document.getElementById('submitBtn').disabled = true;
        } else {
            errorSpan.textContent = '';
            // Only enable button if there are no other validation errors
            checkFormCompleteness();
        }
    });

    // Format input as user types
    contactNumberField.addEventListener('input', function() {
        let value = this.value.replace(/\D/g, ''); // Remove non-digits
        
        // If starts with 63, format as +63
        if (value.startsWith('63') && value.length > 2) {
            value = '+' + value;
        } 
        // If starts with 0, keep as is
        else if (value.startsWith('0')) {
            // Keep as is
        }
        // If doesn't start with 0 or +63, add 0 prefix
        else if (value && !value.startsWith('+63')) {
            value = '0' + value;
        }
        
        // Update input value with formatted number
        this.value = value;
    });
}

// Add a final validation check before unlocking the submit button
function checkFormCompleteness() {
    const requiredFields = document.querySelectorAll('[required]');
    const submit = document.getElementById('submitBtn');
    
    let isComplete = true;
    
    requiredFields.forEach(field => {
        // Check radio buttons
        if (field.type === 'radio') {
            const radioGroup = document.querySelectorAll(`[name="${field.name}"]`);
            const isChecked = Array.from(radioGroup).some(radio => radio.checked);
            if (!isChecked) isComplete = false;
        }
        // Check file inputs
        else if (field.type === 'file') {
            if (!field.files || field.files.length === 0) isComplete = false;
        }
        // Check other fields
        else if (!field.value.trim()) {
            isComplete = false;
        }
    });
    
    // Check vehicle count if "Yes" is selected
    const vehicleYes = document.getElementById('vehicleYes');
    if (vehicleYes && vehicleYes.checked) {
        const howManyVehicles = document.getElementById('howManyVehicles');
        if (!howManyVehicles.value) isComplete = false;
    }
    
    // Enable/disable submit button
    if (submit) {
        submit.disabled = !isComplete;
    }
}

// Check form completeness on page load and when any field changes
document.addEventListener('DOMContentLoaded', function() {
    checkFormCompleteness();
    
    document.querySelectorAll('input, select, textarea').forEach(field => {
        field.addEventListener('change', checkFormCompleteness);
        field.addEventListener('input', checkFormCompleteness);
    });
});
    </script>
</body>
</html>