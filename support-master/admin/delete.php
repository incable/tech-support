<?php
   require 'db_.php';

    if(isset($_POST['delete'])){
        $delete = "DELETE FROM NXT;";
        $result = $conn->query($delete);

        if($result){
            header("location:register_nxt_customer.php?delete='Success'");
        }

    }

?>