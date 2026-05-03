<?php
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
<h2 class="title">Create Account</h2>

<form  method="POST">

    <input class="form" type="text" name="first_name" placeholder="First Name" required><br>

    <input class="form" type="text" name="last_name" placeholder="Last Name" required><br>

    <input class="form" type="email" name="email" placeholder="Email" required><br>

    <input class="form" type="password" name="password" placeholder="Password" required><br>

    
<?php 
if (isset($userCreateResult["message"])) {

    $message = $userCreateResult["message"];

    if (stripos($message, "Is Active") === false) {

      
        if ($message === "User created.") {
            $type = "success";
        } else {
            $type = "error";
        }

        echo "<div class='alert-message $type'>";
        echo htmlspecialchars($message);
        echo "</div>";
    }
}
?>
    <button class="button" type="submit" name="create_user">Create Account</button>

</form>

</div>
</main>
</body>
</html>


<?php include "includes/footer.php"; ?>