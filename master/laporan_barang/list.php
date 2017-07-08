<?php
error_reporting(0);

if($_POST['filter_test']=='okay'){
  
    $from           = (!empty($_POST['from'])) ? $_POST['from'] : "";
    $to             = (!empty($_POST['to'])) ? $_POST['to'] : "";
    $product_id     = (!empty($_POST['filterProduct'])) ? $_POST['filterProduct'] : "";

    //echo "<h1>$product_id</h1>";exit();

    echo"<script>  location.href='index.php?hal=master/laporan_barang/list&from=$from&to=$to&product_id=$product_id' </script>";

    exit();
}
/*
 WHERE tgl_order BETWEEN '2017-05-07' AND '2017-05-09' AND
product.product_id=26 GROUP BY product_name;
*/
    $sql="SELECT *
        FROM
            `product`
            INNER JOIN `orders_detail` 
                ON (`product`.`product_id` = `orders_detail`.`product_id`)
            INNER JOIN `orders` 
                ON (`orders`.`id_orders` = `orders_detail`.`id_orders`)
                         ";//);

            $from   = $_GET['from'];
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

    if(!empty($_GET['from']) && !empty($_GET['to'])){
          
    $sql.="WHERE tgl_order BETWEEN '".$outFrom."' AND '".$outTo."'";

    } 

  /*  if (empty($_GET['product_id'])){

        $sql.=" GROUP BY product_name";

    }
    if(!empty($_GET['product_id'])){
        $sql.="";
    }   
*/
    /*else{

    }*/

/*    if (empty($_GET['product_id']) && empty($_GET['from']) && empty($_GET['to'])) {     //filter all
  
             $sql .= "
             GROUP BY product_name
            ";
        
    }
*/

    if (!empty($_GET['product_id']) && empty($_GET['from']) && empty($_GET['to'])) {     //filter all
  
             $sql .= "
              AND product.product_id=$_GET[product_id] 
            ";
        
    }


    if (!empty($_GET['product_id']) && !empty($_GET['from']) && !empty($_GET['to'])) {
        if($_GET['product_id']==""){
            $sql .= "
               
            ";
        }elseif(!empty($_GET['product_id'])){
             $sql .= "
               AND product.product_id=$_GET[product_id] 
            ";
        }
    }

    //echo $sql;

    $resultProduct =mysql_query($sql);

?>
<div class="wrapper">
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    Laporan Penjualan Baedasarkan Nama Barang
                    <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                        <a href="javascript:;" class="fa fa-times"></a>
                     </span>
                </header>



                <div class="panel-body">
                    <div class="adv-table editable-table ">
                        <div class="clearfix">
                        <!-- start -->

               <!--  <form method="post" action="http://localhost/kasir/master/laporan_barang/print.php" target="_blank"> -->
                <form method="post" action="http://kasir.ruangprogrammer.com/master/laporan_barang/print.php" target="_blank">
                  
                    <?php
                        $from_print       = (!empty($_GET['from'])) ? $_GET['from'] : "";
                        $to_print         = (!empty($_GET['to'])) ? $_GET['to'] : "";
                        $product_id_print = (!empty($_GET['product_id'])) ? $_GET['product_id'] : "";
                    ?>

                    <input type="hidden" name="from" value="<?php echo $from_print; ?>">
                    <input type="hidden" name="to" value="<?php echo $to_print; ?>">
                    <input type="hidden" name="product_id" value="<?php echo $product_id_print; ?>">
                                        
                    <div class="btn-group pull-right">
                         <button type="submit" name="print" class="btn btn-primary">
                            <i class="fa fa-print"></i>   Print
                        </button>
                    </div>

                </form>

                    <form class="form-inline pull-right" role="form" method="POST" action="index.php?hal=master/laporan_barang/list">
                        
                    <input type="hidden" name="filter_test" value="okay">

                            <div class="form-group custom-date-range" data-date="13/07/2013" data-date-format="mm/dd/yyyy">

                                        <input type="text" class="form-control dpd1" name="from">

                                                <button class="btn btn-default" type="button">To</button>

                                        <input type="text" class="form-control dpd2" name="to">

                            </div>

                            <div class="form-group">
                                         <select name="filterProduct" class="form-control">
                                         <option value="">-- Pilih Barang --</option>
                                        <?php
                                        $sql_product=mysql_query("SELECT * FROM product ORDER BY product_id DESC");
                                        while($data_product=mysql_fetch_array($sql_product)){
                                        ?>
                                            <option value="<?php echo $data_product['product_id']; ?>"><?php echo $data_product['product_name']; ?></option>
                                        <?php
                                        }
                                        ?>
                                        </select>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit" name="filter"><i class="fa fa-search"></i> Filter</button> 
                            </div>

                            <div class="form-group">
                            <a href="index.php?hal=master/laporan_barang/list">
                                <button class="btn btn-primary" type="submit" name="resetFilter"><i class="fa fa-repeat"></i> Reset</button> 
                           
                            </a>
                            </div>


                            <div class="form-group">
                               
                            </div>
                    </form>
    
                       <!-- end -->
                    </div>


                            <div class="space15"></div>

                            <div id="laporan_pengeluaran">


                                <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID Order</th>
                                        <th>Nama</th>
                                        <th width="11%">Harga</th>
                                        <th>Qty</th>
                                        <th>Tanggal</th>
                                        <th>Sub Total</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <?php
                                    $no = 1;
                                   
                                    $subtotal=0;
                                    while ($rowProduct = mysql_fetch_array($resultProduct)) {
                                     $subtotal = $rowProduct['product_price'] * $rowProduct['jumlah'];
                                        ?>
                                        <tr class="">
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $rowProduct['id_orders']; ?></td>
                                            <td><b><?php echo $rowProduct['product_name'];?></b></td>
                                            <td>
                                                Rp. <?php echo number_format($rowProduct['product_price'], 0, ',', '.'); ?></td>
                                            <td>
                                                <?php echo $rowProduct['jumlah']; ?>
                                            </td>
                                            <td><?php echo $rowProduct['tgl_order']; ?>
                                            </td>
                                            <td>Rp. <?php echo number_format($subtotal, 0, ',', '.'); ?></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            </section>
        </div>
    </div>
</div>

<script type="text/javascript">
    function PrintElem(elem) {
        Popup($(elem).html());
    }

    function Popup(data) {
        var mywindow = window.open('');
        mywindow.document.write('<html><head><title>CeStruk </title></head>');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');
        mywindow.document.close();
        mywindow.print();
    }
</script>