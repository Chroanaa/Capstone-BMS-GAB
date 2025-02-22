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
</head>
<body>
    <table>
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
                    <td>
                        <a href="../controller/deleteResidentController.php?id=<?php echo $resident['creds_id'] ?>">Delete</a>
                        <button onclick="setUrlId(<?php echo $resident['id'] ?>)" data-toggle="modal" data-target="#issue-document">Issue a document</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>

    </table>

    <div class="modal fade" id="issue-document" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Issue a document</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <select name="document" id="document">
              <option value="1">Barangay Clearance</option>
              <option value="2">Barangay ID</option>
              <option value="3">Business Permit</option>
                <option value="4">Barangay Certificate of Indigency</option>
                <option value="5">First-Time Job Seeker</option>
                <option value="5">Certicate of Live Birth</option>
                <option value="5">Certicate of Guardianship</option>
                <option value="5">Health Certificate</option>
                
       </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Print</button>
      </div>
    </div>
  </div>
</div>

</body>
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
</html>