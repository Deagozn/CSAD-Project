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

</head>
<body class="bg-auto bg-repeat " style="background-image: url('Resources/book-background.png')">

<nav class="sticky top-0 bg-indigo-100 border-blue-200 dark:bg-gray-900" style=" z-index: 2; box-shadow: 0 0 0 1px #86b9f7;">
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
            <div class="dropdown-content" >
            <a href="bookingsloggedinnew.php">New Bookings</a>
            <a href="bookingsloggedinexisting.php">Existing Bookings</a>
            </div>
          </div> 
        </li>
        <li class="flex items-center">
          <a href="library_finderloggedin.php" class="block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500" aria-current="page">LIBRARY FINDER</a>
        </li>
        <li class="flex items-center">
          <a href="feedbackloggedin.php" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">FEEDBACK</a>
        </li>
        <li class="flex items-baseline">
            <h1 class="text-xl mb-1">Welcome Back, <span class="font-bold text-blue-700"><?php echo $fetch_info['name'];?></span>!</h1>
        </li>

      </ul>
    </div>  
  </div>
</nav>
<div style="z-index: -1">
    <div id="googleMap" class="mt-4" style="margin-left: auto;margin-right: auto; height:500px; width:85%;"></div>

<script>
  function initMap() {
    const JRL = { lat: 1.3331318186552286, lng: 103.73952682201035 };
    const QPL = { lat: 1.2989587537978944, lng: 103.80523734215485 };
    const TRL = { lat: 1.352444742798928, lng: 103.94119518645469 };
    const BPL = { lat: 1.3270474451349594, lng: 103.93172288646228 };
    const map = new google.maps.Map(document.getElementById("googleMap"), {
      zoom: 15,
      center: JRL,
    });

    new google.maps.Marker({
      position: JRL,
      map,
      title: "Jurong Regional Library",
    });

    new google.maps.Marker({
      position: QPL,
      map,
      title: "Queenstown Public Library",
    });

    new google.maps.Marker({
      position: TRL,
      map,
      title: "Tampines Regional Library",
    });

    new google.maps.Marker({
      position: BPL,
      map,
      title: "Bedok Public Library",
    });

    // Get user's location and mark it with a different marker
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(
        function (position) {
          const userLocation = {
            lat: position.coords.latitude,
            lng: position.coords.longitude,
          };

          new google.maps.Marker({
            position: userLocation,
            map,
            title: "Your location",
            icon: "https://maps.google.com/mapfiles/ms/icons/blue-dot.png", // Use a blue dot icon for user location
          });

          // Center the map on the user's location
          map.setCenter(userLocation);
        },
        function (error) {
          console.error("Error getting user's location:", error);
        }
      );
    } else {
      console.log("Geolocation is not supported by this browser.");
    }
  }
</script>
<script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDUqwhL74o67qOliukRhbOf7N4gC35mNi0&callback=initMap&v=weekly"
      defer
    ></script>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
</body>
</html>