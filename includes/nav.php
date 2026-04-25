
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once(__DIR__ . "/initialize.php");

$role_id    = $_SESSION['role_id'] ?? null;

// Default page when open website
$homeUrl = 'index.php'; // fallback

switch ((int)$role_id) {
  case 1: $homeUrl = 'admin_index.php'; break;
  case 2: $homeUrl = 'couple_index.php'; break;
  case 3: $homeUrl = 'vendor_index.php'; break;
  case 4: $homeUrl = 'weddingPlanner_index.php'; break;

  default: $homeUrl = 'index.php'; break;
}

// Session data
$first_name = $_SESSION['first_name'] ?? '';
$last_name  = $_SESSION['last_name'] ?? '';


$currentPage = basename($_SERVER['PHP_SELF']);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Be Mine Forever</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <!-- Hamburger button (small screens) -->
<button class="btn btn-light d-md-none menu-btn" 
        type="button" 
        data-bs-toggle="offcanvas" 
        data-bs-target="#Menu">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="20" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
    </svg>
</button>


  <nav class="navbar mt-0">

    <div class="nav-banner" >
        
        <img class="banner d-flex" src="assets/images/topNav.png" alt="">
    </div>

    <div class="nav-container" id="Menu">
       <div class="offcanvas-header d-md-none">
    </div>

       <!-- LEFT MENU -->
        <ul class="nav-menu nav-left">
            <li><a href="index.php" class="nav-link <?php if ($currentPage == 'index.php') echo 'active'; ?>">Home</a></li>
            <li><a href="mail.php" class="nav-link <?php if ($currentPage == 'mail.php') echo 'active'; ?>">Mail</a></li>
            <li class="dropdown">
    <a href="#" class="dropdown-toggle"  aria-expanded="false"
            aria-haspopup="true">Our Wedding</a>

    <ul class="dropdown-menu">
        <li><a href="planning.php" role="menuitem">Planning</a></li>
        <li><a href="our_wedding.php" role="menuitem">View Our Wedding</a></li>
       
    </ul>
</li>
           
        </ul>

         <div class="nav-logo py-0 px-0">
           <img class="logo" src="assets/images/logo.png" alt="Be Mine Logo">
        </div>

         <!-- RIGHT MENU -->
        <ul class="nav-menu nav-right">
             <li class="dropdown">
    <a href="#" class="dropdown-toggle"  aria-expanded="false"
            aria-haspopup="true">Vendors</a>

    <ul class="dropdown-menu">
        <li><a href="planning.php" role="menuitem">Ceremony Venues</a></li>
        <li><a href="our_wedding.php" role="menuitem">Reception Venues</a></li>
        <li><a href="our_wedding.php" role="menuitem">Videographers</a></li>
        <li><a href="our_wedding.php" role="menuitem">Photographers</a></li>
        <li><a href="our_wedding.php" role="menuitem">Invitations</a></li>
        <li><a href="our_wedding.php" role="menuitem">Florists</a></li>
        <li><a href="our_wedding.php" role="menuitem">Fireworks</a></li>
        <li><a href="our_wedding.php" role="menuitem">Bridal & Groom Wear</a></li>
        <li><a href="our_wedding.php" role="menuitem">Caterers & Beverages</a></li>
        <li><a href="our_wedding.php" role="menuitem">Music</a></li>
        <li><a href="our_wedding.php" role="menuitem">Wedding Rings</a></li>
        <li><a href="our_wedding.php" role="menuitem">Beauty Services</a></li>
        
       
    </ul>
</li>
            <li><a href="contact_us.php" class="nav-link <?php if ($currentPage == 'contact_us.php') echo 'active'; ?>">Contact Us</a></li>
            <li><a href="login.php" class="nav-link <?php if ($currentPage == 'login.php') echo 'active'; ?>">Login</a></li>
        </ul>

    </div>

   
</nav>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

<!-- accessibility to open the dropdown menu by keyboard-->
<script>
    document.querySelectorAll(".dropdown-toggle").forEach(button => {

    button.addEventListener("click", function () {
        const menu = this.nextElementSibling;
        const isOpen = this.getAttribute("aria-expanded") === "true";

        // close all
        document.querySelectorAll(".dropdown-menu").forEach(m => m.classList.remove("show"));
        document.querySelectorAll(".dropdown-toggle").forEach(b => b.setAttribute("aria-expanded", "false"));

        // toggle current
        if (!isOpen) {
            menu.classList.add("show");
            this.setAttribute("aria-expanded", "true");

            // move focus to first item
            const firstLink = menu.querySelector("a");
            if (firstLink) firstLink.focus();
        }
    });

    // keyboard support
    button.addEventListener("keydown", function (e) {
        if (e.key === "Enter" || e.key === " ") {
            e.preventDefault();
            this.click();
        }
    });
});

document.addEventListener("click", function (e) {
    if (!e.target.closest(".dropdown")) {
        closeAllDropdowns();
    }
});

document.addEventListener("keydown", function (e) {
    if (e.key === "Escape") {
        closeAllDropdowns();
    }
});

function closeAllDropdowns() {
    document.querySelectorAll(".dropdown-menu").forEach(m => m.classList.remove("show"));
    document.querySelectorAll(".dropdown-toggle").forEach(b => b.setAttribute("aria-expanded", "false"));
}
</script>
</html>

