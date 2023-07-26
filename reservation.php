<!DOCTYPE html>
<html>
  <head>
    <title>Seat Reservation</title>
    <meta charset="utf-8">
    <script src="reservation.js"></script>
    <link a href="style.css" rel="stylesheet"/>
  </head>
  <body style="background-image: url('Resources/book-background.png'); background-size:auto; background-repeat: repeat;">
    <?php
    // (A) FIXED IDS FOR THIS DEMO
    $sessid = 1;
    $userid = 999;

    // (B) GET SESSION SEATS
    require "reserve-lib.php";
    $seats = $_RSV->get($sessid);
    ?>

    <!-- (C) DRAW SEATS LAYOUT -->
    <div class="table">Table</div>
    <div id="layout" ><?php
    foreach (array_slice($seats,0,4) as $s) {
      $taken = is_numeric($s["user_id"]);
      printf("<div class='seat%s'%s>%s</div>",
        $taken ? " taken" : "",
        $taken ? "" : " onclick='reserve.toggle(this)'",
        $s["seat_id"]
      );
    }
    ?></div>
    <div class="table">Table</div>
    <div id="layout" ><?php
    foreach (array_slice($seats,4,4) as $s) {
      $taken = is_numeric($s["user_id"]);
      printf("<div class='seat%s'%s>%s</div>",
        $taken ? " taken" : "",
        $taken ? "" : " onclick='reserve.toggle(this)'",
        $s["seat_id"]
      );
    }
    ?></div>     

    <!-- (D) LEGEND -->
    <div id="legend">
      <div class="seat"></div> <div class="txt">Open</div>
      <div class="seat taken"></div> <div class="txt">Taken</div>
      <div class="seat selected"></div> <div class="txt">Your Selected Seats</div>
    </div>

    <!-- (E) SAVE SELECTION -->
    <form id="ninja" method="post" action="4-save.php">
      <input type="hidden" name="sessid" value="<?=$sessid?>">
      <input type="hidden" name="userid" value="<?=$userid?>">
    </form>
    <button id="go" onclick="reserve.save()">Reserve Seats</button>
  </body>
</html>
