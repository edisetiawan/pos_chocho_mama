<?php
error_reporting(0);
$id = $_GET['id'];

//echo $id; exit();


$queryCatatan = mysql_query("SELECT * FROM note where note_id = '" . $id . "'");
$rowCatatan = mysql_fetch_array($queryCatatan);
if (isset($_POST['ubah'])) {
    $queryUpdate = mysql_query("UPDATE note SET 
                                    note_name   = '" . $_POST['note_name'] . "',
                                    note_status = '" . $_POST['note_status'] . "',
                                    note_price  = '" . $_POST['note_price'] . "',
                                    note_desc   = '" . $_POST['note_desc'] . "'
                                    WHERE note_id = '" . $id . "'
                                     ");

}
if ($queryUpdate) {
    echo "<script> alert('Data Berhasil DiUbah'); location.href='index.php?hal=master/catatan/list' </script>";
    exit;
}
?>
<!--body wrapper start-->
<div class="wrapper">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    DETAIL PENGELUARAN
                </header>
                <div class="panel-body">
                    <div class=" form">
                        <form class="cmxform form-horizontal adminex-form" id="commentForm" method="POST"
                              enctype="multipart/form-data" action="?hal=master/catatan/list">

                            <div class="form-group ">
                                <label for="cname" class="control-label col-lg-2">Nama</label>
                                <div class="col-lg-10">
                                    <?php echo $rowCatatan['note_name'] ?>
                                </div>
                            </div>


                            <div class="form-group ">
                                <label for="cname" class="control-label col-lg-2">Tanggal </label>
                                <div class="col-lg-10">
                                    <?php echo $rowCatatan['note_date'] ?>
                                </div>
                            </div>


                            <div class="form-group ">
                                <label for="cemail" class="control-label col-lg-2">Status</label>
                                <div class="col-lg-10">


                                    <?php
                                    if ($rowCatatan['note_status'] == 'k') {
                                        ?>
                                        Pengeluaran
                                    <?php } elseif ($rowCatatan['note_status'] == 'm') { ?>
                                        Pemasukan
                                    <?php } ?>

                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="cemail" class="control-label col-lg-2">Jumlah </label>
                                <div class="col-lg-10">Rp. 
                                    <?php echo number_format($rowCatatan['note_price'], 0, ',', '.'); ?>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="ccomment" class="control-label col-lg-2">Keterangan</label>
                                <div class="col-lg-10">
                                    <?php echo $rowCatatan['note_desc']; ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">

                                    <button class="btn btn-primary" type="submit"><i class="fa fa-undo"></i> Kembali
                                    </button>

                                </div>
                            </div>
                        </form>

                    </div>

                </div>
            </section>
        </div>
    </div>
</div>
<!--body wrapper end-->

