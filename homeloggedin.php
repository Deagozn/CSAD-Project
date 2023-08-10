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
</head>
<body class="bg-auto bg-repeat " style="background-image: url('Resources/book-background.png')">

<nav class="sticky top-0 bg-indigo-100 border-blue-200 dark:bg-gray-900" style=" z-index: 4; box-shadow: 0 0 0 1px #86b9f7;">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <a href="homeloggedin.php" class="flex items-center">
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
          <a href="homeloggedin.php" class="block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500" aria-current="page">HOME</a>
        </li>
        <li class="flex items-center">
         <div class="dropdown">
          <button class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent" >BOOKINGS</button>
            <div class="dropdown-content">
            <a href="bookingsloggedinnew.php">New Bookings</a>
            <a href="bookingsloggedinexisting.php">Existing Bookings</a>
            </div>
          </div> 
        </li>
        <li class="flex items-center">
          <div class="dropdown">
          <button class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent" >LIBRARY FINDER</button>
            <div class="dropdown-content">
            <a href="library_finderloggedin.php">Locator</a>
            <a href="Library_Directionsloggedin.php">Directions</a>
            </div>
          </div> 
        </li>
        <li class="flex items-center">
          <a href="seatmaploggedin.php" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">SEAT MAP</a>
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
<div class="flex justify-center items-center h-40 mt-4">
    <a href="#" class="flex flex-col items-center bg-blue-400 border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl relative" style="min-width: 80%;">
        <img class="object-fill w-full h-64 md:h-auto md:w-64 md:rounded-none md:rounded-l-lg" src="Resources/image.png" alt="">
        <div class="flex flex-col justify-between p-4 leading-normal">
            <h2 class="mb-2 text-2xl font-bold tracking-tight text-white">Make a booking today!</h2>
            <p class="mb-3 font-3xl text-white">Everything is easier with Kiasu Library, the first-ever library assistant implemented to make your day easier!</p>
            <!-- Button added here -->
            <button class="px-3 py-1 mt-4 text-sm font-medium text-center text-white bg-blue-500 rounded-lg hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300" onclick="redirectTobooking()">
                Book Now!
            </button>
        </div>
    </a>
</div>
    
<div class="flex justify-center items-center h-40 mt-8">
    <a href="#" class="flex flex-col items-center bg-blue-400 border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl relative" style="min-width: 80%;">
        <img class="object-fill w-full h-64 md:h-auto md:w-64 md:rounded-none md:rounded-l-lg" src="Resources/image2.png" alt="">
        <div class="flex flex-col justify-between p-4 leading-normal">
            <h2 class="mb-2 text-2xl font-bold tracking-tight text-white">Locate a library near you!</h2>
            <p class="mb-3 font-3xl text-white">Locate a suitable library near you through library finder! Why go through all the effort to navigate your way here?</p>
            <!-- Button added here -->
            <button class="px-3 py-1 mt-4 text-sm font-medium text-center text-white bg-blue-500 rounded-lg hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300" onclick="redirectTofinder()">
                Find Us!
            </button>
        </div>
    </a>
</div>
    
<div  class="chat-box">
  <div class="chat-box-header">
      <h3>Need Help?</h3>
      <p>
        <i class="fa fa-times"></i> 
      </p>
  </div>
  <div class="chat-box-body">
    <div class="chat-box-body-receive">
      <p>Hi, how can help you?</p>
    </div>
  </div>
  <div class="chat-box-footer">
      <input placeholder="Enter Your Message" type="text" id="userInput">
      <i id="sendButton" class="send far fa-paper-plane"></i>
  </div>
</div>


<div class="chat-button">
  <span></span>
</div>


<div class="modal">
        <div class="modal-content">
            <span class="modal-close-button">&times;</span>
            <h1>Add What you want here.</h1>
        </div>
    </div>    


<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="chatbot.js"></script>
<script>
    function redirectTobooking() {
        // Get the current page name
        var currentPage = window.location.pathname.split("/").pop();

        // Check if the current page is "home.php"
        if (currentPage === "home.php") {
            window.location.href = "bookings.php"; // Replace with the actual URL
        }
        else {
            window.location.href = "bookingsloggedinnew.php";
        }
        
        function redirectTofinder() {
            window.location.href = "library_finder.php";
    }
    }
</script>
<footer class="mt-10 mb-0 p-4 bg-white md:p-8 lg:p-10 dark:bg-gray-800">
  <div class="mx-auto max-w-screen-xl text-center">
      <a href="home.php" class="flex justify-center items-center text-2xl font-semibold text-gray-900 dark:text-white">
          <img class="mr-2 h-8" src="Resources/logo-no-background.png" alt="logo">
          Kiasu Library    
      </a>
      <p class="my-6 text-gray-500 dark:text-gray-400">A library-goer's best friend.</p>
      <ul class="flex flex-wrap justify-center items-center mb-10 text-gray-900 dark:text-white">
          <li>
              <a href="#" class="mr-4 hover:underline md:mr-6 ">About</a>
          </li>
          <li>
              <a href="feedbackloggedin.php" class="mr-4 hover:underline md:mr-6">Feedback</a>
          </li>
          <li>
              <a href="#" class="mr-4 hover:underline md:mr-6 ">Campaigns</a>
          </li>
          <li>
              <a href="bookingsloggedinnew.php" class="mr-4 hover:underline md:mr-6">Book now</a>
          </li>
          <li>
              <a href="library_finderloggedin.php" class="mr-4 hover:underline md:mr-6">Find us</a>
          </li>
          <li>
              <a href="#" class="mr-4 hover:underline md:mr-6">FAQs</a>
          </li>
          <li>
              <p class="mr-4 md:mr-6">Contact</p>
          </li>
      </ul>
      <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2022-2023 <a href="#" class="hover:underline">Kiasu Library™</a>. All Rights Reserved.</span>
  </div>
</footer>
</body>
</html>