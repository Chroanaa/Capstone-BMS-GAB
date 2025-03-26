<?php
session_start();
$loginSession = $_SESSION['session'] ?? null;

if($loginSession){
    header('Location: services.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot password</title>
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
    <link rel="stylesheet" href="styles.css?=time()?>" />
</head>

<body>
   <div id="header"></div>
  <div class="container mt-5">
        <div class="row">
          <div class="col-sm-7 col-md-7 col-lg-5 mx-auto mt-5">
            <div class="card card-signin my-5">
              <div class="card-body">
                <h1 class="card-title text-center h5">Verification Code</h1>
                <form action="../controller/verifyCodeController.php" method="post">
                    <div class="form-floating mb-3">
                      <input
                        type="text"
                        id="email"
                        class="form-control"
                        name="code"
                        placeholder="Code"
                        required
                      />
                      <label for="username">Please provide the code:</label>
                    </div>
                   
                    <div class="login-btn-container">
                      <button class="btn btn-primary btn-block text-uppercase button-main login-btn btn-lg" type="submit">Submit <i class="bi bi-box-arrow-in-right"></i></button>
                    </div>
                  </form>

                   <div class="card-error">

                   </div>
               </div>
            </div>
       </div>
     </div>
  </div>
  <script type="module">
    import {header} from './header.js';
    header();
    const params = new URLSearchParams(window.location?.search);
    const error = params.get('code');
    if(error === 'invalid'){
      document.querySelector('.card-error').innerHTML += `<div class="alert alert-danger mt-5" role="alert">
       <h4 class = "text-center"> Incorrect code please try again </h4>
    </div>`
    setTimeout(() => {
      document.querySelector('.card-error').innerHTML = ""
    }, 3000);
    }
    if(error === "notLoggedIn"){
      document.querySelector('.card-error').innerHTML += `<div class="alert alert-danger mt-5" role="alert">
       <h4 class = "text-center"> Must be logged In</h4>
    </div>`
    setTimeout(() => {
      document.querySelector('.card-error').innerHTML = ""
    }, 3000);
    }
    
  </script>
  <script>
  document.querySelector('.toggle-password').addEventListener('click', function () {
    const passwordInput = document.getElementById('password');
    const icon = this;

    // Toggle the password field type
    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
      icon.classList.remove('bi-eye-slash');
      icon.classList.add('bi-eye');
    } else {
      passwordInput.type = 'password';
      icon.classList.remove('bi-eye');
      icon.classList.add('bi-eye-slash');
    }
  });
</script>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>