
<form method="post" action="">
<section class="upcoming-meetings" id="meetings">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2 class="font-mirt">เพิ่มข้อมูลหน่วยงานหลัก</h2>
                </div>
            </div>
        <div class="container card-regis font">
            <hr>
<form action="" method="post">
    <input type="text" class="control-form" name="n" value="">
    <input type="submit" name="s" value="เพิ่มจำนวนฟอร์ม" class="btn btn-info" > 
</form>

<hr>
        <form action="" method="post">
    <?php
    @$n  = $_POST['n'];
    for($i=1;$i<=$n;$i++) : 
    ?>
    <lable>ชื่อหน่วยงานหลัก</lable> 
    <input type="text" class="control-form" name="<?php echo $i. 'department_name' ; ?>" value=""> <br><br>
    <input type="hidden" name="n" value="<?php echo $n; ?>">
  
   
    <?php endfor ;  ?>
    <input type="submit" name="ins" class="btn btn-primary" value="บันทึกข้อมูลการเพิ่มหน่วยงานหลัก">  
</form>
<?php 
if(isset($_POST['ins'])){
    include 'connection/connection.php' ;
    $n = $_POST['n'];
    for($i=1;$i<=$n;$i++){
        $department_name = $_POST[$i."department_name"];
        $sql = "INSERT INTO department_tb VALUES (?)";
        $params = array($department_name);
        if (sqlsrv_query($conn, $sql , $params)) {
            $alert = '<script type="text/javascript">';
            $alert .= 'alert("เพิ่มข้อมูลหน่วยงานหลัก !!");';
            $alert .= 'window.location.href = "?page=add_department";';
            $alert .= '</script>';
            echo $alert;
            exit();;
        } else {
            echo "Error: " . $sql4 . "<br>" . sqlsrv_errors($conn);
        }
        sqlsrv_close($conn);
    }
}
?> 

</form>
</div>



</section>