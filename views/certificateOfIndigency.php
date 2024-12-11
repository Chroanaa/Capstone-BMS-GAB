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
    <title>Document</title>
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
    <!-- Custom CSS (optional for more animation or effects) -->
    <link rel="stylesheet" href="styles.css" />
  </head>
  <body>
    <header id="header">
    </header>
    <div class="container mt-5 certificate-of-indigency-form">
        <h2 class="text-center h2-indigency">Certificate of Indigency</h2>
        <form action="generate_certificate.php" method="POST">
        
        <div class="row">
            <!-- First Name -->
            <div class="col-md-4 form-floating mb-3">
                <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name" required>
                <label for="firstName">First Name</label>
            </div>

            <!-- Middle Name -->
            <div class="col-md-4 form-floating mb-3">
                <input type="text" class="form-control" id="middleName" name="middleName" placeholder="Middle Name">
                <label for="middleName">Middle Name</label>
            </div>

            <!-- Last Name (Surname) -->
            <div class="col-md-4 form-floating mb-3">
                <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name" required>
                <label for="lastName">Last Name (Surname)</label>
            </div>
        </div>

        <div class="row">
            <!-- Birthday -->
            <div class="col-md-6 form-floating mb-3">
                <input type="date" class="form-control" id="birthday" name="birthday" placeholder="Birthday" required>
                <label for="birthday">Birthday</label>
            </div>

            <!-- Contact Number -->
            <div class="col-md-6 form-floating mb-3">
                <input type="text" class="form-control" id="contact" name="contact" placeholder="Contact Number" required maxlength="11" pattern="\d{11}" title="Please enter 11 digits only">
                <label for="contact">Contact Number</label>
            </div>
        </div>

        <div class="row">
            <!-- Monthly Income -->
            <div class="col-md-6 form-floating mb-3">
                <input type="number" class="form-control" id="income" name="income" placeholder="Monthly Income" required min="0" step="0.01">
                <label for="income">Monthly Income</label>
            </div>

            <!-- Number of Dependents -->
            <div class="col-md-6 form-floating mb-3">
                <input type="number" class="form-control" id="dependents" name="dependents" placeholder="Number of Dependents" required min="0">
                <label for="dependents">Number of Dependents</label>
            </div>
        </div>

        <!-- Reason for Indigency (spanning both columns) -->
        <div class="row">
            <div class="col-12 form-floating mb-3">
                <textarea class="form-control" id="reason" name="reason" placeholder="Reason for Indigency" rows="4"></textarea>
                <label for="reason">Reason for Indigency (optional)</label>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="d-grid gap-2">
            <button type="submit" class="btn indigency-btn btn-primary">Submit</button>
        </div>
     
        </form>
    </div>
    <?php include 'modals/modalLogout.html'?>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Bootstrap JS and dependencies -->   
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="module" >
      import {header} from './header.js';
      header(<?=$loginSession?>);
    </script>
  </body>
</html>
