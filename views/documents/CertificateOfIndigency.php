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
    <link rel="stylesheet"href="../CertificateOfIndigency.css" />
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
                <img src="../../images/baranggay.png" width="100px" height="100px" />
            </div>
        </div>

        <div class="title">
            CERTIFICATION OF INDIGENCY
        </div>

        <div class="content">
            <label>
                This is to certify that 
                <strong style="text-decoration: underline;">
                    <?php echo $information['first_name'] . " " . $information['middle_name'] . " " . $information['last_name']; ?>
                </strong> 
                is a bonafide resident of this Barangay with residence and postal address at 
                <strong style="text-decoration: underline;">
                    <?php echo $information['House/floor/bldgno.'] . " " . $information['Street']; ?>
                </strong>, 
                Barangay 201 Zone 20, Pasay City.
            </label>

            <label>
                This further certifies that he/she belongs to the indigent family in this Barangay.
            </label>

            <label>
                This certification is being issued to 
                <strong style="text-decoration: underline;">
                    <?php echo $information['first_name'] . " " . $information['middle_name'] . " " . $information['last_name']; ?>
                </strong> 
                for <strong >__________</strong>.
            </label>

            <label>
                Issued this 
                <strong style="text-decoration: underline;"><?php echo date('jS'); ?></strong> 
                day of <strong><?php echo date('F'); ?></strong>, 
                <strong style="text-decoration: underline;"><?php echo date('Y'); ?></strong> 
                at Barangay Hall, Barangay 201 Zone 20, Pasay City.
            </label>
        </div>



     

        <div class="footer">
            <p style="color: blue;">HON. JAIME B. BONTILAO</p>
            <p>Barangay Chairman</p>
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