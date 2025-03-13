<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-dark bg-opacity-25 m-0 shadow-lg">
    <div class="container">
        <!-- logo -->
        <a class="navbar-brand text-light" href="#" id="Logo">
            <h3>Stay<span id="stayscan">Scan</span></h3>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Collapsible Menu -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto text-center">
                <li class="nav-item mx-2"><a class="nav-link text-white" href="../frames/Homepage.php">Home</a></li>
                <li class="nav-item mx-2"><a class="nav-link text-white" href="#featured">Room</a></li>
                <li class="nav-item mx-2"><a class="nav-link text-white" href="#About">About</a></li>
                <li class="nav-item mx-2"><a class="nav-link text-white" href="#Contact">Contact</a></li>
            </ul> 
            <!-- Profile Menu -->
            <div class="col-lg-2 d-flex flex-column justify-content-center align-items-center position-relative dropdown" id="ProfileDrop">
                <button class="btn w-100 dropdown-toggle text-white" type="button" id="profileMenu" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle"></i> PROFILE
                </button>
                <ul class="dropdown-menu position-absolute" aria-labelledby="profileMenu" id="ProfileDrop">
                    <li><a class="dropdown-item text-light text-decoration-none" href="../Frames/Dashboard.php">Dashboard</a></li>
                    <li><a class="dropdown-item text-light text-decoration-none" href="../Verify/logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>