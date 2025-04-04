<?php
    session_start();
    if(!isset($_SESSION['admin'])){
        header('Location: AdminLogin.php?error=notLoggedIn');
    }
function getAllResidents(){
    include '../databaseconn/connection.php';
    try {
        $conn = $GLOBALS['User_conn'];
        $stmt = $conn->prepare("SELECT COUNT(*) FROM user_creds");
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    } catch (PDOException $e) {
        return "No residents found";
    }
}
function getAllCountOfDocumentRequest(){
    include '../databaseconn/connection.php';
    try {
        $conn = $GLOBALS['conn'];
        $stmt = $conn->prepare("SELECT COUNT(*) FROM document_requested WHERE status = 'Pending'");
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    } catch (PDOException $e) {
        return "No Documents requested today";
    }
}
function getAllOthersCountOfDocumentRequest(){
    include '../databaseconn/connection.php';
    try {
        $conn = $GLOBALS['conn'];
        $stmt = $conn->prepare("SELECT COUNT(*) FROM document_requested_for_others WHERE status = 'Pending'");
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    } catch (PDOException $e) {
        return "No Documents requested today";
    }
}
function getAllAges(){
    include '../databaseconn/connection.php';
    try {
        $conn = $GLOBALS['conn'];
        $stmt = $conn->prepare(" SELECT 
            CASE 
                WHEN Age BETWEEN 0 AND 10 THEN '0-10'
                WHEN Age BETWEEN 11 AND 20 THEN '11-20'
                WHEN Age BETWEEN 21 AND 30 THEN '21-30'
                WHEN Age BETWEEN 31 AND 40 THEN '31-40'
                WHEN Age BETWEEN 41 AND 50 THEN '41-50'
                WHEN Age BETWEEN 51 AND 60 THEN '51-60'
                WHEN Age BETWEEN 61 AND 70 THEN '61-70'
                WHEN Age BETWEEN 71 AND 80 THEN '71-80'
                ELSE '81+' 
            END as age_range, 
            COUNT(*) as count  
        FROM user_info
        GROUP BY age_range");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    } catch (PDOException $e) {
        return 0;
    }
}
$resident_count = getAllResidents()[0];
$doc_query = getAllCountOfDocumentRequest()[0] + getAllOthersCountOfDocumentRequest()[0];
$age_data = getAllAges();


function getAverageResidencyTime() {
    include '../databaseconn/connection.php';
    try {
        $conn = $GLOBALS['conn'];
        $stmt = $conn->prepare("
            SELECT AVG(DATEDIFF(IFNULL(`to`, CURDATE()), `from`)) AS avg_residency 
            FROM user_info
        ");
        $stmt->execute();
        $result = $stmt->fetch();
        return round($result['avg_residency'], 2); // Round to 2 decimal places
    } catch (PDOException $e) {
        return "No data";
    }
}

function getGenderStatistics() {
    include '../databaseconn/connection.php';
    try {
        $conn = $GLOBALS['conn'];
        $stmt = $conn->prepare("SELECT gender, COUNT(*) AS count FROM user_info GROUP BY gender");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    } catch (PDOException $e) {
        return [];
    }
}

$avg_residency_time = getAverageResidencyTime();
$gender_stats = getGenderStatistics();

function getCivilStatusStatistics() {
    include '../databaseconn/connection.php';
    try {
        $conn = $GLOBALS['conn'];
        $stmt = $conn->prepare("
            SELECT civil_status, COUNT(*) AS count 
            FROM user_info 
            GROUP BY civil_status
        ");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    } catch (PDOException $e) {
        return [];
    }
}


$civil_status_stats = getCivilStatusStatistics();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />

    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="styles.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body id="adminDashboard">
    <div id="adminHeader"></div>

     <div class="container mt-5 admin-container">
       
        
               <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card text-white pale-pink mb-3">
                    <div class="card-body dashboard-card">
                        <h5 class="card-title">Registered Residents</h5>
                        <p class="card-text display-4"><?php echo $resident_count ?> </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white mb-3 light-cyan">
                    <div class="card-body dashboard-card">
                        <h5 class="card-title">Pending Document Request</h5>
                        <p class="card-text display-4"><?php echo $doc_query ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Average Residency Time</h5>
                        <p class="card-text display-4"><?php echo $avg_residency_time; ?> Days</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Age distribution</h5>
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mx-auto">
            <div class="card text-white mb-3">
                <div class="card-body">
                        <h5 class="card-title">Gender Distribution</h5>
                        <canvas id="genderChart" style="max-width: 300px; max-height: 300px; margin: 0 auto;"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mx-auto">
            <div class="card text-white mb-3">
                <div class="card-body">
                    <h5 class="card-title">Civil Status Distribution</h5>
                    <canvas id="civilStatusChart" style="max-width: 300px; max-height: 300px; margin: 0 auto;"></canvas>
                </div>
            </div>
        </div>
        </div>
        
    </div>

    <div class="card-error"></div>

    <div class="modal fade" id="announcementModal" tabindex="-1" aria-labelledby="announcementModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="announcementModalLabel">New Announcement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="announcementForm" method="POST" action="../controller/postAnnouncementController.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="announcementTitle" class="form-label">Title</label>
                        <input type="text" class="form-control" id="announcementTitle" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="announcementAttachment" class="form-label">Attachment</label>
                        <input type="file" class="form-control" id="announcementAttachment" name="attachment">
                    </div>
                    <div class="mb-3">
                        <label for="announcementContent" class="form-label">Content</label>
                        <textarea class="form-control" id="announcementContent" name="content" rows="4" required></textarea>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary" id="saveAnnouncement">Save Announcement</button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="adminHeader.js"></script>
 
    <script type="module">
      import { header } from './adminHeader.js';
    header(false);
    const params = new URLSearchParams(window.location?.search);
    const error = params.get('error');
    const announcementParams = params.get('announcement');

    if(announcementParams === 'success'){
        Swal.fire({
            title: 'Success!',
            text: 'Announcement has been posted successfully',
            icon: 'success',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
    } else if(announcementParams === 'failed'){
        Swal.fire({
            title: 'Error!',
            text: 'Failed to post announcement. Please try again.',
            icon: 'error',
            confirmButtonColor: '#d33',
            confirmButtonText: 'OK'
        });
    }
    </script>
     <script>
        // Chart Configuration
        const ctx = document.getElementById('revenueChart').getContext('2d');
        const ageData = <?php echo json_encode($age_data) ?>;
        const ageDistribution = ageData.map(data => data.count);
        const ageLabels = ageData.map(data => data.age_range);
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ageLabels,
                datasets: [{
                    label: 'Age distribution',
                    data: ageDistribution,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        const emailParams = new URLSearchParams(window.location?.search).get('email');
        if(emailParams === 'success'){
            Swal.fire({
                title: 'Success!',
                text: 'Email has been sent successfully',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        }


        const genderData = <?php echo json_encode($gender_stats); ?>;
        const genderLabels = genderData.map(data => data.gender);
        const genderCounts = genderData.map(data => data.count);

        const genderCtx = document.getElementById('genderChart').getContext('2d');
        new Chart(genderCtx, {
            type: 'pie',
            data: {
                labels: genderLabels,
                datasets: [{
                    label: 'Gender Distribution',
                    data: genderCounts,
                    backgroundColor: ['#FF6384', '#36A2EB'], // Blue for Male, Red for Female
                    borderColor: ['#FF6384', '#36A2EB'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true
            }
        });


        const civilStatusData = <?php echo json_encode($civil_status_stats); ?>;
        const civilStatusLabels = civilStatusData.map(data => data.civil_status);
        const civilStatusCounts = civilStatusData.map(data => data.count);

        const civilStatusCtx = document.getElementById('civilStatusChart').getContext('2d');
        new Chart(civilStatusCtx, {
            type: 'pie',
            data: {
                labels: civilStatusLabels,
                datasets: [{
                    label: 'Civil Status Distribution',
                    data: civilStatusCounts,
                    backgroundColor: [
                        '#FF6384', // Red for Single
                        '#36A2EB', // Blue for Married
                        '#FFCE56', // Yellow for Separated
                        '#4BC0C0'  // Teal for Widow
                    ],
                    borderColor: [
                        '#FF6384',
                        '#36A2EB',
                        '#FFCE56',
                        '#4BC0C0'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>
</body>
</html>
