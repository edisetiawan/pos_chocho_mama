<?php
error_reporting(0);
include("../../config.php"); //exit();

    $sql="SELECT * FROM
                     `note`
                         ";//);
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
    if(!empty($_POST['from']) && !empty($_POST['to'])){
          

    $sql.="WHERE note_date BETWEEN '".$outFrom."' AND '".$outTo."'";

    } 

    if (!empty($_POST['status']) && empty($_POST['from']) && empty($_POST['to'])) {
        if($_POST['status']==""){
            $sql .= "
               
            ";
        }elseif($_POST['status']=="m"){
             $sql .= "
                WHERE note_status='m'
            ";
        }elseif($_POST['status'] == "k"){
             $sql .= "
                 WHERE note_status='k';
            ";
        }
    }


    if (!empty($_POST['status']) && !empty($_POST['from']) && !empty($_POST['to'])) {
        if($_POST['status']==""){
            $sql .= "
               
            ";
        }elseif($_POST['status']=="m"){
             $sql .= "
                AND note_status='m'
            ";
        }elseif($_POST['status'] == "k"){
             $sql .= "
                 AND note_status='k';
            ";
        }
    }

     if (!empty($_POST['status']) && empty($_POST['from']) && empty($_POST['to'])) {
        if($_SESSION['filterStatus']==""){
            $sql .= "
               
            ";
        }elseif($_POST['status']=="m"){
             $sql .= "
                WHERE note_status='m'
            ";
        }elseif($_POST['status']=="k"){
             $sql .= "
                WHERE note_status='K';
            ";
        }
    }

    //echo $sql;

    $resultCatatan =mysql_query($sql);
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

</head>

<body class="print-body">

<section>

    <!--body wrapper start-->
    <div class="wrapper">
        <div class="panel">
            <div class="panel-body invoice">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-3">
                        <h2>Laporan Pengeluaran</h2>
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
                    <th >Transaksi</th>
                    <th >Status</th>
                    <th width="16%">tanggal</th>
                    <th>Catatan</th>
                    <th width="12%">Nominal</th>
                </tr>
                </thead>

                <tbody>
                        <?php
                        $no = 1;
                        $total=0;

                        while ($rowCatatan = mysql_fetch_array($resultCatatan)) {
                            $total+=$rowCatatan['note_price'];
                            ?>
                            <tr class="">
                                <td><?php echo $no++; ?></td>
                                <td >
                                 <?php echo $rowCatatan['note_name']; ?>      
                                </td>
                                <td >
                                    <?php
                                    if ($rowCatatan['note_status'] == 'k') {
                                        echo "Pengeluaran";
                                    } else {
                                        echo "Pemasukan";
                                    }
                                    ?>
                                </td>
                                <td>
                                   <?php echo $rowCatatan['note_date']; ?>
                                </td>
                                <td>
                                   <?php echo $rowCatatan['note_desc']; ?>
                                </td>
                                <td>
                                     Rp. <?php echo number_format($rowCatatan['note_price'], 0, ',', ','); ?>
                                </td>
                            </tr>
                        <?php } ?>
                            <tr>
                                <td colspan="5" align="left">Total :</td>
                                <td>Rp. <?php echo number_format($total, 0, ',', ','); ?></td>
                            </tr>
                    </tbody>

<!-- 
                <tbody>

                <tr>
                    <td>1</td>
                    <td>
                        <h4>Service One</h4>
                        <p>Service Four Description Lorem ipsum dolor sit amet.</p>
                    </td>
                    <td class="text-center"><strong>$ 599.00</strong></td>
                    <td class="text-center"><strong>4</strong></td>
                    <td class="text-center"><strong>$2396.00</strong></td>
                </tr> -->



               <!--  <tr>
                    <td>2</td>
                    <td>
                        <h4>Service Two</h4>
                        <p>Service Four Description Lorem ipsum dolor sit amet.</p>
                    </td>
                    <td class="text-center"><strong>$ 599.00</strong>   </td>
                    <td class="text-center"><strong>5</strong></td>
                    <td class="text-center"><strong>$2995.00</strong></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>
                        <h4>Service Three</h4>
                        <p>Service Four Description Lorem ipsum dolor sit amet.</p>
                    </td>
                    <td class="text-center"><strong>$ 599.00</strong>   </td>
                    <td class="text-center"><strong>2</strong></td>
                    <td class="text-center"><strong>$1198.00</strong></td>
                </tr>
                <tr>
                    <td colspan="2" class="payment-method">
                        <h4>Payment Method</h4>
                        <p>1. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <p>2. Pellentesque tincidunt pulvinar magna quis rhoncus.</p>
                        <p>3. Cras rhoncus risus vitae congue commodo.</p>
                        <br>
                        <h3 class="inv-label">Thank you for your business</h3>
                    </td>
                    <td class="text-right" colspan="2">
                        <p>Sub Total</p>
                        <p>Tax (VAT 10%)</p>
                        <p>Discount (5%)</p>
                        <p><strong>GRAND TOTAL</strong></p>
                    </td>
                    <td class="text-center">
                        <p>$ 6589.00</p>
                        <p>$ 120.00</p>
                        <p>$ 60.00</p>
                        <p><strong>$ 5120.00</strong></p>
                    </td>
                </tr>
 -->
               <!--  </tbody> -->
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
