export function header(isLoggedIn) {
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
            <a class="nav-link" href="./index.php"
              >Home <i class="bi bi-house-fill"></i
            ></a>
          </li>
          <li class="nav-item header-nav-item">
            <a class="nav-link" href="./services.php"
              >Service <i class="bi bi-person-fill"></i
            ></a>
          </li>
          <li class="nav-item header-nav-item">
            <a class="nav-link" href="#"
              >Household <i class="bi bi-house-door-fill"></i
            ></a>
          </li>
          <li class="nav-item header-nav-item">
            <a class="nav-link" href="#"
              >Officials <i class="bi bi-person-badge"></i
            ></a>
          </li>
          <li class="nav-item header-nav-item">
            <a class="nav-link" href="#"
              >About us <i class="bi bi-person-lines-fill"></i
            ></a>
          </li>
          
           ${
             isLoggedIn
               ? `

              <div class="dropdown dropdown-header w-25">
                  <button class="btn nav-item dropdown-toggle dropdown-btn" style = "color: yellow;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Settings
                  </button>
              
                    <div class="dropdown-menu dropdown-pop-up" aria-labelledby="dropdownMenuButton">
                     <a class="dropdown-item nav-link "  href="#">Account</a>
                     <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                     Logout
                     </button>
                    </div>
              </div>
            `
               : `
               <li class='nav-item'>
                <a class='nav-link' href='Login.php'>
                  Login <i class='bi bi-person-plus-fill'></i>
                </a>
              </li>                `
           }
        </ul>
      </div>
    </nav>
`;
  console.log(isLoggedIn);
}
