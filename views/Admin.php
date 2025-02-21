<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <title>Admin Dashboard</title>
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
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Admin Dashboard</a>
                <button class="navbar-toggler" type="button" onclick="toggleNavbar()" aria-controls="adminNavbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="adminNavbarNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="#adminResidents"><i class="bi bi-people-fill"></i> Residents</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#adminDocuments"><i class="bi bi-file-earmark-text-fill"></i> Document Requested</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="../controller/logoutController.php"> Logout <i class="bi bi-box-arrow-right"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <?php include 'modals/modalLogout.html'?>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></script>
    <script>
        function toggleNavbar() {
            var navbar = document.getElementById('adminNavbarNav');
            if (navbar.classList.contains('show')) {
                navbar.classList.remove('show');
            } else {
                navbar.classList.add('show');
            }
        }
    </script>
=======
    <title>Document</title>
</head>
<body>
    
>>>>>>> 13402c8bc95f4a096b919edd6564617aebca4d38
</body>
</html>