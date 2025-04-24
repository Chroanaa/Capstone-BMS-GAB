<?php
session_start();
$loginSession = $_SESSION['session'];
if(!$loginSession){
  header('Location: Login.php?error=notLoggedIn');
  exit();
}
var_dump($loginSession);
include '../controller/getUserInformation.php';
include '../controller/getUserCreds.php'; // Add this line to include getUserCreds.php

$userInfo = getUserInfo($loginSession);
$userCreds = getUserCreds($loginSession); // Get user credentials using the same session ID

// If no user info is found, redirect to login

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
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
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="styles.css" />
    <!-- Add to head section -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    
</head>
<body>
    <header id="header"></header>
    <main>
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card shadow-yellow my-4">
                        <div class="card-header bg-primary text-white">
                            <h2 class="h4 mb-0">User Profile <i class="bi bi-person-circle"></i></h2>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-md-4 text-center">
                                    <div class="profile-image-container mb-3">
                                        <img src="data:image/jpeg;base64,<?php echo $userInfo['picture']; ?>" class="img-fluid rounded-circle" style="width: 150px; height: 150px; object-fit: cover;" alt="Profile Picture">
                                    </div>
                                    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#updatePictureModal">
                                        Update Picture <i class="bi bi-camera"></i>
                                    </button>
                                </div>
                                <div class="col-md-8">
                                    <h3 class="h5 mb-3"><?php echo htmlspecialchars($userInfo['first_name'] . ' ' . $userInfo['middle_name'] . ' ' . $userInfo['last_name']); ?></h3>
                                    <p><i class="bi bi-envelope"></i> <?php echo htmlspecialchars($userInfo['email']); ?></p>
                                    <p><i class="bi bi-telephone"></i> <?php echo htmlspecialchars($userInfo['contact_number']); ?></p>
                                    <p><i class="bi bi-house"></i> <?php echo htmlspecialchars($userInfo['House/floor/bldgno.'] . ', ' . $userInfo['Street']); ?></p>
                                    <p><i class="bi bi-calendar3"></i> Resident since: <?php echo htmlspecialchars($userInfo['from']); ?> to <?php echo htmlspecialchars($userInfo['to']); ?></p>
                                </div>
                            </div>

                            <hr>

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="h5">Personal Information</h4>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                                    Edit Profile <i class="bi bi-pencil-square"></i>
                                </button>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <strong>Date of Birth:</strong> <?php echo htmlspecialchars($userInfo['date_of_birth']); ?>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <strong>Age:</strong> <?php echo htmlspecialchars($userInfo['Age']); ?>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <strong>Place of Birth:</strong> <?php echo htmlspecialchars($userInfo['place_of_birth']); ?>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <strong>Gender:</strong> <?php echo htmlspecialchars($userInfo['gender']); ?>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <strong>Civil Status:</strong> <?php echo htmlspecialchars($userInfo['civil_status']); ?>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <strong>Type of ID:</strong> <?php echo htmlspecialchars($userInfo['type_of_id']); ?>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <strong>Vehicle Ownership:</strong> <?php echo $userInfo['own_vehicle'] === 'Yes' ? 'Yes' : 'No'; ?>
                                    <?php if($userInfo['own_vehicle'] === 'Yes'): ?>
                                        (<?php echo htmlspecialchars($userInfo['vehicle_count']); ?> vehicle/s)
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <strong>House Floors:</strong> <?php echo htmlspecialchars($userInfo['floor_count']); ?>
                                </div>
                            </div>

                            <hr>

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="h5">Account Information</h4>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                                    Change Password <i class="bi bi-key"></i>
                                </button>
                            </div>
                            <div class="row">
                            <div class="col-md-6 mb-3">
                                <strong>Username:</strong> <?php echo htmlspecialchars($userCreds['Username'] ?? ''); ?>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Profile Modal -->
        <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editProfileForm" action="../controller/updateUserProfile.php" method="POST">
                            <input type="hidden" name="user_id" value="<?php echo $loginSession; ?>">
                            
                            <div class="row mb-3">
                                <div class="col-md-4 form-floating">
                                    <input type="text" id="firstName" name="firstName" class="form-control" placeholder="First Name" required value="<?php echo htmlspecialchars($userInfo['first_name']) ?? ""; ?>">
                                    <label for="firstName">First Name</label>
                                </div>
                                <div class="col-md-4 form-floating">
                                    <input type="text" id="middleName" name="middleName" class="form-control" placeholder="Middle Name" value="<?php echo htmlspecialchars($userInfo['middle_name']) ?? ""; ?>">
                                    <label for="middleName">Middle Name</label>
                                </div>
                                <div class="col-md-4 form-floating">
                                    <input type="text" id="lastName" name="lastName" class="form-control" placeholder="Last Name" required value="<?php echo htmlspecialchars($userInfo['last_name']) ?? ""; ?>">
                                    <label for="lastName">Last Name</label>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 form-floating">
                                    <input type="text" id="bldg" name="bldg" class="form-control" placeholder="House/Bldg/Floor no." required value="<?php echo htmlspecialchars($userInfo['House/floor/bldgno.']) ?? ""; ?>">
                                    <label for="bldg">House/Bldg/Floor no.</label>
                                </div>
                                <div class="col-md-6 form-floating">
                                    <input type="text" id="street" name="street" class="form-control" placeholder="Street" required value="<?php echo htmlspecialchars($userInfo['Street']) ?? ""; ?>">
                                    <label for="street">Street</label>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 form-floating">
                                    <input type="date" id="from" name="From" class="form-control" placeholder="From" required value="<?php echo htmlspecialchars($userInfo['from']) ?? ""; ?>">
                                    <label for="from">From</label>
                                </div>
                                <div class="col-md-6 form-floating">
                                    <input type="date" id="to" name="to" class="form-control" placeholder="To" required value="<?php echo htmlspecialchars($userInfo['to']) ?? ""; ?>">
                                    <label for="to">To</label>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 form-floating">
                                    <input type="date" id="date" name="dateOfBirth" class="form-control" placeholder="Date of Birth" required value="<?php echo htmlspecialchars($userInfo['date_of_birth']) ?? ""; ?>">
                                    <label for="date">Date of Birth</label>
                                </div>
                                <div class="col-md-6 form-floating">
                                    <input type="text" id="Age" name="Age" class="form-control" placeholder="Age" readonly value="<?php echo htmlspecialchars($userInfo['Age']) ?? ""; ?>">
                                    <label for="Age">Age</label>
                                </div>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" id="placeofbirth" name="placeOfBirth" class="form-control" placeholder="Place of Birth" required value="<?php echo htmlspecialchars($userInfo['place_of_birth']) ?? ""; ?>">
                                <label for="placeofbirth">Place of Birth</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" id="Contactnumber" name="contactNumber" class="form-control" placeholder="Contact Number" required value="<?php echo htmlspecialchars($userInfo['contact_number']) ?? ""; ?>">
                                <label for="Contactnumber">Contact Number</label>
                                <span class="text-danger" id="contactNumberError"></span>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="email" id="Email" name="Email" class="form-control" placeholder="Email" required value="<?php echo htmlspecialchars($userInfo['email']) ?? ""; ?>">
                                <label for="Email">Email</label>
                                <span class="text-danger" id="emailError"></span>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="mb-2"><b>Sex</b></label>
                                    <div class="form-check">
                                        <input type="radio" id="Male" name="gender" value="Male" class="form-check-input" <?php echo $userInfo['gender'] === 'Male' ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="Male">Male</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" id="Female" name="gender" value="Female" class="form-check-input" <?php echo $userInfo['gender'] === 'Female' ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="Female">Female</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="mb-2"><b>Civil Status</b></label>
                                    <div class="form-check">
                                        <input type="radio" id="Single" name="Civilstatus" value="Single" class="form-check-input" <?php echo $userInfo['civil_status'] === 'Single' ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="Single">Single</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" id="Separated" name="Civilstatus" value="separated" class="form-check-input" <?php echo $userInfo['civil_status'] === 'separated' ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="Separated">Separated</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" id="Married" name="Civilstatus" value="Married" class="form-check-input" <?php echo $userInfo['civil_status'] === 'Married' ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="Married">Married</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" id="Widow" name="Civilstatus" value="Widow" class="form-check-input" <?php echo $userInfo['civil_status'] === 'Widow' ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="Widow">Widow</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-floating mb-3 mt-3">
                                <select id="typeOfId" name="typeOfId" class="form-select" required>
                                    <option value="" disabled>Select Type of ID</option>
                                    <option value="Passport" <?php echo $userInfo['type_of_id'] === 'Passport' ? 'selected' : ''; ?>>Passport</option>
                                    <option value="Driver's License" <?php echo $userInfo['type_of_id'] === "Driver's License" ? 'selected' : ''; ?>>Driver's License</option>
                                    <option value="National ID" <?php echo $userInfo['type_of_id'] === 'National ID' ? 'selected' : ''; ?>>National ID</option>
                                    <option value="Voter's ID" <?php echo $userInfo['type_of_id'] === "Voter's ID" ? 'selected' : ''; ?>>Voter's ID</option>
                                    <option value="School ID" <?php echo $userInfo['type_of_id'] === 'School ID' ? 'selected' : ''; ?>>School ID</option>
                                </select>
                                <label for="typeOfId">Type of ID</label>
                            </div>

                            <div class="mb-3">
                                <label><b>Do you own a vehicle?</b></label>
                                <div class="form-check">
                                    <input type="radio" id="vehicleYes" name="vehicle" value="Yes" class="form-check-input" <?php echo $userInfo['own_vehicle'] === 'Yes' ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="vehicleYes">Yes</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" id="vehicleNo" name="vehicle" value="No" class="form-check-input" <?php echo $userInfo['own_vehicle'] === 'No' ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="vehicleNo">No</label>
                                </div>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="number" id="howManyVehicles" name="howManyVehicles" class="form-control" placeholder="How Many Vehicles" min="0" <?php echo $userInfo['own_vehicle'] === 'No' ? 'disabled' : ''; ?> value="<?php echo htmlspecialchars($userInfo['vehicle_count']); ?>">
                                <label for="howManyVehicles">How Many Vehicles</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="number" id="houseFloors" name="houseFloors" class="form-control" placeholder="How Many Floors" min="0" required value="<?php echo htmlspecialchars($userInfo['floor_count']); ?>">
                                <label for="houseFloors">House Floors</label>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Update Picture Modal -->
        <div class="modal fade" id="updatePictureModal" tabindex="-1" aria-labelledby="updatePictureModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="updatePictureModalLabel">Update Profile Picture</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="updatePictureForm" action="../controller/updateUserPicture.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="user_id" value="<?php echo $loginSession; ?>">
                            
                            <div class="mb-3">
                                <label for="profilePicture" class="form-label">Select New Profile Picture:</label>
                                <input class="form-control" type="file" id="profilePicture" name="user_picture" accept="image/*" required>
                            </div>
                            <div class="mb-3">
                                <img id="profilePicturePreview" src="#" alt="Profile Picture Preview" class="img-fluid" style="display: none; max-width: 100%; height: auto;">
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Update Picture</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Change Password Modal -->
        <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="changePasswordForm" action="../controller/updateUserPassword.php" method="POST">
                            <input type="hidden" name="user_id" value="<?php echo $loginSession; ?>">
                            
                            <div class="form-floating mb-3 position-relative">
                                <input type="password" id="currentPassword" name="currentPassword" class="form-control" placeholder="Current Password" required oninput="checkIfPasswordMatch(<?php echo $loginSession; ?>)">
                                <label for="currentPassword">Current Password</label>
                                <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y pe-3 toggle-password fs-5" style="cursor: pointer;"></i>
                                <span class="text-danger" id="currentPasswordError"></span>
                            </div>

                            <div class="form-floating mb-3 position-relative">
                                <input type="password" id="newPassword" name="newPassword" class="form-control" placeholder="New Password" required>
                                <label for="newPassword">New Password</label>
                                <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y pe-3 toggle-password fs-5" style="cursor: pointer;"></i>
                            </div>

                            <div class="form-floating mb-3 position-relative">
                                <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" placeholder="Confirm New Password" required>
                                <label for="confirmPassword">Confirm New Password</label>
                                <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y pe-3 toggle-password fs-5" style="cursor: pointer;"></i>
                                                                <span class="text-danger" id="confirmPasswordError"></span>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" id="changePasswordBtn" class="btn btn-warning">Change Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include 'modals/modalLogout.html'?>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
    <script type="module">
        import { header } from "./header.js";
        header(<?= $loginSession?>);
    
        document.addEventListener('DOMContentLoaded', function () {
    const changePasswordModal = document.getElementById('changePasswordModal');
    const newPasswordInput = document.getElementById('newPassword');
    const confirmPasswordInput = document.getElementById('confirmPassword');

    changePasswordModal.addEventListener('show.bs.modal', function () {
        newPasswordInput.disabled = true;
        confirmPasswordInput.disabled = true;
    });

    
});
        // Initialize Flatpickr
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
    </script>
    <script>
        // Handle vehicle radio buttons
        document.addEventListener('DOMContentLoaded', function() {
            const vehicleYes = document.getElementById('vehicleYes');
            const vehicleNo = document.getElementById('vehicleNo');
            const howManyVehicles = document.getElementById('howManyVehicles');
            
            if (vehicleYes && vehicleNo && howManyVehicles) {
                vehicleYes.addEventListener('change', function() {
                    if (vehicleYes.checked) {
                        howManyVehicles.disabled = false;
                    }
                });

                vehicleNo.addEventListener('change', function() {
                    if (vehicleNo.checked) {
                        howManyVehicles.disabled = true;
                        howManyVehicles.value = '';
                    }
                });
            }

            // Profile picture preview
            const profilePicture = document.getElementById('profilePicture');
            if (profilePicture) {
                profilePicture.addEventListener('change', function(event) {
                    const [file] = event.target.files;
                    if (file) {
                        const preview = document.getElementById('profilePicturePreview');
                        preview.src = URL.createObjectURL(file);
                        preview.style.display = 'block';
                    }
                });
            }

            // Toggle password visibility
            document.querySelectorAll('.toggle-password').forEach(function(toggleBtn) {
                toggleBtn.addEventListener('click', function() {
                    const passwordInput = this.previousElementSibling.previousElementSibling;
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
            });

            // Form submissions with SweetAlert
            document.getElementById('editProfileForm').addEventListener('submit', function(e) {
                e.preventDefault();
                
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to update your profile information?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#0d6efd',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, update it',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });

            document.getElementById('updatePictureForm').addEventListener('submit', function(e) {
                e.preventDefault();
                
                if (!document.getElementById('profilePicture').files.length) {
                    Swal.fire({
                        title: 'Error',
                        text: 'Please select a picture to upload.',
                        icon: 'error'
                    });
                    return;
                }

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to update your profile picture?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#0d6efd',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, update it',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });

            document.getElementById('changePasswordForm').addEventListener('submit', function(e) {
                e.preventDefault();
                
                const newPassword = document.getElementById('newPassword').value;
                const confirmPassword = document.getElementById('confirmPassword').value;
                
                if (newPassword !== confirmPassword) {
                    Swal.fire({
                        title: 'Error',
                        text: 'New password and confirm password do not match.',
                        icon: 'error'
                    });
                    return;
                }

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to change your password?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ffc107',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, change it',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });

            // Check for URL params for success/error messages
            const urlParams = new URLSearchParams(window.location.search);
            const status = urlParams.get('status');
            const action = urlParams.get('action');
            const message = urlParams.get('message');
            
            if (status === 'success' && action === 'profile_updated') {
                Swal.fire({
                    title: 'Success!',
                    text: 'Your profile has been updated successfully.',
                    icon: 'success',
                    confirmButtonColor: '#0d6efd'
                }).then(() => {
                    window.history.replaceState({}, document.title, window.location.pathname);
                });
            } else if (status === 'success' && action === 'picture_updated') {
                Swal.fire({
                    title: 'Success!',
                    text: 'Your profile picture has been updated successfully.',
                    icon: 'success',
                    confirmButtonColor: '#0d6efd'
                }).then(() => {
                    window.history.replaceState({}, document.title, window.location.pathname);
                });
            } else if (status === 'success' && action === 'password_changed') {
                Swal.fire({
                    title: 'Success!',
                    text: 'Your password has been changed successfully.',
                    icon: 'success',
                    confirmButtonColor: '#0d6efd'
                }).then(() => {
                    window.history.replaceState({}, document.title, window.location.pathname);
                });
            } else if (status === 'error') {
                Swal.fire({
                    title: 'Error!',
                    text: message || 'An error occurred. Please try again.',
                    icon: 'error',
                    confirmButtonColor: '#dc3545'
                }).then(() => {
                    window.history.replaceState({}, document.title, window.location.pathname);
                });
            }
        });
        
    function checkIfPasswordMatch(id) {
        let debounceTimer;
    clearTimeout(debounceTimer)
    const btn = document.getElementById('changePasswordBtn');
     
    
    debounceTimer = setTimeout(() => {
        const current_password = document.getElementById('currentPassword').value; 
        if(current_password == "") {
            document.getElementById('currentPasswordError').textContent = ' ';
            return;
        }
        fetch(`../controller/checkIfPasswordMatch.php?current_password=${encodeURIComponent(current_password)}&id=${id}`)
        .then(response => response.json())
        .then(data => {
            const currentPasswordError = document.getElementById('currentPasswordError');
            if (data.status === 'success') {
                currentPasswordError.textContent = ''; 
                btn.disabled = false;
                document.getElementById('newPassword').disabled = false;
                document.getElementById('confirmPassword').disabled = false;
            }
             else {
                currentPasswordError.textContent = data.message;
                btn.disabled = true; 
                document.getElementById('newPassword').disabled = true;
                document.getElementById('confirmPassword').disabled = true;
            }
        })
            
    }, 300); 
    document.getElementById("confirmPassword").addEventListener("input", function() {
        let debounceTimer;
        clearTimeout(debounceTimer)
        debounceTimer = setTimeout(() => {
            const newPassword = document.getElementById('newPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            const changePasswordBtn = document.getElementById('changePasswordBtn');
            
            if (newPassword !== confirmPassword) {
                changePasswordBtn.disabled = true;
                document.getElementById('confirmPasswordError').textContent = 'Passwords do not match.';
            } else {
                changePasswordBtn.disabled = false;
                document.getElementById('confirmPasswordError').textContent = '';
            }
        }, 300);
    });
}

// Add live validation for contact number
const contactNumberField = document.getElementById('Contactnumber');
if (contactNumberField) {
    // Add error span if it doesn't exist yet
    let errorSpan = document.getElementById('contactNumberError');
    if (!errorSpan) {
        errorSpan = document.createElement('span');
        errorSpan.id = 'contactNumberError';
        errorSpan.className = 'text-danger';
        contactNumberField.parentNode.appendChild(errorSpan);
    }

    contactNumberField.addEventListener('blur', function() {
        // Philippines phone number format (can start with +63 or 0, followed by 10 digits)
        const phoneRegex = /^(\+63|0)[0-9]{10}$/;
        
        if (!phoneRegex.test(this.value) && this.value.trim()) {
            errorSpan.textContent = 'Please enter a valid Philippine phone number (e.g., 09XXXXXXXXX or +639XXXXXXXXX)';
            document.querySelector('#editProfileForm button[type="submit"]').disabled = true;
        } else {
            errorSpan.textContent = '';
            document.querySelector('#editProfileForm button[type="submit"]').disabled = false;
        }
    });

    // Format input as user types
    contactNumberField.addEventListener('input', function() {
        let value = this.value.replace(/\D/g, ''); // Remove non-digits
        
        // If starts with 63, format as +63
        if (value.startsWith('63') && value.length > 2) {
            value = '+' + value;
        } 
        // If starts with 0, keep as is
        else if (value.startsWith('0')) {
            // Keep as is
        }
        // If doesn't start with 0 or +63, add 0 prefix
        else if (value && !value.startsWith('+63')) {
            value = '0' + value;
        }
        
        // Update input value with formatted number
        this.value = value;
    });
}
    </script>
</body>
</html>