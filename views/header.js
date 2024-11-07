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
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="./index.php"
              >Home <i class="bi bi-house-fill"></i
            ></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./services.php"
              >Service <i class="bi bi-person-fill"></i
            ></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"
              >Household <i class="bi bi-house-door-fill"></i
            ></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"
              >Officials <i class="bi bi-person-badge"></i
            ></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"
              >About us <i class="bi bi-person-lines-fill"></i
            ></a>
          </li>
           ${
             isLoggedIn
               ? `
             <li class='nav-item'>
                <a class='nav-link' href='Login.php'>
                  Account<i class='bi bi-person-plus-fill'></i>
                </a>
              </li>
            `
               : `<div class="dropdown">
                  <button class="btn nav-item dropdown-toggle" style = "color: yellow;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Dropdown button
                  </button>
                  <div class="dropdown-menu w-25" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item nav-link "  href="#">Account</a>
                  <a class="dropdown-item nav-link" href="#">Sign Out</a>
                </div>
                </div>`
           }
        </ul>
      </div>
    </nav>
`;
}
