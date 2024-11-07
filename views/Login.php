<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
<style>
  #header{
    backround-color: white;
  }
</style>
<body>
   <div id="header"></div>
  <div class="container">
        <div class="row">
          <div class="col-sm-7 col-md-7 col-lg-5 mx-auto mt-5">
            <div class="card card-signin my-5">
              <div class="card-body">
                <h3 class="card-title">Log in</h3>
                   <form action="../controller/loginController.php" method = "post">
                   <div class="form-label-group">
                      <label for="username">Username:</label>
                        <input type="text" id="username" class="form-control" name = "username" placeholder="Username" required autofocus>
                    </div>
                    <div class="form-label-group">
                      <label for="username">Password:</label>
                        <input type="password" id="Password" name = "password" class="form-control" placeholder="Password" required autofocus>
                    </div>
                    <a href="SignUp.php" style = "text-align:center">Dont have an account? sign up here</a>

                    <div class="login-btn-container">
                        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Login</button>
                    </div>
                   </form>
               </div>
            </div>
       </div>
     </div>
  </div>
  <script src="header.js"></script> 
  <script>
    const params = new URLSearchParams(window.location?.search);
    const error = params.get('error');
    if(error){
     document.querySelector('.card-body').innerHTML += `<div class="alert alert-danger mt-5" role="alert">
       <h4 class = "text-center"> You must be logged in first to use our services </h4>
    </div>`;
    }
    
  </script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>