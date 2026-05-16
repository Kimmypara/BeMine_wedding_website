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

<h1 class="title">Guest List</h1>


<button type="button " class="button mt-3" onclick="openPopup()">
    Add Guest
</button>


<div id="guestPopup" class="popup-overlay">

    <div class="popup-box">

        <span class="close-popup" onclick="closePopup()">&times;</span>

        <h2 class="subtitle4 mb-2 mt-2">Fill in the Form to add a Guest</h2>

        <form action="guest_list.php" method="POST">

            <div class="custom-select">
    <button type="button" class="select-btn" onclick="toggleGuestDropdown()">
    <span id="selectedCategory">Please select a category</span>
    <span class="dropdown-arrow">⌄</span>
</button>

    <div class="select-options" id="guestDropdown">
        <div onclick="selectCategory('Family of the Bride')">Family of the Bride</div>
        <div onclick="selectCategory('Family of the Groom')">Family of the Groom</div>
        <div onclick="selectCategory('Friends')">Friends</div>
        <div onclick="selectCategory('Work Friends')">Work Friends</div>
        <div onclick="selectCategory('Other')">Other</div>
    </div>

    <input type="hidden" name="guest_category" id="guestCategory">
</div>

           

            <input class="form2 w-100 mt-2" type="text" name="guest_name" placeholder="Guest Name" required>

            <input class="form2 w-100 mt-2" type="text" name="guest_surname" placeholder="Guest Surname" required>

            <input class="form2 w-100 mt-2" type="email" name="guest_email" placeholder="Guest Email" required>

            <button class="button mt-3" type="submit" name="save_guest" value="save">
                Save Guest
            </button>

            <?php
if (isset($guestCreateResult['message'])) {
    echo "<div class='alert-message success'>";
    echo htmlspecialchars($guestCreateResult['message']);
    echo "</div>";
}
?>

        </form>

        

    </div>

</div>

<div class="guest-board">

    <?php if (!empty($guestReadResult['data'])): ?>

        <?php
       $groupedGuests = [];
$weddingPlanId = $existingPlan['wedding_plan_id'] ?? 0;

foreach ($guestReadResult['data'] as $guest) {

    if (empty($guest)) {
        continue;
    }

    if ((int)($guest['wedding_plan_id'] ?? 0) === (int)$weddingPlanId) {
        $category = $guest['guest_category'] ?? 'Other';
        $groupedGuests[$category][] = $guest;
    }
}
        ?>

        <?php foreach ($groupedGuests as $category => $guests): ?>

            <div class="guest-category-box">
                <h3><?php echo htmlspecialchars($category); ?></h3>

                <table class="guest-table">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>RSVP</th>
                    </tr>

                    <?php foreach ($guests as $guest): ?>
                        <tr>
                            <td>
                                <?php echo htmlspecialchars(($guest['guest_name'] ?? '') . " " . ($guest['guest_surname'] ?? '')); ?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($guest['guest_email'] ?? ''); ?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($guest['rsvp_status'] ?? 'Pending'); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </table>
            </div>

        <?php endforeach; ?>

    <?php else: ?>

        <p>No guests added yet.</p>

    <?php endif; ?>

</div>

   </div> 
</main>

<script>
function openPopup(){
    document.getElementById("guestPopup").style.display = "flex";
}

function closePopup(){
    document.getElementById("guestPopup").style.display = "none";
}
</script>
<script>
function toggleGuestDropdown(){
    document.getElementById("guestDropdown").classList.toggle("show");
}

function selectCategory(value){
    document.getElementById("selectedCategory").innerText = value;
    document.getElementById("guestCategory").value = value;
    document.getElementById("guestDropdown").classList.remove("show");
}
</script>

</body>
</html>

<?php include "includes/footer.php"; ?>