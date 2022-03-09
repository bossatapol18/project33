<?php include('../connection/connection.php'); ?>
<?php 


$id_dimension_department1 = $_REQUEST["id_dimension_department1"];
$sql = "DELETE FROM dimension_department1 WHERE id_dimension_department1=$id_dimension_department1";
$query = sqlsrv_query($conn, $sql);

echo "<script>history.go(-1);</script>";
?>