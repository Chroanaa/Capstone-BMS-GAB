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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</head>
<body>
  <div id="adminHeader"></div>
  <div class="residents-main-container">
  <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h5 blue">Residents</h1>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addResidentModal">
            <i class="bi bi-person-plus"></i> Add Resident
        </button>
    </div>
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
                        data-civil="<?php echo htmlspecialchars(trim($resident['civil_status'])); ?>">
                        <i class="bi bi-pencil"></i>
                    </button>
                        <a href="#" class="delete-link btn btn-danger btn-sm" data-id="<?php echo $resident['creds_id'] ?>">
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
                    <!-- Add after the profile picture section in the Add Resident Modal -->
                    <div class="row mb-3">
                        <div class="col-md-6 form-floating">
                            <input type="text" id="username" name="username" class="form-control" placeholder="Username">
                            <label for="username">Username (Optional)</label>
                            <span class="text-danger" id="usernameError"></span>

                        </div>
                        <div class="col-md-6 form-floating">
                            <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                            <label for="password">Password (Optional)</label>
                            <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y pe-3 toggle-password fs-5" style="cursor: pointer;"></i>
                        </div>
                    </div>

                    <!-- Residence -->
                    <h6 class="mb-3">Residence</h6>
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
                    <h6 class="mb-3">Residency Period</h6>
                    <div class="row mb-3">
                        <div class="col-md-6 form-floating">
                            <input type="date" id="from" name="From" class="form-control" required>
                            <label for="from">From</label>
                        </div>
                        <div class="col-md-6 form-floating">
                            <input type="date" id="to" name="to" class="form-control" required>
                            <label for="to">To</label>
                        </div>
                    </div>

                    <!-- Personal Details -->
                    <div class="row mb-3">
                        <div class="col-md-6 form-floating">
                            <input type="date" id="date" name="date" class="form-control" required>
                            <label for="date">Date of Birth</label>
                        </div>
                        <div class="col-md-6 form-floating">
                            <input type="text" id="Age" name="Age" class="form-control" readonly>
                            <label for="Age">Age</label>
                        </div>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" id="placeofbirth" name="placeofbirth" class="form-control" placeholder="Place of birth" required>
                        <label for="placeofbirth">Place of birth</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" id="Contactnumber" name="Contactnumber" class="form-control" placeholder="Contact number" required>
                        <label for="Contactnumber">Contact number</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" id="Email" name="Email" class="form-control" placeholder="Email" required>
                        <label for="Contactnumber">Email</label>
                    </div>

                    <!-- Sex and Civil Status -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="mb-2"><b>Sex</b></label>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="Male" name="sex" value="Male" required>
                                <label class="form-check-label" for="Male">Male</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="Female" name="sex" value="Female">
                                <label class="form-check-label" for="Female">Female</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="mb-2"><b>Civil Status</b></label>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="Single" name="Civilstatus" value="Single" required>
                                <label class="form-check-label" for="Single">Single</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="Married" name="Civilstatus" value="Married">
                                <label class="form-check-label" for="Married">Married</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="Separated" name="Civilstatus" value="Separated">
                                <label class="form-check-label" for="Separated">Separated</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="Widow" name="Civilstatus" value="Widow">
                                <label class="form-check-label" for="Widow">Widow</label>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Picture -->
                    <div class="mb-3">
                        <label for="profilePicture" class="form-label">Profile Picture</label>
                        <input type="file" class="form-control" id="profilePicture" name="profilePicture" accept="image/*" required>
                    </div>
                    <div class="mb-3">
                        <img id="profilePicturePreview" src="#" alt="Profile Picture Preview" class="img-fluid" style="display: none; max-width: 200px;">
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id = "submitBtn">Add Resident</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Resident Modal -->
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
            <form id="editResidentForm" action="../controller/editResidentController.php" method="post">
                    <input type="hidden" id="edit_id" name="id">
                    <input type="hidden" id="edit_creds_id" name="creds_id"> <!-- Add this line -->
    

                    
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

                                        <!-- Add after personal information section in the Edit Resident Modal -->
                  
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

                    <!-- Personal Details -->
                    <div class="row mb-3">
                        <div class="col-md-6 form-floating">
                            <input type="date" id="edit_date" name="date" class="form-control" required>
                            <label for="edit_date">Date of Birth</label>
                        </div>
                        <div class="col-md-6 form-floating">
                            <input type="text" id="edit_Age" name="Age" class="form-control" readonly>
                            <label for="edit_Age">Age</label>
                        </div>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" id="edit_placeofbirth" name="placeofbirth" class="form-control" placeholder="Place of birth" required>
                        <label for="edit_placeofbirth">Place of birth</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" id="edit_Contactnumber" name="Contactnumber" class="form-control" placeholder="Contact number" required>
                        <label for="edit_Contactnumber">Contact number</label>
                    </div>

                    <!-- Sex and Civil Status -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="mb-2"><b>Sex</b></label>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="edit_Male" name="sex" value="Male" required>
                                <label class="form-check-label" for="edit_Male">Male</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="edit_Female" name="sex" value="Female">
                                <label class="form-check-label" for="edit_Female">Female</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="mb-2"><b>Civil Status</b></label>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="edit_Single" name="Civilstatus" value="Single" required>
                                <label class="form-check-label" for="edit_Single">Single</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="edit_Married" name="Civilstatus" value="Married">
                                <label class="form-check-label" for="edit_Married">Married</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="edit_Separated" name="Civilstatus" value="Separated">
                                <label class="form-check-label" for="edit_Separated">Separated</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="edit_Widow" name="Civilstatus" value="Widow">
                                <label class="form-check-label" for="edit_Widow">Widow</label>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-warning" id="saveChangesBtn">Save Changes</button>
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
    $('#edit_username').val(btn.data('username'));
    $('#edit_password').val('');
    $('#edit_id').val(btn.data('id'));
    $('#edit_creds_id').val(btn.data('creds-id')); // Add this line
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
    
    switch(selectedDocument){
        case "1":
        window.location.href = `documents/BarangayClearance.php?resident_id=${id}`; 
            break;
        case "2":
            window.location.href = `documents/BarangayID.php?resident_id=${id}`;
            break;
        case "3":
            window.location.href = `documents/BusinessPermit.php?resident_id=${id}`;
            break;
        case "4":
        window.location.href = `documents/CertificateOfIndigency.php?resident_id=${id}`;
            break;
        case "5":
            window.location.href = `documents/FirstTimeJobSeeker.php?resident_id=${id}`;
            break;
        case "6":
            window.location.href = `documents/CertificateOfLiveBirth.php?resident_id=${id}`;
            break;
        case "7":
            window.location.href = `documents/CertificateOfGuardianship.php?resident_id=${id}`;
            break;
        case "8":
            window.location.href = `documents/HealthCertificate.php?resident_id=${id}`;
            break;
            
       
    }
});
    </script>
</html>