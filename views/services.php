<?php
session_start();
$loginSession = $_SESSION['session'] ?? null;

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Services</title>
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
    <div class="header">
      <div class="" style="margin-top: 5rem">
        <h1
          class="text-center mt-3 text-white title"
          style="margin-bottom: 3rem"
        >
          OUR SERVICES
        </h1>
        <ul class="nav flex-column text-center mt-auto mb-5">
           <?php
           $arr = ['Certificate of Indigency', 'Barangay Clearance', 'Business Permit', 
           'First-Time Job Seeker', 'Barangay ID', 'Certificate of Late Live Birth', 'Certificate of Guardianship','Health Certificate'];
            foreach($arr as $item){
              echo "<li class='service-item'>
              <a class='bg-light p-4 rounded-pill text-black text-decoration-none' href='forUserOrOthers.php'>$item</a>
            </li>";
            }
           ?>
        </ul>
      </div>
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
      header(<?= $loginSession?>);
          
      
    </script>
  </body>
</html>
