<?php
$resident_id = $_GET['resident_id'] ?? "";
$others_id = $_GET['others_id'] ?? "";
$information = "";
$email = "";
$created_at = "";

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
    $created_at = $information['time_Created'];
}

if($others_id){
    $information = getOthersInfo($others_id);
    $email = getOthersEmailInfo($information['requestor_id'])[0];
    $created_at = $information['time_Created'];
}

// Format the creation date
$creationDate = date('jS', strtotime($created_at));
$creationMonth = date('F', strtotime($created_at));
$creationYear = date('Y', strtotime($created_at));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Clearance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="stylesheet" href="BarangayClearance.css" />
    <style>
        @page {
            size: A4;
            margin: 0;
        }

        body {
            margin: 0;
            padding: 20px;
            
        }

        .a4-page {
            width: 210mm;
            height: 297mm;
            margin: 0 auto;
            padding: 20mm;
            box-sizing: border-box;
            font-family: 'Courier New', Courier, monospace;
            font-size: 0.8rem;
            font-weight: 600
        }

        @media print {
            .a4-page {
                width: 100%;
                height: 100%;
                padding: 10mm;
                box-sizing: border-box;
                page-break-before: always;
            }
        }
    </style>
    <link rel="stylesheet" href="../BarangayClearance.css" />
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
                <div class="header-line" style="font-size: 1.5rem; font-weight: bold; margin-top: 10px;">BARANGAY CLEARANCE</div>
            </div>
            <div class="baranggay-logo-container">
                <img src="../../images/baranggay.png" width="100px" height="100px" />
            </div>
        </div>
        <div class="mt-4 barangay-clearance-demography">
            <label>To Whom It May Concern:</label>
            <label style="text-indent: 3rem;">This is to certify that the person whose name, signature and thumb marks appear hereon has requested for a BARANGAY CLEARANCE from this office and the result(s) is/are listed below:</label>
            <label>NAME: <span class="fixed-underline"><?php echo $information['first_name'] . " " . $information['middle_name'] . " " . $information['last_name']; ?></span></label>
            <label>ADDRESS: <span class="fixed-underline"><?php echo $information['House/floor/bldgno.'] . " " . $information['Street']; ?></span></label>
            <div class="barangay-clearance-res">
                <div class="perma-res">
                    <label>Permanent Res. <input type="checkbox" /></label>
                </div>
                <div class="inside-res">
                    <label>Temporary Res.</label>
                    <div class="temporary-container">
                    <div>
                        <label><input type="checkbox" />Renter</label>
                    </div>
                    <div >
                        <label><input type="checkbox" />Transients </label>
                    </div>
                    </div>
                </div>
            </div>
            <label>DATE OF BIRTH: <span class="fixed-underline"><?php echo $information['date_of_birth']; ?></span></label>
            <label>PLACE OF BIRTH: <span class="fixed-underline"><?php echo $information['place_of_birth']; ?></span></label>
            <label>CITIZENSHIP: <span class="fixed-underline">FILIPINO</span></label>
            <label>REMARKS: <span class="fixed-underline">NO RECORD ON FILE</span></label>
            <label>PURPOSE: <span class="fixed-underline">LOCAL EMPLOYMENT REQUIREMENT</span></label>
            <label>VALID FOR: <span class="fixed-underline">THREE MONTHS (3) FROM DATE OF ISSUE</span></label>
        </div>
        <div class="mt-4 d-flex justify-content-between">
            <div class="text-center">
                <img src="data:image/gif;base64, <?php echo $information['picture']; ?>" class="img-fluid" style="border: 1px solid black; display: inline-block; width: 100px; height: 100px;" alt="">
                <label>Picture</label>
            </div>
            <div class="text-center">
                <span style="border: 1px solid black; display: inline-block; width: 100px; height: 100px;"></span>
                <label>Left Thumbmark</label><br>
            </div>
            <div class="text-center">
                <span style="border: 1px solid black; display: inline-block; width: 100px; height: 100px;"></span>
                <label>Right Thumbmark</label><br>
            </div>
            <div class="barangay-clearance-signature">
            <div class="text-center">
                <span style="border: 1px solid black; display: inline-block; width: 200px;"></span>
                <label>Signature over Printed Name</label><br>
            </div>
            <div class="text-center">

                <label>CTC No.</label>
                <span style="border: 1px solid black; display: inline-block; width:100px;"></span>
            </div>
            <div class="text-center">
                <label>Issued At</label>
                <span style="border: 1px solid black; display: inline-block; width:100px;"></span>
            </div>
            <div class="text-center">
                <label>Issued On</label>
                <span style="border: 1px solid black; display: inline-block; width:100px;"></span>
            </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <p>Given this <span class="fixed-underline-date"><?php echo $creationDate; ?></span> day of <span class="fixed-underline-date"><?php echo $creationMonth; ?></span> <span class="fixed-underline-date"><?php echo $creationYear; ?></span> at the office of the Barangay Chairman, Kalayaan Village, Balagbag, Pasay City.</p>
        </div>
        <div class="footer">
            <img src="../../images/chairman.jpg" alt="Barangay Chairman" width="150px" height="150px">
            <div class="inside-div-footer">
                <h5 class="chairman-name">HON. JAIME B. BONTILAO</h5>
                <p class="chairman-title">Barangay Chairman</p>
                <p class="chairman-qoute">"Pagbabago . . . tungo"</p>
            </div>
        </div>
       
        <div class="officials">
            
        <p class="officals-h5">Barangay Officials:</p>
            <div class="official">
                <label class="official-name" class="official-name">RODOLFO ALEXI L. LOBO</label>
                <p class="official-title">Chairman Committee on Peace & Order and Public Safety</p>
            </div>
            <div class="official">
                <label class="official-name">EUTIQUIA L. CORRAL</label>
                <p class="official-title">Chairman Committee on Social Service & Health</p>
            </div>
            <div class="official">
                <label class="official-name" style="font-weight:bolder;">ANTONIA P. CERDIN</label>
                <p class="official-title">Chairman Committee on Clean & Green Sanitation</p>
            </div>
            <div class="official">
                <label class="official-name">LORETO C. CASANO</label>
                <p class="official-title">Chairman Committee on Education & Sports</p>
            </div>
            <div class="official">
                <label class="official-name">LEOPOLDO A. SALECIDO</label>
                <p class="official-title">Chairman Committee on Infrastructure & Urban</p>
            </div>
            <div class="official">
                <label class="official-name">ALFREDO G. ABARICO JR.</label>
                <p class="official-title">Chairman Committee on Appropriation</p>
            </div>
            <div class="official">
                <label class="official-name">RODOLFO V. BAGAN</label>
                <p class="official-title">Chairman Committee on Trade & Industry</p>
            </div>
            <div class="official">
                <label class="official-name">VERA MARIE L. SORA</label>
                <p class="official-title">Barangay Secretary</p>
            </div>
            <div class="official">
                <label class="official-name">JOANNA M. CUI</label>
                <p class="official-title">Barangay Treasurer</p>
            </div>
        </div>
        <div class="divider"></div>
        <div class="note">
            <p><span style="color:red;">NOTE:</span> NOT VALID IF THERE ARE ERASURES, WITHOUT PHOTO, THUMBMARK AND DRY SEAL</p>
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