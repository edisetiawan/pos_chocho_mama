<?php
error_reporting(0);
//filter deposit



if($_POST['filter_oke']=="filter_penjualan"){  // echo "tester"; exit();
    $from = (!empty($_POST['from'])) ? $_POST['from'] : "";
    $to   = (!empty($_POST['to'])) ? $_POST['to'] : "";
    
    echo"<script>  location.href='index.php?hal=master/laporan_penjualan/list&from=$from&to=$to' </script>";
    exit();
}

/*if (isset($_POST['filter'])) {  echo "flter penjualan"; exit();
    $from = (!empty($_POST['from'])) ? $_POST['from'] : "";
    $to   = (!empty($_POST['to'])) ? $_POST['to'] : "";
    
    echo"<script>  location.href='index.php?hal=master/laporan_penjualan/list&from=$from&to=$to' </script>";
    exit();
}*/

if (isset($_POST['resetFilter'])) {  
   
    echo"<script>  location.href='index.php?hal=master/laporan_penjualan/list' </script>";

    exit();
}

    $from   = $_GET['from'];

    //echo "SUUU : ".$from;

    $from   = explode('/', $from);
    $from   = array_reverse($from);
    $from   = implode('-', $from);

    $fromTanggal = substr($from, -5, 2);
    $fromBulan =  substr($from, -2);
    $fromTahun = substr($from, 0, 4);

    $outFrom = $fromTahun."-".$fromBulan."-".$fromTanggal;

    $to     = $_GET['to'];
    $to     = explode('/', $to);
    $to     = array_reverse($to);
    $to     = implode('-', $to);

    $toTanggal = substr($to, -5, 2);
    $toBulan =  substr($to, -2);
    $toTahun = substr($to, 0, 4);

    $outTo = $toTahun."-".$toBulan."-".$toTanggal;

    $sql="SELECT *
                                 FROM
                                    `orders`
                                   ";
   
    if(!empty($_GET['from']) && !empty($_GET['to'])){

    $sql.="WHERE tgl_order BETWEEN '".$outFrom."' AND '".$outTo."' ORDER BY id_orders  DESC";

    }

    //echo $sql;
   
    $resultTransaksi=mysql_query($sql);
 
?>
<div class="wrapper">
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    Laporan Penjualan
                    <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                        <a href="javascript:;" class="fa fa-times"></a>
                     </span>
                </header>
                <div class="panel-body">
                <div class="adv-table editable-table ">
                <!-- start -->     
                <div class="clearfix">

              <!--   <form method="post" action="http://localhost/kasir/master/laporan_penjualan/print.php" target="_blank"> -->
                <form method="post" action="http://kasir.ruangprogrammer.com/master/laporan_penjualan/print.php" target="_blank">
                            <?php
                                $from_print       = (!empty($_GET['from'])) ? $_GET['from'] : "";
                                $to_print         = (!empty($_GET['to'])) ? $_GET['to'] : "";
                               
                            ?>

                                <input type="hidden" name="from" value="<?php echo $from_print; ?>">
                                <input type="hidden" name="to" value="<?php echo $to_print; ?>">
                            <div class="btn-group pull-right">
                                 <button type="submit" name="print" class="btn btn-primary">
                                    <i class="fa fa-print"></i>   Print
                                </button>
                            </div>
                </form>

                    <form class="form-inline pull-right" role="form" method="POST" action="">
                        <input type="hidden" name="filter_oke" value="filter_penjualan">
                            <div class="form-group custom-date-range" data-date="13/07/2013" data-date-format="mm/dd/yyyy">

                                        <input type="text" class="form-control dpd1" name="from">

                                                <button class="btn btn-default" type="button">To</button>

                                        <input type="text" class="form-control dpd2" name="to">

                            </div>

                            <div class="form-group">

                           

                                <button class="btn btn-primary" type="submit" name="filter"><i class="fa fa-search"></i> Filter</button> 

                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit" name="resetFilter"><i class="fa fa-repeat"></i> Reset</button> 
                            </div>
                            <div class="form-group">
                               
                            </div>
                    </form>

                 

                </div>
                <!-- end -->
                </div>


                <div class="space15"></div>
                <table class="table table-striped table-hover table-bordered" id="editable-sample">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Order</th>
                        <th>Tanggal Order</th>
                        <th>Petugas</th>
                        <th>Jumlah Item</th>
                        <th>Total</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    $no = 1;
                    $total=0;
                    while ($rowTransaksi = mysql_fetch_array($resultTransaksi)) {
                        $sub_total = +$rowTransaksi['product_price'] * $rowTransaksi['jumlah'];
                       
                        ?>
                        <tr class="" style="text-align: right;">
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $rowTransaksi['id_orders'] ?></td>
                            <td><?php echo $rowTransaksi['tgl_order'] ?>/<?php echo $rowTransaksi['tgl_order'] ?></td>
                            <td><?php echo $rowTransaksi['nama_petugas'] ?></td>
                            <td>
                                <?php
                                $queryQTY = mysql_query("SELECT SUM(orders_detail.jumlah) AS jumlahqty , product.product_id
                        FROM
                            `orders`
                            INNER JOIN `orders_detail` 
                                ON (`orders`.`id_orders` = `orders_detail`.`id_orders`)
                            INNER JOIN `product` 
                                ON (`product`.`product_id` = `orders_detail`.`product_id`) WHERE orders.id_orders='" . $rowTransaksi['id_orders'] . "' ");
                                $QTY = mysql_fetch_array($queryQTY);

                                echo $QTY['jumlahqty'];
                                ?>
                            </td>
                            <td>
                                <?php
                                $queryTotal = mysql_query("SELECT *
                        FROM
                            `orders`
                            INNER JOIN `orders_detail` 
                                ON (`orders`.`id_orders` = `orders_detail`.`id_orders`)
                            INNER JOIN `product` 
                                ON (`product`.`product_id` = `orders_detail`.`product_id`) WHERE orders.id_orders='" . $rowTransaksi['id_orders'] . "'");
                                $totalQuery = 0;
                                while ($rowQueryTotal = mysql_fetch_array($queryTotal)) {

                                    $subTotal = +$rowQueryTotal['jumlah'] * $rowQueryTotal['product_price'];
                                    $totalQuery += $subTotal;
                                }
                                echo "Rp. " . number_format($totalQuery, 0, ',', '.');
                                $total+=$totalQuery;
                                ?>
                            </td>

                        </tr>
                    <?php } ?>
                  
                   <!--      <tr>
                            <td colspan="5">Total </td><td style="text-align: right;">Rp. <?php //echo number_format($total, 0, ',', '.'); ?></td>
                        </tr> -->
                    </tbody>

                </table>
        </div>
        </section>
    </div>
    
</div>
</div>



