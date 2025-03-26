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

$birthDate = new DateTime($information['date_of_birth']);
$today = new DateTime('today');
$age = $birthDate->diff($today)->y;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>First Time Job Seeker Certificate</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../FirstTimeJobSeeker.css" />
    <style>
    
    </style>
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
        <div class="title">
            CERTIFICATION
        </div>
        <p class="republic-act">Republic Act 11261 - First Time Jobseekers Assistance Act</p>
        <div class="content">
            <label>This is to certify that <strong><?php echo $information['first_name'] . " " . $information['middle_name'] . " " . $information['last_name']; ?></strong> a resident at <strong><?php echo $information['House/floor/bldgno.'] . " " . $information['Street']; ?></strong>, is a qualified availee of RA 11261 or the First Time Jobseekers Act of 2019.</label>
            <label>I further certify that the holder/bearer was informed of his/her rights, including the duties and responsibilities accorded by RA 11261 through the Oath of undertaking he/she has signed and executed in the presence of our Barangay Officials.</label>
            <label style="font-weight:bold;">Signed this <strong><?php echo date('jS'); ?></strong> day of <strong><?php echo date('F Y'); ?></strong> at Barangay Hall, Barangay Sinbanali, Bacoor City.</label>
            <label>This certification is valid only for one (1) year from the date of issued.</label>
        </div>
        <div class="footer" style="margin-right: 10%;">
            <div class="signature">
                <p style="color: rgb(20, 20, 78); font-weight:700; font-size: 0.9rem;">HON. JAIME B. BONTILAO</p>
                <p style="font-weight: bold;">Punong Barangay</p>
                <p><?php echo date('m/d/Y'); ?></p>
                <p>Date</p>
                <p style="margin-top: 20px;">Witnessed by:</p>
            </div>
            <div class="signature">
                <p>BRGY SECRETARY/ VERA MARIEL C. SOLA</p>
                <p style="font-size: 0.9rem;">Barangay Official/Designation Position</p>
                <p><?php echo date('m/d/Y'); ?></p>
                <p>Date</p>
            </div>
        </div>
    </div>

    <div class="a4-page bg-light oath-page mt-5">
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
        <div class="title">
            OATH OF UNDERTAKING
        </div>
        <p class="republic-act">Republic Act 11261 - First Time Jobseekers Assistance Act</p>
            <div class="oath-content">
                <p>I, <strong><?php echo $information['first_name'] . " " . $information['middle_name'] . " " . $information['last_name']; ?></strong>, <strong><?php echo $age; ?></strong> years of age, resident at <strong><?php echo $information['House/floor/bldgno.'] . " " . $information['Street']; ?></strong>, availing the benefits of Republic Act 11261, otherwise known as the First Time Jobseekers Act of 2019, do hereby declare, agree and undertake to abide and be bound by the following:</p>
                <ol>
                    <li>That this is the first time that I will actively look for a job, and therefore requesting that a Barangay Certification be issued in my favor to avail the benefits of the law;</li>
                    <li>That I am aware that the benefit and privilege/s under the said law shall be valid only for one (1) year from the date that the Barangay Certification is issued;</li>
                    <li>That I can avail the benefits of the law only once;</li>
                    <li>That I understand that my personal information shall be included in the Roster/List of first Time Jobseekers and will not be used for any unlawful purpose;</li>
                    <li>That I will inform and/or report to the Barangay personally, through text or other means, or through my family/relatives once I get employed, and</li>
                    <li>That I'm not a beneficiary of the Job Start Program under R.A. No. 10869 and other laws that give similar exemptions for the documents or transactions exempted under R.A. No. 11261;</li>
                    <li>That if issued the requested Certification, I will not use the same in any fraud, neither falsifies nor help and/or assist in the fabrication of the said certification;</li>
                    <li>That this undertaking is made solely for the purpose of obtaining a Barangay Certification consistent with the objective of R.A. No. 11261 and not for any other purpose;</li>
                    <li>That I consent to the use of my personal information pursuant to the Data Privacy Act and other applicable laws, rules, and regulations.</li>
                </ol>
                <p>Signed this <strong><?php echo date('jS'); ?></strong> day of March 2025 at Barangay Hall, Barangay 201, Zone 20, Pasay City.</p>
            </div>
        <div class="oath-footer">
            <div class="signature">
            <p style="margin-bottom: 50px;">Signed by:</p>
                <p><strong><?php echo $information['first_name'] . " " . $information['middle_name'] . " " . $information['last_name']; ?></strong></p>
                <p>First Time Jobseeker</p>
            </div>
        
            <div class="signature">
            <p style="margin-bottom: 50px;">Witnessed by:</p>
                <p><strong>Vera Mariel C. Sola</strong></p>
                <p>Brgy Secretary</p>
                <p>Barangay Official and Position</p>
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