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
    <title>Certificate of Guardianship</title>
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
    <div class="container mt-5 guardianship-certificate-form">
        <h2 class="text-center">Certificate of Guardianship</h2>
        <form action="submit_guardianship_certificate.php" method="POST">
        
        <h4>Minor's Information</h4>
        <div class="row mb-3">
            <!-- Minor's First Name -->
            <div class="col-md-4 form-floating">
                <input type="text" class="form-control" id="minorFirstName" name="minorFirstName" placeholder="Minor's First Name" required>
                <label for="minorFirstName">Minor's First Name</label>
            </div>

            <!-- Minor's Middle Name -->
            <div class="col-md-4 form-floating">
                <input type="text" class="form-control" id="minorMiddleName" name="minorMiddleName" placeholder="Minor's Middle Name">
                <label for="minorMiddleName">Minor's Middle Name</label>
            </div>

            <!-- Minor's Last Name -->
            <div class="col-md-4 form-floating">
                <input type="text" class="form-control" id="minorLastName" name="minorLastName" placeholder="Minor's Last Name" required>
                <label for="minorLastName">Minor's Last Name</label>
            </div>
        </div>

        <div class="row mb-3">
            <!-- Minor's Date of Birth -->
            <div class="col-md-6 form-floating">
                <input type="date" class="form-control" id="minorBirthDate" name="minorBirthDate" placeholder="Minor's Date of Birth" required>
                <label for="minorBirthDate">Minor's Date of Birth</label>
            </div>

            <!-- Place of Birth -->
            <div class="col-md-6 form-floating">
                <input type="text" class="form-control" id="minorBirthPlace" name="minorBirthPlace" placeholder="Place of Birth" required>
                <label for="minorBirthPlace">Place of Birth</label>
            </div>
        </div>

        <h4>Parent's Information</h4>
        <div class="row mb-3">
            <!-- Father's Full Name -->
            <div class="col-md-6 form-floating">
                <input type="text" class="form-control" id="fatherName" name="fatherName" placeholder="Father's Full Name" required>
                <label for="fatherName">Father's Full Name</label>
            </div>

            <!-- Mother's Full Name -->
            <div class="col-md-6 form-floating">
                <input type="text" class="form-control" id="motherName" name="motherName" placeholder="Mother's Full Name" required>
                <label for="motherName">Mother's Full Name</label>
            </div>
        </div>

        <h4>Guardian's Information</h4>
        <div class="row mb-3">
            <!-- Guardian's Full Name -->
            <div class="col-md-6 form-floating">
                <input type="text" class="form-control" id="guardianName" name="guardianName" placeholder="Guardian's Full Name" required>
                <label for="guardianName">Guardian's Full Name</label>
            </div>

            <!-- Guardian's Relationship to Minor -->
            <div class="col-md-6 form-floating">
                <input type="text" class="form-control" id="guardianRelationship" name="guardianRelationship" placeholder="Relationship to Minor" required>
                <label for="guardianRelationship">Relationship to Minor</label>
            </div>
        </div>

        <div class="row mb-3">
            <!-- Guardian's Address -->
            <div class="col-md-12 form-floating">
                <input type="text" class="form-control" id="guardianAddress" name="guardianAddress" placeholder="Guardian's Address" required>
                <label for="guardianAddress">Guardian's Address</label>
            </div>
        </div>

        <div class="row mb-3">
            <!-- Reason for Guardianship -->
            <div class="col-md-12 form-floating">
                <textarea class="form-control" id="reasonForGuardianship" name="reasonForGuardianship" placeholder="Reason for Guardianship" rows="4" required></textarea>
                <label for="reasonForGuardianship">Reason for Guardianship</label>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-guardianship">Submit</button>
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
