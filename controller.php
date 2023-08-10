<?php 
session_start();
require "connection.php";
require 'reserve-lib.php';
$email = "";
$name = "";
$errors = array();
$success= array();

//if user signup button
if(isset($_POST['create_account'])){
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone_number=mysqli_real_escape_string($con,$_POST['phone_number']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cfm_password']);
    if($password !== $cpassword){
        $errors['password'] = "Confirm password not matched!";
    }
    $email_check = "SELECT * FROM usertable WHERE email = '$email'";
    $res = mysqli_query($con, $email_check);
    if(mysqli_num_rows($res) > 0){
        $errors['email'] = "Email that you have entered is already exist!";
    }
    if(count($errors) === 0){
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $code = rand(999999, 111111);
        $status = "notverified";
        $insert_data = "INSERT INTO usertable (name, email, password, code, status,phone_number)
                        values('$name', '$email', '$encpass', '$code', '$status','$phone_number')";
        $data_check = mysqli_query($con, $insert_data);
        if($data_check){
            $email=$_POST['email'];
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
    //if user click verification code submit button
    if(isset($_POST['check'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
        $check_code = "SELECT * FROM usertable WHERE code = $otp_code";
        $code_res = mysqli_query($con, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $fetch_code = $fetch_data['code'];
            $email = $fetch_data['email'];
            $code = 0;
            $status = 'verified';
            $update_otp = "UPDATE usertable SET code = $code, status = '$status' WHERE code = $fetch_code";
            $update_res = mysqli_query($con, $update_otp);
            if($update_res){
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                header('location: homeloggedin.php');
                exit();
            }else{
                $errors['otp-error'] = "Failed while updating code!";
            }
        }else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }

    //if user click login button
    if(isset($_POST['login'])){
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $check_email = "SELECT * FROM usertable WHERE email = '$email'";
        $res = mysqli_query($con, $check_email);
        if(mysqli_num_rows($res) > 0){
            $fetch = mysqli_fetch_assoc($res);
            $fetch_pass = $fetch['password'];
            if(password_verify($password, $fetch_pass)){
                $_SESSION['email'] = $email;
                $status = $fetch['status'];
                if($status == 'verified'){
                  $_SESSION['email'] = $email;
                  $_SESSION['password'] = $password;
                    header('location: homeloggedin.php');
                }else{
                    $info = "It's look like you haven't still verify your email - $email";
                    $_SESSION['info'] = $info;
                    header('location: userotp.php');
                }
            }else{
                $errors['email'] = "Incorrect email or password!";
            }
        }else{
            $errors['email'] = "It's look like you're not yet a member! Click on the bottom link to signup.";
        }
    }

    //if user click continue button in forgot password form
    if(isset($_POST['check_email'])){
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $check_email = "SELECT * FROM usertable WHERE email='$email'";
        $run_sql = mysqli_query($con, $check_email);
        if(mysqli_num_rows($run_sql) > 0){
            $code = rand(999999, 111111);
            $insert_code = "UPDATE usertable SET code = $code WHERE email = '$email'";
            $run_query =  mysqli_query($con, $insert_code);
            if($run_query){
                $subject = "Password Reset Code";
                $message = "Your password reset code is $code";
                $sender = "From: NoReply.KiasuLibrary@gmail.com";
                if(mail($email, $subject, $message, $sender)){
                    $info = "We've sent a passwrod reset otp to your email - $email";
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $email;
                    header('location: resetpasswordotp.php');
                    exit();
                }else{
                    $errors['otp-error'] = "Failed while sending code!";
                }
            }else{
                $errors['db-error'] = "Something went wrong!";
            }
        }else{
            $errors['email'] = "This email address does not exist!";
        }
    }

    //if user click check reset otp button
    if(isset($_POST['check-reset-otp'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
        $check_code = "SELECT * FROM usertable WHERE code = $otp_code";
        $code_res = mysqli_query($con, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $email = $fetch_data['email'];
            $_SESSION['email'] = $email;
            $info = "Please create a new password that you don't use on any other site.";
            $_SESSION['info'] = $info;
            header('location: forgot_passwordpt2.php');
            exit();
        }else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }

    //if user click change password button
    if(isset($_POST['change_password'])){
        $_SESSION['info'] = "";
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $cpassword = mysqli_real_escape_string($con, $_POST['cfm_password']);
        if($password !== $cpassword){
            $errors['password'] = "Confirm password not matched!";
        }else{
            $code = 0;
            $email = $_SESSION['email']; //getting this email using session
            $encpass = password_hash($password, PASSWORD_BCRYPT);
            $update_pass = "UPDATE usertable SET code = $code, password = '$encpass' WHERE email = '$email'";
            $run_query = mysqli_query($con, $update_pass);
            if($run_query){
                $info = "Your password changed. Now you can login with your new password.";
                $_SESSION['info'] = $info;
                header('Location: loginnow.php');
            }else{
                $errors['db-error'] = "Failed to change your password!";
            }
        }
    }
    
   //if login now button click
    if(isset($_POST['loginnow'])){
        header('Location: login.php');
    }
    
    //if save button click
 if(isset($_POST['save'])){
    try {
        // Connect to the database using PDO
        $pdo = new PDO(
            "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET,
            DB_USER, DB_PASSWORD, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);

        // Retrieve the values from the form
        $library=$_POST['library'];
        $userid2 = $_POST['userid3'];
        $date = $_POST['bookingdate'];
        $timing = $_POST['timing'];
        $seatno = 1;
        $books = $_POST['bookselected'];

        // Prepare the INSERT query
        $insert_booking = "INSERT INTO userbooking (date, id, timing, seatnumber, books, library)
                        VALUES (:date, :userid, :timing, :seatno, :books, :library)";

        // Create a prepared statement
        $stmt = $pdo->prepare($insert_booking);

        // Bind the parameters and execute the query
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':userid', $userid2); // Assuming $_POST['userid3'] contains the user id
        $stmt->bindParam(':timing', $timing);
        $stmt->bindParam(':seatno', $seatno);
        $stmt->bindParam(':books', $books);
        $stmt->bindParam(':library',$library);
        $stmt->execute();

        // If the execution is successful, the data should now be in the database
        echo "Data submitted successfully!";
    } catch (PDOException $e) {
        // Handle database errors if any
        // For example, display an error message to the user.
        // echo "Database Error: " . $e->getMessage();
    }
    header("Location: bookingsloggedinnew2.php");
}





if (isset($_POST['completebooking'])) {
    try {
        // Connect to the database using PDO
        $pdo = new PDO(
            "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET,
            DB_USER, DB_PASSWORD, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]
        );

        $userid4 = $_POST['userid4'];
        $reservation_query = "SELECT seat_id FROM reservations WHERE user_id = :userid";
        $stmt = $pdo->prepare($reservation_query);
        $stmt->bindParam(':userid', $userid4);
        $stmt->execute();
        $reservation_data = $stmt->fetchAll();

        if ($reservation_data) {
            
            // Seat number found, update the 'userbooking' table
            $seatno = $reservation_data[0]['seat_id'];

            // Prepare the UPDATE query
            $update_booking_first_row = "UPDATE userbooking SET seatnumber = :seatno WHERE id = :userid";

            // Create a prepared statement for the UPDATE query
            $stmt_update = $pdo->prepare($update_booking_first_row);

            // Bind the parameters for the update query
            $stmt_update->bindParam(':seatno', $seatno);
            $stmt_update->bindParam(':userid', $userid4);

            // Execute the UPDATE query
            $stmt_update->execute();
            
            $userbookings_query="SELECT date, timing, books, library FROM userbooking WHERE id= :userid";
            $stmt_prev_data=$pdo->prepare($userbookings_query);
            $stmt_prev_data->bindParam(':userid', $userid4);
            $stmt_prev_data->execute();
            $userbookings_data= $stmt_prev_data->fetch();
            
            if ($userbookings_data){
                
                $userbooking_insert="INSERT INTO userbooking (date,id,timing,seatnumber,books,library) VALUES (:date, :userid, :timing, :seatno, :books, :library)";
                $stmt_insert= $pdo->prepare($userbooking_insert);
                
                for($i=1;$i < count($reservation_data);$i++){
                    $seatno = $reservation_data[$i]['seat_id']; 
                    $stmt_insert->bindParam(':date', $userbookings_data['date']);
                    $stmt_insert->bindParam(':userid', $userid4);
                    $stmt_insert->bindParam(':timing', $userbookings_data['timing']);
                    $stmt_insert->bindParam(':seatno', $seatno);
                    $stmt_insert->bindParam(':books', $userbookings_data['books']);
                    $stmt_insert->bindParam(':library', $userbookings_data['library']);

                    // Execute the INSERT query
                    $stmt_insert->execute();
                }
            }
        }
    } catch (PDOException $e) {
        // Handle database errors if any
        // For example, display an error message to the user.
        // echo "Database Error: " . $e->getMessage();
    }
    header("Location: bookingsloggedinexisting.php");
}


?>