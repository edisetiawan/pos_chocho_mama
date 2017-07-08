<?php
error_reporting(0);
$id = $_GET['id'];
$queryCatatan = mysql_query("SELECT * FROM note where note_id = '" . $id . "'");
$rowCatatan = mysql_fetch_array($queryCatatan);
if (isset($_POST['ubah'])) {
    $queryUpdate = mysql_query("UPDATE note SET 
                                    note_name   = '" . $_POST['note_name'] . "',
                                    note_status = '" . $_POST['note_status'] . "',
                                    note_price  = '" . str_replace(".", "", $_POST['note_price']) . "',
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
                    ADD TRANSAKSI
                </header>
                <div class="panel-body">
                    <div class=" form">
                        <form class="cmxform form-horizontal adminex-form" id="commentForm" method="POST"
                              enctype="multipart/form-data" action="">

                            <div class="form-group ">
                                <label for="cname" class="control-label col-lg-2">Nama</label>
                                <div class="col-lg-10">
                                    <input class=" form-control" id="cname" name="note_name" minlength="2" type="text"
                                           value="<?php echo $rowCatatan['note_name'] ?>" required/>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="cemail" class="control-label col-lg-2">Status</label>
                                <div class="col-lg-10">
                                    <select name="note_status" class="form-control ">
                                        <option value="">-- Pilih Status --</option>
                                        <?php
                                        if ($rowCatatan['note_status'] == 'k') {
                                            ?>
                                            <option value="k" selected>Pengeluaran</option>
                                            <option value="m">Pemasukan</option>
                                        <?php } elseif ($rowCatatan['note_status'] == 'm') { ?>
                                            <option value="k">Pengeluaran</option>
                                            <option value="m" selected>Pemasukan</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="cemail" class="control-label col-lg-2">Jumlah </label>
                                <div class="col-lg-10">
                                    <input class="form-control " id="tanpa-rupiah" type="text" name="note_price"
                                           value="<?php echo number_format($rowCatatan['note_price'], 0, ',', '.'); ?>" required/>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="ccomment" class="control-label col-lg-2">Keterangan</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control " id="ccomment" name="note_desc"
                                              required><?php echo $rowCatatan['note_desc']; ?></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button class="btn btn-primary" type="submit" name="ubah">Save</button>
                                    <a href="?hal=master/catatan/list">
                                        <button class="btn btn-default" type="button">Cancel</button>
                                    </a>
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

