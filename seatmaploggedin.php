<?php require_once"controller.php";?>
<?php 
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email != false && $password != false){
    $sql = "SELECT * FROM usertable WHERE email = '$email'";
    $run_Sql = mysqli_query($con, $sql);
    if($run_Sql){
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['status'];
        $code = $fetch_info['code'];
        if($status == "verified"){
            if($code != 0){
                header('Location: resetpasswordotp.php');
            }
        }else{
            header('Location: userotp.php');
        }
    }
}else{
    header('Location: login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Tailwind CSS CDN link -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css" rel="stylesheet" />
  <link a href="style.css" rel="stylesheet"/>
  <link rel="stylesheet" href="chatbot.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css"/>
  <style>
    /* Set a higher z-index for the navigation bar to keep it on top */
    .nav-bar {
      z-index: 9999;
    }
  </style>

</head>
<body class="bg-auto bg-repeat " style="background-image: url('Resources/book-background.png')">

<nav class="sticky top-0 nav-bar bg-indigo-100 border-blue-200 dark:bg-gray-900" style=" box-shadow: 0 0 0 1px #86b9f7;">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <a href="home.php" class="flex items-center">
        <img src="Resources/logo-no-background.png" class="h-20 mr-5" alt="Kiasu Library Logo" />
    </a>
    <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-indigo-100 focus:outline-none focus:ring-2 focus:ring-indigo-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
        </svg>
    </button>
    <div class="hidden w-full md:block md:w-auto" id="navbar-default">
      <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-indigo-100 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-indigo-100 dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
        <li class="flex items-center">
          <a href="homeloggedin.php" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">HOME</a>
        </li>
       <li class="flex items-center">
          <div class="dropdown">
          <button class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent" >BOOKINGS</button>
            <div class="dropdown-content">
            <a href="bookingsloggedinnew.php">New Bookings</a>
            <a href="bookingsloggedinexisting.php" >Existing Bookings</a>
            </div>
        </div> 
        </li>
        <li class="flex items-center">
          <div class="dropdown">
          <button class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent" >LIBRARY FINDER</button>
            <div class="dropdown-content">
            <a href="library_finderloggedin.php">Libraries</a>
            <a href="Library_Directionsloggedin.php">Directions</a>
            </div>
          </div>        
        </li>
        <li class="flex items-center">
          <a href="seatmaploggedin.php" class="block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500" aria-current="page">SEAT MAP</a>
        </li>
        <li class="flex items-center">
          <a href="feedbackloggedin.php" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">FEEDBACK</a>
        </li>
        <li class="flex items-baseline">
            <div class="dropdown">
            <h1 class="text-xl mb-1">Welcome Back, <span class="font-bold text-blue-700"><?php echo $fetch_info['name'];?></span>!</h1>
            <div class="dropdown-content">
            <a href="settings.php">Settings</a>
            <a href="home.php">Logout</a>
            </div>
            </div>
        </li>
      </ul>
    </div>  
  </div>
</nav>
   <div>
    <div class="flex items-center justify-center h-auto mt-1">
    <div class="max-w-md w-full mx-4 bg-white rounded-lg border border-black shadow-lg p-8">
    <h1 class="text-3xl font-semibold mb-6 text-center">Bookings</h1>
   <?php
    $sessid = 1;

    // (B) GET SESSION SEATS
    $seats = $_RSV->get($sessid);
    ?>

    <!-- (C) DRAW SEATS LAYOUT -->
    <div style="    
    position: absolute;
    margin-left: 104px;
    text-align: center;
    background-color: white;
    width: 175px;
    height: 150px;
    border:2px solid black;
    z-index: 2;
    margin-top: 10px;
    display:flex;
    align-items: center;
    justify-content: center;
    font-family: Arial, Helvetica, sans-serif;
    box-sizing: border-box;">Table</div>
    <div id="layout" ><?php
    foreach (array_slice($seats,0,4) as $s) {
      $taken = is_numeric($s["user_id"]);
      printf("<div class='seat%s'%s>%s</div>",
        $taken ? " taken" : "",
        $taken ? "" : " onclick='reserve.toggle(this)'",
        $s["seat_id"]
      );
    }
    ?></div>
    <div style="    
    position: absolute;
    margin-left: 104px;
    text-align: center;
    background-color: white;
    width: 175px;
    height: 150px;
    border:2px solid black;
    z-index: 2;
    margin-top: 10px;
    display:flex;
    align-items: center;
    justify-content: center;
    font-family: Arial, Helvetica, sans-serif;
    box-sizing: border-box;">Table</div>
    <div id="layout" ><?php
    foreach (array_slice($seats,4,4) as $s) {
      $taken = is_numeric($s["user_id"]);
      printf("<div class='seat%s'%s>%s</div>",
        $taken ? " taken" : "",
        $taken ? "" : " onclick='reserve.toggle(this)'",
        $s["seat_id"]
      );
    }
    ?></div>
    <div id="legend">
      <div class="seat"></div> <div class="txt">Available</div>
      <div class="seat taken"></div> <div class="txt">Taken</div>
    </div>
    </div>
    </div>
    </div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>
</html>