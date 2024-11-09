<?php
$loginSession = $_SESSION['session'] ?? null;

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
    <!-- Custom CSS -->
    <link rel="stylesheet" href="styles.css" />
  </head>
  <body>
    <header id="header">
        
    </header>
  <div class="container mt-5 certificate-of-indigency-form">
        <h2 class="text-center h2-indigency">Certificate of Indigency</h2>
        <form action="generate_certificate.php" method="POST" >
         <!-- Two columns -->
         <div class="row mb-3">
            <!-- First Name -->
            <div class="col-md-4">
                <label for="firstName" class="form-label">First Name</label>
                <input type="text" class="form-control" id="firstName" name="firstName" required>
            </div>

            <!-- Middle Name -->
            <div class="col-md-4">
                <label for="middleName" class="form-label">Middle Name</label>
                <input type="text" class="form-control" id="middleName" name="middleName">
            </div>

            <!-- Last Name (Surname) -->
            <div class="col-md-4">
                <label for="lastName" class="form-label">Last Name (Surname)</label>
                <input type="text" class="form-control" id="lastName" name="lastName" required>
            </div>
        </div>

        <div class="row mb-3">
            <!-- Birthday -->
            <div class="col-md-6">
                <label for="birthday" class="form-label">Birthday</label>
                <input type="date" class="form-control" id="birthday" name="birthday" required>
            </div>

            <!-- Contact Number -->
            <div class="col-md-6">
                <label for="contact" class="form-label">Contact Number</label>
                <input type="text" class="form-control" id="contact" name="contact" required maxlength="11" pattern="\d{11}" title="Please enter 11 digits only">
            </div>
        </div>

        <div class="row mb-3">
            <!-- Monthly Income -->
            <div class="col-md-6">
                <label for="income" class="form-label">Monthly Income</label>
                <input type="number" class="form-control" id="income" name="income" required min="0" step="0.01">
            </div>

            <!-- Number of Dependents -->
            <div class="col-md-6">
                <label for="dependents" class="form-label">Number of Dependents</label>
                <input type="number" class="form-control" id="dependents" name="dependents" required min="0">
            </div>
        </div>

        <!-- Reason for Indigency (spanning both columns) -->
        <div class="mb-3">
            <label for="reason" class="form-label">Reason for Indigency (optional)</label>
            <textarea class="form-control" id="reason" name="reason" rows="4"></textarea>
        </div>

        <!-- Submit Button -->
     
            <button type="submit" class="btn indigency-btn">Submit</button>
     
        </form>
    </div>
    <!-- Bootstrap JS and dependencies -->   

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="module" >
      import {header} from './header.js';
      header();
    </script>
  </body>
</html>
