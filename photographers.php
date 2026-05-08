<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id']) || (int)$_SESSION['role_id'] !== 2) {
    header("Location: login.php");
    exit;
}

$category_id = 8; // Photography category id
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
<h1 class="title">Photographers</h1>

<div class="row align-items-stretch">

<?php if (!empty($vendorCategoryReadResult['data'])): ?>
    <?php foreach($vendorCategoryReadResult['data'] as $vendor): ?>

    <div class="col-lg-6 col-md-6 col-sm-12 mb-4 d-flex">

        <div class="vendor-card card p-3 d-flex flex-column w-100">

            <div id="carouselVendor<?php echo $vendor['vendor_id']; ?>" class="carousel slide">

                <div class="carousel-inner">

                    <?php foreach ($vendor["images"] as $index => $image): ?>
                        <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                            <img src="<?php echo htmlspecialchars($image); ?>" class="photo d-block w-100" alt="Vendor image">
                        </div>
                    <?php endforeach; ?>

                </div>

                <button class="carousel-control-prev" type="button"
                    data-bs-target="#carouselVendor<?php echo $vendor['vendor_id']; ?>"
                    data-bs-slide="prev">

                    <span class="carousel-control-prev-icon"></span>
                </button>

                <button class="carousel-control-next" type="button"
                    data-bs-target="#carouselVendor<?php echo $vendor['vendor_id']; ?>"
                    data-bs-slide="next">

                    <span class="carousel-control-next-icon"></span>
                </button>

            </div>

            <h3 class="subtitle3"><?php echo htmlspecialchars($vendor['vendor_name']); ?></h3>

            <p>
                Location:&nbsp; &nbsp;
                <?php echo htmlspecialchars($vendor['locations']); ?>
            </p>

            <p>
                Price Range:&nbsp; &nbsp;
                €<?php echo htmlspecialchars($vendor['min_price']); ?>
               
            </p>

            <?php
$shortText = substr($vendor['basic_info'], 0, 120);
?>

<div class="basic-info-container">

    <p id="shortInfo<?php echo $vendor['vendor_id']; ?>">
        <?php echo htmlspecialchars($shortText); ?>...
        <a href="javascript:void(0);"
           class="read-toggle"
           onclick="
                document.getElementById('shortInfo<?php echo $vendor['vendor_id']; ?>').style.display='none';
                document.getElementById('fullInfo<?php echo $vendor['vendor_id']; ?>').style.display='block';
           ">
           Read More
        </a>
    </p>

    <div id="fullInfo<?php echo $vendor['vendor_id']; ?>" style="display:none;">

        <p>
            <?php echo nl2br(htmlspecialchars($vendor['basic_info'])); ?>
        </p>

        <a href="javascript:void(0);"
           class="read-toggle"
           onclick="
                document.getElementById('fullInfo<?php echo $vendor['vendor_id']; ?>').style.display='none';
                document.getElementById('shortInfo<?php echo $vendor['vendor_id']; ?>').style.display='block';
           ">
           Read Less
        </a>

    </div>

</div>

            <div class="row">
                <div class="col-12">
 <div class="mt-auto">
    <button class="button w-100 align-self-end mt-2">
        Request a Quotation
    </button>
</div>
                </div>
            </div>
           

        </div>

    </div>

    <?php endforeach; ?>

<?php else: ?>

    <p>No vendors found.</p>

<?php endif; ?>

</div>



</div>
</main>
</body>
</html>


<?php include "includes/footer.php"; ?>