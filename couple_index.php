<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id']) || (int)$_SESSION['role_id'] !== 2) {
    header("Location: login.php");
    exit;
}

include "includes/nav.php";
?>


<style>
<?php include 'css/style.css'; ?>
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <main class="main-content">
    <div class="container">

<h1 class="title">About Us</h1>

<div id="carouselExample" class="carousel slide ">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="assets/images/flowers.png" class="photo d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="assets/images/cake.png" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="assets/images/heart.png" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<div class="row">
    
    <div class="col-12">
<h2 class="subtitle">Timeless Planning for Infinite Love</h2>
<p>Welcome to Be Mine Forever, your all-in-one wedding planning platform designed to make your special day effortless and unforgettable.
    <br>
    <br>

With years of combined experience in the wedding industry, our team understands the challenges couples face when planning their wedding. That is why Be Mine Forever brings everything together in one place, from discovering trusted vendors and managing your budget, to organising tasks and tracking your progress.
<br>
    <br>

At Be Mine Forever, we believe that planning a wedding should be exciting, not overwhelming. Our platform is designed to simplify the entire process, giving couples the tools they need to plan confidently and stay in control. Whether you are organising a large celebration or a small, intimate wedding, Be Mine Forever adapts to your needs.
<br>
    <br>

We focus on providing a personalised experience, allowing couples to customise their plans, explore different themes, and manage every detail with ease. With a user-friendly interface and smart planning features, Be Mine Forever helps turn ideas into reality.
<br>
    <br>

So why choose Be Mine Forever? Because it is more than just a planning tool. It is your digital partner in creating a wedding that truly reflects your story.</p>




    </div>



</div>
</div>
</main>
</body>
</html>

<?php include "includes/footer.php"; ?>