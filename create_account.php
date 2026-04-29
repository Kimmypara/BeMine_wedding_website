<?php

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

<h2>Create Account</h2>

<?php if (isset($userCreateResult)): ?>
    <p>
        <?php echo htmlspecialchars($userCreateResult["message"] ?? "Done"); ?>
    </p>
    <pre>
<?php print_r($userCreateResult ?? 'No response yet'); ?>
</pre>
<?php endif; ?>

<form method="POST">

    <input type="text" name="first_name" placeholder="First Name" required><br><br>

    <input type="text" name="last_name" placeholder="Last Name" required><br><br>

    <input type="email" name="email" placeholder="Email" required><br><br>

    <input type="password" name="password" placeholder="Password" required><br><br>

    <select name="role_id" required>
        <option value="">Select Role</option>
        <option value="2">Couple</option>
        <option value="3">Vendor</option>
    </select><br><br>

    <button type="submit" name="submit">Create Account</button>

</form>

</main>
</body>
</html>













<?php include "includes/footer.php"; ?>