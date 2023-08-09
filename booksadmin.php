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
    
    if (isset($_POST['deletebooks'])) {
    $book_id = $_POST['book_id'];

    // Step 1: Delete the book
    $stmt_delete = $conn2->prepare("DELETE FROM booktable WHERE id = ?");
    $stmt_delete->bind_param("i", $book_id);
    $delete_result = $stmt_delete->execute();

    if ($delete_result) {
        // Step 2-5: Reset auto-increment IDs
        $reset_query = "
            CREATE TABLE temp_booktable AS SELECT * FROM booktable WHERE id != $book_id;
            ALTER TABLE temp_booktable DROP COLUMN id;
            ALTER TABLE temp_booktable ADD id INT AUTO_INCREMENT PRIMARY KEY FIRST;
            INSERT INTO temp_booktable SELECT * FROM booktable WHERE id = $book_id;
            DROP TABLE booktable;
            ALTER TABLE temp_booktable RENAME TO booktable;
            ALTER TABLE booktable AUTO_INCREMENT = (SELECT MAX(id) + 1 FROM booktable);
        ";
        $conn2->multi_query($reset_query);

        // Redirect to the table view page after deletion and resetting IDs
        header("Location: booksadmin.php");
        exit();
    } else {
        // Handle the deletion error
        $errorMsg = "Failed to delete book from booktable: " . $conn2->error;
        console_log($errorMsg);
    }
}

    
    if (isset($_POST['addbooks'])) {

        $book_name = $_POST['bookname'];
        $stmt = $conn2->prepare("INSERT INTO `booktable` (`name`) VALUES (?)");
        $stmt->bind_param('s', $book_name); // Bind the value to the prepared statement
        $result = $stmt->execute();

        if ($result) {
            header("Location: booksadmin.php"); // Redirect to the table view page after deletion
                exit();

        } else {
            // Handle the deletion error for userbooking table
            $errorMsg = "Failed to add book to booktable: " . $conn2->error;
            console_log($errorMsg); // Assuming you have a function for logging errors
        }
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css"/>
  <style>
    /* Button used to open the contact form - fixed at the bottom of the page */
    .open-button {
      background-color: #1b53fa;
      color: white;
      padding: 16px 20px;
      border: none;
      cursor: pointer;
      opacity: 0.8;
      position: fixed;
      bottom: 23px;
      right: 28px;
      width: 280px;
    }

    /* The popup form - hidden by default */
    .form-popup {
      display: none;
      position: fixed;
      bottom: 0;
      right: 15px;
      border: 3px solid #f1f1f1;
      z-index: 9;
    }

    /* Add styles to the form container */
    .form-container {
      max-width: 300px;
      padding: 10px;
      background-color: white;
    }

    /* Full-width input fields */
    .form-container input[type=text], .form-container input[type=password] {
      width: 100%;
      padding: 15px;
      margin: 5px 0 22px 0;
      border: none;
      background: #f1f1f1;
    }

    /* When the inputs get focus, do something */
    .form-container input[type=text]:focus, .form-container input[type=password]:focus {
      background-color: #ddd;
      outline: none;
    }

    /* Set a style for the submit/login button */
    .form-container .btn {
      background-color: #269dff;
      color: white;
      padding: 16px 20px;
      border: none;
      cursor: pointer;
      width: 100%;
      margin-bottom:10px;
      opacity: 0.8;
    }

    /* Add a red background color to the cancel button */
    .form-container .cancel {
      background-color: gray;
    }

    /* Add some hover effects to buttons */
    .form-container .btn:hover, .open-button:hover {
      opacity: 1;
    }
  </style>
</head>
<body class="bg-auto bg-repeat " style="background-image: url('Resources/book-background.png')">

<nav class="sticky top-0 bg-indigo-100 border-blue-200 dark:bg-gray-900" style=" z-index: 4; box-shadow: 0 0 0 1px #86b9f7;">
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
          <a href="admindashboard.php" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">DASHBOARD</a>
        </li>
        <li class="flex items-center">
          <a href="booksadmin.php" class="block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500" aria-current="page">BOOKS</a>
        </li>
        <li class="flex items-center">
          <a href="seatmapadmin.php" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">SEAT MAP</a>
        </li>
        <li class="flex items-center">
          <div class="dropdown">
          <button class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">FEEDBACK</button>
            <div class="dropdown-content">
            <a href="feedbackbug.php">BUGS</a>
            <a href="feedbackmain.php" >FEEDBACK</a>
            <a href="feedbackothers.php" >OTHERS</a>
            </div>
        </div> 
        </li>
        <li class="flex items-baseline">
            <h1 class="text-xl mb-1">Welcome Back, <span class="font-bold text-blue-700">Admin</span>!</h1>
        </li>
      </ul>
    </div>  
  </div>
</nav>

<div class="flex items-center justify-center h-auto mt-1">
    <div class="max-w-3xl w-full mx-4 bg-white rounded-lg border border-black shadow-lg p-8">
    <h1 class="text-3xl font-semibold mb-6 text-center">Books</h1>
    <?php
    if(!empty($row2)){
    ?>
    <table class="mx-auto">
        <tr style="border:2px solid black;">
            <td style="border:2px solid black; padding: 5px">Book ID</td>
            <td style="border:2px solid black; padding: 5px">Name</td>
            <td style="border:2px solid black; padding: 5px;" >Remove</td>
        </tr><?php foreach ($row2 as $rowbooks) {?>
        <tr style="border:2px solid black;">
        <td style="border:2px solid black; padding: 5px"><?php echo $rowbooks['id']?></td>
        <td style="border:2px solid black; padding: 5px"><?php echo $rowbooks['name']?></td>
        <td style="border:2px solid black; padding: 5px">
            <form action="booksadmin.php" method="POST">
                <input type="hidden" name="book_id" value="<?php echo $rowbooks['id']; ?>">
                <input name="deletebooks" type="submit" class="cursor-pointer form-control button w-full bg-red-500 hover:bg-blue-600 text-white font-medium py-3 px-3 rounded" value="Remove">
            </form>
        </td>
        </tr>
    <?php 
        }
    ?>
    </table>
    <?php
    } else{
    ?>
    <p class="block mb-2 text-sm font-medium text-gray-600 dark:text-white text-center"> No Books Available</p>
    <?php } ?>
    </div>
</div>
    
<button class="open-button" onclick="openForm()">Add Book</button>

<div class="form-popup" id="myForm">
  <form action="booksadmin.php" class="form-container" method="POST">

    <label for="bookname"><b>Book Name:</b></label>
        <input type="text" placeholder="Enter Book Name " name="bookname" required >
        <input type="submit" class="btn" name="addbooks" value="Add">
    <button type="button" class="btn cancel" onclick="closeForm()">Cancel</button>
  </form>
</div>

<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>


     


<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
