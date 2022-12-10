<table border="1">
    <tr bgcolor="#00DFFF">
        <th>No</th>
        <th>Operator_Id</th>
        <th>Active</th>
        <th>TRAN_COUNT</th>
        <th>collected</th>
    </tr>
<?php 
    include("../../auth_admin.php");
    include("../../dbConnect.php");
    $id = $_GET['id'];
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=$id-usage-details.xls");
    $conn = connect();
    $query = mysqli_query($conn,"SELECT CUST.Operator_Id,CUST.ACTIVE, CNT.TRAN_COUNT,CNT.collected from (SELECT Count(*) ACTIVE, OPERATOR_ID from CUSTOMER where SERVICE_STATUS = 'Active' group by OPERATOR_ID) CUST,(SELECT count(*) as TRAN_COUNT, sum(COLLECTED_AMOUNT) as collected, OPERATOR_ID from ALL_COLLECTION_REPORT where SYNC_MONTH = '$id' group by OPERATOR_ID) CNT where CUST.OPERATOR_ID = CNT.OPERATOR_ID");
    close($conn);
    $i=1;
    while ($data = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
        echo '<tr>
        		<td>'.$i.'</td>
                <td>'.$data['Operator_Id'].'</td>
                <td>'.$data['ACTIVE'].'</td>
                <td>'.$data['TRAN_COUNT'].'</td>
                <td>'.$data['collected'].'</td>
             </tr>';
        $i++;
    }
?>
</table>