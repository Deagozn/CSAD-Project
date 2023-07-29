<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Tailwind CSS CDN link -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css" rel="stylesheet" />

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
          <a href="home.php" class="block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500" aria-current="page">HOME</a>
        </li>
        <li class="flex items-center">
          <a href="bookings.php" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">BOOKINGS</a>
        </li>
        <li class="flex items-center">
          <a href="library_finder.php" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">LIBRARY FINDER</a>
        </li>
        <li class="flex items-center">
          <a href="feedback.php" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">FEEDBACK</a>
        </li>
        <li class="flex items-baseline">
          <a href="login.php" type="button" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 text-center ">LOGIN</a>        
        </li>
      </ul>
    </div>  
  </div>
</nav>

<div>
    
</div>
<div class="flex justify-center items-center h-60vh">
  <!-- Image container with relative position -->
  <div class="relative mt-8 mb-8"> <!-- Add 'mt-8' for margin-top and 'mb-8' for margin-bottom -->
      <img src="Resources/bookingtab.png" alt="tab1" class="block w-1100px h-auto mx-auto">
      <!-- Button overlay with absolute position -->
      <button class="absolute bottom-5 right-5 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
          Book now!
      </button>
  </div>
</div>
<div class="flex justify-center items-center h-60vh">
  <!-- Image container with relative position -->
  <div class="relative mt-8 mb-8"> <!-- Add 'mt-8' for margin-top and 'mb-8' for margin-bottom -->
      <img src="Resources/findertab.png" alt="tab1" class="block w-1100px h-auto mx-auto">
      <!-- Button overlay with absolute position -->
      <button class="absolute bottom-5 right-5 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
          Find us!
      </button>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
</body>
</html>