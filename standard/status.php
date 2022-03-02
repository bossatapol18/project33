<style>
    /* body {
    background-color: blue
} */

    .card {
        border: none;
        background: #eee
    }

    .search {
        width: 100%;
        margin-bottom: auto;
        margin-top: 20px;
        height: 50px;
        background-color: #fff;
        padding: 10px;
        border-radius: 5px
    }

    .search-input {
        color: white;
        border: 0;
        outline: 0;
        background: none;
        width: 0;
        margin-top: 5px;
        caret-color: transparent;
        line-height: 20px;
        transition: width 0.4s linear
    }

    .search .search-input {
        padding: 0 10px;
        width: 100%;
        caret-color: #536bf6;
        font-size: 19px;
        font-weight: 300;
        color: black;
        transition: width 0.4s linear
    }

    .search-icon {
        height: 34px;
        width: 34px;
        float: right;
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        background-color: #536bf6;
        font-size: 10px;
        bottom: 30px;
        position: relative;
        border-radius: 5px
    }

    .search-icon:hover {
        color: #fff !important
    }

    a:link {
        text-decoration: none
    }

    .card-inner {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(0, 0, 0, .125);
        border-radius: .25rem;
        border: none;
        cursor: pointer;
        transition: all 2s
    }

    .card-inner:hover {
        transform: scale(1.1)
    }

    .mg-text span {
        font-size: 12px
    }

    .mg-text {
        line-height: 14px
    }
</style>

<?php
$page = (isset($_GET['page'])) ? $_GET['page'] : '';
$strKeyword = '';
if (isset($_POST) && !empty($_POST)) {
    $strKeyword = $_POST["txtKeyword"];
}
// $sql = ("SELECT * , a.standard_idtb,a.standard_status,b.statuss_name AS name_status  FROM main_std a
// INNER JOIN select_status b ON a.standard_status = b.status_name
// WHERE standard_detail  LIKE '%$strKeyword%' OR standard_status LIKE '%$strKeyword%'
// OR standard_number  LIKE '%$strKeyword%' OR standard_note LIKE '%$strKeyword%'OR standard_day  LIKE ' %$strKeyword%' OR statuss_name LIKE '%$strKeyword%'");
$sql = "SELECT * ,  a.standard_source,b.source_id,b.source_name AS name_source FROM main_std a JOIN source_tb b ON a.standard_source = b.source_id WHERE a.standard_number LIKE '%$strKeyword%' ORDER BY standard_idtb desc";
$query = sqlsrv_query($conn, $sql);

// $sql3 = "SELECT * FROM doc_status WHERE standard_idtb=" . $data['standard_idtb'];
// $query3 = sqlsrv_query($conn , $sql3);



$sql2 = "SELECT * FROM select_status";
$query2 = sqlsrv_query($conn, $sql2);
?>
<section>
    <form method="post" action="">
        <div class="section-title">
            <h2 class="font-mirt">เอกสารทั้งหมด</h2>
            <h3 class="font-mirt">หน้าเอกสารทั้งหมด</h3>
        </div>

        <div class="container mb-5">
            <div class="row d-flex justify-content-center">
                <div class="col-md-9">
                    <div class="card p-4 mt-3">
                        <h3 class="heading mt-5 text-center">ค้นหาเอกสารที่นี่</h3>
                        <div class="d-flex justify-content-center px-5">
                            <div class="search"> <input type="text" class="search-input" placeholder="กรุณากรอกเลข มอก. ที่ต้องการค้นหา" name="txtKeyword" id="txtKeyword" value="<?php echo $strKeyword ?>">
                                <button class="search-icon" type="submit" value="ค้นหา"><i class="fa fa-search"></i></button>
                                <!-- <a href="#" class="search-icon"> <i class="fa fa-search"></i> </a>  -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-content font">
            <div id="home" class="container-fluid tab-pane active m-2">
                <div align="right">
                    <a href="?page=insert2" class="btn bt mg-t-bt b-add text-white mg-r" style="background:#4CAF50;">
                        <h5 class="font-mirt">+ เพิ่มเอกสารใหม่</h5>
                    </a>
                </div>
                <hr>
                <!-- <div align="right" class="">
                    <input name="txtKeyword" type="text" id="txtKeyword" style="width:20%;"
                        value="<?php echo $strKeyword; ?>">
                    <button class="btn btn-primary" type="submit" value="ค้นหา">ค้นหา</button>
                </div> -->
                <table class="table table-hover table-responsive-xl  text-center pt-5" style="background-color: white;" id="tableall">
                    <thead>
                        <tr>
                            <th class="col-1 text-center">ลำดับที่</th>
                            <th class="col-1 text-center">วันที่เพิ่มเอกสาร</th>
                            <th class="col-1 text-center">ที่มา</th>
                            <th class="col-1 text-center">วาระจากที่ประชุมสมอ.</th>
                            <th class="col-2 text-center">วาระจากที่ประชุมสมอ./จดหมายสอบถามจากสมอ. วันที่</th>
                            <th class="col-2 text-center">เลขที่มอก.</th>
                            <th class="col-2 text-center">ชื่อมาตรฐาน</th>
                            <th class="col-1 text-center">วันที่เปลี่ยนแปลงสถานะ</th>
                            <!-- <th class="col-1">เลขที่เอกสาร</th> -->
                            <th class="col-2 text-center">สถานะ</th>
                            <th class="col-1 text-center"></th>
                            <th class="col-1 text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php while ($data = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) : ?>
                            <?php
                            $sql3 = "SELECT * ,a.status_name,b.id_statuss,b.statuss_name AS name_status 
                            FROM doc_status a JOIN select_status b  ON a.status_name = b.id_statuss 
                            WHERE a.standard_idtb=" . $data['standard_idtb'] . "ORDER BY a.id_doc_status desc";
                            $query3 = sqlsrv_query($conn, $sql3);
                            ?>
                            <?php $data2 = sqlsrv_fetch_array($query3, SQLSRV_FETCH_ASSOC) ?>
                            <tr class="text-center">
                                <td class="align-middle"><?= $i++ ?></td>
                                <td class="align-middle"><?= dateThai($data['standard_create'])  ?></td>
                                <td class="align-middle"><?= $data['name_source'] ?></td>
                                <td class="align-middle"><?= $data['standard_meet'] ?></td>
                                <?php if ($data['standard_source'] == '1') { ?>
                                    <td class="align-middle"><?= dateThai($data['standard_survey'])  ?></td>
                                <?php } ?>
                                <?php if ($data['standard_source'] == '2') { ?>
                                    <td class="align-middle"><?= dateThai($data['standard_survey'])  ?></td>
                                <?php } ?>
                                <td class="align-middle"><?= $data['standard_number'] ?></td>
                                <td class="align-middle"><?= $data['standard_detail'] ?></td>
                                <?php if ($data2['status_date'] == '') : ?>
                                    <td class="align-middle">ยังไม่ได้ระบุสถานะ</td>
                                <?php endif; ?>
                                <?php if ($data2['status_date']) : ?>
                                    <td class="align-middle"><?= dateThai($data2['status_date']); ?></td>
                                <?php endif; ?>

                                <td class="align-middle"><?= $data2['name_status'] ?></td>

                                <!-- <?php if ($data2['status_name'] == 1) : ?>
                            <td class="align-middle bg-c-g " style=""><?= $data['name_status'] ?></td>
                            <?php endif; ?>
                            <?php if ($data2['status_name'] == 2) : ?>
                            <td class="align-middle  text-lighred bg-c-g" style="">
                                <?= $data['name_status'] ?></td>
                            <?php endif; ?>
                            <?php if ($data2['status_name'] == 3) : ?>
                            <td class="align-middle bg-c-g" style=""><?= $data['name_status'] ?></td>
                            <?php endif; ?>
                            <?php if ($data2['status_name'] == 4) : ?>
                            <td class="align-middle bg-c-g" style="">
                                <?= $data['name_status'] ?></td>
                            <?php endif; ?>
                            <?php if ($data2['status_name'] == 5) : ?>
                            <td class="align-middle bg-c-g" style=" ">
                                <?= $data['name_status'] ?></td>
                            <?php endif; ?>
                            <?php if ($data2['status_name'] == 6) : ?>
                            <td class="align-middle bg-c-g" style=" ">
                                <?= $data['name_status'] ?></td>
                            <?php endif; ?>
                            <?php if ($data2['status_name'] == 7) : ?>
                            <td class="align-middle bg-c-r">
                                <?= $data['name_status'] ?></td>
                            <?php endif; ?> -->
                                <td class="align-middle">
                                    <a href="standard_idtb=<?= $data['standard_idtb'] ?>" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?php echo $data['standard_idtb']; ?>" tyle="background-color:#31f9cb;">ไฟล์แนบ</a>
                                    <?php require('modalstatus.php'); ?>
                                </td>
                                <td class="align-middle">
                                    <div class="mb-3">
                                        <h5>
                                            <!--กดรายงานสถานะแล้วไปหน้าไหนต่อ แล้วในหน้านั้นเป็นประมาณไหน จะได้สร้างถูก -->
                                            <!-- <a href="?page=<? //= $_GET['page'] 
                                                                ?>&function=update&standard_idtb=<? //= $data['standard_idtb'] 
                                                                                                                        ?>" class="btn btn-sm btn-warning">แก้ไขข้อมูลสถานะ</a> -->
                                            <a href="?page=detail&standard_idtb=<?= $data['standard_idtb'] ?>" class="btn btn-sm font-mirt" style="background-color:#31f9cb;">แก้ไข</a>
                                            <!-- <a href="?page=<? //= $_GET['page'] 
                                                                ?>&function=reportprint&standard_idtb=<? //= $data['standard_idtb'] 
                                                                                                                            ?>" onclick="return confirm('คุณต้องการพิมพ์เอกสารนี้ : <? //= $data['standard_number'] 
                                                                                                                                                                                                                ?> หรือไม่ ??')" class="btn btn-sm btn-info">พิมพ์รายงาน</a> -->
                                            <!-- <a href="?page=<? //= $_GET['page'] 
                                                                ?>&function=delete&standard_idtb=<? //= $data['standard_idtb'] 
                                                                                                                        ?>" onclick="return confirm('คุณต้องการลบเอกสารนี้ : <? //= $data['standard_number'] 
                                                                                                                                                                                                        ?> หรือไม่ ??')" class="btn btn-sm btn-danger">ลบเอกสาร</a> -->
                                        </h5>
                                    </div>
                                </td>
                            </tr>

                        <?php endwhile; ?>

                    </tbody>
                </table>
    </form>
    </div>
    </div>
</section>