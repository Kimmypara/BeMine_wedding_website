
<?php
include "includes/curl_login.php";
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
<h2 class="title">Login</h2>
<pre>
<?php print_r($loginResult); ?>
</pre>
<form  method="POST" action="login.php">

    <input class="form" type="email" name="email" placeholder="Email" required><br>

    <input class="form" type="password" name="password" placeholder="Password" required>
<div class="row">
    <div class="col-lg-2"></div>
    <div class="col-lg-8"><a class="account" href="create_account.php">Create a New Account</a></div>
    <div class="col-lg-2"></div>
</div><br>


<?php 
if (isset($loginResult["message"])) {

    $message = $loginResult["message"];
    $type = (stripos($message, "success") !== false) ? "success" : "error";

    echo "<div class='alert-message $type'>";
    echo htmlspecialchars($message);
    echo "</div>";
}
?>

    <button class="button" type="submit" name="login">Login</button>

</form>
</div>
</main>
</body>
</html>


<?php include "includes/footer.php"; ?>