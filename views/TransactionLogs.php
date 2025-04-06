<?php
    session_start();
    if(!isset($_SESSION['admin'])){
        header('Location: AdminLogin.php?error=notLoggedIn');
    }
   
    function getAuditlog(){
        include_once '../databaseconn/connection.php';
        $sql = "SELECT * FROM audit_log";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    $audits = getAuditlog();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Logs</title>
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
    <link
      href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="styles.css" />
</head>
<body id="adminDashboard">
    <div id="adminHeader"></div>
    <div class="container mt-5 ">
    <h1 class="text-center mb-4 h5-yellow">Transaction Logs</h1>
    <div class="table-responsive bg-white p-4 rounded shadow-yellow">
        <table id="transactionLogsTable" class="table table-striped table-bordered">
                <thead class="">
                    <tr>
                        <th>Id</th>
                        <th>Action</th>
                        <th>IP Address</th>
                        <th>Time Created</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($audits as $audit): ?>
                        <tr>
                            <td><?= htmlspecialchars($audit['id']) ?></td>
                            <td><?= htmlspecialchars($audit['action']) ?></td>
                            <td><?= htmlspecialchars($audit['ip_address']) ?></td>
                            <td><?= htmlspecialchars($audit['time_Created']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="adminHeader.js"></script>
    <script type="module">
        import { header } from './adminHeader.js';
        header(false); // Pass false since the user is not logged in
    </script>
    <script>
        $(document).ready(function() {
            $('#transactionLogsTable').DataTable({
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
</body>
</html>