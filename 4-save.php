<?php
// (A) LOAD LIBRARY
require "reserve-lib.php";
 
// (B) SAVE
$_RSV->save($_POST["sessid"], $_POST["userid"], $_POST["seats"]);
header('Location: bookingsloggedinnew3.php');
?>