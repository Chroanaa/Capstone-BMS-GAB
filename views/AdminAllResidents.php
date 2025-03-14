<?php
function getAllResidents(){
    include '../databaseconn/connection.php';
    $conn = $GLOBALS['conn'];
    $stmt = $conn->prepare("SELECT * FROM user_info");
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
}
$residents = getAllResidents();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Residents</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <!-- Bootstrap Icons -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css"
      rel="stylesheet"
    />
    <!-- DataTables CSS -->
    <link
      href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="styles.css" />
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body>
  <div id="adminHeader"></div>
  <div class="residents-main-container">
    <h1 class="text-center h5 blue">Residents</h1>
    <table id="residentsTable" class="table table-striped table-bordered">
        <thead>
            <th>ID</th>
            <th>Fullname</th>
            <th>House No.</th>
            <th>Street</th>
            <th>From</th>
            <th>To</th>
            <th>Date of Birth</th>
            <th>Age</th>
            <th>Place of birth</th>
            <th>Contact Number</th>
            <th>Gender</th>
            <th>Civil Status</th>
            <th>Action</th>
        </thead>
        <tbody>
            <?php foreach($residents as $resident): ?>
                <tr>
                    <td><?php echo $resident['id'] ?></td>
                    <td><?php echo $resident['Fullname'] ?></td>
                    <td><?php echo $resident['House/floor/bldgno.'] ?></td>
                    <td><?php echo $resident['Street'] ?></td>
                    <td><?php echo $resident['from'] ?></td>
                    <td><?php echo $resident['to'] ?></td>
                    <td><?php echo $resident['date_of_birth'] ?></td>
                    <td><?php echo $resident['Age'] ?></td>
                    <td><?php echo $resident['place_of_birth'] ?></td>
                    <td><?php echo $resident['contact_number'] ?></td>
                    <td><?php echo $resident['gender'] ?></td>
                    <td><?php echo $resident['civil_status'] ?></td>
                    <td class="residents-table-action">
                        <a href="#" class="delete-link btn btn-danger" data-id="<?php echo $resident['creds_id'] ?>"><i class="bi bi-trash"></i></a>
                        <button onclick="setUrlId(<?php echo $resident['id'] ?>)" data-toggle="modal" data-target="#issue-document" class="btn-primary btn">Issue a document</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="modal fade" id="issue-document" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Issue a Document</h5>
        <button type="button" class="close text-white print-close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label for="document" class="form-label">Select Document:</label>
        <select class="form-control" name="document" id="document">
          <option value="1">Barangay Clearance</option>
          <option value="2">Barangay ID</option>
          <option value="3">Business Permit</option>
          <option value="4">Barangay Certificate of Indigency</option>
          <option value="5">First-Time Job Seeker</option>
          <option value="6">Certificate of Live Birth</option>
          <option value="7">Certificate of Guardianship</option>
          <option value="8">Health Certificate</option>
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Print</button>
      </div>
    </div>
  </div>
</div>

</div>
</body>
<!-- jQuery and DataTables JS -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
<!-- SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        $('#residentsTable').DataTable({
            responsive: true,
            lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
            pageLength: 5,
            scrollY: '50vh',  // Set vertical scroll height to 50% of viewport height
            scrollX: true,    // Enable horizontal scrolling
            scrollCollapse: true  // Enable scroll collapse
        });
        $('.dataTables_filter input').attr('placeholder', 'Search By Name...');
        // SweetAlert for delete confirmation
        $('.delete-link').on('click', function(e) {
            e.preventDefault();
            const id = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `../controller/deleteResidentController.php?id=${id}`;
                }
            });
        });

        // SweetAlert for status messages
        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get('status');
        if (status === 'success') {
            Swal.fire({
                title: 'Deleted!',
                text: 'The resident has been deleted.',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        } else if (status === 'error') {
            Swal.fire({
                title: 'Error!',
                text: 'There was an error deleting the resident.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    function setUrlId(id){
        const newUrl = `${window.location.protocol}//${window.location.host}${window.location.pathname}?id=${id}`;
        window.history.pushState({ path: newUrl }, '', newUrl);
    }
</script>
<script type="module">
        import { header } from './adminHeader.js';
        header(false); // Pass false since the user is not logged in
        const params = new URLSearchParams(window.location?.search);
        const error = params.get('error');
        if(error === 'wrongcreds'){
            document.querySelector('.card-error').innerHTML += `<div class="alert alert-danger mt-5" role="alert">
                <h4 class="text-center"> Wrong credentials </h4>
            </div>`;
            setTimeout(() => {
                document.querySelector('.card-error').innerHTML = "";
            }, 3000);
        }
        if(error === "notLoggedIn"){
            document.querySelector('.card-error').innerHTML += `<div class="alert alert-danger mt-5" role="alert">
                <h4 class="text-center"> Must be logged In</h4>
            </div>`;
            setTimeout(() => {
                document.querySelector('.card-error').innerHTML = "";
            }, 3000);
        }
    </script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
        header(true); // Pass true if the user is logged in
        $('#residentsTable').DataTable(); // Initialize DataTable
    });
    </script>
</html>