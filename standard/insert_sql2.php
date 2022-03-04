<?php
require '../connection/connection.php';
function datetodb($date)
//    23/04/2564
{
    $day = substr($date, 0, 2); // substrตัดข้อความที่เป็นสติง
    $month = substr($date, 3, 2); //ตัดตำแหน่ง
    $year = substr($date, 6) - 543;
    $dateme = $year . '-' . $month . '-' . $day;
    return $dateme; //return ส่งค่ากลับไป
}

$mode = $_REQUEST["mode"];
if ($mode == "insert_data") {
    $standard_meet = $_REQUEST["standard_meet"];
    $standard_number = $_REQUEST["standard_number"];
    $standard_detail = $_REQUEST["standard_detail"];
    $standard_mandatory = $_REQUEST["standard_mandatory"];
    $standard_source = $_REQUEST["standard_source"];
    // วันที่ประชุม
    $standard_survey = datetodb($_REQUEST["standard_survey"]);
    // จดหมายสอบถามสมอ
    // $standard_pick = datetodb($_REQUEST["standard_pick"]);
    // $standard_tacking = $_REQUEST["standard_tacking"];
    $standard_note = $_REQUEST["standard_note"];
    $date = date('Y-m-d');
    //$file = $_REQUEST["file"];
    $group_id = $_REQUEST["group_id"];
    $agency_id = $_REQUEST["agency_id"];
    //$type_id = $_REQUEST["type_id"];
   // $id_doc_status = $_REQUEST["id_doc_status"];
    $department_id = $_REQUEST["department_id"];
    $department1_id = $_REQUEST["department1_id"];
    $sql = "INSERT INTO main_std (standard_source, standard_mandatory , standard_meet  , standard_number , standard_detail , standard_note  ,standard_create, standard_survey ) 
      VALUES ('$standard_source', '$standard_mandatory','$standard_meet','$standard_number','$standard_detail','$standard_note' ,  '$date' ,'$standard_survey')";

    //$conn->query($sql);
    //sqlsrv_close($conn);

    $stmt = sqlsrv_query($conn, $sql);

    $sqlmaxid = "SELECT @@IDENTITY AS 'Maxid'";
    $querymax = sqlsrv_query($conn, $sqlmaxid);
    $resultMaxid = sqlsrv_fetch_array($querymax, SQLSRV_FETCH_ASSOC);

    $standard_idtb =  $resultMaxid['Maxid'];

    $sql_status = "INSERT INTO doc_status ( status_name , status_date , standard_idtb  ) 
            VALUES ('7', '$date', '$standard_idtb')";

            $stmt_status = sqlsrv_query($conn, $sql_status);

    $countgroup = count($group_id);

    //echo $test;


    for ($i = 0; $i < $countgroup; $i++) {
        $groupid =  $group_id[$i];

        //echo "<br>";
        if (trim($groupid) <> "") {

            $sql2 = "INSERT INTO dimension_group ( group_id , standard_idtb  ) 
            VALUES ('$groupid', '$standard_idtb')";

            $stmt2 = sqlsrv_query($conn, $sql2);
        }

        // if ($stmt2 == false) {
        //     die(print_r(sqlsrv_errors()));
        // } else {
        //     echo "บันทึกข้อมูลสำเร็จ1";
        // }


        //echo "<br>";
    }

    //2

    $countagency = count($agency_id);

    //echo $test;


    for ($i = 0; $i < $countagency; $i++) {
        $agencyid =  $agency_id[$i];

        //echo "<br>";

        if (trim($agencyid) <> "") {
            $sql3 = "INSERT INTO dimension_agency ( agency_id , standard_idtb  ) 
            VALUES ('$agencyid', '$standard_idtb')";

            $stmt3 = sqlsrv_query($conn, $sql3);
        }
    }


    $countboxdepartment = count($department_id);

    //echo $test;


    for ($i = 0; $i < $countboxdepartment; $i++) {
        $departmentid =  $department_id[$i];

        //echo "<br>";
        if (trim($departmentid) <> "") {

            $sql4 = "INSERT INTO dimension_department ( department_id , standard_idtb  ) 
      VALUES ('$departmentid', '$standard_idtb')";
            $stmt4 = sqlsrv_query($conn, $sql4);
        }
    }

    $countboxdepartment1 = count($department1_id);
    //echo $test;
    for ($i = 0; $i < $countboxdepartment1; $i++) {
        $department1id =  $department1_id[$i];

        //echo "<br>";
        if (trim($department1id) <> "") {

            $sql11 = "INSERT INTO dimension_department1 ( department1_id , standard_idtb  ) 
      VALUES ('$department1id', '$standard_idtb')";
            $stmt11 = sqlsrv_query($conn, $sql11);
        }
    }



    date_default_timezone_set("Asia/Bangkok");
    $date = date("Y-m-d");
    //เพิ่มไฟล์
    $upload = $_FILES['fileupload'];
    //print_r($upload);
    $count_upload = count($upload['name']);

    for ($i = 0; $i < $count_upload; $i++) {
        $file_name = $upload['name'][$i];
        $file_type = $upload['type'][$i];
        $file_tmp_name = $upload['tmp_name'][$i];
        $file_error = $upload['error'][$i];
        $file_size = $upload['size'][$i];

        // echo "<br> $i . $file_name ";

        if ($file_name != "") {   //not select file
            //โฟลเดอร์ที่จะ upload file เข้าไป 
            $path = "../fileupload/";

            $numrand        = (mt_rand()); //สุ่มตัวเลข
            //$path           = "userfile/"; //กำหนดpath ใหม่
            $type           = strrchr($file_name, "."); //ดึงเฉพาะนามสกุลไฟล์
            $newname        = $date .  $numrand . $type; //ตั้งชื่อใหม่เรียงวันที่ ตัวเลขที่สุม และนามสกุลไฟล์
            $path_copy      = $path . $newname; //กำหนดpath
            //$path_link      = "/fileupload/" . $newname; //กำหนดlink
            //echo $file_name;
            // copy($fltem, $path_copy
            copy($file_tmp_name, $path_copy); //คัดลอกไwล์

            $sql_insert_file = "INSERT INTO dimension_file (fileupload , standard_idtb , upload_date) 
                    VALUES ( '$newname' , '$standard_idtb' , '$date')";
            $insert_file = sqlsrv_query($conn, $sql_insert_file);
        }
    }

    if (sqlsrv_query($conn, $sql5)) {
        $alert = '<script type="text/javascript">';
        $alert .= 'alert("เพิ่มข้อมูลสถานะสำเร็จ !!");';
        $alert .= 'window.location.href = "../index.php?page=status";';
        $alert .= '</script>';
        echo $alert;
        exit();;
    } else {
        echo "Error: " . $sql4 . "<br>" . sqlsrv_errors($conn);
    }
    sqlsrv_close($conn);
}
