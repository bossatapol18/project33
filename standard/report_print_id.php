    <?php
    require('pdf.php');
    ?>
    <?php ob_start(); ?>
    <?php
    if (isset($_GET['standard_idtb']) && !empty($_GET['standard_idtb'])) {
        $standard_idtb = $_GET['standard_idtb'];
        $sql = "SELECT * ,main_std.standard_mandatory,manda_tb.manda_id,manda_tb.manda_name AS name_manda   FROM main_std JOIN manda_tb ON main_std.standard_mandatory = manda_tb.manda_id  WHERE standard_idtb='$standard_idtb'";
        $query = sqlsrv_query($conn, $sql);
        $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);

        $sql3 = "SELECT TOP(1) *,a.status_name,b.id_statuss,b.statuss_name AS name_status FROM doc_status a JOIN select_status b  ON a.status_name = b.id_statuss WHERE standard_idtb=" . $result['standard_idtb'] . "ORDER BY id_doc_status desc";
        $query3 = sqlsrv_query($conn, $sql3);
        $data2 = sqlsrv_fetch_array($query3, SQLSRV_FETCH_ASSOC);
    }


    $sql2 = "SELECT * FROM select_status";
    $query2 = sqlsrv_query($conn, $sql2);
    $sql3 = "SELECT * FROM type_tb";
    $query3 = sqlsrv_query($conn, $sql3);

    ?>
    <style>
        body {
            font-family: 'Sarabun', sans-serif;
        }

        .ml {
            margin-left: 5%;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            border-color: whitesmoke;
        }

        th,
        td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #04AA6D;
            color: white;
        }

        tr:hover {
            background-color: whitesmoke;
        }
    </style>

    <?php
    if (isset($_GET['standard_idtb']) && !empty($_GET['standard_idtb'])) {
        $standard_idtb = $_GET['standard_idtb'];
        $sql2 = "SELECT * FROM main_std  WHERE standard_idtb=$standard_idtb";
        $query2 = sqlsrv_query($conn, $sql2);
        $row = sqlsrv_fetch_array($query2, SQLSRV_FETCH_ASSOC);
    }
    ?>

    <body>
        <form action="" method="post">
            <div class="container" style="text-align:center;">
                <img src="./standard/tistr_sitename.png">
                <h3>????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????? 35 ??????????????????????????? </h3>
                <h3>????????????????????????????????????????????? ????????????????????????????????? ??????????????????????????????????????? ????????????????????????????????????????????? 12120</h3>
                <h3 style="text-align:left;">???????????????????????????????????? ??????????????????????????????????????? : <u><?= $row['standard_idtb']; ?></u></h3>
            </div>
            <div class="container">
                <!-- <p class="justify-content-right" style="font-size: 18px;">
            <?php
                date_default_timezone_set('asia/bangkok');
                $date = date('m/d/Y');
                $date3 = DateThai($date);
                $date2 = date('???????????? h:i:s');
                echo '<p align=end>';
                echo $date;
                echo '</p>';
                echo '<p align=end>';
                echo $date2;
                echo '</p>';
                ?>  -->

                <table>
                </table>
                <hr>


                <p><strong>1. ????????????????????????????????? : </strong> <strong style="color: red;"><?php echo $result['standard_detail']; ?></strong></p>
                <p><strong>2. ??????????????? :</strong> <strong style="color: green;"><?= $data2['name_status']; ?></strong></p>
                <p><strong>3. ?????????????????????????????????????????????????????????????????? </strong> </p>
                <div class="row">
                    <div class="col-sm-6">
                        <table style="border-collapse: collapse; width: 100%; text-align:center;margin-top:2%; " class="table table-bordered" border="1">
                            <thead>
                                <tr style="background-color: green;">
                                    <th>????????????????????????????????????????????????</th>
                                    <th>???????????????????????????</th>
                                    <th>???????????????????????????????????????????????????????????????.</th>
                                </tr>
                                <tr>
                                    <td><?= DateThai($result['standard_create']) ?></td>
                                    <td><?= $result['standard_number'] ?></td>
                                    <td><?= $result['standard_meet'] ?></td>
                                </tr>
                            </thead>
                        </table>
                    </div>

                    <div class="col-sm-6">
                        <table style="border-collapse: collapse; width: 100%; text-align:center;margin-top:2%; " class="table table-bordered" border="1">
                            <thead>
                                <tr style="background-color: green;">
                                    <th>???????????????????????????????????????.</th>
                                    <th>?????????????????????????????????</th>
                                    <th>?????????????????????????????????????????????????????????</th>
                                    <th style="background-color:red;">???????????????</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td><?= $result['name_manda'] ?></td>
                                    <td><?= $result['standard_detail'] ?></td>

                                    <?php
                                    $sql4 = "SELECT * ,a.status_name,b.id_statuss,b.statuss_name AS name_status FROM doc_status a JOIN select_status b  ON a.status_name = b.id_statuss WHERE a.standard_idtb=" . $result['standard_idtb'] . "ORDER BY a.id_doc_status desc";
                                    $query4 = sqlsrv_query($conn, $sql4);
                                    ?>

                                    <?php
                                    $j = 1;
                                    while ($data3 = sqlsrv_fetch_array($query4, SQLSRV_FETCH_ASSOC)) { ?>
                                        <?php if ($j != 1) {
                                            echo "<tr><td></td><td></td>";
                                        } ?>
                                        <?php if ($data3['status_date'] == '') : ?>
                                            <td>??????????????????????????????????????????????????????</td>
                                        <?php endif; ?>

                                        <?php if ($data3['status_date']) : ?>
                                            <td><?= dateThai($data3['status_date']); ?></td>
                                        <?php endif; ?>
                                        <td class="align-middle"><?= $data3['name_status'] ?></td>
                                        <?php if ($j != 1) {
                                            echo "</tr>";
                                        } ?>
                                    <?php
                                    $j++;
                                    } ?>

                                    <!-- <?php if ($data2['status_name'] == 1) : ?>
                                        <td><?= $result['name_status'] ?></td>
                                    <?php endif; ?>
                                    <?php if ($data2['status_name'] == 2) : ?>
                                        <td>
                                            <?= $result['name_status'] ?></td>
                                    <?php endif; ?>
                                    <?php if ($data2['status_name'] == 3) : ?>
                                        <td><?= $result['name_status'] ?></td>
                                    <?php endif; ?>
                                    <?php if ($data2['status_name'] == 4) : ?>
                                        <td>
                                            <?= $result['name_status'] ?></td>
                                    <?php endif; ?>
                                    <?php if ($data2['status_name'] == 5) : ?>
                                        <td>
                                            <?= $result['name_status'] ?></td>
                                    <?php endif; ?>
                                    <?php if ($data2['status_name'] == 6) : ?>
                                        <td>
                                            <?= $result['name_status'] ?></td>
                                    <?php endif; ?>
                                    <?php if ($data2['status_name'] == 7) : ?>
                                        <td>
                                            <p>?????????????????????????????????????????????</p>
                                        </td>
                                    <?php endif; ?> -->
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <table style="border-collapse: collapse; width: 100%; text-align:center; margin-top:2%; " class="table table-bordered" border="1">
                    <thead>
                        <tr style="background-color: green;">
                            <!-- <th>????????????????????? tacking </th>
                        <th>????????????????????????</th> -->
                            <th>?????????????????????????????????????????????????????????????????????????????????????????????</th>
                            <th>????????????????????????????????????</th>
                            <th>?????????????????????????????????</th>
                            <th>??????????????????????????????????????????</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <!-- <td><?= $result['standard_tacking']; ?></td>
                        <td><?= $result['standard_note']; ?></td> -->
                            <td>
                                <?php
                                $i = 1;
                                $standarsidtb = $_REQUEST['standard_idtb'];
                                $sql2 = "SELECT * ,a.agency_id,b.agency_id,b.agency_name AS name_agency FROM dimension_agency a INNER JOIN agency_tb b ON a.agency_id= b.agency_id 
                            WHERE standard_idtb  = '$standarsidtb' ";
                                $query2 = sqlsrv_query($conn, $sql2);
                                while ($result2 = sqlsrv_fetch_array($query2, SQLSRV_FETCH_ASSOC)) { ?>
                                    <?= $i++ ?>. <?= $result2['name_agency']; ?><br>
                                <?php } ?>
                            </td>
                            <td>
                                <?php
                                $ii = 1;
                                $standarsidtb = $_REQUEST['standard_idtb'];
                                $sql3 = "SELECT * ,b.department_id,c.department_id,c.department_name AS name_department FROM dimension_department b INNER JOIN department_tb c ON b.department_id = c.department_id 
                            WHERE standard_idtb  = '$standarsidtb' ";
                                $query3 = sqlsrv_query($conn, $sql3);
                                while ($result3 = sqlsrv_fetch_array($query3, SQLSRV_FETCH_ASSOC)) { ?>
                                   <?= $result3['name_department']; ?><br>
                                <?php } ?>
                            </td>
                            <!-- <td>
                                <?php
                                $iii = 1;
                                $standarsidtb = $_REQUEST['standard_idtb'];
                                $sql4 = "SELECT * ,a.type_id,b.type_id,b.type_name AS name_type FROM dimension_type a INNER JOIN type_tb b ON a.type_id = b.type_id 
                            WHERE standard_idtb  = '$standarsidtb' ";
                                $query4 = sqlsrv_query($conn, $sql4);
                                while ($result4 = sqlsrv_fetch_array($query4, SQLSRV_FETCH_ASSOC)) { ?>
                                    <?= $iii++ ?>. <?= $result4['name_type']; ?><br>
                                <?php } ?>
                            </td> -->
                            <!-- ????????? -->
                            <td>
                                <?php
                                $ii = 1;
                                $standarsidtb = $_REQUEST['standard_idtb'];
                                $sql6 = "SELECT * ,b.department1_id,c.department1_id,c.department1_name AS name_department1 FROM dimension_department1 b INNER JOIN department1_tb c ON b.department1_id = c.department1_id 
                            WHERE standard_idtb  = '$standarsidtb' ";
                                $query6 = sqlsrv_query($conn, $sql6);
                                while ($result6 = sqlsrv_fetch_array($query6, SQLSRV_FETCH_ASSOC)) { ?>
                                    <?= $ii++ ?>.<?= $result6['name_department1']; ?><br>
                                <?php } ?>
                            </td>
                            <!-- ????????? -->
                            <td>
                                <?php
                                $iiii = 1;
                                $standarsidtb = $_REQUEST['standard_idtb'];
                                $sql5 = "SELECT * ,a.group_id,b.group_id,b.group_name AS name_group FROM dimension_group a INNER JOIN group_tb b ON a.group_id = b.group_id 
                            WHERE standard_idtb  = '$standarsidtb' ";
                                $query5 = sqlsrv_query($conn, $sql5);
                                while ($result4 = sqlsrv_fetch_array($query5, SQLSRV_FETCH_ASSOC)) { ?>
                                    <?= $iiii++ ?>.<?= $result4['name_group']; ?><br>
                                <?php } ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="row">
                    <p><strong>4. ????????????????????????</strong> </p>
                    <table>
                        <tr>
                            <td>
                                <p style="width:100%; " rows="4"><?= $result['standard_note']; ?></p>
                            </td>
                        </tr>
                    </table>

                </div>
        </form>



    </body>

    <?php require('pdfend.php'); ?>
    <br>
    <a href="Report_PDF.pdf" class="btn btn-warning mt-3">????????????????????????????????? PDF</a>

    <a href="./standard/report_print_id_excle.php?standard_idtb&standard_idtb=<?= $result['standard_idtb'] ?>" class="btn  btn-success mt-3">????????????????????????????????? Excel</a>

    <a href="./standard/report_print_id_word.php?standard_idtb&standard_idtb=<?= $result['standard_idtb'] ?>" class="btn btn-primary mt-3">????????????????????????????????? Word</a>