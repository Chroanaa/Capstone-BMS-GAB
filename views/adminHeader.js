export function header() {
  const currentPath = window.location.pathname.split("/").pop();
  const headerDiv = document.getElementById("adminHeader");

  if (headerDiv) {
    headerDiv.innerHTML = `
              <nav class="navbar navbar-expand-lg navbar-light bg-light admin-navbar">
                  <div class="container-fluid">
                      <a class="navbar-brand admin-navbar-brand ${
                        currentPath === "Admin.php" ? "active" : ""
                      }" href="Admin.php">Admin</a>
                      <button class="navbar-toggler admin-navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbarNav" aria-controls="adminNavbarNav" aria-expanded="false" aria-label="Toggle navigation">
                          <span class="navbar-toggler-icon"></span>
                      </button>
                      <div class="collapse navbar-collapse" id="adminNavbarNav">
                          <ul class="navbar-nav me-auto mb-2 mb-lg-0 navbar-nav-unique">
                              <li class="nav-item ${
                                currentPath === "AdminAllResidents.php"
                                  ? "active"
                                  : ""
                              }">
                                  <a class="nav-link admin-nav-link" href="AdminAllResidents.php"><i class="bi bi-people-fill"></i> Residents</a>
                              </li>
                              <li class="nav-item ${
                                currentPath === "AdminDocumentRequest.php"
                                  ? "active"
                                  : ""
                              }">
                                  <a class="nav-link admin-nav-link" href="AdminDocumentRequest.php"><i class="bi bi-file-earmark-text-fill"></i> Document Requested</a>
                              </li>
                              <li class="nav-item ${
                                currentPath === "TransactionLogs.php"
                                  ? "active"
                                  : ""
                              }">
                                  <a class="nav-link admin-nav-link" href="TransactionLogs.php"><i class="bi bi-clock-history"></i> Audit Logs</a>
                              </li>
                              <li class="nav-item ${
                                currentPath === "Announcement.php"
                                  ? "active"
                                  : ""
                              }">
                                  <a class="nav-link admin-nav-link" href="Announcement.php"><i class="bi bi-megaphone"></i> Announcement</a>
                              </li>
                               <li class="nav-item ${
                                 currentPath === "Household.php" ? "active" : ""
                               }">
                                  <a class="nav-link admin-nav-link" href="Household.php"><i class="bi bi-house"></i> Household</a>
                              </li>
                          </ul>
                          <ul class="navbar-nav">
                              <li class="nav-item">
                                  <a class="nav-link admin-logout-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                      <i class="bi bi-box-arrow-right"></i> Logout
                                  </a>
                              </li>
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
                              <a href="../controller/adminLogoutController.php" class="btn btn-danger">Logout <i class="bi bi-box-arrow-in-right"></i></a>
                          </div>
                      </div>
                  </div>
              </div>
          `;
  }
}
