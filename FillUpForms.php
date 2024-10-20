<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fill up</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
      integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="styles.css" />
</head>
<body>
    <div class="container w-50 bg-light">
       <div class="form-container">
          <form action="FillUpForms.php" method="post">
             <h1>Fill up</h1>
             <label for="Firstname">Firstname:</label>
             <input type="text" name = "firstname" placeholder="Firstname">
             <label for="Lastname">Lastname:</label>
             <input type="text" name = "lastname" placeholder="Lastname">
       </div>
      </form>
    </div>
</body>
</html>