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
<body>
    <div id="header"></div>
    <div class="container mt-5">
        <h1 class="text-center mb-4">SK Officials</h1>
        <div class="card shadow">
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item"><strong>SK Chairman:</strong> Rubenich Reyes</li>
                    <li class="list-group-item"><strong>SK Councilor:</strong> April Mae Amac</li>
                    <li class="list-group-item"><strong>SK Councilor:</strong> Divine Love Agraviador</li>
                    <li class="list-group-item"><strong>SK Councilor:</strong> John Michael Miclat</li>
                    <li class="list-group-item"><strong>SK Councilor:</strong> Christian Felix</li>
                    <li class="list-group-item"><strong>SK Councilor:</strong> Mar Louise Doring</li>
                    <li class="list-group-item"><strong>SK Councilor:</strong> Keithlyn Castañeda</li>
                    <li class="list-group-item"><strong>SK Councilor:</strong> Mary Rose Gallamos</li>
                </ul>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="module">
      import { header } from "./header.js";
      header(<?= $loginSession?>);
    </script>
</body>
</html>