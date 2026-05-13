    <?php
//Users Read
    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, "http://localhost/BeMine_wedding_website/api/users/read.php");
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        "Accept"=> "application/json",
        "Content-Type"=> "application/json"
    ]);

    $userReadResult = curl_exec($curl);

    curl_close($curl);
   //echo $userReadResult;
    $userReadResult = json_decode($userReadResult, true);

    
//Category Read
    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, "http://localhost/BeMine_wedding_website/api/category/read.php");
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        "Accept"=> "application/json",
        "Content-Type"=> "application/json"
    ]);

    $categoryReadResult = curl_exec($curl);

    curl_close($curl);
   //echo $categoryReadResult;
    $categoryReadResult = json_decode($categoryReadResult, true);


    
  
      
// Guest read
    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, "http://localhost/BeMine_wedding_website/api/guest/read.php");
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        "Accept"=> "application/json",
        "Content-Type"=> "application/json"
    ]);

    $guestReadResult = curl_exec($curl);

    curl_close($curl);
   //echo $guestReadResult;
    $guestReadResult = json_decode($guestReadResult, true);
    

    //Role read
    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, "http://localhost/BeMine_wedding_website/api/role/read.php");
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        "Accept"=> "application/json",
        "Content-Type"=> "application/json"
    ]);

    $roleReadResult = curl_exec($curl);

    curl_close($curl);
   //echo $roleReadResult;
    $roleReadResult = json_decode($roleReadResult, true);
  
   
    //Task Read
    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, "http://localhost/BeMine_wedding_website/api/task/read.php");
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        "Accept"=> "application/json",
        "Content-Type"=> "application/json"
    ]);

    $taskReadResult = curl_exec($curl);

    curl_close($curl);
   //echo $taskReadResult;
    $taskReadResult = json_decode($taskReadResult, true);
  
      
// Wedding plan read
    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, "http://localhost/BeMine_wedding_website/api/wedding_plan/read.php");
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        "Accept"=> "application/json",
        "Content-Type"=> "application/json"
    ]);

    $weddingPlanReadResult = curl_exec($curl);

    curl_close($curl);
   //echo $weddingPlanReadResult;
    $weddingPlanReadResult = json_decode($weddingPlanReadResult, true);
    

    //Wedding plan task read
    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, "http://localhost/BeMine_wedding_website/api/wedding_plan_task/read.php");
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        "Accept"=> "application/json",
        "Content-Type"=> "application/json"
    ]);

    $weddingPlanTaskReadResult = curl_exec($curl);

    curl_close($curl);
   //echo $weddingPlanTaskReadResult;
    $weddingPlanTaskReadResult = json_decode($weddingPlanTaskReadResult, true);


    


    //Vendors Read by category id
  if (isset($category_id)) {

    // Vendors Read by category id
    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL,
        "http://localhost/BeMine_wedding_website/api/vendor/readByCategoryId.php?category_id=" . $category_id
    );
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_HTTPHEADER, [
    "Accept: application/json",
    "Content-Type: application/json"
]);

    $vendorCategoryReadResult = curl_exec($curl);

    curl_close($curl);
   //echo $vendorCategoryReadResult;
    $vendorCategoryReadResult = json_decode($vendorCategoryReadResult, true);
  }



     //User create (POST)
$userCreateResult = null;

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['create_user'])) {

    $data = [
        "first_name" => $_POST['first_name'] ?? "",
        "last_name"  => $_POST['last_name'] ?? "",
        "email"      => $_POST['email'] ?? "",
        "password"   => $_POST['password'] ?? "",
        "role_id"    => 2,
        "is_active"  => 1
    ];

    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, "http://localhost/BeMine_wedding_website/api/users/create.php");
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        "Accept: application/json",
        "Content-Type: application/json"
    ]);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));

   $response = curl_exec($curl);

if ($response === false) {
    $userCreateResult = ["message" => curl_error($curl)];
} else {
    $userCreateResult = json_decode($response, true);

    if (isset($userCreateResult["message"]) && $userCreateResult["message"] === "User created.") {
        header("Location: login.php");
        exit;
    }
}
}


//User login(POST)
$loginResult = null;

if (isset($_POST['login'])) {

    $data = [
        "email"    => $_POST['email'] ?? "",
        "password" => $_POST['password'] ?? ""
    ];

    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "http://localhost/BeMine_wedding_website/api/users/login.php",
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            "Accept: application/json",
            "Content-Type: application/json"
        ],
        CURLOPT_POSTFIELDS => json_encode($data)
    ]);

    $response = curl_exec($curl);

    if ($response === false) {
        $loginResult = ["message" => curl_error($curl)];
    } else {
        $loginResult = json_decode($response, true);
    }

    curl_close($curl);

    if (isset($loginResult["message"]) && $loginResult["message"] === "Login successful.") {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION["user_id"] = $loginResult["data"]["user_id"];
        $_SESSION["first_name"] = $loginResult["data"]["first_name"];
        $_SESSION["last_name"] = $loginResult["data"]["last_name"];
        $_SESSION["email"] = $loginResult["data"]["email"];
        $_SESSION["role_id"] = $loginResult["data"]["role_id"];

        $role_id = (int)$_SESSION["role_id"];

        if ($role_id === 1) {
            header("Location: admin_index.php");
            exit;
        } elseif ($role_id === 2) {
            header("Location: couple_index.php");
            exit;
        } elseif ($role_id === 3) {
            header("Location: vendor_index.php");
            exit;
        } elseif ($role_id === 4) {
            header("Location: weddingPlanner_index.php");
            exit;
        } else {
            header("Location: index.php");
            exit;
        }
    }
}



//Wedding Plan Read By User Id(GET)
$weddingPlanCreateResult = null;
$existingPlan = null;
$planExists = false;

$user_id = $_SESSION['user_id'] ?? "";
$selectedCategories = [];

/* READ EXISTING PLAN */
if (!empty($user_id)) {

    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, "http://localhost/BeMine_wedding_website/api/wedding_plan/readByUserId.php?user_id=" . $user_id);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        "Accept: application/json",
        "Content-Type: application/json"
    ]);
  

    $response = curl_exec($curl);
    curl_close($curl);

    $readResult = json_decode($response, true);

    if (isset($readResult["exists"]) && $readResult["exists"] === true) {
        $planExists = true;
        $existingPlan = $readResult["data"];
        $selectedCategories = $existingPlan["categories"] ?? [];
    }
}

/* Wedding Plan CREATE OR UPDATE */
if (isset($_POST['save_plan'])) {

    $data = [
        "wedding_plan_id" => $existingPlan["wedding_plan_id"] ?? "",
        "user_id" => $user_id,
        "user_nickname" => $_POST['user_nickname'] ?? "",
        "partner_nickname" => $_POST['partner_nickname'] ?? "",
        "wedding_date" => $_POST['wedding_date'] ?? "",
        "guest_count" => $_POST['guest_count'] ?? "",
         "categories" => $_POST['categories'] ?? [],
        "budget" => $_POST['budget'] ?? ""
    ];

    $curl = curl_init();

    if ($planExists) {
        $url = "http://localhost/BeMine_wedding_website/api/wedding_plan/update.php";
        $method = "PATCH";
    } else {
        $url = "http://localhost/BeMine_wedding_website/api/wedding_plan/create.php";
        $method = "POST";
    }

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        "Accept: application/json",
        "Content-Type: application/json"
    ]);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($curl);

    if ($response === false) {
        $weddingPlanCreateResult = ["message" => curl_error($curl)];
    } else {
        $weddingPlanCreateResult = json_decode($response, true);
    }
    

    curl_close($curl);
}




// Read selected wedding plan tasks
if (!empty($existingPlan['wedding_plan_id'])) {

    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "http://localhost/BeMine_wedding_website/api/wedding_plan_task/readByWeddingPlanId.php?wedding_plan_id=" . $existingPlan['wedding_plan_id'],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "Accept: application/json",
            "Content-Type: application/json"
        ]
    ]);

    $taskReadResult = curl_exec($curl);
    curl_close($curl);

    $taskReadResult = json_decode($taskReadResult, true);

} else {
    $taskReadResult = ["data" => []];
}


// Update selected wedding plan tasks when completed
if (isset($_POST['save_task'])) {

    $completedTasks = $_POST['completed_tasks'] ?? [];

    foreach ($taskReadResult['data'] as $task) {

        $isCompleted = in_array(
            $task['wedding_plan_task_id'],
            $completedTasks
        ) ? 1 : 0;

        $data = [
            "wedding_plan_task_id" => $task['wedding_plan_task_id'],
            "is_completed" => $isCompleted
        ];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "http://localhost/BeMine_wedding_website/api/wedding_plan_task/updateIsCompleted.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "PATCH",
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => [
                "Accept: application/json",
                "Content-Type: application/json"
            ]
        ]);

        $response = curl_exec($curl);

        curl_close($curl);
    }
}


?>