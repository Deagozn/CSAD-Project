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
<div class="flex justify-center items-center h-40 mt-8">
    <a href="#" class="flex flex-col items-center bg-blue-400 border border-gray-200 rounded-lg shadow md:flex-row md:max-w-3xl relative" style="min-width: 80%;">
        <img class="object-fill w-full h-64 md:h-auto md:w-64 md:rounded-none md:rounded-l-lg" src="Resources/image.png" alt="">
        <div class="flex flex-col justify-between p-4 leading-normal">
            <h2 class="mb-2 text-2xl font-bold tracking-tight text-white">Make a booking today!</h2>
            <p class="mb-3 font-3xl text-white">Everything is easier with Kiasu Library, the first-ever library assistant implemented to make your day easier!</p>
            <!-- Button added here -->
            <button class="px-3 py-1 mt-4 text-sm font-medium text-center text-white bg-blue-500 rounded-lg hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300" onclick="redirectTofinder()">
                Book Now!
            </button>
        </div>
    </a>
</div>
    
<div class="flex justify-center items-center h-40 mt-8">
    <a href="#" class="flex flex-col items-center bg-blue-400 border border-gray-200 rounded-lg shadow md:flex-row md:max-w-3xl relative" style="min-width: 80%;">
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
    
    <div class="flex justify-center items-center mt-10 mx-auto max-w-5xl p-4">
        <!-- Centered YouTube Video -->
        <div class="rounded-lg shadow-lg p-6" style="background-color: steelblue; margin-left: 0px;">
            <h1 class="text-xl font-semibold mb-4 text-center"></h1>
            <div class="aspect-w-16 aspect-h-9 flex items-center justify-center" style="">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/7_9U7jyEOyI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            </div>
        </div>
    </div>


<div class="mt-8 flex justify-center items-center flex-wrap">
    <div class="sm:hidden">
        <label for="tabs" class="sr-only">Select tab</label>
        <select id="tabs" class="bg-gray-100 border-0 border-b border-gray-200 text-gray-900 text-sm rounded-t-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option>Statistics</option>
            <option>Services</option>
            <option>FAQ</option>
        </select>
    </div>
    <ul class="text-sm font-medium text-center text-gray-500 divide-x divide-gray-200 rounded-lg dark:divide-gray-600 sm:flex dark:text-gray-400" id="fullWidthTab" data-tabs-toggle="#fullWidthTabContent" role="tablist" style="width:90%;">
        <li class="w-full">
            <button id="stats-tab" data-tabs-target="#stats" type="button" role="tab" aria-controls="stats" aria-selected="true" class="inline-block w-full p-4 rounded-tl-lg bg-gray-50 hover:bg-gray-300 focus:outline-none dark:bg-gray-700 dark:hover:bg-gray-600">Statistics</button>
        </li>
        <li class="w-full">
            <button id="about-tab" data-tabs-target="#about" type="button" role="tab" aria-controls="about" aria-selected="false" class="inline-block w-full p-4 bg-gray-50 hover:bg-gray-300 focus:outline-none dark:bg-gray-700 dark:hover:bg-gray-600">Services</button>
        </li>
        <li class="w-full">
            <button id="faq-tab" data-tabs-target="#faq" type="button" role="tab" aria-controls="faq" aria-selected="false" class="inline-block w-full p-4 rounded-tr-lg bg-gray-50 hover:bg-gray-300 focus:outline-none dark:bg-gray-700 dark:hover:bg-gray-600">FAQ</button>
        </li>
    </ul>
    <div style="width:90%;">
    <div id="fullWidthTabContent" class="border-t border-gray-500 dark:border-gray-600">
        <div class="hidden p-4 bg-gray-50 rounded-lg md:p-8 dark:bg-gray-800" id="stats" role="tabpanel" aria-labelledby="stats-tab">
            <dl class="grid max-w-screen-xl grid-cols-2 gap-8 p-4 mx-auto text-gray-900 sm:grid-cols-3 xl:grid-cols-6 dark:text-white sm:p-8">
                <div class="flex flex-col items-center justify-center">
                    <dt class="mb-2 text-3xl font-extrabold">73M+</dt>
                    <dd class="text-gray-500 dark:text-gray-400">Users</dd>
                </div>
                <div class="flex flex-col items-center justify-center">
                    <dt class="mb-2 text-3xl font-extrabold">100M+</dt>
                    <dd class="text-gray-500 dark:text-gray-400">Bookings Made</dd>
                </div>
                <div class="flex flex-col items-center justify-center">
                    <dt class="mb-2 text-3xl font-extrabold">1000s</dt>
                    <dd class="text-gray-500 dark:text-gray-400">Investors</dd>
                </div>
                <div class="flex flex-col items-center justify-center">
                    <dt class="mb-2 text-3xl font-extrabold">1B+</dt>
                    <dd class="text-gray-500 dark:text-gray-400">Invested</dd>
                </div>
                <div class="flex flex-col items-center justify-center">
                    <dt class="mb-2 text-3xl font-extrabold">90+</dt>
                    <dd class="text-gray-500 dark:text-gray-400">Libraries</dd>
                </div>
                <div class="flex flex-col items-center justify-center">
                    <dt class="mb-2 text-3xl font-extrabold">4M+</dt>
                    <dd class="text-gray-500 dark:text-gray-400">Books</dd>
                </div>
            </dl>
        </div>
        <div class="hidden p-4 bg-gray-50 rounded-lg md:p-8 dark:bg-gray-800" id="about" role="tabpanel" aria-labelledby="about-tab">
            <h2 class="mb-5 text-2xl font-extrabold tracking-tight text-gray-900 dark:text-white">We invest in the Library's potential</h2>
            <!-- List -->
            <ul role="list" class="space-y-4 text-gray-500 dark:text-gray-400">
                <li class="flex space-x-2 items-center">
                    <svg class="flex-shrink-0 w-3.5 h-3.5 text-blue-600 dark:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                    </svg>
                    <span class="leading-tight">Make bookings</span>
                </li>
                <li class="flex space-x-2 items-center">
                    <svg class="flex-shrink-0 w-3.5 h-3.5 text-blue-600 dark:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                    </svg>
                    <span class="leading-tight">Find Libraries</span>
                </li>
                <li class="flex space-x-2 items-center">
                    <svg class="flex-shrink-0 w-3.5 h-3.5 text-blue-600 dark:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                    </svg>
                    <span class="leading-tight">Check seat occupancy</span>
                </li>
            </ul>
        </div>
        <div class="hidden p-4 bg-gray-50 rounded-lg dark:bg-gray-800" id="faq" role="tabpanel" aria-labelledby="faq-tab">
            <div id="accordion-flush" data-accordion="collapse" data-active-classes="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white" data-inactive-classes="text-gray-500 dark:text-gray-400">
                <h2 id="accordion-flush-heading-1">
                    <button type="button" class="flex items-center justify-between w-full py-5 font-medium text-left text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400" data-accordion-target="#accordion-flush-body-1" aria-expanded="true" aria-controls="accordion-flush-body-1">
                    <span>What is Kiasu Library?</span>
                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                    </svg>
                    </button>
                </h2>
                <div id="accordion-flush-body-1" class="hidden" aria-labelledby="accordion-flush-heading-1">
                    <div class="py-5 border-b border-gray-50 dark:border-gray-700">
                    <p class="mb-2 text-gray-500 dark:text-gray-400">Kiasu Library is a library seat booking system.</p>
                    <p class="text-gray-500 dark:text-gray-400"> <a href="about.php" class="text-blue-600 dark:text-blue-500 hover:underline">CLick Here</a> to find out more about us.</p>
                    </div>
                </div>
                <h2 id="accordion-flush-heading-2">
                    <button type="button" class="flex items-center justify-between w-full py-5 font-medium text-left text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400" data-accordion-target="#accordion-flush-body-2" aria-expanded="false" aria-controls="accordion-flush-body-2">
                    <span>How can I book a seat?</span>
                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                    </svg>
                    </button>
                </h2>
                <div id="accordion-flush-body-2" class="hidden" aria-labelledby="accordion-flush-heading-2">
                    <div class="py-5 border-b border-gray-50 dark:border-gray-700">
                    <p class="mb-2 text-gray-500 dark:text-gray-400">You can book a seat by clicking BOOKINGS on the navigation bar or</p>
                    <p class="text-gray-500 dark:text-gray-400"><a href="bookings.php" class="text-blue-600 dark:text-blue-500 hover:underline">Click here</a> to make a booking</p>
                    </div>
                </div>
                <h2 id="accordion-flush-heading-3">
                    <button type="button" class="flex items-center justify-between w-full py-5 font-medium text-left text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400" data-accordion-target="#accordion-flush-body-3" aria-expanded="false" aria-controls="accordion-flush-body-3">
                    <span>Can I cancel my booking?</span>
                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                    </svg>
                    </button>
                </h2>
                <div id="accordion-flush-body-3" class="hidden" aria-labelledby="accordion-flush-heading-3">
                    <div class="py-5 border-b border-gray-50 dark:border-gray-700">
                    <p class="mb-2 text-gray-500 dark:text-gray-400">Yes you can! You can cancel you booking by logging into your account and click existing bookings. You will see the beside every booking there is a delete button. </p>
                    <p class="mb-2 text-gray-500 dark:text-gray-400">You can cancel your booking by clicking that button.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
    }
    
    function redirectTofinder() {
            window.location.href = "library_finder.php";
    }
</script>




<div class="mt-10" style="max-width: 1350px; margin-left: 10%; margin-right: 10%; background-color: lightskyblue; color: white; padding: 10px; text-align: center;">
        <h1 style="margin: 0; font-size: 30px; font-weight: bold;">The "Librarians"</h1>
</div>
<div class="flex flex-col md:flex-row mt-5 md:pl-70" style="margin-left: 10%; margin-right: 10%; margin-top: 20px; " margin-right: 100px;>
  <!-- Card 1  -->
  <div class="w-full max-w-md bg-blue-200 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mx-3 my-4">
    <div class="flex justify-end px-5 pt-5">   
    </div>
    <div class="flex flex-col items-center pb-10">
        <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="Resources/gremlin1.png" alt="gremlin1"/>
        <h4 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">Chester Yong</h4>
        <span class="text-md text-gray-500 dark:text-gray-400 text-center">The "Database Master". Handles most of our required databases and tabs.</span>
        
    </div>
</div>

  <!-- Card 2 -->
  <div class="w-full max-w-md bg-blue-200 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mx-3 my-4">
    <div class="flex justify-end px-5 pt-5">   
    </div>
    <div class="flex flex-col items-center pb-10">
        <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="Resources/gremlin2.jpg" alt="gremlin2"/>
        <h4 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">Nicholas Lee</h4>
        <span class="text-md text-gray-500 dark:text-gray-400 text-center">The "Designer" and the person in charge of media.</span>
        
    </div>
</div>

  <!-- Card 3 -->
  <div class="w-full max-w-md bg-blue-200 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mx-3 my-4">
    <div class="flex justify-end px-5 pt-5">   
    </div>
    <div class="flex flex-col items-center pb-10">
        <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="Resources/gremlin3.jpg" alt="gremlin3"/>
        <h4 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">Bryan Lim</h4>
        <span class="text-md text-gray-500 dark:text-gray-400 text-center">The leader of the three. Handles the rest of what is required and needed to be done.</span>
        
    </div>
</div>
</div>



<footer class="mt-10 mb-0 p-4 bg-white md:p-8 lg:p-10 dark:bg-gray-800" style="background-color: lightskyblue;">
  <div class="mx-auto max-w-screen-xl text-center" >
      <a href="home.php" class="flex justify-center items-center text-2xl font-semibold text-gray-900 dark:text-white">
          <img class="mr-2 h-8" src="Resources/logo-no-background.png" alt="logo">
          Kiasu Library    
      </a>
      <p class="my-6 text-gray-500 dark:text-gray-400">A library-goer's best friend.</p>
      <ul class="flex flex-wrap justify-center items-center mb-10 text-gray-900 dark:text-white">
          <li>
              <a href="about.php" class="mr-4 hover:underline md:mr-6 ">About</a>
          </li>
          <li>
              <a href="feedback.php" class="mr-4 hover:underline md:mr-6">Feedback</a>
          </li>
          <li>
              <a href="bookings.php" class="mr-4 hover:underline md:mr-6">Book now</a>
          </li>
          <li>
              <a href="library_finder.php" class="mr-4 hover:underline md:mr-6">Find us</a>
          </li>
      </ul>
      <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2022-2023 <a href="#" class="hover:underline">Kiasu Library™</a>. All Rights Reserved.</span>
  </div>
</footer>
</body>
</html>
