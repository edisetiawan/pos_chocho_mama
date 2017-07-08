<?php
if (isset($_POST['simpan'])) {

    $queryInsert = mysql_query("INSERT INTO note (note_name,
                note_status,note_price,note_desc,note_date)
                 VALUES ('" . $_POST['note_name'] . "',
                         '" . $_POST['note_status'] . "',
                         '" . str_replace(".", "", $_POST['note_price']). "',
                         '" . $_POST['note_desc'] . "',
                         NOW())");


    if ($queryInsert) {
        echo "<script> alert('Data Berhasil Disimpan'); location.href='index.php?hal=master/catatan/list' </script>";
        exit;
    }
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
                                <label for="cname" class="control-label col-lg-2">Transaksi</label>
                                <div class="col-lg-10">
                                    <input class=" form-control" id="cname" name="note_name" minlength="2" type="text"
                                           required/>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="cemail" class="control-label col-lg-2">Status</label>
                                <div class="col-lg-10">
                                    <select name="note_status" class="form-control ">
                                        <option value="">-- Pilih Status --</option>
                                        <option value="k">Pengeluaran</option>
                                        <option value="m">Pemasukan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="cemail" class="control-label col-lg-2">Jumlah </label>
                                <div class="col-lg-10">
                                    <input class="form-control " id="tanpa-rupiah" type="text" name="note_price" required/>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="ccomment" class="control-label col-lg-2">Keterangan</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control " id="ccomment" name="note_desc" required></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button class="btn btn-primary" type="submit" name="simpan">Save</button>
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

