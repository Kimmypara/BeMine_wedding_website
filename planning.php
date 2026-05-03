<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id']) || (int)$_SESSION['role_id'] !== 2) {
    header("Location: login.php");
    exit;
}

include "includes/nav.php";
include "includes/curl.php";
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

<form action="planning.php" method="POST">

    <input class="form2" type="text" name="user_nickname" placeholder="Your Name" required value="<?php echo htmlspecialchars($existingPlan['user_nickname'] ?? ''); ?>"><br>

    <input class="form2" type="text" name="partner_nickname" placeholder="Partner’s Name" required
     value="<?php echo htmlspecialchars($existingPlan['partner_nickname'] ?? ''); ?>"><br>

    <input class="form2" type="date" name="wedding_date" placeholder="Wedding date" required
    value="<?php echo htmlspecialchars($existingPlan['wedding_date'] ?? ''); ?>"><br>

    <h3 class="subtitle2">Select what you need for your wedding</h3>

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12">
               <label class="checkbox-item">
  <input type="checkbox" name="categories[]" value="5" <?php if (in_array(5, $selectedCategories)) echo "checked"; ?>>
  <span>Ceremony Venue</span>
</label>

<label class="checkbox-item">
  <input type="checkbox" name="categories[]" value="7" <?php if (in_array(7, $selectedCategories)) echo "checked"; ?>>
  <span>Reception Venue</span>
</label>

<label class="checkbox-item">
  <input type="checkbox" name="categories[]" value="9" <?php if (in_array(9, $selectedCategories)) echo "checked"; ?>>
  <span>Bridal & Groom wear</span>
</label>

<label class="checkbox-item">
  <input type="checkbox" name="categories[]" value="1" <?php if (in_array(1, $selectedCategories)) echo "checked"; ?>>
  <span>Florists</span>
</label>

<label class="checkbox-item">
  <input type="checkbox" name="categories[]" value="4" <?php if (in_array(4, $selectedCategories)) echo "checked"; ?>>
  <span>Invitations</span>
</label>

<label class="checkbox-item">
  <input type="checkbox" name="categories[]" value="10" <?php if (in_array(10, $selectedCategories)) echo "checked"; ?>>
  <span>Caterers & Beverages</span>
</label>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <label class="checkbox-item">
  <input type="checkbox" name="categories[]" value="6" <?php if (in_array(6, $selectedCategories)) echo "checked"; ?>>
  <span>Videographers</span>
</label>

<label class="checkbox-item">
  <input type="checkbox" name="categories[]" value="8" <?php if (in_array(8, $selectedCategories)) echo "checked"; ?>>
  <span>Photographers</span>
</label>

<label class="checkbox-item">
  <input type="checkbox" name="categories[]" value="11" <?php if (in_array(11, $selectedCategories)) echo "checked"; ?>>
  <span>Fireworks</span>
</label>

<label class="checkbox-item">
  <input type="checkbox" name="categories[]" value="12" <?php if (in_array(12, $selectedCategories)) echo "checked"; ?>>
  <span>Music</span>
</label>

<label class="checkbox-item">
  <input type="checkbox" name="categories[]" value="13" <?php if (in_array(13, $selectedCategories)) echo "checked"; ?>>
  <span>Wedding Rings</span>
</label>

<label class="checkbox-item">
  <input type="checkbox" name="categories[]" value="14" <?php if (in_array(14, $selectedCategories)) echo "checked"; ?>>
  <span>Beauty Services</span>
</label>
        </div>
    </div>

<div class="form-group-inline">
  <label>How many Guests?</label>
  <input class="form3" type="text" name="guest_count" required
  value="<?php echo htmlspecialchars($existingPlan['guest_count'] ?? ''); ?>">
</div>

<div class="form-group-inline">
  <label>Your Budget (€)</label>
  <input class="form3" type="text" name="budget" required
  value="<?php echo htmlspecialchars($existingPlan['budget'] ?? ''); ?>">
</div>


<?php 

if (isset($weddingPlanCreateResult["message"])) {

    $message = $weddingPlanCreateResult["message"];

    $type = (
    $message === "Wedding Plan created." ||
    $message === "Wedding Plan updated."
) ? "success" : "error";
    echo "<div class='alert-message $type'>";
    echo htmlspecialchars($message);
    echo "</div>";
}


?>

<button class="button" type="submit" name="save_plan" value="save">
    <?php echo $planExists ? "Update" : "Save"; ?>
</button>
</form>

</div>
</main>
</body>
</html>

<?php include "includes/footer.php"; ?>