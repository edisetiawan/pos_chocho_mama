<?php
if (isset($_GET['hapus'])) {
    $queryHapus = mysql_query("DELETE FROM note where note_id = '" . $_GET['hapus'] . "'");

    if ($queryHapus) {
        echo "<script> alert('Data Berhasil Dihapus'); location.href='index.php?hal=master/catatan/list' </script>";
        exit;
    }
}
?>
<div class="wrapper">
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    List Catatan
                    <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                        <a href="javascript:;" class="fa fa-times"></a>
                     </span>
                </header>
                <div class="panel-body">
                    <div class="adv-table editable-table ">
                        <div class="clearfix">
                            <div class="btn-group">

                                <a href="?hal=master/catatan/add">
                                    <button data-toggle="modal" class="btn btn-primary">
                                        Add New <i class="fa fa-plus"></i>
                                    </button>
                                </a>

                            </div>
                            <div class="btn-group pull-right">
                                <!--     
                                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="#">Print</a></li>
                                        <li><a href="#">Save as PDF</a></li>
                                        <li><a href="#">Export to Excel</a></li>
                                    </ul> 
                                -->
                            </div>
                        </div>
                        <div class="space15"></div>
                        <table class="table table-striped table-hover table-bordered" id="editable-sample">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th width="4%">Transaksi</th>
                                <th>Status</th>
                                <th width="11%">Tanggal</th>
                                <th width="26%">Catatan</th>
                                <th>Nominal</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $no = 1;
                            $total=0;
                            $queryCatatan = mysql_query("SELECT * FROM note ORDER BY note_id DESC");
                            while ($rowCatatan = mysql_fetch_array($queryCatatan)) {
                            $total+=$rowCatatan['note_price'];
                                ?>
                                <tr class="">
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $rowCatatan['note_name']; ?></td>
                                    <td><?php
                                        if ($rowCatatan['note_status'] == 'k') {
                                            echo "Pengeluaran";
                                        } else {
                                            echo "Pemasukan";
                                        }

                                        ?>

                                    </td>
                                    <td><?php echo $rowCatatan['note_date']; ?>
                                    </td>
                                    <td>
                                        <?php
                                        $deskripsi = substr($rowCatatan['note_desc'], 0, 100);
                                        echo $deskripsi;
                                        echo ".....<br>";

                                        ?>
                                    </td>
                                    <td><b>Rp. <?php echo number_format($rowCatatan['note_price'], 0, ',', '.'); ?></b></td>

                                    <td>
                                        <a href="?hal=master/catatan/detail&id=<?php echo $rowCatatan['note_id']; ?>">
                                            <button class="btn btn-primary" type="submit"><i class="fa fa-eye"></i>
                                                Detail
                                            </button>
                                        </a>
                                        <a href="?hal=master/catatan/edit&id=<?php echo $rowCatatan['note_id']; ?>">
                                            <button class="btn btn-primary" type="submit"><i class="fa fa-edit"
                                                                                             aria-hidden="true"></i>
                                                Edit
                                            </button>
                                        </a>
                                        <a href="?hal=master/catatan/list&hapus=<?php echo $rowCatatan['note_id']; ?>">
                                            <button class="btn btn-danger" type="submit" name="hapus"><i
                                                        class="fa fa-trash-o"></i> Delete
                                            </button>
                                        </a>

                                    </td>
                                </tr>
                            <?php } ?>
                           <!--  
                            <tr>
                                <td colspan="5">Total</td><td><b>Rp. <?php  //echo number_format($total, 0, ',', '.'); ?></b></td>
                            </tr>
                            -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>