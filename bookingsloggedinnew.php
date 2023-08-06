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

<?php

    function console_log($data) {
    echo '<script>';
    echo 'console.log(' . json_encode($data) . ')';
    echo '</script>';
}

   $servername2 = "localhost";
   $username2 = "root";
   $password2 = "";
   $dbname2 = "booklist";
     
   // connect the database with the server
   $conn2 = new mysqli($servername2,$username2,$password2,$dbname2);
     
    // if error occurs 
    if ($conn2 -> connect_errno)
    {
       $errorMsg = "Failed to connect to MySQL: " . $conn->connect_error;
       console_log($errorMsg);
       exit();
    }
  
    $sql2 = "select * from booktable";
    $result2 = ($conn2->query($sql2));
    //declare array to store the data of database
    $row2 = []; 
  
    if ($result2->num_rows > 0) 
    {
        // fetch all data from db into array 
        $row2 = $result2->fetch_all(MYSQLI_ASSOC);  
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
  <script src="reservation.js"></script>
</head>
<body class="bg-auto bg-repeat " style="background-image: url('Resources/book-background.png')">

<nav class="sticky top-0 bg-indigo-100 border-blue-200 dark:bg-gray-900" style="z-index: 4; box-shadow: 0 0 0 1px #86b9f7;">
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
          <button class="block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500" aria-current="page">BOOKINGS</button>
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
            <a href="library_finderloggedin.php">Locator</a>
            <a href="Library_Directionsloggedin.php">Directions</a>
            </div>
          </div> 
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
<div>
    <div class="flex items-center justify-center h-auto mt-1">
    <div class="max-w-md w-full mx-4 bg-white rounded-lg border border-black shadow-lg p-8">
    <h1 class="text-3xl font-semibold mb-6 text-center">Bookings</h1>
    <form action="bookingsloggedinnew.php" method="POST" id="mainForm" autocomplete="">
        <?php
        $userid3=$fetch_info['id'];
        ?>
        <div class="mb-6">
        <label for="library" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Library</label>
        <select id="library" name="library" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
            <option value="QtL"             <?php if (isset($_POST['library']) && $_POST['library'] == 'QtL') { echo 'selected="selected"'; } ?> >Queenstown Public Library</option>
            <option value="JurongLibrary"   <?php if (isset($_POST['library']) && $_POST['library'] == 'JurongLibrary') { echo 'selected="selected"'; } ?> >Jurong Regional Library</option>
            <option value="BedokLibrary"    <?php if (isset($_POST['library']) && $_POST['library'] == 'BedokLibrary') { echo 'selected="selected"'; } ?> >Bedok Public Library</option>
            <option value="TampinesLibrary" <?php if (isset($_POST['library']) && $_POST['library'] == 'TampinesLibrary') { echo 'selected="selected"'; } ?> >Tampines Regional Library</option>
        </select>

        </div>
        <div class="mb-6">
        <label for="bookingdate" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date</label>
        <input type="date" id="bookingdate" name="bookingdate" value="<?php if(isset($_POST['bookingdate'])){$date=$_POST['bookingdate']; echo $date;} ?>" required=""/>
        </div>
        <div class="mb-6">
        <label for="starttiming" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Timing</label>
        <select id="timing" name="timing" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
            <option value="8.00am to 9.00am"      <?php if (isset($_POST['timing']) && $_POST['timing'] == '8.00am to 9.00am') { echo 'selected="selected"'; } ?> >8.00am to 9.00am</option>
            <option value="9.00am to 10.00am"     <?php if (isset($_POST['timing']) && $_POST['timing'] == '9.00am to 10.00am') { echo 'selected="selected"'; } ?> >9.00am to 10.00am</option>
            <option value="10.00am to 11.00am"    <?php if (isset($_POST['timing']) && $_POST['timing'] == '10-11') { echo 'selected="selected"'; } ?> >10.00am to 11.00am</option>
            <option value="11.00am to 12.00pm"    <?php if (isset($_POST['timing']) && $_POST['timing'] == '11-12') { echo 'selected="selected"'; } ?> >11.00am to 12.00pm</option>
        </select>
        </div>
        <div class="mb-6">
            
        <label for="books" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Books</label>
        <?php
        if (!empty($row2)) {
            ?>
            <datalist id="books" name="books">
            <option>No Book Selected</option>
            <?php
            foreach ($row2 as $rows2) {
                echo '<option>' . htmlspecialchars($rows2['name']) . '</option>';
            }
            ?>
            </datalist>
        <?php
        }
        ?>
        
        <input placeholder="No Books Selected" name="bookselected" value="<?php if(isset($_POST['bookselected'])){$book=$_POST['bookselected']; echo $book;} ?>" autoComplete="on" list="books" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required=""/> 
        
        </div>
        <input type="hidden" name="userid3" value="<?=$userid3?>">
        <div class="mb-6">
        <input type="submit" name="save" value="Continue" class="cursor-pointer form-control button w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-3 rounded">
        </div>
    </form> 
    
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
</body>
</html>
