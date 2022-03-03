
<form method="post" action="">
<section class="upcoming-meetings" id="meetings">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2 class="font-mirt">เพิ่มข้อมูลกลุ่มผลิตภัณฑ์</h2>
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
    <lable>ชื่อกลุ่มผลิตภัณฑ์</lable> 
    <input type="text" class="control-form" name="<?php echo $i. 'group_name' ; ?>" value=""> <br><br>
    <input type="hidden" name="n" value="<?php echo $n; ?>">
  
   
    <?php endfor ;  ?>
    <input type="submit" name="ins" class="btn btn-primary" value="บันทึกข้อมูลการเพิ่มกลุ่มผลิตภัณฑ์">  
</form>
<?php 
if(isset($_POST['ins'])){
    include 'connection/connection.php' ;
    $n = $_POST['n'];
    for($i=1;$i<=$n;$i++){
        $group_name = $_POST[$i."group_name"];
        $sql = "INSERT INTO group_tb VALUES (?)";
        $params = array($group_name);
        if (sqlsrv_query($conn, $sql , $params)) {
            $alert = '<script type="text/javascript">';
            $alert .= 'alert("เพิ่มข้อมูลกลุ่มผลิตภัณฑ์สำเร็จ !!");';
            $alert .= 'window.location.href = "?page=add_group";';
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