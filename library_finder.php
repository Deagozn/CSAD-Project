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

<nav class="sticky top-0 bg-indigo-100 border-blue-200 dark:bg-gray-900 z-50" style=" box-shadow: 0 0 0 1px #86b9f7;">
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
          <a href="home.php" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">HOME</a>
        </li>
        <li class="flex items-center">
          <a href="bookings.php" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">BOOKINGS</a>
        </li>
        <li class="flex items-center">
          <div class="dropdown">
          <button class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent" >LIBRARY FINDER</button>
            <div class="dropdown-content">
            <a href="library_finder.php">Locator</a>
            <a href="Library_Directions.php">Directions</a>
            </div>
          </div>        
        </li>
        <li class="flex items-center">
          <a href="seatmap.php" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">SEAT MAP</a>
        </li>
        <li class="flex items-center">
          <a href="feedback.php" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">FEEDBACK</a>
        </li>
        <li class="flex items-baseline">
          <a href="login.php" type="button" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 text-center ">LOGIN</a>        </li>
        </li>

      </ul>
    </div>  
  </div>
</nav>
<div>
    <div class="max-w-5xl w-11/12 mx-4 my-4 bg-gray-100 rounded-lg border border-black shadow-lg p-4">
        <div class="text-blue-700 font-bold text-4xl text-center" >Library Finder</div>
        <div class="text-blue-900 font-semibold text-2xl text-center">Use the map to find the library that is closest to you.</div>
        <div id="googleMap" class="mt-4" style="margin-left: auto;margin-right: auto; height:500px; width:85%;"></div>
    </div>
<script>
  function initMap() {
    const JRL = { lat: 1.3331318186552286, lng: 103.73952682201035 };
    const QPL = { lat: 1.2989587537978944, lng: 103.80523734215485 };
    const TRL = { lat: 1.352444742798928, lng: 103.94119518645469 };
    const BPL = { lat: 1.3270474451349594, lng: 103.93172288646228 };
    const map = new google.maps.Map(document.getElementById("googleMap"), {
      zoom: 15,
      center: JRL
    });

    new google.maps.Marker({
      position: JRL,
      map,
      title: "Jurong Regional Library"
    });

    new google.maps.Marker({
      position: QPL,
      map,
      title: "Queenstown Public Library"
    });

    new google.maps.Marker({
      position: TRL,
      map,
      title: "Tampines Regional Library"
    });

    new google.maps.Marker({
      position: BPL,
      map,
      title: "Bedok Public Library"
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