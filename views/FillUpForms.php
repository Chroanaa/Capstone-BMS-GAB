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
        data-bs-toggle="collapse"
        data-bs-target="#navbarNav"
        aria-controls="navbarNav"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="index.html">Home <i class="bi bi-house-fill"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="services.html">Service <i class="bi bi-person-fill"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Household <i class="bi bi-house-door-fill"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Officials <i class="bi bi-person-badge"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About us <i class="bi bi-person-lines-fill"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Sign up <i class="bi bi-person-plus-fill"></i></a>
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
                <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#home">Resident Details</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#menu1">Certificates/Permits/ID</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#menu2">Signature</a>
                  </li>
                </ul>
                <form action="../controller/addUserRequest.php" method="post">
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
                            <label for="From">From:</label>
                            <input type="text" id="from" name="From" class="form-control">
                          </div>
                        </div>
                        <div class="col">
                          <div class="form-label-group">
                            <label for="to">To:</label>
                            <input type="text" id="to" name="to" class="form-control">
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
                            <input type="text" id="Age" name="Age" class="form-control">
                          </div>
                        </div>
                      </div>
                      <div class="form-label-group">
                        <label for="placeofbirth">Place of birth:</label>
                        <input type="text" id="placeofbirth" name="placeofbirth" class="form-control">
                      </div>
                      <div class="form-label-group">
                        <label for="Contact number">Contact number:</label>
                        <input type="text" id="Contactnumber" name="Contactnumber" class="form-control">
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
                        <label for="Purpose">Purpose:</label>
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
                    </div>
                    <div id="menu1" class="container tab-pane fade"><br>
                      <div class="form-label-group">
                        <input type="checkbox" name="documents[]" id="Barangay_clearance" value="Barangay_clearance">
                        <label for="Barangay_clearance">Barangay clearance</label>
                      </div>
                      <div class="form-label-group">
                        <input type="checkbox" name="documents[]" id="Certificate_of_indigency" value="Certificate_of_indigency">
                        <label for="Certificate_of_indigency">Certificate of indigency</label>
                      </div>
                      <div class="form-label-group">
                        <input type="checkbox" name="documents[]" id="Barangay_id" value="Barangay_id">
                        <label for="Barangay_id">Barangay Id</label>
                      </div>
                      <div class="form-label-group">
                        <input type="checkbox" name="documents[]" id="Certifiacte_of_ownership" value="Certifiacte_of_ownership">
                        <label for="Certifiacte_of_ownership">Certificate of ownership</label>
                      </div>
                      <div class="form-label-group">
                        <input type="checkbox" name="documents[]" id="Certifiacte_of_livebirth" value="Certifiacte_of_livebirth">
                        <label for="Certifiacte_of_livebirth">Certificate of Live birth</label>
                      </div>
                      <div class="form-label-group">
                        <input type="checkbox" name="documents[]" id="Certifiacte_of_Guardianship" value="Certifiacte_of_Guardianship">
                        <label for="Certifiacte_of_Guardianship">Certificate of Guardianship</label>
                      </div>
                      <div class="form-label-group">
                        <input type="checkbox" name="documents[]" id="Health_certificate" value="Health_certificate">
                        <label for="Health_certificate">Health Certificate</label>
                      </div>
                      <div class="form-label-group">
                        <input type="checkbox" name="documents[]" id="FirstTime_Job_Seeker" value="FirstTime_Job_Seeker">
                        <label for="FirstTime_Job_Seeker">First-Time Job Seeker</label>
                      </div>
                    </div>
                    <div id="menu2" class="container tab-pane fade"><br>
                      <h3>Certified true and Correct</h3>
                      <div class="container mt-5">
                        <div class="mb-4">
                          <canvas></canvas>
                          <div class="signature-box"></div>
                          <button type="button" class="clear">Clear</button>
                          <div class="text-center">Signature </div>
                          <div class="text-muted text-center">Applicant</div>
                        </div>
                        <div class="mb-3">
                          <span>Date:</span>
                          <h4 class="dateToday"></h4>
                          <button type="submit" name="submit" id="submitBtn" class="btn btn-primary">Submit</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
    <script>
      const dateOfBirth = document.getElementById("date"); 
      const dateToday = document.querySelector(".dateToday");
      const clear = document.querySelector(".clear");
      const Age = document.getElementById("Age");
      const form = document.querySelector("form");
      dateToday.innerHTML = new Date().toLocaleDateString();
      const submit = document.getElementById("submitBtn");
    
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
        document.getElementById("Age").value = age;
      });

      const canvas = document.querySelector("canvas");
      const ctx = canvas.getContext("2d");
      const signaturePad = new SignaturePad(canvas, {
        backgroundColor: "rgb(255, 255, 255)",
        penColor: "rgb(0, 0, 0)"
      });
      const signatureBox = document.querySelector(".signature-box");
      signaturePad.onEnd = function () {
        signatureBox.innerHTML = "";
        signatureBox.appendChild(signaturePad.toDataURL());
      };
      clear.addEventListener("click", function (e) {
        e.preventDefault();
        signaturePad.clear();
        signatureBox.innerHTML = "";
      });
    </script>
</body>
</html>