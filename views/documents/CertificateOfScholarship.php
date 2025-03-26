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
    <title>Certificate of Scholarship</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        @page {
            size: A4;
            margin: 0;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Times New Roman', Times, serif;
        }

        .a4-page {
            width: 210mm;
            height: 297mm;
            margin: 0 auto;
            padding: 20mm;
            box-sizing: border-box;
            border: 1px solid #000;
        }

        .header-page {
            text-align: center;
            font-size: 0.8rem;
        }

        .header-page img {
            width: 100px;
        }

        .header-page .barangay-logo {
            width: 100px;
            height: 100px;
        }

        .title {
            text-align: center;
            font-size: 2.5rem;
            font-weight: bold;
            margin-top: 20px;
            font-family: 'Old English Text MT', serif;
        }

        .subtitle {
            text-align: center;
            font-size: 1.2rem;
            margin-top: 10px;
        }

        .content {
            margin-top: 30px;
            font-size: 1.2rem;
            text-align: center;
        }

        .content label {
            display: block;
            margin-bottom: 20px;
        }

        .footer {
            text-align: center;
            margin-top: 50px;
        }

        .footer p {
            margin: 0;
            font-size: 1.2rem;
        }

        .footer .signature {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
            padding: 0 50px;
        }

        .footer .signature div {
            text-align: center;
        }
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
            Certificate of Scholarship
        </div>

        <div class="subtitle">
            In Honor of Outstanding Academic Performance
        </div>

        <div class="content">
            <label>We Gladly Present</label>
            <label><strong><?php echo $information['first_name'] . " " . $information['middle_name'] . " " . $information['last_name']; ?></strong></label>
            <label>With This Scholarship Award For Excellence In:</label>
            <label>__________________________</label>
            <label>Awarded the <strong><?php echo date('jS'); ?></strong> Day of <strong><?php echo date('F'); ?></strong> In the Year <strong><?php echo date('Y'); ?></strong>.</label>
        </div>

        <div class="footer">
                    <p style="margin-top: 30%; color: green; font-size: 1.5rem; font-weight: bold; font-style: italic;">HON. JAIME B. BONTILAO</p>
                    <p style=" font-weight: bold; font-style: italic;">Barangay Chairman</p>
         </div>
    </div>      


</body>
   <script>
   function notifyResident(email){
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
</html>