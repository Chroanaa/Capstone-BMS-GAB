<?php
include '../controller/performanceMetric.php';
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

$avg_residency_time = getAverageResidencyTime();
$gender_stats = getGenderStatistics();
$processing_stats = getProcessingTimeStats();
$volume_stats = getDocumentVolumeStats();
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
    <style>
       .custom-blue {
        background-color: #1e87ce !important;
    }
    .text-custom-blue {
        color: #1e87ce !important;
    }
    .compact-chart {
        max-height: 250px;
    }
    .dashboard-card {
        transition: all 0.3s ease;
        height: 130px;
        overflow: hidden;
    }
    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }
    .card-stats {
        height: 100%;
        max-height: 350px;
        overflow-y: auto;
    }
    .mini-pie-chart {
        max-width: 200px !important;
        max-height: 200px !important;
        margin: 0 auto;
    }
    .card-title {
        font-size: 1.1rem !important;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .card-text.display-4 {
        font-size: 2.5rem !important;
        font-weight: bold;
    }
    .fs-6 {
        font-size: 0.9rem !important;
    }
    </style>
</head>
<body id="adminDashboard">
    <div id="adminHeader"></div>

    <div class="container mt-4 admin-container">
       
        <div class="row justify-content-center">
            <div class="col-md-4 mb-3">
                <div class="card pale-pink mb-3 shadow-yellow">
                    <div class="card-body dashboard-card">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="card-title text-custom-blue">Registered Residents</h5>
                            <i class="bi bi-people-fill fs-1 text-custom-blue"></i>
                        </div>
                        <p class="card-text display-4"><?php echo $resident_count ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card light-cyan mb-3 shadow-yellow">
                    <div class="card-body dashboard-card">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="card-title text-custom-blue">Pending Document Request</h5>
                            <i class="bi bi-file-earmark-text fs-1 text-custom-blue"></i>
                        </div>
                        <p class="card-text display-4"><?php echo $doc_query ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card mb-3 shadow-yellow">
                    <div class="card-body dashboard-card">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="card-title text-custom-blue">Average Residency Time</h5>
                            <i class="bi bi-calendar-week fs-1 text-custom-blue"></i>
                        </div>
                        <p class="card-text display-4"><?php echo $avg_residency_time; ?> <span class="fs-6">Days</span></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
    <div class="col-md-6 mb-3">
        <div class="card shadow-yellow">
            <div class="card-header custom-blue text-white">
                <div class="d-flex align-items-center">
                    <i class="bi bi-bar-chart-fill me-2"></i>
                    <h5 class="mb-0">Age Distribution</h5>
                </div>
            </div>
            <div class="card-body compact-chart">
                <canvas id="revenueChart" height="180"></canvas>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 mb-3">
        <div class="card shadow-yellow">
            <div class="card-header custom-blue text-white">
                <div class="d-flex align-items-center">
                    <i class="bi bi-clock-history me-2"></i>
                    <h5 class="mb-0">Document Processing Time</h5>
                </div>
            </div>
            <div class="card-body compact-chart">
                <canvas id="processingTimeChart" height="180"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3 mb-3">
        <div class="card shadow-yellow">
            <div class="card-header custom-blue text-white">
                <div class="d-flex align-items-center">
                    <i class="bi bi-gender-ambiguous me-2"></i>
                    <h5 class="mb-0">Gender Distribution</h5>
                </div>
            </div>
            <div class="card-body compact-chart">
                <canvas id="genderChart" class="mini-pie-chart"></canvas>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-3">
        <div class="card shadow-yellow">
            <div class="card-header custom-blue text-white">
                <div class="d-flex align-items-center">
                    <i class="bi bi-people me-2"></i>
                    <h5 class="mb-0">Civil Status</h5>
                </div>
            </div>
            <div class="card-body compact-chart">
                <canvas id="civilStatusChart" class="mini-pie-chart"></canvas>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 mb-3">
        <div class="card shadow-yellow">
            <div class="card-header custom-blue text-white">
                <div class="d-flex align-items-center">
                    <i class="bi bi-file-earmark-bar-graph me-2"></i>
                    <h5 class="mb-0">Document Volume by Type</h5>
                </div>
            </div>
            <div class="card-body compact-chart">
                <canvas id="documentVolumeChart" height="180"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 mb-3">
        <div class="card shadow-yellow">
            <div class="card-header custom-blue text-white">
                <div class="d-flex align-items-center">
                    <i class="bi bi-table me-2"></i>
                    <h5 class="mb-0">Processing Time Statistics</h5>
                </div>
            </div>
            <div class="card-body card-stats">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="custom-blue text-white">
                            <tr>
                                <th>Date</th>
                                <th>Average Time (sec)</th>
                                <th>Min Time (sec)</th>
                                <th>Max Time (sec)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($processing_stats as $stat): ?>
                            <tr>
                                <td><?= $stat['day'] ?></td>
                                <td><?= round($stat['avg_time'], 2) ?></td>
                                <td><?= round($stat['min_time'], 2) ?></td>
                                <td><?= round($stat['max_time'], 2) ?></td>
                            </tr>
                            <?php endforeach; ?>
                            <?php if(empty($processing_stats)): ?>
                            <tr>
                                <td colspan="4" class="text-center">No data available</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
    </div>

    <div class="card-error"></div>

    <!-- Announcement Modal -->
    <div class="modal fade" id="announcementModal" tabindex="-1" aria-labelledby="announcementModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header custom-blue text-white">
                    <h5 class="modal-title" id="announcementModalLabel">New Announcement</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
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
                            <button type="submit" class="btn custom-blue text-white" id="saveAnnouncement">Save Announcement</button>
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
            confirmButtonColor: '#1e87ce',
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
                    backgroundColor: 'rgba(30, 135, 206, 0.5)',
                    borderColor: 'rgba(30, 135, 206, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
        
        // Check for email parameters
        const emailParams = new URLSearchParams(window.location?.search).get('email');
        if(emailParams === 'success'){
            Swal.fire({
                title: 'Success!',
                text: 'Email has been sent successfully',
                icon: 'success',
                confirmButtonColor: '#1e87ce',
                confirmButtonText: 'OK'
            });
        }

        // Gender chart
        const genderData = <?php echo json_encode($gender_stats); ?>;
        const genderLabels = genderData.map(data => data.gender);
        const genderCounts = genderData.map(data => data.count);

        const genderCtx = document.getElementById('genderChart').getContext('2d');
        new Chart(genderCtx, {
            type: 'doughnut',
            data: {
                labels: genderLabels,
                datasets: [{
                    label: 'Gender Distribution',
                    data: genderCounts,
                    backgroundColor: ['#FF6384', '#1e87ce'], // Pink for Female, Custom blue for Male
                    borderColor: ['#FF6384', '#1e87ce'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Civil Status chart
        const civilStatusData = <?php echo json_encode($civil_status_stats); ?>;
        const civilStatusLabels = civilStatusData.map(data => data.civil_status);
        const civilStatusCounts = civilStatusData.map(data => data.count);

        const civilStatusCtx = document.getElementById('civilStatusChart').getContext('2d');
        new Chart(civilStatusCtx, {
            type: 'doughnut',
            data: {
                labels: civilStatusLabels,
                datasets: [{
                    label: 'Civil Status Distribution',
                    data: civilStatusCounts,
                    backgroundColor: [
                        '#1e87ce', // Custom blue for Single
                        '#36A2EB', // Light blue for Married
                        '#FFCE56', // Yellow for Separated
                        '#4BC0C0'  // Teal for Widow
                    ],
                    borderColor: [
                        '#1e87ce',
                        '#36A2EB',
                        '#FFCE56',
                        '#4BC0C0'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
        
        // Processing Time chart
        const processingData = <?= json_encode($processing_stats) ?>;
        const processingLabels = processingData.map(data => data.day);
        const processingValues = processingData.map(data => data.avg_time);
        
        new Chart(document.getElementById('processingTimeChart').getContext('2d'), {
            type: 'line',
            data: {
                labels: processingLabels,
                datasets: [{
                    label: 'Average Processing Time (seconds)',
                    data: processingValues,
                    backgroundColor: 'rgba(30, 135, 206, 0.5)',
                    borderColor: 'rgba(30, 135, 206, 1)',
                    borderWidth: 2,
                    tension: 0.2,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Seconds'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Date'
                        }
                    }
                }
            }
        });
        
        // Document Volume Chart
        const volumeData = <?= json_encode($volume_stats) ?>;
        const volumeLabels = volumeData.map(data => data.doc_type);
        const volumeValues = volumeData.map(data => data.count);
        
        new Chart(document.getElementById('documentVolumeChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: volumeLabels,
                datasets: [{
                    label: 'Number of Requests',
                    data: volumeValues,
                    backgroundColor: 'rgba(30, 135, 206, 0.5)',
                    borderColor: 'rgba(30, 135, 206, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        },
                        title: {
                            display: true,
                            text: 'Count'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Document Type'
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>