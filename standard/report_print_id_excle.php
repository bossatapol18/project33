<?php
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=report_Excle.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<?php require 'date.php' ; ?>
<!DOCTYPE html>
<html lang="en">

<head></head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ระบบติดตามเอกสาร</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<style>
    .ii{
        display: none;
    }
</style>
<body>

    <?php
    require '../connection/connection.php';
    if (isset($_GET['standard_idtb']) && !empty($_GET['standard_idtb'])) {
        $standard_idtb = $_GET['standard_idtb'];
        $sql = "SELECT * FROM main_std WHERE standard_idtb = '$standard_idtb'";
        $query = sqlsrv_query($conn, $sql);
        $data = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
    }
    ?>
    <center>
        <form action="" method="post" enctype=multipart/form-data>
            <div class=" mb-3">
                <table border="1" class="table table-bordered">
                    <thead>
                        <tr>
                            <th rowspan="3" style="background-color: #3cb371;">ลำดับที่</th>
                            <th rowspan="3" style="background-color: #3cb371;">วาระจากในที่ประชุมสมอ.</th>
                            <th rowspan="3" style="background-color: #3cb371;">เลขที่มอก.</th>
                            <th rowspan="3" style="background-color: #3cb371;">ชื่อมาตรฐาน</th>
                            <th rowspan="3" style="background-color: #3cb371;">หน่วยงานอื่นที่คาดว่าจะทดสอบได้</th>
                            <th rowspan="3" style="background-color: #3cb371;">ประเภทมาตรฐาน</th>
                            <th rowspan="3" style="background-color: #3cb371;">หน่วยงานหลัก</th>
                            <th rowspan="3" style="background-color: #3cb371;">หน่วยงานรอง</th>
                            <th colspan="3" rowspan="2" style="background-color: #ffd747;">ความก้าวหน้าของการขอรับการแต่งตั้ง</th>
                        </tr>
                        <tr>
                          
                        </tr>
                        <tr>
                            <td style="text-align: center; background-color: #ffd747;">ระบุวันที่</td>
                            <td style="text-align: center; background-color: #ffd747;">สถานะ</td>
                            <td style="text-align: center; background-color: #ffd747;">เลขเอกสารที่เกี่ยวข้อง</td>
                        </tr>
                    </thead>
                       
                    <tbody>
                        <?php $i = 1; ?>
                        <tr class="text-center">
                            <td class="align-middle"><?= $i++ ?></td>
                            <td class="align-middle"><?= $data['standard_meet'] ?></td>
                            <td class="align-middle"><?= $data['standard_number'] ?></td>
                            <td class="align-middle"><?= $data['standard_detail'] ?></td>
                            <td style="background-color:;">
                                <?php
                                $ii = 1;
                                $standarsidtb = $_REQUEST['standard_idtb'];
                                $sql2 = "SELECT * ,a.agency_id,b.agency_id,b.agency_name AS name_agency FROM dimension_agency a INNER JOIN agency_tb b ON a.agency_id= b.agency_id 
                                WHERE standard_idtb  = '$standarsidtb' ";
                                $query2 = sqlsrv_query($conn, $sql2);
                                while ($result2 = sqlsrv_fetch_array($query2, SQLSRV_FETCH_ASSOC)) { ?>
                                    <?= $ii++ ?>.<?= $result2['name_agency']; ?><br>
                                <?php } ?>
                            </td>
                            <td>
                            <?php
                                $ii = 1;
                                $standarsidtb = $_REQUEST['standard_idtb'];
                                $sql2 = "SELECT * ,a.standard_mandatory,b.manda_id,b.manda_name AS name_manda FROM main_std a INNER JOIN manda_tb b ON a.standard_mandatory= b.manda_id 
                                WHERE standard_idtb  = '$standarsidtb' ";
                                $query2 = sqlsrv_query($conn, $sql2);
                                while ($result2 = sqlsrv_fetch_array($query2, SQLSRV_FETCH_ASSOC)) { ?>
                                    <?= $ii++ ?>.<?= $result2['name_manda']; ?><br>
                                <?php } ?>
                            </td>
                            
                            <td>
                                <?php
                                $iii = 1;
                                $standarsidtb = $_REQUEST['standard_idtb'];
                                $sql3 = "SELECT * ,b.department_id,c.department_id,c.department_name AS name_department FROM dimension_department b INNER JOIN department_tb c ON b.department_id = c.department_id 
                                WHERE standard_idtb  = '$standarsidtb' ";
                                $query3 = sqlsrv_query($conn, $sql3);
                                while ($result3 = sqlsrv_fetch_array($query3, SQLSRV_FETCH_ASSOC)) { ?>
                                 <?= $result3['name_department']; ?><br>
                                <?php } ?>
                            </td>
                            <td>
                                <?php
                                $iii = 1;
                                $standarsidtb = $_REQUEST['standard_idtb'];
                                $sql10 = "SELECT * ,b.department1_id,c.department1_id,c.department1_name AS name_department1 FROM dimension_department1 b INNER JOIN department1_tb c ON b.department1_id = c.department1_id 
                                WHERE standard_idtb  = '$standarsidtb' ";
                                $query10 = sqlsrv_query($conn, $sql10);
                                while ($result10 = sqlsrv_fetch_array($query10, SQLSRV_FETCH_ASSOC)) { ?>
                                    <?= $iii++ ?>.<?= $result10['name_department1']; ?><br>
                                <?php } ?>
                            </td>
                            <td>
                                <?php
                                $iii = 1;
                                $standarsidtb = $_REQUEST['standard_idtb'];
                                $sql8 = "SELECT * FROM doc_status WHERE standard_idtb  = '$standarsidtb' ";
                                $query8 = sqlsrv_query($conn, $sql8);
                                while ($result8 = sqlsrv_fetch_array($query8, SQLSRV_FETCH_ASSOC)) {
                                $d = $result8['status_date'];
                                $e = explode("-", $d); 
                                ?>
                                <?php echo "วันที่ ".datethai($d)  ?><br>
                                      <?php } ?>
                            </td>
                            <td>
                                <?php
                                $iii = 1;
                                $standarsidtb = $_REQUEST['standard_idtb'];
                                $sql7 = "SELECT * ,a.status_name,b.id_statuss,b.statuss_name AS name_status FROM doc_status a JOIN select_status b  ON a.status_name = b.id_statuss WHERE standard_idtb  = '$standarsidtb' ";
                                $query7 = sqlsrv_query($conn, $sql7);
                                while ($result7 = sqlsrv_fetch_array($query7, SQLSRV_FETCH_ASSOC)) { ?>
                                    <?= $result7['name_status']; ?><br>
                                <?php } ?>
                            </td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </form>
    </center>
</body>

</html>