<?php require_once"controller.php";?>
<?php
if(isset($_POST['submitprofile'])){    
        
        //changing name and phone number only

        $userid6 = $_POST['settingsid'];
        $current_email=$_POST['settingsemail'];
        $change_name = mysqli_real_escape_string($con,$_POST['changename']);
        $change_email = mysqli_real_escape_string($con,$_POST['changeemail']);
        $change_phone_number = mysqli_real_escape_string($con,$_POST['changephoneno']);
        
        //change name and phone number only
        $update_profile = "UPDATE usertable SET name='$change_name', phone_number='$change_phone_number' WHERE id= $userid6";
        $run_query2 = mysqli_query($con, $update_profile);
        if ($run_query2) {
            $success['updateprofile'] = "Profile Updated!";
        }

        $nochangepassword = $_POST['nochangepass'];
        $old_password = mysqli_real_escape_string($con, $_POST['old_password']);
        $new_password = mysqli_real_escape_string($con, $_POST['changepassword']);
        $new_cpassword = mysqli_real_escape_string($con, $_POST['changecfm_password']);

        // change password only
        if (!empty($new_password) || !empty($new_cpassword) || !empty($old_password)) {
            if (!password_verify($old_password, $nochangepassword)) {
                $errors['password'] = "Old password not matched!";
            } else if ($new_password !== $new_cpassword) {
                $errors['password'] = "Confirm password not matched!";
            } else {
                // changing password only
                $new_password_hashed = password_hash($new_cpassword, PASSWORD_BCRYPT);
                $update_password = "UPDATE usertable SET password='$new_password_hashed' WHERE id = $userid6";
                $run_query = mysqli_query($con, $update_password);
                if ($run_query) {
                    $success['successchange'] = "Password Change Successfully!";
                } else {
                    $errors['db-error'] = "Failed to Change Password!";
                }
            }
        }
        $email_check = "SELECT * FROM usertable WHERE email = '$change_email'";
        $res = mysqli_query($con, $email_check);
        if(mysqli_num_rows($res) > 0 && $change_email!==$current_email){
            $errors['email'] = "Email that you have entered is already exist!";
        }else if($change_email!==$current_email){
            $code = rand(999999, 111111);
            $status = "notverified";
            $update_email="UPDATE usertable SET email='$change_email', status='$status', code='$code' WHERE id = $userid6";
            $data_check = mysqli_query($con, $update_email);
            if($data_check){
                $email=$_POST['changeemail'];
                $subject = "Email Verification Code";
                $message = "Your verification code is $code";
                $sender = "From: NoReply.KiasuLibrary@gmail.com";
                //Php code to send email
                if(mail($email, $subject, $message, $sender)){
                    $info = "We've sent a verification code to your email - $email";
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $email;
                    $_SESSION['password'] = $password;
                    header('location: userotp.php');
                    exit();
                }else{
                    $errors['otp-error'] = "Failed while sending code!";
                }
            }else{
                $errors['db-error'] = "Failed while inserting data into database!";
            }
        }
     }
?>
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
            <a href="library_finder.php">Libraries</a>
            <a href="Library_Directions.php">Directions</a>
            </div>
          </div>        
        </li>
        <li class="flex items-center">
          <a href="seatmaploggedin.php" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">SEAT MAP</a>
        </li>
        <li class="flex items-center">
          <a href="feedback.php" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">FEEDBACK</a>
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
    <div class="max-w-2xl w-full mx-4 bg-white rounded-lg border border-black shadow-lg p-8">
    <h1 class="text-3xl font-semibold mb-6 text-center">Settings</h1>
    <form action="settingschange.php" method="POST" enctype="multipart/form-data">
    <?php
    if(count($errors) == 1){
    ?>
    <div class="alert alert-danger text-center">
    <?php
    foreach($errors as $showerror){
    echo $showerror;
    }
    ?>
    </div>
    <?php
    }else if(count($errors) > 1){
    ?>
    <div class="alert alert-danger">
    <?php
    foreach($errors as $showerror){
        ?>
        <li><?php echo $showerror; ?></li>
    <?php
    }
    ?>
    </div>
    <?php
    }
    ?>
    <?php 
    if (count($success)==1){
    ?>
    <div class="alert alert-success text-center">
    <?php foreach($success as $showsuccess){
        echo $showsuccess; 
    }
    ?>
    </div>
    <?php
    }else if(count($success) > 1){
    ?>
    <div class="alert alert-success text-center">
    <?php
    foreach($success as $showsuccess){
        ?>
        <li><?php echo $showsuccess; ?></li>
    <?php
    }
    ?>
    </div>
    <?php
    }
    ?>
    <label class="mt-6 block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name:</label>
    <input type="text" name="changename" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $fetch_info['name']; ?>" required/>
    <label class="mt-6 block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email:</label>
    <input type="text" name="changeemail" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $fetch_info['email']; ?>" required/>
    <label class="mt-6 block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone Number:</label>
    <input type="text" name="changephoneno" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $fetch_info['phone_number']; ?>" required/>
    <div class="mt-6 form-group">
    <label class="block text-gray-700 font-medium" for="old_password">Old Password:</label>
    <input type="password" id="old_password" name="old_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter old password to create new password">
    </div>
    <div class="mt-6 form-group">
    <label for="password" class="block text-gray-700 font-medium">New Password:</label>
    <input type="password" id="password" name="changepassword" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter your new password">
    </div>
    <div class="mt-6 form-group">
    <label for="cfm_password" class="block text-gray-700 font-medium">Confirm Password</label>
    <input type="password" id="cfm_password" name="changecfm_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Re-enter your password">
    </div>
    <?php
    $userpass=$fetch_info['password'];
    $userid5=$fetch_info['id'];
    $useremail=$fetch_info['email'];
    ?>
    <input type="hidden" name="nochangepass" value="<?=$userpass?>"/>
    <input type="hidden" name="settingsid" value="<?=$userid5?>"/>
    <input type="hidden" name="settingsemail" value="<?=$useremail?>"/>
    <div class="mt-6">
    <input type="submit" name="submitprofile" value="Update Profile" class="mt-6 cursor-pointer form-control button w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-3 rounded"/>
    </div>
    </form>
    </div>   
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
</body>
</html>
