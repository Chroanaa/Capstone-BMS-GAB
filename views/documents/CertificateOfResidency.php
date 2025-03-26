<?php

$resident_id = $_GET['resident_id'] ?? "";
$others_id = $_GET['others_id'] ?? "";
$information = "";
$email = "";
function getResidentInfo($id){
    include '../../databaseconn/connection.php';
    $conn = $GLOBALS['conn'];
    $stmt = $conn->prepare("SELECT * FROM user_info WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch();
}
function getOthersInfo($id){
    include '../../databaseconn/connection.php';
    $conn = $GLOBALS['conn'];
    $stmt = $conn->prepare("SELECT * FROM requested_for_others_info WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch();
}
function getOthersEmailInfo($id){
    include '../../databaseconn/connection.php';
    $conn = $GLOBALS['conn'];
    $stmt = $conn->prepare("SELECT email FROM user_info WHERE creds_id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch();
}
if($resident_id){
    $information = getResidentInfo($resident_id);
    $email = $information['email'];
}
if($others_id){
   $information = getOthersInfo($others_id);
    $email = getOthersEmailInfo($information['requestor_id'])[0];

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Indigency</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../CertificateOfResidency.css" />
</head>
<body>
    <button class="btn btn-primary" id = "notify" onclick="notifyResident('<?php echo $email ?>')">
        Notify the Resident
    </button>
    <button class="btn btn-secondary" id = "print" onclick="printDocument()">
        Print
    </button>
    <div class="a4-page bg-light">
        <div class="header-page d-flex justify-content-between align-items-center">
            <div class="baranggay-logo-container">
                <img src="../../images/baranggay.png" width="100px" height="100px" />
            </div>
            <div class="text-center">
                <div class="header-line" style="font-size: 0.8rem;">REPUBLIC OF THE PHILIPPINES</div>
                <div class="header-line" style="font-size: 0.8rem; font-weight: 700;">OFFICE OF THE SANGGUNIANG BARANGAY</div>
                <div class="header-line" style="font-size: 0.8rem;">BARANGAY 201, ZONE 20</div>
                <div class="header-line" style="font-size: 0.8rem;">PASAY CITY, METRO MANILA</div>
                <div class="header-line" style="font-size: 0.8rem;">TEL NO. 02-8770622</div>
                <div class="header-line header-email" style="font-size: 0.8rem; font-weight: bold;">EMAIL: barangay201zone20pasaycity@gmail.com</div>
            </div>
            <div class="baranggay-logo-container">
                <img src="../images/baranggay_logo.png" width="100px" height="100px" />
            </div>
        </div>

        <div class="d-flex mt-4">
            <div class="left-section" style="flex: 1;  padding-right: 10px;">
                <div class="barangay-officials mt-5 ">
                    <p class="fw-bold fs-5" style="margin-bottom: 10px;">Barangay Officials</p>
                    <p style="color: red;">HON. JAIME B. BONTILAO</p>
                    <p style="margin-bottom: 20px;">Barangay Chairman</p>
                    <p style="color: blue;">HON. EUFEMIA L. CORRAL</p>
                    <p style="margin-bottom: 20px;">Chairman Committee on Social Service & Health</p>
                    <p style="color: blue;">HON. LEOPOLDO A. SALCEDO</p>
                    <p style="margin-bottom: 20px;">Chairman Committee on Trade and Industry</p>
                    <p style="color: blue;">HON. ANTONIA P. CRON</p>
                    <p style="margin-bottom: 20px;">Chairman Committee on Clean & Green Sanitation</p>
                    <p style="color: blue;">HON. ROMEO ALEX R. LOBO</p>
                    <p style="margin-bottom: 20px;">Chairman Committee on Peace & Order and Public Safety</p>
                    <p style="color: blue;">HON. LORETO E. CASIANO</p>
                    <p style="margin-bottom: 20px;">Chairman Committee on Education and Sports</p>
                    <p style="color: blue;">HON. RODOLFO V. ILAGAN</p>
                    <p style="margin-bottom: 20px;">Chairman Committee on Infrastructure & Urban</p>
                    <p style="color: blue;">HON. ALFREDO O. ABARICO JR.</p>
                    <p style="margin-bottom: 20px;">Chairman Committee on Appropriation</p>
                    <p style="color: blue;">VERA MARIE C. SOLA</p>
                    <p style="margin-bottom: 20px;">Barangay Secretary</p>
                    <p style="color: blue;">JOANNA V. CUI</p>
                    <p style="margin-bottom: 20px;">Barangay Treasurer</p>
                </div>
            </div>
            <div class="right-section" style="flex: 2; padding-left: 10px; font-style: italic; font-weight: bold;">
                <p style="text-align: end; font-weight: bold;">Date: <span style="text-decoration: underline;"><?php echo date('F d, Y'); ?></span></p>
                <div class="title">
                    CERTIFICATION
                </div>

                <div class="content">
                    <label>To whom it may concern,</label>
                    <label>This is to certify that Mr/Ms. <strong style="text-decoration: underline;"><?php echo $information['first_name'] . " " . $information['middle_name'] . " " . $information['last_name']; ?></strong>, Filipino, Single/Married, <strong style="text-decoration: underline;"><?php echo $information['Age']; ?></strong> years of age, is a bona fide resident of <strong style="text-decoration: underline;"><?php echo $information['House/floor/bldgno.'] . " " . $information['Street']; ?></strong>, Brgy. 201 Zone 20, Pasay City.</label>
                    <label>This certification is being issued upon the request of the subject person for ______________</strong>.</label>
                </div>


                <div class="footer">
                    <p style="margin-top: 30%; color: green; font-size: 1.5rem; font-weight: bold; font-style: italic;">HON. JAIME B. BONTILAO</p>
                    <p style=" font-weight: bold; font-style: italic;">Barangay Chairman</p>
                    <p class="note" style="margin-top: 50%; color: black;"><span style="color: red;">NOTE:</span> NOT VALID WITHOUT OFFICIAL BARANGAY SEAL</p>
                </div>
                
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        const notifyResident = (email) => {
            window.location.href = `../../controller/sendEmail.php?email=${email}`;
        }
       function printDocument(){
    document.getElementById('notify').style.display = 'none';
           document.getElementById('print').style.display = 'none';
            window.print();
            document.getElementById('notify').style.display = 'flex';
            document.getElementById('print').style.display = 'flex';
   }
    </script>
</body>
</html>