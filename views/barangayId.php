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
    <title>Barangay ID Application</title>
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
    <div class="container mt-5 barangay-id-form">
        <h2 class="text-center">Barangay ID Application</h2>
        <form action="generate_barangay_id.php" method="POST">
        
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
            <!-- Birthday -->
            <div class="col-md-6 form-floating">
                <input type="date" class="form-control" id="birthday" name="birthday" placeholder="Birthday" required>
                <label for="birthday">Birthday</label>
            </div>

            <!-- Contact Number -->
            <div class="col-md-6 form-floating">
                <input type="text" class="form-control" id="contact" name="contact" placeholder="Contact Number" required maxlength="11" pattern="\d{11}" title="Please enter 11 digits only">
                <label for="contact">Contact Number</label>
            </div>
        </div>

        <div class="row mb-3">
            <!-- Gender -->
            <div class="col-md-6 form-floating">
                <select class="form-control" id="gender" name="gender" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
                <label for="gender">Gender</label>
            </div>

            <!-- Civil Status -->
            <div class="col-md-6 form-floating">
                <select class="form-control" id="civilStatus" name="civilStatus" required>
                    <option value="Single">Single</option>
                    <option value="Married">Married</option>
                    <option value="Widowed">Widowed</option>
                    <option value="Separated">Separated</option>
                </select>
                <label for="civilStatus">Civil Status</label>
            </div>
        </div>

        <div class="row mb-3">
            <!-- Address -->
            <div class="col-md-12 form-floating">
                <input type="text" class="form-control" id="address" name="address" placeholder="Address" required>
                <label for="address">Address</label>
            </div>
        </div>

        <div class="row mb-3">
            <!-- Place of Birth -->
            <div class="col-md-6 form-floating">
                <input type="text" class="form-control" id="placeOfBirth" name="placeOfBirth" placeholder="Place of Birth" required>
                <label for="placeOfBirth">Place of Birth</label>
            </div>

            <!-- Occupation -->
            <div class="col-md-6 form-floating">
                <input type="text" class="form-control" id="occupation" name="occupation" placeholder="Occupation" required>
                <label for="occupation">Occupation</label>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-barangay-id">Submit</button>
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
