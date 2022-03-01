
<form method="post" action="">
<section class="upcoming-meetings" id="meetings">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2 class="font-mirt">เพิ่มข้อมูลสถานะ</h2>
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
    <lable>ชื่อสถานะ</lable> 
    <input type="text" class="control-form" name="<?php echo $i. 'statuss_name' ; ?>" value=""> <br><br>
    <input type="hidden" name="n" value="<?php echo $n; ?>">
  
   
    <?php endfor ;  ?>
    <input type="submit" name="ins" class="btn btn-primary" value="บันทึกข้อมูลการเพิ่มสถานะ">  
</form>
<?php 
if(isset($_POST['ins'])){
    include 'connection/connection.php' ;
    $n = $_POST['n'];
    for($i=1;$i<=$n;$i++){
        $statuss_name = $_POST[$i."statuss_name"];
        $sql = "INSERT INTO select_status VALUES (?)";
        $params = array($statuss_name);
        $show = sqlsrv_query($conn, $sql, $params);
    }
}
?> 

</form>
</div>



</section>