<?php
session_start();
$loginSession = $_SESSION['session'] ?? null;


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Welcome to Barangay 201, ZONE 20 Website</title>
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
    <div class="container mt-5" style="margin-top: 10% !important">
      <div class="row">
        <div class="col index-left">
            <h1 class="index-welcome">Welcome!</h1>
            <h2 class="index-location">BARANGAY 201, ZONE 20 Pasay city, Philippines <a href="services.php" class="services-call-btn">Services <i class="bi bi-arrow-right-short"></i></a></h2>
            <h2 class="contact-us">Contact Us:</h2>
            <div class="contact-info">
              <p class="contact-infos"><i class="bi bi-facebook"></i> <a href="https://www.facebook.com/brgy201zone20" target="_blank">https://www.facebook.com/brgy201zone20</a></p>
              <p class="contact-infos"><i class="bi bi-telephone-plus"></i> 0995-984-0893</p>
              <p class="contact-infos"><i class="bi bi-envelope-fill"></i> barangay201pasaycity2018@gmail.com</p>
              <p class="contact-infos"><i class="bi bi-geo-alt-fill"></i> Gate 2 Kalayaan Village Barangay 201, Zone 20 1300 Pasay City, Philippines
              </p>
            </div>
        </div>
        <div class="col">
          <img src="../images/baranggay.svg" alt ="barangay logo" width="100%" height="100%"/>
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
