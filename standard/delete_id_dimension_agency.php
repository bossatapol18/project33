<?php include('../connection/connection.php'); ?>
<?php 


$id_dimension_agency = $_REQUEST["id_dimension_agency"];
// เปลี่ยนตรงนี้เป็น UPDATE โดยให้มีฟิลด์ flag_delete = 1
$sql = "DELETE FROM dimension_agency WHERE id_dimension_agency=$id_dimension_agency";
$query = sqlsrv_query($conn, $sql);

echo "<script>history.go(-1);</script>";
?>