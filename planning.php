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

<h1 class="title">Planning</h1>

<img class="photo d-block w-100 mb-4" src="assets/images/planning_img.png" alt="Couple silhouette under stars">

<form action="" method="POST">

    <input class="form2" type="text" name="user_nickname" placeholder="Your Name" required><br>

    <input class="form2" type="text" name="partner_nickname" placeholder="Partner’s Name" required><br>

    <input class="form2" type="date" name="wedding_date" placeholder="Wedding date" required><br>

    <h3 class="subtitle2">Select what you need for your wedding</h3>

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12">
               <label class="checkbox-item">
  <input type="checkbox" name="categories[]" value="5">
  <span>Ceremony Venue</span>
</label>

<label class="checkbox-item">
  <input type="checkbox" name="categories[]" value="7">
  <span>Reception Venue</span>
</label>

<label class="checkbox-item">
  <input type="checkbox" name="categories[]" value="9">
  <span>Bridal & Groom wear</span>
</label>

<label class="checkbox-item">
  <input type="checkbox" name="categories[]" value="1">
  <span>Florists</span>
</label>

<label class="checkbox-item">
  <input type="checkbox" name="categories[]" value="4">
  <span>Invitations</span>
</label>

<label class="checkbox-item">
  <input type="checkbox" name="categories[]" value="10">
  <span>Caterers & Beverages</span>
</label>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <label class="checkbox-item">
  <input type="checkbox" name="categories[]" value="6">
  <span>Videographers</span>
</label>

<label class="checkbox-item">
  <input type="checkbox" name="categories[]" value="8">
  <span>Photographers</span>
</label>

<label class="checkbox-item">
  <input type="checkbox" name="categories[]" value="11">
  <span>Fireworks</span>
</label>

<label class="checkbox-item">
  <input type="checkbox" name="categories[]" value="12">
  <span>Music</span>
</label>

<label class="checkbox-item">
  <input type="checkbox" name="categories[]" value="13">
  <span>Wedding Rings</span>
</label>

<label class="checkbox-item">
  <input type="checkbox" name="categories[]" value="14">
  <span>Beauty Services</span>
</label>
        </div>
    </div>

<div class="form-group-inline">
  <label>How many Guests?</label>
  <input class="form3" type="text" name="guest_count" required>
</div>

<div class="form-group-inline">
  <label>Your Budget (€)</label>
  <input class="form3" type="text" name="budget" required>
</div>

<button class="button" type="submit" name="submit" value="save">Save</button>
</form>

</div>
</main>
</body>
</html>

<?php include "includes/footer.php"; ?>