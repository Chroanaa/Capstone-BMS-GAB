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
    <div class="header">
      <h1 style="font-family: Impact, Charcoal, sans-serif">WELCOME</h1>
      <h2 style="font-family: Impact, Charcoal, sans-serif">
        BARANGAY 201, ZONE 20
      </h2>
      <h2
        style="
          font-size: 25px;
          margin-top: 10px;
          font-family: Impact, Charcoal, sans-serif;
        "
      >
        Pasay city, Philippines
      </h2>
    </div>
    <div class="content">
      <h3 style="font-family: Impact, Charcoal, sans-serif; margin-top: -10%">
        CONTACT US:
      </h3>
      <div class="contact-info">
        FACEBOOK :<br />
        CONTACT NUMBER :<br />
        EMAIL ACCOUNT :<br />
        ADDRESS :
      </div>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="module">
      import { header } from "./header.js";
      header(<?= json_encode($loginSession)?>);
    </script>
  </body>
</html>
