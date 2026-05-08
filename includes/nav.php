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

if (!isset($categoryReadResult)) {
    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, "http://localhost/BeMine_wedding_website/api/category/read.php");
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        "Accept: application/json",
        "Content-Type: application/json"
    ]);

    $categoryResponse = curl_exec($curl);
    curl_close($curl);

    $categoryReadResult = json_decode($categoryResponse, true);
}

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



  <nav class="navbar mt-0">

    <div class="nav-banner bg-drop" >
      <picture>
    <source media="(max-width: 1100px)" srcset="assets/images/topNav_small.png">
    <img src="assets/images/topNav.png" class="banner" alt="Banner">
</picture>

 <div class="nav-logo py-0 px-0">
           <img class="logo" src="assets/images/logo.png" alt="Be Mine Logo">
        </div>
    </div>
  <!-- Hamburger button (small screens) -->
<button class="menu-btn" id="openMenuBtn" type="button" aria-label="Open menu">
    ☰
</button>
    <div class="nav-container" id="Menu">


        <div class="mobile-menu-header">
    <h2>Menu</h2>
    <button type="button" id="closeMenuBtn" class="close-menu-btn">×</button>
</div>

       <div class="offcanvas-header d-md-none">
    </div>



       <!-- LEFT MENU -->
        <ul class="nav-menu nav-left">
            <li>
    <a href="<?php echo $homeUrl; ?>" class="nav-link <?php if ($currentPage == $homeUrl) echo 'active'; ?>">
        Home
    </a>
</li>
            <li><a href="mail.php" class="nav-link <?php if ($currentPage == 'mail.php') echo 'active'; ?>">Mail</a></li>
            
            <li class="dropdown">
    <a href="#" class="dropdown-toggle"  aria-expanded="false"
            aria-haspopup="true">Our Wedding</a>

    <ul class="dropdown-menu">
        <li><a href="planning.php" role="menuitem">Planning</a></li>
        <li><a href="our_wedding.php" role="menuitem">View Our Wedding</a></li>
       
    </ul>
</li>

 <li class="dropdown">
    <a href="#" class="dropdown-toggle"  aria-expanded="false"
            aria-haspopup="true">Planning Tools</a>

    <ul class="dropdown-menu">
        <li><a href="RSVP.php" role="menuitem">RSVP Website</a></li>
        <li><a href="dinner_tables.php" role="menuitem">Dinner Table Planner</a></li>
         <li><a href="legal_docs.php" role="menuitem">Legal Documents</a></li>
        <li><a href="testimonials.php" role="menuitem">Testimonials</a></li>
        <li><a href="guest_list.php" role="menuitem">Guest List</a></li>
    </ul>
</li>
           
        </ul>

        

         <!-- RIGHT MENU -->
    <!-- RIGHT MENU -->
<ul class="nav-menu nav-right">

    <li class="dropdown ">

        <a href="#"
           class="dropdown-toggle "
           aria-expanded="false"
           aria-haspopup="true">

           Vendors

        </a>

        <ul class="dropdown-menu vendors_list">

            <?php if (!empty($categoryReadResult['data'])): ?>

                <?php foreach($categoryReadResult['data'] as $category): ?>

                    <li>

                        <a href="vendors.php?category=<?php echo urlencode($category['slug']); ?>">

                            <?php echo htmlspecialchars($category['category_name']); ?>

                        </a>

                    </li>

                <?php endforeach; ?>

            <?php endif; ?>

        </ul>

    </li>

    <li>
        <a href="honeymoon.php"
           class="nav-link <?php if ($currentPage == 'honeymoon.php') echo 'active'; ?>">

           Honeymoon

        </a>
    </li>

    <li>
        <a href="contact_us.php"
           class="nav-link <?php if ($currentPage == 'contact_us.php') echo 'active'; ?>">

           Contact Us

        </a>
    </li>

    <?php if (isset($_SESSION['user_id'])): ?>

        <li>
            <a href="logout.php"
               class="nav-link <?php if ($currentPage == 'logout.php') echo 'active'; ?>">

               Logout

            </a>
        </li>

    <?php else: ?>

        <li>
            <a href="login.php"
               class="nav-link <?php if ($currentPage == 'login.php') echo 'active'; ?>">

               Login/Sign up

            </a>
        </li>

    <?php endif; ?>

</ul>
    </div>

   
</nav>
<div class="icon-nav ">
    <a href="index.php">
        <img src="assets/images/home_icon.png" alt="">
        
    </a>

    <a href="mail.php">
        <img src="assets/images/mail.png" alt="">
        
    </a>

    <a href="#">
        <img src="assets/images/accessibility.png" alt="">
       
    </a>

   <a href="#" id="bottomMenuBtn" aria-label="Open menu">
    <img src="assets/images/menu.png" alt="Menu">
</a>
</div>
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
<script>
document.addEventListener("DOMContentLoaded", function () {

    const menu = document.getElementById("Menu");
    const openBtn = document.getElementById("openMenuBtn");
    const bottomMenuBtn = document.getElementById("bottomMenuBtn");
    const closeBtn = document.getElementById("closeMenuBtn");

    if (openBtn) {
        openBtn.addEventListener("click", function (e) {
            e.preventDefault();
            menu.classList.add("open");
        });
    }

    if (bottomMenuBtn) {
        bottomMenuBtn.addEventListener("click", function (e) {
            e.preventDefault();
            menu.classList.add("open");
        });
    }

    if (closeBtn) {
        closeBtn.addEventListener("click", function () {
            menu.classList.remove("open");
        });
    }

    document.addEventListener("click", function (e) {
        if (
            menu.classList.contains("open") &&
            !menu.contains(e.target) &&
            !openBtn.contains(e.target) &&
            !bottomMenuBtn.contains(e.target)
        ) {
            menu.classList.remove("open");
        }
    });

});
</script>
</html>

