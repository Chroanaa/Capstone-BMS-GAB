export function header(isLoggedIn) {
    const headerDiv = document.getElementById('adminHeader');
    if (headerDiv) {
        headerDiv.innerHTML = `
            <nav class="navbar navbar-expand-lg navbar-light bg-light admin-navbar">
                <div class="container-fluid">
                    <a class="navbar-brand admin-navbar-brand" href="#">Admin</a>
                    <button class="navbar-toggler admin-navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbarNav" aria-controls="adminNavbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="adminNavbarNav">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 navbar-nav-unique">
                            <li class="nav-item">
                                <a class="nav-link admin-nav-link" href="AdminAllResidents.php"><i class="bi bi-people-fill"></i> Residents</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link admin-nav-link" href="AdminDocumentRequest.php"><i class="bi bi-file-earmark-text-fill"></i> Document Requested</a>
                            </li>
                        </ul>
                        <ul class="navbar-nav">
                            ${isLoggedIn ? `
                            <li class="nav-item">
                                <button class="nav-link admin-nav-link btn" data-bs-toggle="modal" data-bs-target="#exampleModal"> Logout <i class="bi bi-box-arrow-right"></i></button>
                            </li>
                            ` : ''}
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Logout Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="modal-header-img-container">
                                <img src="../images/alert-img.png" alt="alert" width="100px" height="100px"/>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <h4>Are you sure you want to logout?</h4>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary logout-close-btn" data-bs-dismiss="modal">Close</button>
                            <a href="../controller/logoutController.php" class="btn btn-danger">Logout <i class="bi bi-box-arrow-in-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }
}