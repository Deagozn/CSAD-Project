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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css"/>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>
<body class="bg-auto bg-repeat " style="background-image: url('Resources/book-background.png')">

<nav class="sticky top-0 bg-indigo-100 border-blue-200 dark:bg-gray-900 w-full" style=" z-index: 4; box-shadow: 0 0 0 1px #86b9f7;">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <a href="admindashboard.php" class="flex items-center">
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
          <a href="admindashboard.php" class="block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500" aria-current="page">DASHBOARD</a>
        </li>
        <li class="flex items-center">
          <a href="booksadmin.php" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">BOOKS</a>
        </li>
        <li class="flex items-center">
          <a href="seatmapadmin.php" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">SEAT MAP</a>
        </li>
        <li class="flex items-center">
          <div class="dropdown">
          <button class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">FEEDBACK</button>
            <div class="dropdown-content">
            <a href="feedbackbug.php">BUGS</a>
            <a href="feedbackmain.php" >FEEDBACK</a>
            <a href="feedbackothers.php" >OTHERS</a>
            </div>
        </div> 
        </li>
        <li class="flex items-baseline">
            <h1 class="text-xl mb-1">Welcome Back, <span class="font-bold text-blue-700">Admin</span>!</h1>
        </li>
      </ul>
    </div>  
  </div>
</nav>
    
<div class="max-w-sm w-full bg-gray-300 rounded-lg shadow dark:bg-gray-800 p-4 md:p-6 my-4 mx-3" style="max-height: 450px">
  
  <div class="flex justify-between mb-3">
      <div class="flex justify-center items-center">
          <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white pr-1">Feedback</h5>
          <svg data-popover-target="chart-info-1" data-popover-placement="bottom" class="w-3.5 h-3.5 text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white cursor-pointer ml-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm0 16a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3Zm1-5.034V12a1 1 0 0 1-2 0v-1.418a1 1 0 0 1 1.038-.999 1.436 1.436 0 0 0 1.488-1.441 1.501 1.501 0 1 0-3-.116.986.986 0 0 1-1.037.961 1 1 0 0 1-.96-1.037A3.5 3.5 0 1 1 11 11.466Z"/>
          </svg>
          <div data-popover id="chart-info-1" role="tooltip" class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
              <div class="p-3 space-y-2">
                  <h3 class="font-semibold text-gray-900 dark:text-white">Feedback Analysis</h3>
                  <p>This shows the proportion of the different type of feedback recieved.</p>
              </div>
          </div>
        </div>   
  </div>

  <!-- Line Chart -->
  <div class="py-6" id="donut-chart"></div>

  <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
    <div class="flex justify-between items-center pt-5">
      <!-- Button -->
      <button
        id="dropdownDefaultButton"
        data-dropdown-toggle="lastDaysdropdown"
        data-dropdown-placement="bottom"
        class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-900 text-center inline-flex items-center dark:hover:text-white"
        type="button">
        Last 7 days
        <svg class="w-2.5 m-2.5 ml-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
        </svg>
      </button>
      <div id="lastDaysdropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
          <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
            <li>
              <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Yesterday</a>
            </li>
            <li>
              <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Today</a>
            </li>
            <li>
              <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 7 days</a>
            </li>
            <li>
              <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 30 days</a>
            </li>
            <li>
              <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 90 days</a>
            </li>
          </ul>
      </div>
    </div>
  </div>
</div>

    <div class="flex h-auto my-4 mx-3" style="min-width: 600px">
    <div class="max-w-md w-full  bg-gray-300 rounded-lg border border-black shadow-lg p-8">
    <div class="flex justify-between mb-5">
      <div class="flex justify-center items-center">
          <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white pr-1">Seat-Map</h5>
          <svg data-popover-target="chart-info-2" data-popover-placement="bottom" class="w-3.5 h-3.5 text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white cursor-pointer ml-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm0 16a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3Zm1-5.034V12a1 1 0 0 1-2 0v-1.418a1 1 0 0 1 1.038-.999 1.436 1.436 0 0 0 1.488-1.441 1.501 1.501 0 1 0-3-.116.986.986 0 0 1-1.037.961 1 1 0 0 1-.96-1.037A3.5 3.5 0 1 1 11 11.466Z"/>
          </svg>
          <div data-popover id="chart-info-2" role="tooltip" class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
              <div class="p-3 space-y-2">
                  <h3 class="font-semibold text-gray-900 dark:text-white">Seat Map</h3>
                  <p>Shows the seats that are free/occupied.</p>
              </div>
          </div>
        </div>   
  </div>
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
    
<script src="feedback_donut.js" type="module"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>