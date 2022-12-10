<?php
    include("../auth_admin.php");
    include("../dbConnect.php");
    $employee_name = $_SESSION['employee_name'];
    $email = $_SESSION['email'];
    $phone = $_SESSION['phone'];
    $employeeid = $_SESSION['id'];


    if (isset($_POST['system_id'])) {
        $id = $_POST['system_id'];
        $conn = connect();
        $select_list = mysqli_query($conn,"SELECT * FROM list_of_complaints WHERE sys_complaint_id =".san_out($id)."' ");
        close($conn);
        $names = mysqli_fetch_all($select_list,MYSQLI_ASSOC);
        echo json_encode($names);
    }
?>