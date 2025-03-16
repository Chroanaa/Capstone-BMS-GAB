<?php
session_start();
$loginSession = $_SESSION['session'] ?? null;


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>About Us</title>
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
    <div id="header"></div>
    <!-- About Us Content -->
<div class="container mt-5 about-us-container">
    <div class="row justify-content-center">
        <!-- Vision Section -->
        <div class="col-md-6 mb-4">
            <div class="about-us-card h-100 shadow">
                <div class="about-us-card-body">
                    <h2 class="about-us-card-title text-center text-primary mb-4">VISION</h2>
                    <p class="about-us-card-text lead text-center">
                    <i class="bi bi-caret-right-fill"></i> A PEACEFUL AND WELL DISCIPLINED BARANGAY WITH PRODUCTIVE AND SELF SUFFICIENT, 
                        BUSINESS ORIENTED AND OF GOOD MORAL VALUES GOD FEARING CONSTITUENT WITH A 
                        CLEAN AND HEALTHY ECO FRIENDLY ENVIRONMENT AND A SYSTEMATIC GOVERNANCE.
                    </p>
                </div>
            </div>
        </div>

        <!-- Mission Section -->
        <div class="col-md-6 mb-4">
            <div class="about-us-card h-100 shadow">
                <div class="about-us-card-body">
                    <h2 class="about-us-card-title text-center text-primary mb-4">MISSION</h2>
                    <p class="about-us-card-text lead text-center">
                    <i class="bi bi-caret-right-fill"></i> TO PROMOTE PEACE AND ORDER, ECONOMIC STABILITY, GOOD MORAL VALUES AND A 
                        HEALTHY ENVIRONMENT AND TO STRENGTHEN BARANGAY CAPABILITY IN GOOD GOVERNANCE 
                        THRU TRANSPARENCY, ACCOUNTABILITY AND DELIVERY OF BASIC SERVICES.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- Modal for Logging out please wag mo ibahin kupal --> 
    <?php include 'modals/modalLogout.html'?>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="module">
      import { header } from "./header.js";
      header(<?= $loginSession?>);
    </script>
  </body>
</html>
