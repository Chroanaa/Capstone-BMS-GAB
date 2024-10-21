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
   <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <button
        class="navbar-toggler bg-light"
        type="button"
        data-toggle="collapse"
        data-target="#navbarNav"
        aria-controls="navbarNav"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="index.html"
              >Home <i class="bi bi-house-fill"></i
            ></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="services.html"
              >Service <i class="bi bi-person-fill"></i
            ></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"
              >Household <i class="bi bi-house-door-fill"></i
            ></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"
              >Officials <i class="bi bi-person-badge"></i
            ></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"
              >About us <i class="bi bi-person-lines-fill"></i
            ></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"
              >Sign up <i class="bi bi-person-plus-fill"></i
            ></a>
          </li>
        </ul>
      </div>
    </nav>
    <main>
      <div class="container">
  <div class="row">
          <div class="col-sm-7 col-md-7 col-lg-5 mx-auto mt-5">
            <div class="card card-signin my-5">
              <div class="card-body">
<h5 class="card-title text-center">Fill up</h5>
                <form class="form-signin" method="POST">
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
                    <input type="text" id="inputBldg" name="bldg" class="form-control">
                  </div>
                  </div>
                    <div class="col">
                    <div class="form-label-group">
                    <label for="street">Street:</label>
                    <input type="text" id="street" name="street" class="form-control">
                  </div>
                  </div>
                 </div>
                <h4>RESIDENT OF THE BARANGAY</h4>
                 <div class="row">
                  <div class="col">
                    <div class="form-label-group">
                    <label for="From" >From:</label>
                    <input type="text" id="from" name="From" class="form-control">
                  </div>
                  </div>
                    <div class="col">
                    <div class="form-label-group">
                    <label for="street">To:</label>
                    <input type="text" id="street" name="street" class="form-control">
                  </div>
                  </div>
                 </div>
               
                   <div class="row">
                  <div class="col">
                    <div class="form-label-group">
                      <label for="date">Date of birth:</label>
                    <input type="date" name="date" id="date" class="form-control">
                  </div>
                  </div>
                    <div class="col">
                    <div class="form-label-group">
                    <label for="Age">Age:</label>
                    <input type="text" id="Age" name="Age" class="form-control" disabled>
                  </div>
                  </div>
                 </div>
                 <div class="form-label-group">
                  <label for="placeofbirth">Place of birth:</label>
                   <input type="text" id="placeofbirth" name="placeofbirth" class="form-control" >
                 </div>
                  <div class="form-label-group">
                  <label for="Contact number">Contact number:</label>
                   <input type="text" id="Contact number" name="Contact number" class="form-control" >
                 </div>
                 <div class="form-label-group">
                  <span><b>Sex:</b></span>
                  <input type="radio" id="Male" name="sex" value="Male">
                   <label for="html">Male</label>
                  <input type="radio" id="Female" name="sex" value="Female">
                  <label for="html">Female</label>
                 </div>
                    <div class="form-label-group">
                  <span><b>Civil Status:</b></span>
                  <input type="radio" id="Single" name="Civil status" value="single">
                   <label for="html">Single</label>
                  <input type="radio" id="Separated" name="Civil status" value="seperated">
                  <label for="html">Seprated</label>
                   <input type="radio" id="Married" name="Civil status" value="Married">
                  <label for="html">Married</label>
                  <input type="radio" id="Widow" name="Civil status" value="Widow">
                  <label for="html">Widow</label>
                 </div>
                 <div class="form-label-group"> <label for="Purpose">Purpose:</label>
                 <select name="Purpose" id="Purpose">
                   <option value="employment">Employment</option>
                   <option value="Driver's License">Driver's License</option>
                   <option value="Tricycle Franchise">Tricycle Franchise</option>
                   <option value="DSWD">DSWD</option>
                   <option value="Housing loan">Housing loan</option>
                   <option value="Burial Assistance">Burial Assistance</option>
                   <option value="Finance Assistance">Finance Assistance</option>
                   <option value="Postal ID">Postal ID</option>
                   <option value="Multi-purpose Loan">Multi-purpose Loan</option>
                   <option value="Medical Assistance">Medical Assistance</option>
                 </select>
                </div>
                <div class="form-label-group">
                  <label for="Certificate/Id/permits">Certificate/Id/permits:</label>
                 <select name="Certificate/Id/permits:" id="Certificate/Id/permits:">
                   <option value="Certifiacte of Residency">Certifiacte of Residency</option>
                   <option value="Barangay Clearance">Barangay Clearance</option>
                   <option value="Certificate of Indigency">Certificate of Indigency</option>
                   <option value="Certificate of Ownership">Certificate of Ownership</option>
                   <option value="Certificate of Late Live Birth">Certificate of Late Live Birth</option>
                   <option value="Certificate of Guardianship">Certificate of Guardianship</option>
                   <option value="Health Certificate">Health Certificate</option>
                   <option value="Postal ID">First time job Seeker Certificate</option>
                 </select>
                </div>
                 </form>
       </div>
      </div>
      </div>
    </div>
  </div>
    </main>
</body>
<!-- Bootstrap JS and dependencies -->
 <script>
  const dateOfBirth = document.getElementById("date"); 
 
  dateOfBirth.addEventListener("input", function() { 
    const today = new Date();
    const birthDate = new Date(dateOfBirth.value);
    let age = today.getFullYear() - birthDate.getFullYear();
    const monthDiff = today.getMonth() - birthDate.getMonth();
    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
      age--;
    }
    document.getElementById("Age").value = age;
   })
 </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>