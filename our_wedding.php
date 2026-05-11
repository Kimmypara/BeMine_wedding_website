<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id']) || (int)$_SESSION['role_id'] !== 2) {
    header("Location: login.php");
    exit;
}

include "includes/curl.php";
include "includes/nav.php";


$budget = (float)($existingPlan['budget'] ?? 0);
$spent = 1000;

$moneyLeft = $budget - $spent;
$moneyLeft = max(0, $moneyLeft);

$moneyLeft = number_format($moneyLeft, 0, '', '');
$digits = str_split($moneyLeft);

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

<h1 class="title">Our Wedding Plan</h1>
<form method="POST">
<div class="budget-box">
    <h2 >Budget</h2>
    <h3 >Money left from your budget</h3>

    <div class="budget-digits">
        <?php foreach($digits as $digit): ?>
            <span><?php echo $digit; ?></span>
        <?php endforeach; ?>
    </div>
</div>

<div class="row">

    <?php if (!empty($selectedCategories)): ?>
        <?php foreach ($categoryReadResult['data'] as $category): ?>

            <?php if (in_array((int)$category['category_id'], $selectedCategories)): ?>

                <div class="col-lg-6 col-md-6 col-sm-12 ">
                    <label class="checkbox-item">

                        <input 
                            type="checkbox" 
                            name="completed_tasks[]" 
                            value="<?php echo htmlspecialchars($category['category_id']); ?>"
                        >

                        <span>
                            <?php echo htmlspecialchars($category['category_name']); ?>
                        </span>

                    </label>
                </div>

            <?php endif; ?>

        <?php endforeach; ?>
    <?php endif; ?>


 
</div>

   <button class="button" type="submit" name="save_task" value="save">
    Save
</button>

            </form>
</div>

    </div>
</main>
</body>
</html>













<?php include "includes/footer.php"; ?>