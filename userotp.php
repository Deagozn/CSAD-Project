<?php require_once "controller.php";?>
<?php 
$email = $_SESSION['email'];
if($email == false){
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
  <link a href="style.css" rel="stylesheet">
</head>
<body class="bg-auto bg-repeat flex items-center justify-center h-screen" style="background-image: url('Resources/book-background.png')">
  
  <div class="max-w-md w-full mx-4 bg-white rounded-lg border border-black shadow-lg p-8">
    <img src="Resources/logo-no-background.png" class="h-20 mr-5" alt="Kiasu Library Logo" style="margin-bottom: 30px; margin-left: 30%; width: 50%; height: auto"/>
    <form action="userotp.php" method="POST" autocomplete="off">
                    <h2 class="text-3xl font-semibold mb-6">Code Verification</h2>
                    <?php 
                    if(isset($_SESSION['info'])){
                        ?>
                        <div class="alert alert-success text-center">
                            <?php echo $_SESSION['info']; ?>
                        </div>
                        <?php
                    }
                    ?>
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
                    <div class="form-group">
                        <input class="form-control mt-1 block w-full" type="number" name="otp" placeholder="Enter verification code" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-3 rounded mt-2" type="submit" name="check" value="Submit">
                    </div>
                </form>
           
  </div>
</body>
</html>



