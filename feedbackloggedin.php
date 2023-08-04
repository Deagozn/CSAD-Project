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
                header('Location: reset-code.php');
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
    

<nav class="sticky top-0 bg-indigo-100 border-blue-200 dark:bg-gray-900" style=" box-shadow: 0 0 0 1px #86b9f7;">
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
          <a href="homeloggedin.php" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">HOME</a>
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
          <a href="library_finderloggedin.php" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">LIBRARY FINDER</a>
        </li>
        <li class="flex items-center">
          <a href="feedbackloggedin.php" class="block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500" aria-current="page">FEEDBACK</a>
        </li>
        <li class="flex items-baseline">
           <h1 class="text-xl mb-1">Welcome Back, <span class="font-bold text-blue-700"><?php echo $fetch_info['name'];?></span>!</h1> 
        </li>
      </ul>
    </div>  
  </div>
</nav>
<div class="flex items-center justify-center h-screen mt-1">
    <div class="max-w-md w-full mx-4 bg-white rounded-lg border border-black shadow-lg p-8">
    <h1 class="text-3xl font-semibold mb-6">Feedback</h1>
    <form id="feedback_form">
      <div class="mb-6">
        <label for="feedback_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Feedback Type</label>
        <select id="feedback_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
          <option value="BUG" selected>Bugs</option>
          <option value="FEEDBACK">Feedback</option>
          <option value="OTHERS">Others</option>
        </select>
      </div>
      <div class="mb-6">
        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
        <textarea id="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write a breif descrition of your problem/feedback here" required></textarea>
      </div>
        <div class="mb-6">     
            <div class="flex items-center justify-center w-full">
                <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                  <div class="flex flex-col items-center justify-center pt-5 pb-6">
                    <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                    </svg>
                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400 text-center"><span class="font-semibold">Click to upload </span><span class="font-bold">one</span> image to support your feedback/report</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">PNG or JPG (MAX. 800x400px)</p>
                  </div>
                  <input id="dropzone-file" type="file" class="hidden" onchange="displayFileNames(this)"/>
                  <p id="file-names" class="text-sm text-gray-600 mt-2"></p>
                </label>
            </div>
        </div> 
      <button type="submit" id="submit_btn" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-3 rounded">SUBMIT</button>
    </form>
  </div>
</div>
  
<script type="module" src="./feedback.js" ></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
<script>
   function displayFileNames(input) {
    const fileNames = document.getElementById('file-names');
    fileNames.textContent = '';

    for (let i = 0; i < input.files.length; i++) {
      const fileName = input.files[i].name;
      const span = document.createElement('span');
      span.textContent = fileName;
      fileNames.appendChild(span);

      if (i !== input.files.length - 1) {
        fileNames.appendChild(document.createTextNode(', '));
      }
    }
  }
</script>
</body>
</html>