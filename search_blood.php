<?php
  require_once('connectvars.php');

  if (isset($_POST['submit'])){
    // Connect to the database
    $dbc = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);

    // Grab the user-entered log-in data
    $sb_bdgrp = mysqli_real_escape_string($dbc, trim($_POST['bdgrp']));
    $sb_state = mysqli_real_escape_string($dbc, trim($_POST['sttatte']));
    $sb_city = mysqli_real_escape_string($dbc, trim($_POST['cityy']));

    if (!empty($sb_bdgrp) && !empty($sb_state) && !empty($sb_city)) {
      // Look up the blood group, state and city in the database
      $query = "SELECT full_name, bloodgrp, mobile_number, state, city, units, disease FROM donate WHERE bloodgrp = '$sb_bdgrp' AND state = '$sb_state' AND city = '$sb_city'";
      $data = mysqli_query($dbc, $query);

      while ($row = mysqli_fetch_array($data)){
        echo "<td>$row ['full_name']</td>";
      };
    }
    else {
      $error_msg = 'Sorry.';
      echo "$error_msg";
    }
  }
mysqli_close($dbc);
?>