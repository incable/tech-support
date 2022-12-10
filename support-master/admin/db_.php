<?php

      $servername = "rupayee.c1cxf42d2qm3.us-west-2.rds.amazonaws.com";
  $username = "cableguy";
    $password = "Cb1gu7#$62";
    $dbname = "rupayee";

    
    $conn = mysqli_connect($servername, $username, $password, $dbname);
      mysqli_options($conn, MYSQLI_OPT_LOCAL_INFILE, true);

?>