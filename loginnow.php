<?php require_once "controller.php";?>
<?php 
$email = $_SESSION['email'];
if($email == false){
  header('Location: login.php');
}
?>

<!DOCTYPE h
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1" >
  <!-- Tailwind CSS CDN link -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css" rel="stylesheet" />
  <link a href="style.css" rel="stylesheet"/>
</head>
<body class="bg-auto bg-repeat flex items-center justify-center" style="background-image: url('Resources/book-background.png'); height: auto">
  
  <div class="max-w-md w-full mx-4 bg-white rounded-lg border border-black shadow-lg p-8 ">
    <img src="Resources/bluecheckicon.png" class="h-20 " alt="Blue Check Icon" style=" margin-bottom: 5%; margin-left: auto; margin-right: auto; width: 50%; height: auto;"/>
    <h1 class="text-3xl font-semibold mb-6">Login Now</h1>
    <form action="loginnow.php" method="POST">
        <?php 
            if(isset($_SESSION['info'])){
                ?>
                <div class="alert alert-success text-center">
                <?php echo $_SESSION['info']; ?>
                </div>
                <?php
            }
            ?>
        <input type="submit" class="form-control button w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-3 rounded" name="loginnow" value="LOGIN NOW"/>
    </form>