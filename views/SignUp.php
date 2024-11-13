<?php
session_start();
$loginSession = $_SESSION['session'] ?? null;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
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
    <header id = "header"></header>

    <main>
    <div class="container">
        <div class="row">
          <div class="col-sm-7 col-md-7 col-lg-5 mx-auto mt-5">
            <div class="card card-signin my-5">
              <div class="card-body">
                <h5 class="card-title text-center">Sign Up</h5>
                <form action="../controller/signUpController.php" method="post">
                  <div class="tab-content">
                    <div id="home" class="container tab-pane active"><br>
                      <div class="form-label-group">
                        <label for="inputName">Full name of APPLICANT:</label>
                        <input
                          type="text"
                          id="inputName"
                          name="name"
                          class="form-control"
                          placeholder="Name"
                          required
                          autofocus
                        />
                      </div>
                      <h4>RESIDENCE:</h4>
                      <div class="row">
                        <div class="col">
                          <div class="form-label-group">
                            <label for="inputBldg" style="font-size: 0.7rem;">HOUSE/BLDG/Floor no.:</label>
                            <input type="text" id="inputBldg" name="bldg" class="form-control" required>
                          </div>
                        </div>
                        <div class="col">
                          <div class="form-label-group">
                            <label for="street">Street:</label>
                            <input type="text" id="street" name="street" class="form-control" required>
                          </div>
                        </div>
                      </div>
                      <h4>RESIDENT OF THE BARANGAY</h4>
                      <div class="row">
                        <div class="col">
                          <div class="form-label-group">
                            <label for="From">From:</label>
                            <input type="text" id="from" name="From" class="form-control" required>
                          </div>
                        </div>
                        <div class="col">
                          <div class="form-label-group">
                            <label for="to">To:</label>
                            <input type="text" id="to" name="to" class="form-control" required>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="form-label-group">
                            <label for="date">Date of birth:</label>
                            <input type="date" name="date" id="date" class="form-control" required>
                          </div>
                        </div>
                        <div class="col">
                          <div class="form-label-group">
                            <label for="Age">Age:</label>
                            <input type="text" id="Age" name="Age" class="form-control" required>
                          </div>
                        </div>
                      </div>
                      <div class="form-label-group">
                        <label for="placeofbirth">Place of birth:</label>
                        <input type="text" id="placeofbirth" name="placeofbirth" class="form-control" required>
                      </div>
                      <div class="form-label-group">
                        <label for="Contact number">Contact number:</label>
                        <input type="text" id="Contactnumber" name="Contactnumber" class="form-control" required>
                      </div>
                      <div class="form-label-group">
                        <span><b>Sex:</b></span>
                        <input type="radio" id="Male" name="sex" value="Male">
                        <label for="Male">Male</label>
                        <input type="radio" id="Female" name="sex" value="Female">
                        <label for="Female">Female</label>
                      </div>
                      <div class="form-label-group">
                        <span><b>Civil Status:</b></span>
                        <input type="radio" id="Single" name="Civilstatus" value="single">
                        <label for="Single">Single</label>
                        <input type="radio" id="Separated" name="Civilstatus" value="separated">
                        <label for="Separated">Separated</label>
                        <input type="radio" id="Married" name="Civilstatus" value="Married">
                        <label for="Married">Married</label>
                        <input type="radio" id="Widow" name="Civilstatus" value="Widow">
                        <label for="Widow">Widow</label>
                      </div>
                      <div class="form-label-group">
                      <label for="username">Username:</label>
                        <input type="text" id="username" name = "username" class="form-control" placeholder="Username" required autofocus>
                    </div>
                    <div class="form-label-group">
                      <label for="username">Password:</label>
                        <input type="password" name = "password" id="Password" class="form-control" placeholder="Password" required autofocus>
                    </div>
                    <div class="login-btn-container">
                        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" id ="submitBtn">Register</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
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
    </main>
    <script src = "header.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
    <script type = "module">
      import {header} from './header.js';
      header(<?= $loginSession?>);
     const dateOfBirth = document.getElementById("date"); 
      const clear = document.querySelector(".clear");
      const Age = document.getElementById("Age");
      const form = document.querySelector("form");
      const submit = document.getElementById("submitBtn");
      const sex = document.querySelector("input[name=sex]:checked");
      const civilStatus = document.querySelector("input[name=Civilstatus]:checked");
    
      dateOfBirth.addEventListener("input", function() { 
        const today = new Date();
        const birthDate = new Date(dateOfBirth.value);
        if(birthDate > today) {
          alert("Date of birth cannot be in the future");
          dateOfBirth.value = "";
          Age.value = "";
          return;
        }
        
        let age = today.getFullYear() - birthDate.getFullYear();
        const monthDiff = today.getMonth() - birthDate.getMonth();
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
          age--;
        }
        if(age > 100) {
          alert("Invalid date of birth");
          dateOfBirth.value = "";
          Age.value = "";
          return;
        }
        document.getElementById("Age").value = age;
      });
     
   
    </script>
</body>
</html>