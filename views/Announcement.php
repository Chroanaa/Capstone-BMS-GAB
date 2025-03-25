<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: AdminLogin.php?error=notLoggedIn');
    exit();
}
include('../databaseconn/connection.php');

// Fetch announcements
$sql = "SELECT * FROM announcement_tbl ORDER BY time_Created DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$announcements = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announcement</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css" />
    <style>
        .card {
            transition: transform 0.2s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .dropdown-toggle::after {
            display: none;
        }
        .btn-link {
            text-decoration: none;
        }
        .card-text {
            color: #6c757d;
        }
        .announcement-card.d-none {
            display: none;
        }
    </style>
</head>
<body id="adminDashboard">
    <div id="adminHeader"></div>
    
    <div class="residents-main-container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h5 blue">Announcements</h1>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAnnouncementModal">
                <i class="bi bi-plus-circle"></i> Add Announcement
            </button>
        </div>

        <div class="row row-cols-1 row-cols-md-3 g-4" id="announcementsContainer">
            <?php foreach ($announcements as $index => $announcement): 
                // Generate the correct image data URI
                $imageData = '';
                if (!empty($announcement['attachment'])) {
                    $finfo = new finfo(FILEINFO_MIME_TYPE);
                    $mimeType = $finfo->buffer($announcement['attachment']);
                    $imageData = 'data:' . $mimeType . ';base64,' . $announcement['attachment'];
                }
            ?>
                <div class="col announcement-card <?php echo $index >= 3 ? 'd-none' : '' ?>" data-index="<?php echo $index; ?>">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <h5 class="card-title"><?php echo htmlspecialchars($announcement['title']); ?></h5>
                                <div class="dropdown">
                                    <button class="btn btn-link text-dark p-0" type="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                          <li>
                                              <button class="dropdown-item view-announcement" 
                                                      data-id="<?php echo $announcement['id']; ?>"
                                                      data-title="<?php echo htmlspecialchars($announcement['title']); ?>"
                                                      data-content="<?php echo htmlspecialchars($announcement['content']); ?>"
                                                      data-image="<?php echo $imageData; ?>"
                                                      data-bs-toggle="modal" 
                                                      data-bs-target="#viewAnnouncementModal">
                                                  <i class="bi bi-eye view-icon"></i> View
                                              </button>
                                          </li>
                                          <li>
                                              <button class="dropdown-item edit-announcement" 
                                                      data-id="<?php echo $announcement['id']; ?>"
                                                      data-title="<?php echo htmlspecialchars($announcement['title']); ?>"
                                                      data-content="<?php echo htmlspecialchars($announcement['content']); ?>"
                                                      data-image="<?php echo $imageData; ?>"
                                                      data-bs-toggle="modal" 
                                                      data-bs-target="#editAnnouncementModal">
                                                  <i class="bi bi-pencil edit-icon"></i> Edit
                                              </button>
                                          </li>
                                          <li>
                                              <button class="dropdown-item delete-announcement" 
                                                      data-id="<?php echo $announcement['id']; ?>">
                                                  <i class="bi bi-trash delete-icon"></i> Delete
                                              </button>
                                          </li>
                                      </ul>
                                </div>
                            </div>
                            <p class="card-text text-muted small mb-2">
                                <i class="bi bi-calendar"></i> 
                                <?php echo date('F d, Y', strtotime($announcement['time_Created'])); ?>
                            </p>
                            <p class="card-text content-preview">
                                <?php 
                                $content = htmlspecialchars($announcement['content']);
                                $shortContent = substr($content, 0, 100);
                                echo $shortContent;
                                if (strlen($content) > 100) {
                                    echo '<span class="dots">...</span>';
                                    echo '<span class="more-content d-none">' . substr($content, 100) . '</span>';
                                    echo '<br><button class="btn btn-link p-0 see-more-btn">See More</button>';
                                }
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if (count($announcements) > 3): ?>
          <div class="text-center mt-3">
              <button id="seeMoreBtn" class="btn btn-primary">See More</button>
          </div>
      <?php endif; ?>
    </div>

    <!-- View Modal -->
    <div class="modal fade" id="viewAnnouncementModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewTitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <img id="viewImage" src="" class="img-fluid mb-3" style="max-height: 50vh; object-fit: contain; display: none;">
                    <p id="viewContent" class="mb-0"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editAnnouncementModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="../controller/editAnnouncementController.php" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Announcement</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="editId">
                        <div class="mb-3">
                            <label for="editTitle" class="form-label">Title</label>
                            <input type="text" class="form-control" id="editTitle" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="editContent" class="form-label">Content</label>
                            <textarea class="form-control" id="editContent" name="content" rows="5" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="editImage" class="form-label">Image</label>
                            <input type="file" class="form-control" id="editImage" name="image" accept="image/*">
                            <img id="editImagePreview" src="" class="img-fluid mt-2" style="max-height: 200px; display: none;">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Add Announcement Modal -->
<div class="modal fade" id="addAnnouncementModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="../controller/postAnnouncementController.php" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Announcement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="addTitle" class="form-label">Title</label>
                        <input type="text" class="form-control" id="addTitle" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="addContent" class="form-label">Content</label>
                        <textarea class="form-control" id="addContent" name="content" rows="5" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="addImage" class="form-label">Image (Optional)</label>
                        <input type="file" class="form-control" id="addImage" name="attachment" accept="image/*">
                        <img id="addImagePreview" src="" class="img-fluid mt-2" style="max-height: 200px; display: none;">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Announcement</button>
                </div>
            </form>
        </div>
    </div>
</div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            // See More Cards functionality
            let visibleCount = 3;
            const increment = 3;
            const totalAnnouncements = $('.announcement-card').length;

            $('#seeMoreBtn').click(function() {
                const cards = $('.announcement-card.d-none');
                cards.slice(0, increment).removeClass('d-none');
                visibleCount += increment;

                // Hide the "See More" button if all announcements are visible
                if (visibleCount >= totalAnnouncements) {
                    $(this).hide();
                }
            });


            // View Announcement
            $('.view-announcement').click(function() {
                $('#viewTitle').text($(this).data('title'));
                $('#viewContent').text($(this).data('content'));
                
                // Get the image data from the data attribute
                const imageSrc = $(this).data('image');
                const $image = $('#viewImage');
                
                // If there is an image, display it; otherwise, hide the image element
                if (imageSrc) {
                    $image.attr('src', imageSrc).show();
                } else {
                    $image.hide();
                }
            });

            // Edit Announcement
            $('.edit-announcement').click(function() {
                $('#editId').val($(this).data('id'));
                $('#editTitle').val($(this).data('title'));
                $('#editContent').val($(this).data('content'));
                const imageSrc = $(this).data('image');
                const $preview = $('#editImagePreview');
                if (imageSrc) {
                    $preview.attr('src', imageSrc).show();
                } else {
                    $preview.hide();
                }
            });

            // Image Preview for Edit Modal
            $('#editImage').on('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#editImagePreview').attr('src', e.target.result).show();
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Delete Announcement
            // Replace or modify the existing delete announcement code
            $('.delete-announcement').click(function() {
                const id = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `../controller/deleteAnnouncementController.php`,
                            type: 'POST',
                            data: { id: id },
                            success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: 'Announcement has been deleted.',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(() => {
                                    // Reload the page to reflect changes
                                    location.reload();
                                });
                            },
                            error: function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: 'Failed to delete announcement.',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
    <script>
       <?php if(isset($_SESSION['alert'])): ?>
        Swal.fire({
            icon: '<?php echo $_SESSION['alert']['type']; ?>',
            title: '<?php echo $_SESSION['alert']['title']; ?>',
            text: '<?php echo $_SESSION['alert']['message']; ?>',
            showConfirmButton: false,
            timer: 1500
        });
        <?php unset($_SESSION['alert']); ?>
    <?php endif; ?>

    // Add to the existing $(document).ready() function
$('#addImage').on('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            $('#addImagePreview').attr('src', e.target.result).show();
        };
        reader.readAsDataURL(file);
    }
});
</script>
    <script type="module">
      import { header } from './adminHeader.js';
    header(false);
    </script>
</body>
</html>