<?php
session_start();

$loginSession = $_SESSION['session'] ?? null;
if($loginSession == null){
  header('Location: Login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Health Certificate Application</title>
    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="styles.css" />
  </head>
  <body>
    <header id="header">
        <!-- Optional Header content -->
    </header>
    <div class="container mt-5 health-certificate-form">
        <h2 class="text-center">Health Certificate Application</h2>
        <form action="submit_health_certificate.php" method="POST">
        
        <h4>Applicant Information</h4>
        <div class="row mb-3">
            <!-- First Name -->
            <div class="col-md-4 form-floating">
                <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name" required>
                <label for="firstName">First Name</label>
            </div>

            <!-- Middle Name -->
            <div class="col-md-4 form-floating">
                <input type="text" class="form-control" id="middleName" name="middleName" placeholder="Middle Name">
                <label for="middleName">Middle Name</label>
            </div>

            <!-- Last Name -->
            <div class="col-md-4 form-floating">
                <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name" required>
                <label for="lastName">Last Name</label>
            </div>
        </div>

        <div class="row mb-3">
            <!-- Date of Birth -->
            <div class="col-md-6 form-floating">
                <input type="date" class="form-control" id="birthDate" name="birthDate" placeholder="Date of Birth" required>
                <label for="birthDate">Date of Birth</label>
            </div>

            <!-- Contact Number -->
            <div class="col-md-6 form-floating">
                <input type="text" class="form-control" id="contactNumber" name="contactNumber" placeholder="Contact Number" required maxlength="11" pattern="\d{11}" title="Please enter 11 digits only">
                <label for="contactNumber">Contact Number</label>
            </div>
        </div>

        <div class="row mb-3">
            <!-- Address -->
            <div class="col-md-12 form-floating">
                <input type="text" class="form-control" id="address" name="address" placeholder="Address" required>
                <label for="address">Address</label>
            </div>
        </div>

        <h4>Medical Information</h4>
        <div class="row mb-3">
            <!-- Known Allergies -->
            <div class="col-md-6 form-floating">
                <input type="text" class="form-control" id="allergies" name="allergies" placeholder="Known Allergies">
                <label for="allergies">Known Allergies</label>
            </div>

            <!-- Pre-existing Conditions -->
            <div class="col-md-6 form-floating">
                <input type="text" class="form-control" id="conditions" name="conditions" placeholder="Pre-existing Conditions">
                <label for="conditions">Pre-existing Conditions</label>
            </div>
        </div>

        <div class="row mb-3">
            <!-- Current Medications -->
            <div class="col-md-6 form-floating">
                <input type="text" class="form-control" id="medications" name="medications" placeholder="Current Medications">
                <label for="medications">Current Medications</label>
            </div>

            <!-- Recent Illnesses -->
            <div class="col-md-6 form-floating">
                <input type="text" class="form-control" id="recentIllnesses" name="recentIllnesses" placeholder="Recent Illnesses">
                <label for="recentIllnesses">Recent Illnesses</label>
            </div>
        </div>

        <div class="row mb-3">
            <!-- Purpose of Health Certificate -->
            <div class="col-md-12 form-floating">
                <textarea class="form-control" id="purpose" name="purpose" placeholder="Purpose of Health Certificate" rows="4" required></textarea>
                <label for="purpose">Purpose of Health Certificate</label>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-health-certificate">Submit</button>
        </div>
     
        </form>
    </div>

    <!-- Logout Modal -->
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
            <a href="../controller/logoutController.php" class="btn btn-danger">Logout</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script type="module">
      import {header} from './header.js';
      header(<?=$loginSession?>);
    </script>
  </body>
</html>
