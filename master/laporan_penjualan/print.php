<?php
session_start();
error_reporting(0);
include("../../config.php");

//$queryTransaksi = mysql_query(
    $from   = $_POST['from'];
    $from   = explode('/', $from);
    $from   = array_reverse($from);
    $from   = implode('-', $from);

    $fromTanggal = substr($from, -5, 2);
    $fromBulan =  substr($from, -2);
    $fromTahun = substr($from, 0, 4);

    $outFrom = $fromTahun."-".$fromBulan."-".$fromTanggal;

    $to     = $_POST['to'];
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
                                   ";//);
   
    if(!empty($_POST['from']) && !empty($_POST['to'])){

    $sql.="WHERE tgl_order BETWEEN '".$outFrom."' AND '".$outTo."' ORDER BY id_orders  DESC";

    }
   
    //echo $sql;



    $resultTransaksi=mysql_query($sql);
    ?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="#" type="image/png">

    <title>Invoice</title>

    <link href="../../assets/css/style.css" rel="stylesheet">
    <link href="../../assets/css/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->

</head>

<body class="print-body">

<section>

    <!--body wrapper start-->
    <div class="wrapper">
        <div class="panel">
            <div class="panel-body invoice">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-3">
                        <h2>Laporan Penjualan</h2>
                    </div>
                    <div class="col-md-4 col-md-offset-4 col-sm-4 col-sm-offset-4 col-xs-5 col-xs-offset-4 ">
                      <!--   <img class="inv-logo" src="../../assets/images/logo.png" alt=""/>
                        <p>121 King Street, Melbourne <br/>
                            Victoria 3000 Australia <br/>
                            Phone: +61 3 8376 6284</p> -->
                    </div>
                </div>
                <div class="invoice-address">
              <div class="row">
                        <div class="col-md-5 col-sm-5 col-xs-5">
                           <!--  <h4 class="inv-to">Invoice To</h4> -->
                            <h2 class="corporate-id"> CHOCHO MAMA</h2>
                            <p>

<!-- Jl. RAYA TANJUNG KM 5 BLENCONG
GUNUNG SARI LOMBOK BARAT
TLP. 0212345859
NPWP : 09.000.000.000.00.9-888.00 -->
                                Jl. RAYA TANJUNG KM 5 BLENCONG<br>
                               GUNUNG SARI LOMBOK BARAT<br>
                                Phone: +61 3 8376 6284,
                                NPWP : 09.000.000.000.00.9-888.00
                            </p>
<!--
                        </div>
                        <div class="col-md-4 col-md-offset-3 col-sm-4 col-sm-offset-3 col-xs-4 col-xs-offset-3">
                            <div class="inv-col"><span>Invoice#</span> 432134-A</div>
                            <div class="inv-col"><span>Invoice Date :</span> 22 March 2014</div>
                            <h1 class="t-due">TOTAL DUE</h1>
                            <h2 class="amnt-value">$ 3120.00</h2>
                        </div>
                    </div> -->
                </div>
            </div>


            <table class="table table-bordered table-invoice">
                

                <thead>
                <tr>
                    <th>No</th>
                    <th>Id Order</th>
                    <th>Tanggal Order</th>
                    <th>Petugas</th>
                    <th>Jumlah Item</th>
                    <th>Total</th>
                </tr>
                </thead>



                                   <tbody>
                    <?php
                    $no = 1;
  
                    while ($rowTransaksi = mysql_fetch_array($resultTransaksi)) {
                        $sub_total = +$rowTransaksi['product_price'] * $rowTransaksi['jumlah'];
                        $total += $sub_total;
                        ?>
                        <tr class="">
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
                                echo "Rp. " . number_format($totalQuery, 0, ',', ',');
                                ?>
                            </td>

                        </tr>
                    <?php } ?>

                    </tbody>

            </table>
        </div>
    </div>
    <!--body wrapper end

</section> -->

<!-- Placed js at the end of the document so the pages load faster -->
    <script src="../../assets/js/jquery-1.10.2.min.js"></script>
    <script src="../../assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
    <script src="../../assets/js/modernizr.min.js"></script>


    <!--common scripts for all pages-->
    <script src="../../assets/js/scripts.js"></script>

    <script type="text/javascript">
        window.print();
    </script>

</body>
</html>
