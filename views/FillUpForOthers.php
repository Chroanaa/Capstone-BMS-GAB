<?php
session_start();

$loginSession = $_SESSION['session'] ?? null;
if($loginSession == null){
  header('Location: Login.php?error=notLoggedIn');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fill up for others</title>
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

    <!-- Add to the head section of your PHP files -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="styles.css" />

    <!-- Add to head section -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <header id="header"></header>
    <main>
    <div class="container">
        <div class="row">
          <div class="col-sm-10 col-md-9 col-lg-7 mx-auto mt-5">
            <div class="card card-signin my-5 shadow-yellow">
              <div class="card-body">
                <h5 class="card-title text-center h5">Fill up <i class="bi bi-pencil-square"></i></h5>
                <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#home">Resident Details</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#menu1">Certificates/Permits/ID</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#menu2">Signature</a>
                  </li>
                </ul>
                <form action="../controller/addRequestForOthers.php" method="post" enctype="multipart/form-data">
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
                      <h4 class="card-title">RESIDENCE</h4>
                      <div class="row mb-3">
                        <div class="col-md-6">
                          <div class="form-floating">
                            <input type="text" id="inputBldg" name="bldg" class="form-control" placeholder="House/Bldg/Floor no.">
                            <label for="inputBldg">HOUSE/BLDG/Floor no.</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-floating">
                            <input type="text" id="street" name="street" class="form-control" placeholder="Street">
                            <label for="street">Street</label>
                          </div>
                        </div>
                      </div>
                      <h4 class="card-title">RESIDENT OF THE BARANGAY</h4>
                      <div class="row mb-3">
                        <h5 class="note">Ex. Resident of Barangay since From : 1/16/2025 To: 3/16/2025</h5>
                        <div class="col-md-6">
                          <div class="form-floating">
                            <input type="date" id="from" name="From" class="form-control" placeholder="From">
                            <label for="from">From</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-floating">
                            <input type="date" id="to" name="to" class="form-control" placeholder="To">
                            <label for="to">To</label>
                          </div>
                        </div>
                      </div>

                      <div class="row mb-3">
                        <div class="col-md-6">
                          <div class="form-floating">
                            <input type="date" name="date" id="date" class="form-control" placeholder="Date of birth">
                            <label for="date">Date of birth</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-floating">
                            <input type="text" id="Age" name="Age" class="form-control" placeholder="Age">
                            <label for="Age">Age</label>
                          </div>
                        </div>
                      </div>

                      <div class="form-floating mb-3">
                        <input type="text" id="placeofbirth" name="placeofbirth" class="form-control" placeholder="Place of birth">
                        <label for="placeofbirth">Place of birth</label>
                      </div>

                      <div class="form-floating mb-3">
                        <input type="text" id="Contactnumber" name="Contactnumber" class="form-control" placeholder="Contact number">
                        <label for="Contactnumber">Contact number</label>
                      </div>

                      <div class="row mb-3">
                        <div class="col-md-6">
                          <div class="form-label-group">
                            <span><b>Sex:</b></span>
                            <div class="form-check">
                              <input type="radio" class="form-check-input" id="Male" name="sex" value="Male" required>
                              <label class="form-check-label" for="Male">Male</label>
                            </div>
                            <div class="form-check">
                              <input type="radio" class="form-check-input" id="Female" name="sex" value="Female">
                              <label class="form-check-label" for="Female">Female</label>
                            </div>
                          </div>
                        </div>
                        
                        <div class="col-md-6">
                          <div class="form-label-group">
                            <span><b>Civil Status:</b></span>
                            <div class="form-check">
                              <input type="radio" class="form-check-input" id="Single" name="Civilstatus" value="single">
                              <label class="form-check-label" for="Single">Single</label>
                            </div>
                            <div class="form-check">
                              <input type="radio" class="form-check-input" id="Separated" name="Civilstatus" value="separated">
                              <label class="form-check-label" for="Separated">Separated</label>
                            </div>
                            <div class="form-check">
                              <input type="radio" class="form-check-input" id="Married" name="Civilstatus" value="Married">
                              <label class="form-check-label" for="Married">Married</label>
                            </div>
                            <div class="form-check">
                              <input type="radio" class="form-check-input" id="Widow" name="Civilstatus" value="Widow">
                              <label class="form-check-label" for="Widow">Widow</label>
                            </div>
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

                      <!-- Upload ID Picture -->
                      <div class="mb-3">
                        <label for="valid_id" class="form-label">Upload ID picture:</label>
                        <input class="form-control" type="file" id="valid_id" name="valid_id" accept="image/*" required>
                      </div>

                      <!-- Vehicle Ownership -->
                      <div class="mb-3">
                        <span><b>Do you own a vehicle?</b></span>
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
                      </div>

                      <!-- How Many Floors -->
                      <div class="form-floating mb-3">
                        <input type="number" id="floor_count" name="floor_count" class="form-control" placeholder="How Many Floors" min="0" required />
                        <label for="floor_count">House Floors</label>
                      </div>

                      <div class="form-floating mb-3">
                        <select name="Purpose" id="Purpose" class="form-select">
                          <option value="employment">Employment</option>
                          <option value="Driver's License">Driver's License</option>
                          <option value="Tricycle Franchise">Tricycle Franchise</option>
                          <option value="DSWD">DSWD</option>
                          <option value="Housing loan">Housing loan</option>
                          <option value="Burial Assistance">Burial Assistance</option>
                          <option value="Finance Assistance">Finance Assistance</option>
                          <option value="Postal ID">Postal ID</option>
                          <option value="Multi-purpose Loan">Multi-purpose Loan</option>
                          <option value="Medical Assistance">Medical Assistance</option>
                        </select>
                        <label for="Purpose">Purpose</label>
                      </div>

                      <!-- File uploader for picture -->
                      <div class="mb-3">
                        <label for="profilePicture" class="form-label">Upload Profile Picture:</label>
                        <input class="form-control" type="file" id="profilePicture" name="profilePicture" accept="image/*" required>
                      </div>
                      <div class="mb-3">
                        <img id="profilePicturePreview" src="#" alt="Profile Picture Preview" class="img-fluid" style="display: none; max-width: 100%; height: auto;">
                      </div>
                    </div>

                    <div id="menu1" class="container tab-pane fade"><br>
                      <div class="form-check fill-up-label">
                        <input type="checkbox" class="form-check-input" name="documents[]" id="Barangay_clearance" value="Barangay_clearance">
                        <label class="form-check-label" for="Barangay_clearance">Barangay clearance</label>
                      </div>
                      <div class="form-label-group mb-3 fill-label-group">
                <div class="form-check fill-up-label">
                  <input type="checkbox" name="documents[]" id="Certificate_of_indigency" value="Certificate_of_indigency" class="form-check-input">
                  <label for="Certificate_of_indigency" class="form-check-label">Certificate of indigency</label>
                </div>
                <div class="form-check fill-up-label">
                  <input type="checkbox" name="documents[]" id="Certificate_of_residency" value="Certificate_of_residency" class="form-check-input">
                  <label for="Certificate_of_residency" class="form-check-label">Certificate of Residency</label>
                </div>
                <div class="form-check fill-up-label">
                  <input type="checkbox" name="documents[]" id="Barangay_id" value="Barangay_id" class="form-check-input">
                  <label for="Barangay_id" class="form-check-label">Barangay Id</label>
                </div>
              
                <div class="form-check fill-up-label">
                  <input type="checkbox" name="documents[]" id="FirstTime_Job_Seeker" value="FirstTime_Job_Seeker" class="form-check-input">
                  <label for="FirstTime_Job_Seeker" class="form-check-label">First-Time Job Seeker</label>
                </div>
                <div class="form-check fill-up-label">
                  <input type="checkbox" name="documents[]" id="Certificate_of_scholarship" value="Certificate_of_scholarship" class="form-check-input">
                  <label for="Certificate_of_scholarship" class="form-check-label">Certificate of scholarship</label>
                </div>
              </div>
            </div>
            

                    <div id="menu2" class="container tab-pane fade"><br>
                      <h3 class="purpose">Certified true and Correct</h3>
                      
                      <div class="container mt-5">
                        <div class="mb-4">
                          <button type="button" class="clear btn btn-primary"><i class="bi bi-arrow-clockwise"></i></button>
                          <canvas class="signature-canvas"></canvas>
                          <div class="signature-box"></div>
                          <div class="text-center">Signature </div>
                          <div class="text-muted text-center">Applicant</div>
                          <input type="hidden" name="signature" id="signature">
                        </div>
                        <div class="mb-3">
                          <span>Date:</span>
                          <h4 class="dateToday"></h4>
                          <button type="submit" name="submit" id="submitBtn" class="btn btn-primary button-main ms-auto">Submit <i class="bi bi-box-arrow-in-right"></i></button>
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
      <?php include 'modals/modalLogout.html'?>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
    <script type="module">
      import {header} from "./header.js";
      header(<?= $loginSession?>);

      const dateOfBirth = document.getElementById("date"); 
      const dateToday = document.querySelector(".dateToday");
      const clear = document.querySelector(".clear");
      const Age = document.getElementById("Age");
      const form = document.querySelector("form");
      dateToday.innerHTML = new Date().toLocaleDateString();
      const submit = document.getElementById("submitBtn");
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
        document.getElementById("Age").value = age;
      });

      const canvas = document.querySelector("canvas");
      const ctx = canvas.getContext("2d");
      const signaturePad = new SignaturePad(canvas, {
        backgroundColor: "rgb(255, 255, 255)",
        penColor: "rgb(0, 0, 0)"
      });
      const signatureBox = document.querySelector(".signature-box");
      signaturePad.onEnd = function () {
        signatureBox.innerHTML = "";
        signatureBox.appendChild(signaturePad.toDataURL());
      };
      clear.addEventListener("click", function (e) {
        e.preventDefault();
        signaturePad.clear();
        signatureBox.innerHTML = "";
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

      // Handle vehicle selection
      const vehicleYes = document.getElementById('vehicleYes');
      const vehicleNo = document.getElementById('vehicleNo');
      const howManyVehicles = document.getElementById('howManyVehicles');

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



/// Replace the existing form submission handler with this:

document.querySelector('form').addEventListener('submit', async function(e) {
    e.preventDefault();

    // Validate signature
    if (signaturePad.isEmpty()) {
        Swal.fire({
            title: 'Signature Required',
            text: 'Please provide your signature before submitting',
            icon: 'warning',
            confirmButtonColor: '#0d6efd'
        });
        return;
    }

    // Validate document selection
    const documents = document.querySelectorAll('input[name="documents[]"]:checked');
    if (documents.length === 0) {
        Swal.fire({
            title: 'Document Required',
            text: 'Please select at least one document to request',
            icon: 'warning',
            confirmButtonColor: '#0d6efd'
        });
        return;
    }
const signatureDataUrl = signaturePad.toDataURL();
document.getElementById('signature').value = signatureDataUrl;
    // Confirmation dialog
    const confirmResult = await Swal.fire({
        title: 'Confirm Information',
        text: 'Are all the information correct?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes, submit',
        cancelButtonText: 'No, let me check',
        confirmButtonColor: '#0d6efd',
        cancelButtonColor: '#6c757d',
        reverseButtons: true
    });

    if (confirmResult.isConfirmed) {
        try {
            // Show loading state
            Swal.fire({
                title: 'Submitting...',
                html: 'Please wait while we process your request',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Submit the form
            const formData = new FormData(this);
            const response = await fetch(this.action, {
                method: 'POST',
                body: formData
            });

            if (response.ok) {
                Swal.fire({
                    title: 'Success!',
                    text: 'Your request has been submitted successfully',
                    icon: 'success',
                    confirmButtonColor: '#0d6efd'
                }).then(() => {
                    window.location.href = 'AccountDashboard.php';
                });
            } else {
                throw new Error('Form submission failed');
            }
        } catch (error) {
            Swal.fire({
                title: 'Error!',
                text: 'Something went wrong. Please try again.',
                icon: 'error',
                confirmButtonColor: '#dc3545'
            });
        }
    }
});

// Remove existing onclick handler
submit.onclick = null;
    </script>

</body>
</html>