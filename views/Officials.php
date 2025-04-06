<?php
session_start();
$loginSession = $_SESSION['session'] ?? null;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Officials</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
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
<body class="body-padding">
    <?php include 'modals/modalLogout.html';?>
    <div id="header"></div>
    <div class="container mt-5 ">
        <h1 class="text-center mb-4 h5-yellow">SK Officials</h1>
        <div class="card officials-body shadow-yellow">
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item"><strong class="officials-title">SK Chairman:</strong> <span class="officials-name">Rubenich Reyes</span></li>
                    <li class="list-group-item"><strong class="officials-title">SK Councilor:</strong> <span class="officials-name"> April Mae Amac</span></li>
                    <li class="list-group-item"><strong class="officials-title">SK Councilor:</strong> <span class="officials-name"> Divine Love Agraviador</span></li>
                    <li class="list-group-item"><strong class="officials-title">SK Councilor:</strong> <span class="officials-name"> John Michael Miclat</span></li>
                    <li class="list-group-item"><strong class="officials-title">SK Councilor:</strong> <span class="officials-name"> Christian Felix</span></li>
                    <li class="list-group-item"><strong class="officials-title">SK Councilor:</strong> <span class="officials-name"> Mar Louise Doring</span></li>
                    <li class="list-group-item"><strong class="officials-title">SK Councilor:</strong> <span class="officials-name"> Keithlyn Castañeda</span></li>
                    <li class="list-group-item"><strong class="officials-title">SK Councilor:</strong> <span class="officials-name"> Mary Rose Gallamos</span></li>
                </ul>
            </div>
        </div>
    </div>
  <!-- Bootstrap JS and dependencies -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Bootstrap JS and dependencies -->   
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="module" >
      import {header} from './header.js';
      header(<?= $loginSession?>);
          
      
    </script>
</body>
</html>