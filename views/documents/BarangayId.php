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
    <title>Barangay ID</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="../BarangayId.css" rel="stylesheet"/>
</head>
<body>
    <button class="btn btn-primary" onclick="notifyResident('<?php echo $email ?>')">
        Notify the Resident
    </button>
    <div class="id-card">
        <div class="id-card-inner-container">
        <div class="barangay-id-header">
            <img src="../images/baranggay_logo.png" alt="">
            <div class="barangay-id-center">
                <p>Office of the Sangguniang Barangay</p>
                <p>Brgy. 201 Zone 20</p>
                <p>Pasay City, Metro Manila</p>
                <p>Tel. # 776-0822</p>
            </div>
            <img src="../images/baranggay_logo.png" alt="">
        </div>
        <div class="photo">
            <img src="data:image/jpeg;base64, <?php echo $information['picture'] ?>" alt="Photo" style="width: 100%; height: 100%; border: 3px solid blue; border-radius: 15px;">
        </div>
        <div class="info">
            <span class="underline"><?php echo $information['first_name'] . " " . $information['middle_name'] . " " . $information['last_name']; ?></span>
            <div class="id-card-inside-info">
                <span class="underline"><?php echo $information['House/floor/bldgno.'] . " " . $information['Street']; ?></span>
                <span class="underline mt-4"></span>
                <p>ADDRESS</p>
            </div>
        </div>
        <div class="footer">
            <p>ID No. <span class="id-number"><?php echo $information['id']; ?></span></p>
        </div>
        </div>
    </div>
    <div class="id-card-back">
        <div class="info">
            <p class="bold">Date of Birth: <span class="underline"><?php echo $information['date_of_birth']; ?></span></p>
            <p class="bold">TIN: <span class="underline"></span></p>
            <p class="bold">SSS/GSIS NO: <span class="underline"></span></p>
            <p class="bold">TEL No: <span class="underline"></span></p>
            <p class="bold">Precinct No.: <span class="underline"></span></p>
            <p class="text-center">IN CASE OF EMERGENCY</p>
            <p>Please Notify:</p>
            <span class="underline-notify"></span>
            <span class="underline-valid"></span>
            <p class="text-center bold">Valid Until</p>
            <p class="this-certify">This is to certify that the person whose name, photo and signature appear herein is a bonafide resident of Barangay 201 Zone 20, Pasay City.</p>
        </div>
        <div class="footer">
            <img src="../../images/chairman.jpg" alt="Barangay Chairman" style="width: 100px; height:100px;">
            <div class="footer-inner-div">
            <div class="underline"></div>
                <p class="chairman-name">HON. JAIME BONTILAO</p>
                <p class="chairman-title">Barangay Chairman</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        const notifyResident = (email) => {
            window.location.href = `../../controller/sendEmail.php?email=${email}`;
        }
    </script>
</body>
</html>