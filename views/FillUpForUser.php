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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fill Up For User</title>
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
                <h5 class="card-title text-center">Fill up</h5>
                <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#documents">Certificates/permits/ID</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#Signature">Signature</a>
                  </li>
                </ul>
                <form action="../controller/addRequestForUser.php" method="post">
                  <div class="tab-content">
                    <div id="documents" class="container tab-pane active"><br>
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
                    <div id="Signature" class="container tab-pane fade"><br>
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
      <?php include 'modals/modalLogout.html'?>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
    <script type="module">
   import { header } from "./Header.js";
      header(<?= $loginSession?>);
      const dateToday = document.querySelector(".dateToday");
      dateToday.textContent = new Date().toLocaleDateString();
 
      const clear = document.querySelector(".clear");
      const submit = document.getElementById("submitBtn");
     

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