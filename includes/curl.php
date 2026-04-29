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



     //User create (POST)
if (isset($_POST['submit'])) {

    $data = [
        "first_name" => $_POST['first_name'],
        "last_name"  => $_POST['last_name'],
        "email"      => $_POST['email'],
        "password"   => $_POST['password'],
        "role_id"    => (int)$_POST['role_id'],
        "is_active"  => 1
    ];

    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, "http://localhost/BeMine_wedding_website/api/users/create.php");
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
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
    }

    curl_close($curl);
}

?>