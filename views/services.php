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
      <div class="container-sm border border-5" style="margin-top: 5rem">
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
              <a class='bg-light p-4 rounded-pill text-black text-decoration-none' href=''>$item</a>
            </li>";
            }
           ?>
        </ul>
      </div>
    </div>




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
        <a href="../controller/logoutController.php" class = "btn btn-danger">Logout</a>
      </div>
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
       // dito mo lagay kim yung mga services 
      const serviceItem = document.querySelectorAll('.service-item');
       serviceItem.forEach((item) => {
         item.addEventListener('click', (e) => {
          e.preventDefault();
           if(e.target.innerText === 'Certificate of Indigency'){
             window.location.href = 'certificateOfIndigency.php';
           }else if (e.target.innerText === 'Barangay Clearance'){
             window.location.href = 'barangayClearance.php';
           }else if (e.target.innerText === 'Business Permit'){
             window.location.href = 'businessPermit.php';
           }else if (e.target.innerText === 'First-Time Job Seeker'){
             window.location.href = 'firstTimeJobSeeker.php';
           }else if (e.target.innerText === 'Barangay ID'){
             window.location.href = 'barangayId.php';
           }else if (e.target.innerText === 'Certificate of Late Live Birth'){
             window.location.href = 'certificateOfLateLiveBirth.php';
           }else if (e.target.innerText === 'Certificate of Guardianship'){
             window.location.href = 'certificateOfGuardianship.php';
           }else if (e.target.innerText === 'Health Certificate'){
             window.location.href = 'healthCertificate.php';
           }
           
         });
       });
    </script>
  </body>
</html>
