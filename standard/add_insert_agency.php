
<form method="post" action="">
<section class="upcoming-meetings" id="meetings">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2 class="font-mirt">เพิ่มข้อมูลหน่วยงานคู่แข่ง</h2>
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
    <lable>ชื่อหน่วยงานคู่แข่ง</lable> 
    <input type="text" class="control-form" name="<?php echo $i. 'agency_name' ; ?>" value=""> <br><br>
    <input type="hidden" name="n" value="<?php echo $n; ?>">
  
   
    <?php endfor ;  ?>
    <input type="submit" name="ins" class="btn btn-primary" value="บันทึกข้อมูลการเพิ่มหน่วยงานคู่แข่ง">  
</form>
<?php 
if(isset($_POST['ins'])){
    include 'connection/connection.php' ;
    $n = $_POST['n'];
    for($i=1;$i<=$n;$i++){
        $agency_name = $_POST[$i."agency_name"];
        $sql = "INSERT INTO agency_tb VALUES (?)";
        $params = array($agency_name);
        $show = sqlsrv_query($conn, $sql, $params);
    }
}
?> 

</form>
</div>



</section>