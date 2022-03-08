<form id="form_insert" action="" method="post">

<input type="hidden" name="mode" value="insert_data">

<table id="table_insert">
    <tr>
        <td>ชื่อกลุ่มผลิตภัณฑ์: <input type="text" class="form-control" name="group_name[]"></td>
    </tr>
    <tr>
        <td align="right">
            <button type="button" onclick="$(this).parent().parent().parent().remove();">-ลบ</button>
        </td>
    </tr>
</table>
</form>

<button onclick="add_element('form_insert','table_insert');">+เพิ่ม</button>
<button onclick="$('#form_insert').submit();">บันทึก</button>

<?php
include("./connection/connection.php");
@$mode = $_REQUEST["mode"];

if ($mode == "insert_data") {
$group_name = $_REQUEST["group_name"];


print_r($group_name);

if (count($group_name) > "0") {

foreach ($group_name as $first_name) {

    if (trim($first_name) != "") {
        //    echo "<br>".$first_name; 

         $sql = "INSERT INTO group_tb (group_name)
         VALUES ('$first_name')";
        $pp =sqlsrv_query($conn, $sql);
    }
}
}

//  $sql = "INSERT INTO main_user (user_group_name,user_lname,user_username,user_password,user_status,user_add_date)
//  VALUES ('$group_name','$lname','$username','$password','1','$date_today')";

//  $conn->query($sql);

echo "<script>location.href='?page=add_group';</script>";
}

