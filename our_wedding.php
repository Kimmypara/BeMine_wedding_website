<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

header("Cache-Control: no-cache, must-revalidate");
header("Expires: 01 Jan 1970 00:00");

if (!isset($_SESSION['user_id']) || (int)$_SESSION['role_id'] !== 2) {
    header("Location: login.php");
    exit;
}

// SAVE FIRST
if (isset($_POST['save_task'])) {

    include "includes/curl.php";

    $completedTasks = $_POST['completed_tasks'] ?? [];

    foreach ($taskReadResult['data'] as $task) {

        $taskId = $task['wedding_plan_task_id'];

        $isCompleted = in_array($taskId, $completedTasks) ? 1 : 0;

        $data = [
            "wedding_plan_task_id" => $taskId,
            "is_completed" => $isCompleted
        ];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "http://localhost/BeMine_wedding_website/api/wedding_plan_task/updateIsCompleted.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "PUT",
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => [
                "Accept: application/json",
                "Content-Type: application/json"
            ]
        ]);

        curl_exec($curl);
        curl_close($curl);
    }

    header("Location: our_wedding.php?saved=1");
    exit;
}

// READ AFTER SAVE
include "includes/curl.php";
include "includes/nav.php";

$budget = (float)($existingPlan['budget'] ?? 0);

$categoryCosts = [
    'Caterers' => 7000,
    'Photographer' => 1200,
    'Florists' => 800,
    'Invitations' => 400,
    'Bridal Wear' => 1500,
    'Reception Venue' => 6500,
    'Live Bands' => 2000,
    'Beverage Services' => 5000,
    'Wedding Cars' => 800
];

$spent = 0;

foreach ($taskReadResult['data'] as $task) {

    if ((int)$task['is_completed'] === 1) {

        $categoryName = $task['category_name'];

        $spent += $categoryCosts[$categoryName] ?? 500;
    }
}

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
<form method="POST" >

 <img src="assets/images/couple1.png" class="photo d-block w-100" alt="">



<p class="date">
    <?php echo date("d F Y", strtotime($existingPlan['wedding_date'])); ?>
</p>

    

    <div class="countdown-box">
    <div class="time-card">
        <span id="years">0</span>
        <p>Years</p>
    </div>

    <div class="time-card">
        <span id="months">0</span>
        <p>Months</p>
    </div>

    <div class="time-card">
        <span id="days">0</span>
        <p>Days</p>
    </div>

</div>


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

<?php if (!empty($taskReadResult['data'])): ?>

    <?php foreach ($taskReadResult['data'] as $task): ?>

        <div class="col-lg-6 col-md-6 col-sm-12">
            <label class="checkbox-item">

                <input 
                    type="checkbox" 
                    name="completed_tasks[]" 
                    value="<?php echo htmlspecialchars($task['wedding_plan_task_id']); ?>"
                    data-cost="<?php echo $categoryCosts[$task['category_name']] ?? 500; ?>"
                    <?php if ((int)$task['is_completed'] === 1) echo "checked"; ?>
                >
                

                <span>
                    <?php echo htmlspecialchars($task['category_name']); ?>
                </span>

            </label>
        </div>

    <?php endforeach; ?>

<?php else: ?>

    <p>No planning tasks found. Please select categories from the Planning page first.</p>

<?php endif; ?>

</div>

   <button class="button" type="submit" name="save_task" value="save">
    Save
</button>

            </form>
</div>

    </div>
</main>

<script>
const budget = <?php echo (float)($existingPlan['budget'] ?? 0); ?>;

const checkboxes = document.querySelectorAll('input[name="completed_tasks[]"]');

const budgetDigits = document.querySelector('.budget-digits');

function animateValue(start, end, duration) {

    let startTimestamp = null;

    function step(timestamp) {

        if (!startTimestamp) startTimestamp = timestamp;

        const progress = Math.min((timestamp - startTimestamp) / duration, 1);

        const current = Math.floor(progress * (end - start) + start);

        renderDigits(current);

        if (progress < 1) {
            window.requestAnimationFrame(step);
        }
    }

    window.requestAnimationFrame(step);
}

function renderDigits(number) {

    budgetDigits.innerHTML = '';

    number.toString().split('').forEach(digit => {
        budgetDigits.innerHTML += `<span>${digit}</span>`;
    });
}

function updateBudget() {

    let spent = 0;

    checkboxes.forEach(box => {
        if (box.checked) {
            spent += Number(box.dataset.cost);
        }
    });

    const newMoneyLeft = Math.max(0, budget - spent);

    const currentDisplayed =
        parseInt(budgetDigits.textContent.replace(/\D/g, '')) || 0;

    animateValue(currentDisplayed, newMoneyLeft, 500);
}

checkboxes.forEach(box => {
    box.addEventListener('change', updateBudget);
});

updateBudget();
</script>

<script>
const weddingDate = new Date("<?php echo $existingPlan['wedding_date']; ?>T00:00:00");

function updateCountdown() {

    const now = new Date();

    if (now >= weddingDate) {
        document.querySelector(".countdown-box").innerHTML =
            "Today is the big day!";
        return;
    }

    let years = weddingDate.getFullYear() - now.getFullYear();
    let months = weddingDate.getMonth() - now.getMonth();
    let days = weddingDate.getDate() - now.getDate();

    let hours = weddingDate.getHours() - now.getHours();
    let minutes = weddingDate.getMinutes() - now.getMinutes();
    let seconds = weddingDate.getSeconds() - now.getSeconds();

    if (seconds < 0) {
        seconds += 60;
        minutes--;
    }

    if (minutes < 0) {
        minutes += 60;
        hours--;
    }

    if (hours < 0) {
        hours += 24;
        days--;
    }

    if (days < 0) {
        const previousMonth = new Date(
            weddingDate.getFullYear(),
            weddingDate.getMonth(),
            0
        );

        days += previousMonth.getDate();
        months--;
    }

    if (months < 0) {
        months += 12;
        years--;
    }

    document.getElementById("years").textContent = years;
    document.getElementById("months").textContent = months;
    document.getElementById("days").textContent = days;
    document.getElementById("hours").textContent = hours;
    document.getElementById("minutes").textContent = minutes;
    document.getElementById("seconds").textContent = seconds;
}

updateCountdown();

setInterval(updateCountdown, 1000);
</script>


</body>
</html>


<?php include "includes/footer.php"; ?>
