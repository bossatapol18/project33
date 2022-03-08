<section class="upcoming-meetings" id="meetings">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2 class="font-mirt">เพิ่มข้อมูลหน่วยงานอื่นที่คาดว่าจะทดสอบได้</h2>
                </div>
            </div>
            <div class="mb-3">
            <button class="btn btn-success bt mg-t-bt b-add mt-3" onclick="add_element('form_insert','table_insert');">+ เพิ่ม</button>

            </div>
         
            <form id="form_insert" action="" method="post">

                <input type="hidden" name="mode" value="insert_data">
                <table>
                    <tr>
                        <td>ชื่อหน่วยงานอื่นที่คาดว่าจะทดสอบได้ <input type="text" class="form-control" width="40%" name="agency_name[]"></td>
                    </tr>
                </table>
                <table id="table_insert" style="display:none;">
                    <div class="input-group" id="subtable_insert">
                        <tr>
                            <td>ชื่อหน่วยงานอื่นที่คาดว่าจะทดสอบได้ <input type="text" class="form-control" width="40%" name="agency_name[]"></td>
                        </tr>
                        <tr>
                            <td align="right">
                                <button class="btn btn-danger bt mg-t-bt b-add" type="button" onclick="$(this).parent().parent().parent().remove();">ลบ</button>
                            </td>
                        </tr>
                    </div>

                </table>
            </form>
        </div>
        <button class="btn btn-primary mt-3" onclick="$('#form_insert').submit();">บันทึก</button>

    </div>
</section>


<?php
include("./connection/connection.php");
@$mode = $_REQUEST["mode"];

if ($mode == "insert_data") {
    $agency_name = $_REQUEST["agency_name"];


    print_r($agency_name);

    if (count($agency_name) > "0") {

        foreach ($agency_name as $first_name) {

            if (trim($first_name) != "") {
                //    echo "<br>".$first_name; 

                $sql = "INSERT INTO agency_tb (agency_name)
         VALUES ('$first_name')";
                $pp = sqlsrv_query($conn, $sql);
            }
        }
    }

    //  $sql = "INSERT INTO main_user (user_agency,user_lname,user_username,user_password,user_status,user_add_date)
    //  VALUES ('$agency','$lname','$username','$password','1','$date_today')";

    //  $conn->query($sql);

    echo "<script>location.href='?page=add_agency';</script>";
}
