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
    <title>For you or For Others</title>
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
    <header id="header"></header>
    <div class="container card-container ">
      <div class="row">
        <div class="col-sm-7 col-md-7 col-lg-5 mx-auto mt-5">
          <div class="card card-signin my-5 shadow-yellow">
            <div class="card-body card-body-for-user-or-others ">
              <h3
                class="card-title text-center"
                
              >
                Is it for you or for others?
              </h3>
              <div class="form-label-group for-user-or-others-radio-div ">
                <input type="radio" name="choose" value="user" id="user" class="form-check-input"/>
                <label for="user"><h4>For Me</h4></label>
              </div>
              <div class="form-label-group for-user-or-others-radio-div">
                <input type="radio" name="choose" value="others" id="others" class="form-check-input"/>
                <label for="others"><h4>For Others</h4></label>
              </div>
              <button
                class="btn-primary btn cards-for-user-or-others-btn "
                type="submit"
                id="submit"
              >
                Next <i class="bi bi-arrow-right"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
   <?php include 'modals/modalLogout.html'?>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <link
    rel="stylesheet"
    type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.5/css/bootstrap-dialog.min.css"
  />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.5/js/bootstrap-dialog.min.js"></script>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script type="module">
    import { header } from "./header.js";
      header(<?= $loginSession?>);
    document.getElementById("submit").addEventListener("click", function () {
      let choose = document.querySelector('input[name="choose"]:checked');
      if (choose == null) {
        document.querySelector(".card-body").innerHTML +=
          "<div class='alert alert-danger mt-5' role='alert'>Please select an option</div>";
        return;
      }

      if (choose.value == "user") {
        window.location.href = "FillUpForUser.php";
      } else if (choose.value == "others") {
        window.location.href = "FillUpForOthers.php";
      }
    });
  </script>
</html>
