export function header(isLoggedIn) {
  const currentPath = window.location.pathname.split("/").pop();

  document.querySelector("#header").innerHTML = `
<nav class="navbar navbar-expand-lg navbar-light bg-light">
      <button
        class="navbar-toggler bg-light"
        type="button"
        data-toggle="collapse"
        data-target="#navbarNav"
        aria-controls="navbarNav"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse " id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item header-nav-item">
            <a class="nav-link ${
              currentPath === "index.php" ? "active" : ""
            }" href="./index.php"
              >Home <i class="bi bi-house-fill"></i
            ></a>
          </li>
          <li class="nav-item header-nav-item">
            <a class="nav-link ${
              currentPath === "services.php" ? "active" : ""
            }" href="./services.php"
              >Service <i class="bi bi-person-fill"></i
            ></a>
          </li>
          <li class="nav-item header-nav-item">
             <a class="nav-link ${
              currentPath === "Officials.php" ? "active" : ""
            }" href="./Officials.php"
              >Officials<i class="bi bi-person-badge"></i
            ></a>
          </li>
          <li class="nav-item header-nav-item">
            <a class="nav-link ${
              currentPath === "AboutUs.php" ? "active" : ""
            }" href="./AboutUs.php"
              >About&nbspUs<i class="bi bi-person-lines-fill"></i
            ></a>
          </li>
          
           ${
             isLoggedIn
               ? `
              <li class="nav-item header-nav-item">
              <div class="dropdown dropdown-header w-100">
                <button class="btn dropdown-toggle dropdown-btn" style="" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="../images/user.png" alt="profile" class="dropdown-icon" height="25px" width="25px"/>
                    <span class="dropdown-label">Profile</span>
                </button>

              <div class="dropdown-menu dropdown-pop-up" aria-labelledby="dropdownMenuButton">
                <button onclick="window.location.href='accountDashboard.php'" class="btn account-btn ${
                  currentPath === "accountDashboard.php" ? "active" : ""
                }">
                  Account
                </button>
                 <button onclick="window.location.href='userProfile.php'" class="btn account-btn ${
                  currentPath === "userProfile.php" ? "active" : ""
                }">
                  Profile
                </button>
                <button type="button" id = "dashboard" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  Logout
                </button>
              </div>
            </div>
            </li>
            `
               : `
               <li class='nav-item ${
                 currentPath === "Login.php" ? "active" : ""
               }'>
                <a class='nav-link' href='Login.php'>
                  Login <i class='bi bi-person-plus-fill'></i>
                </a>
              </li>`
           }
        </ul>
      </div>
    </nav>
`;
  console.log(currentPath);
}
