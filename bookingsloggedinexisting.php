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
if (isset($_POST['deletebooking'])) {
    $servername2 = "localhost";
    $username2 = "root";
    $password2 = "";
    $dbname2 = "userform";

    // Connect to the database
    $conn2 = new mysqli($servername2, $username2, $password2, $dbname2);

    if ($conn2->connect_error) {
        $errorMsg = "Failed to connect to MySQL: " . $conn2->connect_error;
        console_log($errorMsg);
        exit();
    }

    $booking_id = $_POST['booking_id'];
    // Prepare the delete query using prepared statements for userbooking table
    $stmt = $conn2->prepare("DELETE FROM userbooking WHERE booking_id = ?");
    $stmt->bind_param("i", $booking_id); // Assuming booking_id is an integer, use "i" for integer parameter binding
    $result = $stmt->execute();

    if ($result) {
        // Successfully deleted the booking from userbooking table
        // Now proceed to delete from reservations table
        $seatnum = $_POST['seatno'];
        $stmt2 = $conn2->prepare("DELETE FROM reservations WHERE seat_id = ?");
        $stmt2->bind_param("s", $seatnum);
        $result2 = $stmt2->execute();

        if ($result2) {
            // Successfully deleted the booking from reservations table
            header("Location: bookingsloggedinexisting.php"); // Redirect to the table view page after deletion
            exit();
        } else {
            // Handle the deletion error for reservations table
            $errorMsg = "Failed to delete booking from reservations: " . $conn2->error;
            console_log($errorMsg); // Assuming you have a function for logging errors
        }
    } else {
        // Handle the deletion error for userbooking table
        $errorMsg = "Failed to delete booking from userbooking: " . $conn2->error;
        console_log($errorMsg); // Assuming you have a function for logging errors
    }
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
<?php
$servername2 = "localhost";
$username2 = "root";
$password2 = "";
$dbname2 = "userform";

// connect the database with the server
$conn3 = new mysqli($servername2, $username2, $password2, $dbname2);

// if an error occurs
if ($conn3->connect_errno) {
    $errorMsg = "Failed to connect to MySQL: " . $conn3->connect_error;
    console_log($errorMsg);
    exit();
}

$userid = $fetch_info['id'];
$sql3 = "SELECT * FROM userbooking WHERE id = $userid"; // Use named placeholder :userid
$result3 = $conn3->query($sql3);

// Declare an array to store the data from the database.
$row3 = [];

if ($result3->num_rows > 0) {
    // Fetch all data from the result set into the array.
    $row3 = $result3->fetch_all(MYSQLI_ASSOC);
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
    <div class="max-w-2xl w-full mx-4 bg-white rounded-lg border border-black shadow-lg p-8">
    <h1 class="text-3xl font-semibold mb-6 text-center">Bookings</h1>
    <?php
    if(!empty($row3)){
    ?>
    <table class="mx-auto">
        <tr style="border:2px solid black;">
            <td style="border:2px solid black; padding: 5px">Date</td>
            <td style="border:2px solid black; padding: 5px">Timing</td>
            <td style="border:2px solid black; padding: 5px">Seat Number</td>
            <td style="border:2px solid black; padding: 5px">Books</td>
            <td style="border:2px solid black; padding: 5px">Delete</td>
        </tr><?php foreach ($row3 as $row4) {?>
        <tr style="border:2px solid black;">
        <td style="border:2px solid black; padding: 5px"><?php echo $row4['date']?></td>
        <td style="border:2px solid black; padding: 5px"><?php echo $row4['timing']?></td>
        <td style="border:2px solid black; padding: 5px"><?php echo $row4['seatnumber']?></td>
        <td style="border:2px solid black; padding: 5px"><?php echo $row4['books']?></td>
        <td style="border:2px solid black; padding: 5px">
            <form action="bookingsloggedinexisting.php" method="POST">
                <input type="hidden" name="booking_id" value="<?php echo $row4['booking_id']; ?>">
                <input type="hidden" name="seatno" value="<?php echo $row4['seatnumber']; ?>">
                <input name="deletebooking" type="submit" class="cursor-pointer form-control button w-full bg-red-500 hover:bg-blue-600 text-white font-medium py-3 rounded" value="Delete">
            </form>
        </td>
        </tr>
    <?php 
        }
    ?>
    </table>
    <?php
    }
    ?>


    
    </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
</body>
</html>
