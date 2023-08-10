<?php require_once "controller.php";?>
<?php
      if(isset($_POST['loginadmin'])){
        $password = mysqli_real_escape_string($con, $_POST['passwordadmin']);
        $getpw = "SELECT password FROM admin WHERE id = 1";
        $admin = mysqli_query($con, $getpw);
        $fetch = mysqli_fetch_assoc($admin);
        $cpw = $fetch['password'];
        if ($password === $cpw) {
          header('location: admindashboard.php');  
        }else{
          $errors['Password'] = "Password is incorrect!";
        }
 
    } ?>
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
<body class="bg-auto bg-repeat flex items-center justify-center h-screen" style="background-image: url('Resources/book-background.png')">
  
  <div class="max-w-md w-full mx-4 bg-white rounded-lg border border-black shadow-lg p-8">
    <img src="Resources/logo-no-background.png" class="h-20 mr-5" alt="Kiasu Library Logo" style="margin-bottom: 30px; margin-left: 30%; width: 50%; height: auto"/>
    <h1 class="text-3xl font-semibold mb-6 text-center">Admin</h1>
    <form action="adminlogin.php" method="POST" autocomplete="">
         <?php
                    if(count($errors) > 0){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
      <div class="mb-6">
        <label for="password" class="block text-gray-700 font-medium">Password</label>
        <input type="password" id="password" name="passwordadmin" class="form-input mt-1 block w-full" placeholder="Enter your password" required>
      </div>
      <input type="submit" class="form-control button w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-3 rounded" name="loginadmin" value="LOGIN"/>
      
    </form>
  </div>

</body>
</html>
