<?php
session_start();

function getHouseholds(){
    include_once '../databaseconn/connection.php';
    $sql = "SELECT 
    `House/floor/bldgno.`, 
    `Street`,
    GROUP_CONCAT(CONCAT(`first_name`, ' ', `last_name`) SEPARATOR ', ') AS residents,
    MIN(`date_of_birth`) AS oldest_dob,
    MAX(`date_of_birth`) AS youngest_dob,
    MIN(`Age`) AS oldest_age,
    MAX(`Age`) AS youngest_age,
    `gender`
FROM `user_info`
GROUP BY `House/floor/bldgno.`, `Street`
ORDER BY `Street`, `House/floor/bldgno.`;
";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}

$households = getHouseholds();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Household</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="styles.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body class="body-padding">
    <div id="adminHeader"></div>
    <div class="container mt-5 ">
        <h1 class="text-center mb-4 h5-yellow">Household Information</h1>
        <div class="table-responsive bg-white p-4 rounded shadow-yellow">
            <table id="householdTable" class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>House Address</th>
                        <th>Residents</th>
                        <th>Oldest DOB</th>
                        <th>Youngest DOB</th>
                        <th>Oldest Age</th>
                        <th>Youngest Age</th>
                        <th>gender</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($households as $household): ?>
                        <tr>
                            <td><?= $household['Street'] . ' ' . $household['House/floor/bldgno.'] ?></td>
                            <td><?= $household['residents'] ?></td>
                            <td><?= $household['oldest_dob'] ?></td>
                            <td><?= $household['youngest_dob'] ?></td>
                            <td><?= $household['oldest_age'] ?></td>
                            <td><?= $household['youngest_age'] ?></td>
                             <td><?= $household['gender'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="adminHeader.js"></script>
<script type="module">
    import { header } from './adminHeader.js';
    header(false); // Pass false since the user is not logged in

    // Initialize DataTable
    $(document).ready(function() {
        $('#householdTable').DataTable({
            responsive: true,
            lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
            pageLength: 10,
            language: {
                search: "Search:",
                lengthMenu: "Display _MENU_ records per page",
                info: "Showing _START_ to _END_ of _TOTAL_ records",
                paginate: {
                    first: "First",
                    last: "Last",
                    next: "Next",
                    previous: "Previous"
                }
            }
        });
    });
</script>
</html>