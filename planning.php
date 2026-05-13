<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id']) || (int)$_SESSION['role_id'] !== 2) {
    header("Location: login.php");
    exit;
}

// SAVE FIRST
if (isset($_POST['save_plan'])) {

    // include curl only if you need $existingPlan here
    include "includes/curl.php";

    $wedding_plan_id = $existingPlan['wedding_plan_id'] ?? null;

    $data = [
        "wedding_plan_id" => $wedding_plan_id,
        "categories" => $_POST['categories'] ?? []
    ];

    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "http://localhost/BeMine_wedding_website/api/wedding_plan_task/createSelected.php",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => [
            "Accept: application/json",
            "Content-Type: application/json"
        ]
    ]);

    $response = curl_exec($curl);
    curl_close($curl);

    header("Location: planning.php?saved=1");
    exit;
}

// THEN READ FRESH DATA
include "includes/curl.php";
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

<form action="planning.php" method="POST">

    <input class="form2" type="text" name="user_nickname" placeholder="Your Name" required value="<?php echo htmlspecialchars($existingPlan['user_nickname'] ?? ''); ?>"><br>

    <input class="form2" type="text" name="partner_nickname" placeholder="Partner’s Name" required
     value="<?php echo htmlspecialchars($existingPlan['partner_nickname'] ?? ''); ?>"><br>

    <input class="form2" type="date" name="wedding_date" placeholder="Wedding date" required
    value="<?php echo htmlspecialchars($existingPlan['wedding_date'] ?? ''); ?>"><br>

    <h3 class="subtitle2">Select what you need for your wedding</h3>

  <div class="row">

<?php if (!empty($categoryReadResult['data'])): ?>
    <?php foreach($categoryReadResult['data'] as $category): ?>

        <div class="col-lg-6 col-md-6 col-sm-12">

            <label class="checkbox-item">

                <input 
                    type="checkbox" 
                    name="categories[]" 
                    value="<?php echo htmlspecialchars($category['category_id']); ?>"
                    <?php if (in_array((int)$category['category_id'], $selectedCategories)) echo "checked"; ?>
                >

                <span>
                    <?php echo htmlspecialchars($category['category_name']); ?>
                </span>

            </label>

        </div>

    <?php endforeach; ?>
<?php endif; ?>

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
</div>
</main>
</body>
</html>

<?php include "includes/footer.php"; ?>