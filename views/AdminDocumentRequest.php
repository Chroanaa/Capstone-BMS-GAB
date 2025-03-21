<?php
function getAllDocumentRequest(){
    include ('../databaseconn/connection.php');
    $conn = $GLOBALS['conn'];
    $sql = "SELECT d.*, u.*, d.id as document_id,
            u.first_name as Firstname,
            u.middle_name,
            u.last_name as Lastname 
            FROM document_requested d
            JOIN user_info u
            ON d.user_id = u.creds_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
}
function getOthersDocumentRequest(){
    include ('../databaseconn/connection.php');
    $conn = $GLOBALS['conn'];
    $sql = "SELECT d.*,u.*,d.id as 'document_id',ui.first_name as 'requested_by_first_name',ui.middle_name as 'requested_by_middle_name',ui.last_name as 'requested_by_last_name'
    FROM document_requested_for_others d
    JOIN requested_for_others_info u
    ON d.requestor_id = u.id
    JOIN user_info ui ON ui.creds_id = d.user_requestor_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
}
$others = getOthersDocumentRequest();
$documents = getAllDocumentRequest();

function formatDocumentName($documentName) {
    return ucwords(str_replace('_', ' ', $documentName));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Request</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="styles.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body>
  <div id="adminHeader"></div>
  <div class="residents-main-container">
    <h1 class="text-center h5 blue">Document Requests</h1>
    <div class="table-responsive">
        <table id="documentRequestTable" class="table table-striped table-bordered " style="width:100%">
        <thead>
            <tr>
                <th>Fullname</th>
                <th>Document Requested</th>
                <th>Purpose</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($documents as $document): ?>
                <?php $fullname = trim($document['first_name'] . ' ' . 
                ($document['middle_name'] ? $document['middle_name'] . ' ' : '') . 
                $document['last_name']); ?>
                <tr>
                    <td><?php echo $fullname; ?></td>
                    <td><?php echo formatDocumentName($document['documents_requested']); ?></td>
                    <td><?php echo $document['purpose']; ?></td>
                    <td><?php echo $document['status']; ?></td>
                    <td>
                    <button class="btn btn-info btn-sm view-btn" 
                            data-fullname="<?= htmlspecialchars($fullname) ?>"
                            data-document="<?= htmlspecialchars(formatDocumentName($document['documents_requested'])) ?>"
                            data-purpose="<?= htmlspecialchars($document['purpose']) ?>"
                            data-status="<?= htmlspecialchars($document['status']) ?>"
                            data-toggle="modal" 
                            data-target="#viewDocumentModal">
                        View
                    </button>
                    <?php if($document['status'] === 'Pending'): ?>
                            <form action="../controller/approveDocumentRequest.php" method="POST" class="d-inline">
                                <input type="hidden" name="id" value="<?php echo $document['document_id']; ?>">
                                <button type="submit" class="btn btn-success btn-sm">Approve</button>
                            </form>
                            <form action="../controller/rejectDocumentRequest.php" method="POST" class="d-inline">
                                <input type="hidden" name="id" value="<?php echo $document['document_id']; ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                            </form>
                        <?php else: ?>
                           <?php if($document['status'] === 'Approved'): ?>
                            <form action="../controller/undoOthersDocumentRequest.php" method="POST" class="d-inline">
                                <input type="hidden" name="id" value="<?php echo $document['document_id']; ?>">
                                <button type="submit" class="btn btn-warning btn-sm">Cancel</button>
                                
                            </form>
                        <button onclick="setResidentIdUrlId(<?php echo $document['id'] ?>)" data-toggle="modal" data-target="#issue-document" class="btn-primary btn btn-sm">
                            Issue a document
                        </button>
                        <?php else: ?>
                        <form action="../controller/undoOthersDocumentRequest.php" method="POST" class="d-inline">
                                <input type="hidden" name="id" value="<?php echo $document['document_id']; ?>">
                                <button type="submit" class="btn btn-warning btn-sm">Cancel</button>
                        </form>
                        <?php endif; ?>
                        <?php endif; ?>
</td>
                </tr>
            <?php endforeach; ?>
            <?php foreach($others as $other): ?>
                <?php $fullname = $other['first_name'] . " " . $other['middle_name'] . " " . $other['last_name']; ?>
                <?php $requested_by_fullname = $other['requested_by_first_name'] . " " . $other['requested_by_middle_name'] . " " . $other['requested_by_last_name']; ?>

                
                <tr>
                    <td><?php echo $fullname; ?></td>
                    <td><?php echo formatDocumentName($other['documents_requested']); ?></td>
                    <td><?php echo $other['purpose']; ?></td>
                    <td><?php echo $other['status']; ?></td>
                    <td>
                    <button class="btn btn-info btn-sm view-btn-others" 
                            data-fullname="<?= htmlspecialchars($fullname) ?>"
                            data-requested-by="<?= htmlspecialchars($requested_by_fullname) ?>"
                            data-document="<?= htmlspecialchars(formatDocumentName($other['documents_requested'])) ?>"
                            data-purpose="<?= htmlspecialchars($other['purpose']) ?>"
                            data-status="<?= htmlspecialchars($other['status']) ?>"
                            data-toggle="modal" 
                            data-target="#viewDocumentModalOthers">
                        View
                    </button>
                        <?php if($other['status'] === 'Pending'): ?>
                            <form action="../controller/approveOthersDocumentRequest.php" method="POST" class="d-inline">
                                <input type="hidden" name="id" value="<?php echo $other['document_id']; ?>">
                                <button type="submit" class="btn btn-success btn-sm">Approve</button>
                            </form>
                            <form action="../controller/rejectOthersDocumentRequest.php" method="POST" class="d-inline">
                                <input type="hidden" name="id" value="<?php echo $other['document_id']; ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                            </form>
                        <?php else: ?>
                        <?php if($other['status'] === 'Approved'): ?>
                            <form action="../controller/undoOthersDocumentRequest.php" method="POST" class="d-inline">
                                <input type="hidden" name="id" value="<?php echo $other['document_id']; ?>">
                                <button type="submit" class="btn btn-warning btn-sm">Cancel</button>
                                
                            </form>
                        <button onclick="setOthersIdUrlId(<?php echo $other['user_requestor_id'] ?>)" data-toggle="modal" data-target="#issue-document" class="btn-primary btn btn-sm">
                            Issue a document
                        </button>
                        <?php else: ?>
                        <form action="../controller/undoOthersDocumentRequest.php" method="POST" class="d-inline">
                                <input type="hidden" name="id" value="<?php echo $other['document_id']; ?>">
                                <button type="submit" class="btn btn-warning btn-sm">Cancel</button>
                        </form>
                        <?php endif; ?>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
                        </div>



<!-- Issue document Modal -->
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

  <!-- View Document Modal -->
<div class="modal fade" id="viewDocumentModal" tabindex="-1" role="dialog" aria-labelledby="viewDocumentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="viewDocumentModalLabel">Document Request Details</h5>
                <button type="button" class="close text-white print-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <dl class="row">
                    <dt class="col-sm-4">Full Name:</dt>
                    <dd class="col-sm-8" id="viewFullname">-</dd>

                    <dt class="col-sm-4">Requested:</dt>
                    <dd class="col-sm-8" id="viewDocument">-</dd>

                    <dt class="col-sm-4">Purpose:</dt>
                    <dd class="col-sm-8" id="viewPurpose">-</dd>

                    <dt class="col-sm-4">Status:</dt>
                    <dd class="col-sm-8" id="viewStatus">-</dd>
                </dl>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="viewDocumentModalOthers" tabindex="-1" role="dialog" aria-labelledby="viewDocumentModalOthers" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="viewDocumentModalLabel">Document Request Details</h5>
                <button type="button" class="close text-white print-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <dl class="row">
                    <dt class="col-sm-4">Requested For:</dt>
                    <dd class="col-sm-8" id="viewRequestedOthers">-</dd>

                    <dt class="col-sm-4">Requested By:</dt>
                    <dd class="col-sm-8" id="viewRequestedBy">-</dd>

                    <dt class="col-sm-4">Requested:</dt>
                    <dd class="col-sm-8" id="viewDocumentOthers">-</dd>

                    <dt class="col-sm-4">Purpose:</dt>
                    <dd class="col-sm-8" id="viewPurposeOthers">-</dd>

                    <dt class="col-sm-4">Status:</dt>
                    <dd class="col-sm-8" id="viewStatusOthers">-</dd>
                </dl>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    function setUrlId(id){
        const newUrl = `${window.location.protocol}//${window.location.host}${window.location.pathname}?id=${id}`;
        window.history.pushState({ path: newUrl }, '', newUrl);
    }
    </script>
  <script>
  $(document).ready(function() {
    $('#documentRequestTable').DataTable({ /* ... existing datatable config ... */ });

    // SweetAlert for status messages
    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('status');
    
    $(document).ready(function() {
    // ... existing datatable initialization ...

    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('status');
    
    if (status === 'approved') {
        Swal.fire('Approved!', 'Document request has been approved.', 'success');
    } else if (status === 'rejected') {
        Swal.fire('Rejected!', 'Document request has been rejected.', 'error');
    } else if (status === 'undone') {
        Swal.fire('Cancelled!', 'Document Cancelled', 'info');
    } else if (status === 'error') {
        Swal.fire('Error!', 'An error occurred.', 'error');
    }
    
    // Clear URL parameters after showing alert
    history.replaceState({}, document.title, window.location.pathname);
  });
  $('.dataTables_filter input').attr('placeholder', 'Search by Name...');
    }
    
  );
   function setResidentIdUrlId(id){
        const newUrl = `${window.location.protocol}//${window.location.host}${window.location.pathname}?resident_id=${id}`;
        window.history.pushState({ path: newUrl }, '', newUrl);
   }
   function setOthersIdUrlId(id){
        const newUrl = `${window.location.protocol}//${window.location.host}${window.location.pathname}?others_id=${id}`;
        window.history.pushState({ path: newUrl }, '', newUrl);
   }

   // Add this to your existing script section
$(document).ready(function() {
    // Handle view button click
    $('.view-btn').on('click', function() {
        const fullname = $(this).data('fullname');
        const document = $(this).data('document');
        const purpose = $(this).data('purpose');
        const status = $(this).data('status');

        $('#viewFullname').text(fullname);
        $('#viewDocument').text(document);
        $('#viewPurpose').text(purpose);
        $('#viewStatus').text(status);
    });
     $('.view-btn-others').on('click', function() {
        const fullname = $(this).data('fullname');
        const requestedBy = $(this).data('requested-by');
        const document = $(this).data('document');
        const purpose = $(this).data('purpose');
        const status = $(this).data('status');

        $('#viewRequestedOthers').text(fullname);
        $('#viewRequestedBy').text(requestedBy);
        $('#viewDocumentOthers').text(document);
        $('#viewPurposeOthers').text(purpose);
        $('#viewStatusOthers').text(status);
    });
});
</script>
</body>
</html>