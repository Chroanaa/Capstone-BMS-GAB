<?php
 session_start();
    if(!isset($_SESSION['admin'])){
        header('Location: AdminLogin.php?error=notLoggedIn');
    }
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</head>
<body>
  <div id="adminHeader"></div>
  <div class="residents-main-container shadow-yellow">
  <div class="d-flex justify-content-between align-items-center mb-3 ">
        <h1 class="h5 blue">Residents</h1>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addResidentModal">
            <i class="bi bi-person-plus"></i> Add Resident
        </button>
    </div>
    <table id="residentsTable" class="table table-striped table-bordered">
    <thead class="table-blue">
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
                <?php $fullname = $resident['first_name'] . ' ' . $resident['middle_name'] . ' ' . $resident['last_name']; ?>
                
                <tr>
                    <td><?php echo $resident['id'] ?></td>
                    <td><?php echo $fullname?></td>
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
                    <button class="btn btn-warning btn-sm edit-resident" 
                    data-toggle="modal" 
                    data-target="#editResidentModal" 
                    data-id="<?php echo htmlspecialchars($resident['id']); ?>"
                    data-creds-id="<?php echo htmlspecialchars($resident['creds_id']); ?>"
                    data-firstname="<?php echo htmlspecialchars(trim($resident['first_name'])); ?>"
                    data-middlename="<?php echo htmlspecialchars(trim($resident['middle_name'])); ?>"
                    data-lastname="<?php echo htmlspecialchars(trim($resident['last_name'])); ?>"
                    data-houseno="<?php echo htmlspecialchars(trim($resident['House/floor/bldgno.'])); ?>"
                    data-street="<?php echo htmlspecialchars(trim($resident['Street'])); ?>"
                    data-from="<?php echo htmlspecialchars(trim($resident['from'])); ?>"
                    data-to="<?php echo htmlspecialchars(trim($resident['to'])); ?>"
                    data-dob="<?php echo htmlspecialchars(trim($resident['date_of_birth'])); ?>"
                    data-age="<?php echo htmlspecialchars(trim($resident['Age'])); ?>"
                    data-pob="<?php echo htmlspecialchars(trim($resident['place_of_birth'])); ?>"
                    data-contact="<?php echo htmlspecialchars(trim($resident['contact_number'])); ?>"
                    data-gender="<?php echo htmlspecialchars(trim($resident['gender'])); ?>"
                    data-civil="<?php echo htmlspecialchars(trim($resident['civil_status'])); ?>"
                    data-picture="data:image/jpeg;base64,<?php echo base64_encode($resident['picture']); ?>"
                    data-id-image="data:image/jpeg;base64,<?php echo base64_encode($resident['id_picture']); ?>">
                    <i class="bi bi-pencil"></i>
                </button>
                        <a href="#" class="delete-link btn btn-danger btn-sm" onclick="deleteResident(<?php echo $resident['creds_id'] ?>)">
                            <i class="bi bi-trash"></i>
                        </a>
                        <button onclick="setUrlId(<?php echo $resident['id'] ?>)" data-toggle="modal" data-target="#issue-document" class="btn-primary btn btn-sm">
                            Issue a document
                        </button>
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
            <option value="3">Certificate of Residency</option>
            <option value="4">Certificate of Indigency</option>
            <option value="5">First-Time Job Seeker</option>
            <option value="6">Certificate of Scholarship</option>
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id = "print">Print</button>
      </div>
    </div>
  </div>
</div>
</div>

<!-- Add Resident Modal -->
<div class="modal fade" id="addResidentModal" tabindex="-1" role="dialog" aria-labelledby="addResidentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="addResidentModalLabel">Add New Resident</h5>
                <button type="button" class="close text-white print-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addResidentForm" action="../controller/addResidentController.php" method="POST" enctype="multipart/form-data">
                    <!-- Personal Information -->
                    <div class="row mb-3">
                        <div class="col-md-4 form-floating">
                            <input type="text" id="firstName" name="firstName" class="form-control" placeholder="First Name" required>
                            <label for="firstName">First Name</label>
                        </div>
                        <div class="col-md-4 form-floating">
                            <input type="text" id="middleName" name="middleName" class="form-control" placeholder="Middle Name">
                            <label for="middleName">Middle Name</label>
                        </div>
                        <div class="col-md-4 form-floating">
                            <input type="text" id="lastName" name="lastName" class="form-control" placeholder="Last Name" required>
                            <label for="lastName">Last Name</label>
                        </div>
                    </div>

                    <!-- Residence -->
                    <div class="row mb-3">
                        <div class="col-md-6 form-floating">
                            <input type="text" id="bldg" name="bldg" class="form-control" placeholder="House/Bldg/Floor no." required>
                            <label for="bldg">House/Bldg/Floor no.</label>
                        </div>
                        <div class="col-md-6 form-floating">
                            <input type="text" id="street" name="street" class="form-control" placeholder="Street" required>
                            <label for="street">Street</label>
                        </div>
                    </div>

                    <!-- Residency Period -->
                    <div class="row mb-3">
                        <div class="col-md-6 form-floating">
                            <input type="date" id="from" name="From" class="form-control" placeholder="From" required>
                            <label for="from">From</label>
                        </div>
                        <div class="col-md-6 form-floating">
                            <input type="date" id="to" name="to" class="form-control" placeholder="To" required>
                            <label for="to">To</label>
                        </div>
                    </div>

                    <!-- Date of Birth -->
                    <div class="row mb-3">
                        <div class="col-md-6 form-floating">
                            <input type="date" id="date" name="date" class="form-control" placeholder="Date of Birth" required>
                            <label for="date">Date of Birth</label>
                        </div>
                        <div class="col-md-6 form-floating">
                            <input type="text" id="Age" name="Age" class="form-control" placeholder="Age" readonly>
                            <label for="Age">Age</label>
                        </div>
                    </div>

                    <!-- Place of Birth -->
                    <div class="form-floating mb-3">
                        <input type="text" id="placeofbirth" name="placeofbirth" class="form-control" placeholder="Place of Birth" required>
                        <label for="placeofbirth">Place of Birth</label>
                    </div>

                    <!-- Contact Number -->
                    <div class="form-floating mb-3">
                        <input type="text" id="Contactnumber" name="Contactnumber" class="form-control" placeholder="Contact Number" required>
                        <label for="Contactnumber">Contact Number</label>
                    </div>

                    <!-- Email -->
                    <div class="form-floating mb-3">
                        <input type="email" id="Email" name="Email" class="form-control" placeholder="Email" required>
                        <label for="Email">Email</label>
                        <span class="text-danger" id="emailError"></span>
                    </div>

                    <!-- Gender -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="mb-2"><b>Sex</b></label>
                            <div class="form-check">
                                <input type="radio" id="Male" name="sex" value="Male" class="form-check-input" required>
                                <label class="form-check-label" for="Male">Male</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" id="Female" name="sex" value="Female" class="form-check-input" required>
                                <label class="form-check-label" for="Female">Female</label>
                            </div>
                        </div>

                        <!-- Civil Status -->
                        <div class="col-md-6">
                            <label class="mb-2"><b>Civil Status</b></label>
                            <div class="form-check">
                                <input type="radio" id="Single" name="Civilstatus" value="Single" class="form-check-input" required>
                                <label class="form-check-label" for="Single">Single</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" id="Married" name="Civilstatus" value="Married" class="form-check-input" required>
                                <label class="form-check-label" for="Married">Married</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" id="Widow" name="Civilstatus" value="Widow" class="form-check-input" required>
                                <label class="form-check-label" for="Widow">Widow</label>
                            </div>
                        </div>
                    </div>

                    <!-- Type of ID -->
                    <div class="form-floating mb-3">
                        <select id="typeOfId" name="typeOfId" class="form-select" required>
                            <option value="" disabled selected>Select Type of ID</option>
                            <option value="Passport">Passport</option>
                            <option value="Driver's License">Driver's License</option>
                            <option value="National ID">National ID</option>
                            <option value="Voter's ID">Voter's ID</option>
                        </select>
                        <label for="typeOfId">Type of ID</label>
                    </div>

                    <!-- Upload ID Picture -->
                    <div class="mb-3">
                        <label for="id" class="form-label">Upload ID Picture:</label>
                        <input class="form-control" type="file" id="id" name="id" accept="image/*" required>
                    </div>

                    <!-- Vehicle Ownership -->
                    <div class="mb-3">
                        <label><b>Do you own a vehicle?</b></label>
                        <div class="form-check">
                            <input type="radio" id="vehicleYes" name="vehicle" value="Yes" class="form-check-input" required>
                            <label class="form-check-label" for="vehicleYes">Yes</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" id="vehicleNo" name="vehicle" value="No" class="form-check-input" required>
                            <label class="form-check-label" for="vehicleNo">No</label>
                        </div>
                    </div>

                    <!-- How Many Vehicles -->
                    <div class="form-floating mb-3">
                        <input type="number" id="howManyVehicles" name="howManyVehicles" class="form-control" placeholder="How Many Vehicles" min="0" disabled>
                        <label for="howManyVehicles">How Many Vehicles</label>
                        <input type="hidden" id="noOfVehicales" name="noOfVehicales">
                    </div>

                    <!-- Profile Picture -->
                    <div class="mb-3">
                        <label for="profilePicture" class="form-label">Profile Picture:</label>
                        <input class="form-control" type="file" id="profilePicture" name="user_picture" accept="image/*" required>
                    </div>
                    <div class="mb-3">
                        <img id="profilePicturePreview" src="#" alt="Profile Picture Preview" class="img-fluid" style="display: none; max-width: 100%; height: auto;">
                    </div>

                    <!-- Username -->
                    <div class="form-floating mb-3">
                        <input type="text" id="username" name="username" class="form-control" placeholder="Username" required>
                        <label for="username">Username</label>
                        <span class="text-danger" id="usernameError"></span>
                    </div>

                    <!-- Password -->
                    <div class="form-floating mb-3 position-relative">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                        <label for="password">Password</label>
                        <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y pe-3 toggle-password fs-5" style="cursor: pointer;"></i>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="submitBtn">Add Resident</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<<!-- Edit Resident Modal -->
<div class="modal fade" id="editResidentModal" tabindex="-1" role="dialog" aria-labelledby="editResidentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title" id="editResidentModalLabel">Edit Resident</h5>
                <button type="button" class="close print-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editResidentForm" action="../controller/editResidentController.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" id="edit_id" name="id">
                    <input type="hidden" id="edit_creds_id" name="creds_id">

                    <!-- Personal Information -->
                    <div class="row mb-3">
                        <div class="col-md-4 form-floating">
                            <input type="text" id="edit_firstName" name="firstName" class="form-control" placeholder="First Name" required>
                            <label for="edit_firstName">First Name</label>
                        </div>
                        <div class="col-md-4 form-floating">
                            <input type="text" id="edit_middleName" name="middleName" class="form-control" placeholder="Middle Name">
                            <label for="edit_middleName">Middle Name</label>
                        </div>
                        <div class="col-md-4 form-floating">
                            <input type="text" id="edit_lastName" name="lastName" class="form-control" placeholder="Last Name" required>
                            <label for="edit_lastName">Last Name</label>
                        </div>
                    </div>

                    <!-- Residence -->
                    <div class="row mb-3">
                        <div class="col-md-6 form-floating">
                            <input type="text" id="edit_bldg" name="bldg" class="form-control" placeholder="House/Bldg/Floor no." required>
                            <label for="edit_bldg">House/Bldg/Floor no.</label>
                        </div>
                        <div class="col-md-6 form-floating">
                            <input type="text" id="edit_street" name="street" class="form-control" placeholder="Street" required>
                            <label for="edit_street">Street</label>
                        </div>
                    </div>

                    <!-- Residency Period -->
                    <div class="row mb-3">
                        <div class="col-md-6 form-floating">
                            <input type="date" id="edit_from" name="From" class="form-control" required>
                            <label for="edit_from">From</label>
                        </div>
                        <div class="col-md-6 form-floating">
                            <input type="date" id="edit_to" name="to" class="form-control" required>
                            <label for="edit_to">To</label>
                        </div>
                    </div>

                    <!-- Date of Birth -->
                    <div class="row mb-3">
                        <div class="col-md-6 form-floating">
                            <input type="date" id="edit_date" name="date" class="form-control" required>
                            <label for="edit_date">Date of Birth</label>
                        </div>
                        <div class="col-md-6 form-floating">
                            <input type="text" id="edit_Age" name="Age" class="form-control" placeholder="Age" readonly>
                            <label for="edit_Age">Age</label>
                        </div>
                    </div>

                    <!-- Place of Birth -->
                    <div class="form-floating mb-3">
                        <input type="text" id="edit_placeofbirth" name="placeofbirth" class="form-control" placeholder="Place of Birth" required>
                        <label for="edit_placeofbirth">Place of Birth</label>
                    </div>

                    <!-- Contact Number -->
                    <div class="form-floating mb-3">
                        <input type="text" id="edit_Contactnumber" name="Contactnumber" class="form-control" placeholder="Contact Number" required>
                        <label for="edit_Contactnumber">Contact Number</label>
                    </div>

                    <!-- Gender -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="mb-2"><b>Sex</b></label>
                            <div class="form-check">
                                <input type="radio" id="edit_Male" name="sex" value="Male" class="form-check-input" required>
                                <label class="form-check-label" for="edit_Male">Male</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" id="edit_Female" name="sex" value="Female" class="form-check-input" required>
                                <label class="form-check-label" for="edit_Female">Female</label>
                            </div>
                        </div>

                        <!-- Civil Status -->
                        <div class="col-md-6">
                            <label class="mb-2"><b>Civil Status</b></label>
                            <div class="form-check">
                                <input type="radio" id="edit_Single" name="Civilstatus" value="Single" class="form-check-input" required>
                                <label class="form-check-label" for="edit_Single">Single</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" id="edit_Married" name="Civilstatus" value="Married" class="form-check-input" required>
                                <label class="form-check-label" for="edit_Married">Married</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" id="edit_Widow" name="Civilstatus" value="Widow" class="form-check-input" required>
                                <label class="form-check-label" for="edit_Widow">Widow</label>
                            </div>
                        </div>
                    </div>

                    <!-- Type of ID -->
                    <div class="form-floating mb-3">
                        <select id="edit_typeOfId" name="typeOfId" class="form-select" required>
                            <option value="" disabled>Select Type of ID</option>
                            <option value="Passport">Passport</option>
                            <option value="Driver's License">Driver's License</option>
                            <option value="National ID">National ID</option>
                            <option value="Voter's ID">Voter's ID</option>
                        </select>
                        <label for="edit_typeOfId">Type of ID</label>
                    </div>
                    <!-- Profile Picture -->
                    <div class="mb-3">
                        <label for="edit_profilePicture" class="form-label">Profile Picture:</label>
                        <input class="form-control" type="file" id="edit_profilePicture" name="profilePicture" accept="image/*">
                        <img id="editProfilePicturePreview" src="#" alt="Profile Picture Preview" class="img-fluid mt-2" style="max-height: 200px; display: none;">
                    </div>

                    <!-- ID Picture -->
                    <div class="mb-3">
                        <label for="edit_idPicture" class="form-label">ID Picture:</label>
                        <input class="form-control" type="file" id="edit_idPicture" name="idPicture" accept="image/*">
                        <img id="editIdPicturePreview" src="#" alt="ID Picture Preview" class="img-fluid mt-2" style="max-height: 200px; display: none;">
                    </div>
                    <!-- Vehicle Ownership -->
                    <div class="mb-3">
                        <label><b>Do you own a vehicle?</b></label>
                        <div class="form-check">
                            <input type="radio" id="edit_vehicleYes" name="vehicle" value="Yes" class="form-check-input" required>
                            <label class="form-check-label" for="edit_vehicleYes">Yes</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" id="edit_vehicleNo" name="vehicle" value="No" class="form-check-input" required>
                            <label class="form-check-label" for="edit_vehicleNo">No</label>
                        </div>
                    </div>

                    <!-- How Many Vehicles -->
                    <div class="form-floating mb-3">
                        <input type="number" id="edit_howManyVehicles" name="howManyVehicles" class="form-control" placeholder="How Many Vehicles" min="0" disabled>
                        <label for="edit_howManyVehicles">How Many Vehicles</label>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning" id="saveChangesBtn">Save Changes</button>
                    </div>
                </form>
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
       

        // SweetAlert for status messages
        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get('status');
        const editStatus = urlParams.get('edit');
        const addStatus = urlParams.get('add');
        if(addStatus == "success"){
            Swal.fire({
                title: 'Success!',
                text: 'Resident has been added.',
                icon: 'success',
                confirmButtonText: 'OK',
                preConfirm: () => {
                    window.history.replaceState({}, document.title, window.location.pathname);
                }
            });
        }else if(addStatus == "failed"){
            Swal.fire({
                title: 'Error!',
                text: 'There was an error adding the resident.',
                icon: 'error',
                confirmButtonText: 'OK',
                preConfirm: () => {
                    window.history.replaceState({}, document.title, window.location.pathname);
                }
            });
        }
        if(editStatus == "success"){
            Swal.fire({
                title: 'Success!',
                text: 'Resident has been updated.',
                icon: 'success',
                confirmButtonText: 'OK',
                preConfirm: () => {
                    window.history.replaceState({}, document.title, window.location.pathname);
                }
            });
        }else if(editStatus == "failed"){
            Swal.fire({
                title: 'Error!',
                text: 'There was an error updating the resident.',
                icon: 'error',
                confirmButtonText: 'OK',
                preConfirm: () => {
                    window.history.replaceState({}, document.title, window.location.pathname);
                }
            });
        }
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
function deleteResident(id) {
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
       }

    // Add to your existing script section
$(document).ready(function() {
    // Age calculation
    $('#date').on('change', function() {
        const today = new Date();
        const birthDate = new Date(this.value);
        if(birthDate > today) {
            alert("Date of birth cannot be in the future");
            this.value = "";
            $('#Age').val("");
            return;
        }
        
        let age = today.getFullYear() - birthDate.getFullYear();
        const monthDiff = today.getMonth() - birthDate.getMonth();
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        if(age > 100) {
            alert("Invalid date of birth");
            this.value = "";
            $('#Age').val("");
            return;
        }
        $('#Age').val(age);
    });

    // Profile picture preview
    $('#profilePicture').on('change', function(event) {
        const [file] = event.target.files;
        if (file) {
            const preview = $('#profilePicturePreview');
            preview.attr('src', URL.createObjectURL(file));
            preview.show();
        }
    });
});


// Add this to your existing $(document).ready function
$('.edit-resident').on('click', function() {
    const btn = $(this);

    // Set values in form
    $('#edit_id').val(btn.data('id'));
    $('#edit_creds_id').val(btn.data('creds-id'));
    $('#edit_firstName').val(btn.data('firstname'));
    $('#edit_middleName').val(btn.data('middlename'));
    $('#edit_lastName').val(btn.data('lastname'));
    $('#edit_bldg').val(btn.data('houseno'));
    $('#edit_street').val(btn.data('street'));
    $('#edit_from').val(btn.data('from'));
    $('#edit_to').val(btn.data('to'));
    $('#edit_date').val(btn.data('dob'));
    $('#edit_Age').val(btn.data('age'));
    $('#edit_placeofbirth').val(btn.data('pob'));
    $('#edit_Contactnumber').val(btn.data('contact'));

    // Set radio buttons
    $(`input[name="sex"][value="${btn.data('gender')}"]`).prop('checked', true);
    $(`input[name="Civilstatus"][value="${btn.data('civil')}"]`).prop('checked', true);

    // Render existing ID image
    const idImageSrc = btn.data('id-image'); // Ensure this data attribute is set in the button
    const $idImagePreview = $('#editIdImagePreview');
    if (idImageSrc) {
        $idImagePreview.attr('src', idImageSrc).show();
    } else {
        $idImagePreview.hide();
    }
});

// Handle new ID image upload
$('#edit_id').on('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            $('#editIdImagePreview').attr('src', e.target.result).show();
        };
        reader.readAsDataURL(file);
    }
});

document.querySelector('.toggle-password-edit').addEventListener('click', function() {
    const passwordInput = document.getElementById('edit_password');
    const icon = this;

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
    } else {
        passwordInput.type = 'password';
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
    }
});

// Add the age calculation for edit form
$('#edit_date').on('change', function() {
    const today = new Date();
    const birthDate = new Date(this.value);
    if(birthDate > today) {
        alert("Date of birth cannot be in the future");
        this.value = "";
        $('#edit_Age').val("");
        return;
    }
    
    let age = today.getFullYear() - birthDate.getFullYear();
    const monthDiff = today.getMonth() - birthDate.getMonth();
    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    if(age > 100) {
        alert("Invalid date of birth");
        this.value = "";
        $('#edit_Age').val("");
        return;
    }
    $('#edit_Age').val(age);
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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

    function setUrlId(id){
        const newUrl = `${window.location.protocol}//${window.location.host}${window.location.pathname}?id=${id}`;
        window.history.pushState({ path: newUrl }, '', newUrl);
    }

    // Add this to your existing $(document).ready function

// Initialize Flatpickr for Add Resident Modal
flatpickr("#from", {
    maxDate: "today",
    dateFormat: "Y-m-d",
    onChange: function(selectedDates, dateStr) {
        toPicker.set('minDate', dateStr);
    }
});

const toPicker = flatpickr("#to", {
    maxDate: "today",
    dateFormat: "Y-m-d"
});

flatpickr("#date", {
    maxDate: "today",
    dateFormat: "Y-m-d",
    onChange: function(selectedDates) {
        if (selectedDates[0]) {
            const today = new Date();
            const birthDate = selectedDates[0];
            let age = today.getFullYear() - birthDate.getFullYear();
            const monthDiff = today.getMonth() - birthDate.getMonth();
            
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            
            if (age > 100) {
                Swal.fire({
                    title: 'Invalid Age',
                    text: 'Please enter a valid date of birth',
                    icon: 'error'
                });
                this.clear();
                document.getElementById('Age').value = '';
                return;
            }
            
            document.getElementById('Age').value = age;
        }
    }
});

// Initialize Flatpickr for Edit Resident Modal
flatpickr("#edit_from", {
    maxDate: "today",
    dateFormat: "Y-m-d",
    onChange: function(selectedDates, dateStr) {
        editToPicker.set('minDate', dateStr);
    }
});

const editToPicker = flatpickr("#edit_to", {
    maxDate: "today",
    dateFormat: "Y-m-d"
});

flatpickr("#edit_date", {
    maxDate: "today",
    dateFormat: "Y-m-d",
    onChange: function(selectedDates) {
        if (selectedDates[0]) {
            const today = new Date();
            const birthDate = selectedDates[0];
            let age = today.getFullYear() - birthDate.getFullYear();
            const monthDiff = today.getMonth() - birthDate.getMonth();
            
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            
            if (age > 100) {
                Swal.fire({
                    title: 'Invalid Age',
                    text: 'Please enter a valid date of birth',
                    icon: 'error'
                });
                this.clear();
                document.getElementById('edit_Age').value = '';
                return;
            }
            
            document.getElementById('edit_Age').value = age;
        }
    }
});

// Remove existing date change handlers since Flatpickr will handle them
$('#date').off('change');
$('#edit_date').off('change');


// Add to your existing JavaScript in AdminAllResidents.php
document.querySelector('.toggle-password').addEventListener('click', function() {
    const passwordInput = document.getElementById('password');
    const icon = this;

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
    } else {
        passwordInput.type = 'password';
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
    }
});




document.getElementById('saveChangesBtn').addEventListener('click', function(e) {
    e.preventDefault();
    
    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to save these changes?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ffc107',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, save changes',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('editResidentForm').submit();
        }
    });
});

function debounce(func, wait) {
    let timeout;
    return function(...args) {
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(this, args), wait);
    };
}

const username = document.getElementById('username');

username.addEventListener('input', debounce(async function() {
    const usernameValue = username.value;
    const submit = document.getElementById('submitBtn');

        const check = await fetch(`../controller/checkDuplicateController.php?username=${usernameValue}`);
        const response = await check.json();
        if (response.status === 'error') {
            document.getElementById('usernameError').textContent = response.message;
            submit.disabled = true;
        } else {
            document.getElementById('usernameError').textContent = '';
            submit.disabled = false;
        }
}, 300));
document.querySelector("#print").addEventListener("click", function(){
    const selectedDocument = document.querySelector("#document").value;
    const id = new URLSearchParams(window.location.search).get("id");
    
    // Match services array with corresponding document pages
    switch(selectedDocument){
        case "1": // Barangay Clearance
            window.location.href = `documents/BarangayClearance.php?resident_id=${id}`; 
            break;
        case "2": // Barangay ID
            window.location.href = `documents/BarangayID.php?resident_id=${id}`;
            break;
        case "3": // Certificate of Residency
            window.location.href = `documents/CertificateOfResidency.php?resident_id=${id}`;
            break;
        case "4": // Certificate of Indigency
            window.location.href = `documents/CertificateOfIndigency.php?resident_id=${id}`;
            break;
        case "5": // First-Time Job Seeker
            window.location.href = `documents/FirstTimeJobSeeker.php?resident_id=${id}`;
            break;
        case "6": // Certificate of Scholarship
            window.location.href = `documents/CertificateOfScholarship.php?resident_id=${id}`;
            break;
    }
});


document.addEventListener('DOMContentLoaded', function () {
    // Add Resident Modal
    const vehicleYes = document.getElementById('vehicleYes');
    const vehicleNo = document.getElementById('vehicleNo');
    const howManyVehicles = document.getElementById('howManyVehicles');

    vehicleYes.addEventListener('change', function () {
        howManyVehicles.disabled = !vehicleYes.checked;
    });

    vehicleNo.addEventListener('change', function () {
        if (vehicleNo.checked) {
            howManyVehicles.disabled = true;
            howManyVehicles.value = ''; // Clear the value when disabled
        }
    });

    // Edit Resident Modal
    const editVehicleYes = document.getElementById('edit_vehicleYes');
    const editVehicleNo = document.getElementById('edit_vehicleNo');
    const editHowManyVehicles = document.getElementById('edit_howManyVehicles');

    editVehicleYes.addEventListener('change', function () {
        editHowManyVehicles.disabled = !editVehicleYes.checked;
    });

    editVehicleNo.addEventListener('change', function () {
        if (editVehicleNo.checked) {
            editHowManyVehicles.disabled = true;
            editHowManyVehicles.value = ''; // Clear the value when disabled
        }
    });
});


// Handle profile picture preview
$('#edit_profilePicture').on('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            $('#editProfilePicturePreview').attr('src', e.target.result).show();
        };
        reader.readAsDataURL(file);
    }
});

// Handle ID picture preview
$('#edit_idPicture').on('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            $('#editIdPicturePreview').attr('src', e.target.result).show();
        };
        reader.readAsDataURL(file);
    }
});

// Populate existing images in the edit modal
$('.edit-resident').on('click', function() {
    const btn = $(this);

    // Set profile picture
    const profilePictureSrc = btn.data('picture');
    const $profilePicturePreview = $('#editProfilePicturePreview');
    if (profilePictureSrc) {
        $profilePicturePreview.attr('src', profilePictureSrc).show();
    } else {
        $profilePicturePreview.hide();
    }

    // Set ID picture
    const idPictureSrc = btn.data('id-image');
    const $idPicturePreview = $('#editIdPicturePreview');
    if (idPictureSrc) {
        $idPicturePreview.attr('src', idPictureSrc).show();
    } else {
        $idPicturePreview.hide();
    }
});
    </script>
</html>