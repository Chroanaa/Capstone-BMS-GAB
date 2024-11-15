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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Business Permit Application</title>
    <!-- Bootstrap CSS -->
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
  </head>
  <body>
    <header id="header">
        <!-- Optional Header content -->
    </header>
    <div class="container mt-5 business-permit-form">
        <h2 class="text-center">Business Permit Application</h2>
        <form action="generate_permit.php" method="POST">
        
        <div class="row mb-3">
            <!-- Business Name -->
            <div class="col-md-6 form-floating">
                <input type="text" class="form-control" id="businessName" name="businessName" placeholder="Business Name" required>
                <label for="businessName">Business Name</label>
            </div>

            <!-- Business Type -->
            <div class="col-md-6 form-floating">
                <input type="text" class="form-control" id="businessType" name="businessType" placeholder="Business Type (e.g., Retail, Manufacturing)" required>
                <label for="businessType">Business Type</label>
            </div>
        </div>

        <div class="row mb-3">
            <!-- Owner's First Name -->
            <div class="col-md-4 form-floating">
                <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name" required>
                <label for="firstName">Owner's First Name</label>
            </div>

            <!-- Owner's Middle Name -->
            <div class="col-md-4 form-floating">
                <input type="text" class="form-control" id="middleName" name="middleName" placeholder="Middle Name">
                <label for="middleName">Owner's Middle Name</label>
            </div>

            <!-- Owner's Last Name (Surname) -->
            <div class="col-md-4 form-floating">
                <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name" required>
                <label for="lastName">Owner's Last Name</label>
            </div>
        </div>

        <div class="row mb-3">
            <!-- Contact Number -->
            <div class="col-md-6 form-floating">
                <input type="text" class="form-control" id="contact" name="contact" placeholder="Contact Number" required maxlength="11" pattern="\d{11}" title="Please enter 11 digits only">
                <label for="contact">Contact Number</label>
            </div>

            <!-- Email Address -->
            <div class="col-md-6 form-floating">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required>
                <label for="email">Email Address</label>
            </div>
        </div>

        <div class="row mb-3">
            <!-- Business Address -->
            <div class="col-md-12 form-floating">
                <input type="text" class="form-control" id="businessAddress" name="businessAddress" placeholder="Business Address" required>
                <label for="businessAddress">Business Address</label>
            </div>
        </div>

        <div class="row mb-3">
            <!-- Business Registration Number -->
            <div class="col-md-6 form-floating">
                <input type="text" class="form-control" id="registrationNumber" name="registrationNumber" placeholder="Business Registration Number" required>
                <label for="registrationNumber">Business Registration Number</label>
            </div>

            <!-- Tax Identification Number (TIN) -->
            <div class="col-md-6 form-floating">
                <input type="text" class="form-control" id="taxId" name="taxId" placeholder="Tax Identification Number (TIN)" required>
                <label for="taxId">Tax Identification Number (TIN)</label>
            </div>
        </div>

        <div class="row mb-3">
            <!-- Purpose of Permit -->
            <div class="col-md-12 form-floating">
                <textarea class="form-control" id="purpose" name="purpose" placeholder="Purpose of Permit" rows="4" required></textarea>
                <label for="purpose">Purpose of Permit</label>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="d-grid gap-2">
            <button type="submit" class="btn  btn-business-permit">Submit</button>
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
