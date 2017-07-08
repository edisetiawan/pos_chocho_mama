<?php
error_reporting(0);

if($_POST['filter_test']=='okay'){
  
    $from       = (!empty($_POST['from'])) ? $_POST['from'] : "";
    $to         = (!empty($_POST['to'])) ? $_POST['to'] : "";
    $status     = (!empty($_POST['filterStatus'])) ? $_POST['filterStatus'] : "";

    echo"<script>  location.href='index.php?hal=master/laporan_pengeluaran/list&from=$from&to=$to&status=$status' </script>";

    exit();
}


/*if (isset($_POST['filter'])) {  //echo "filter"; exit();
    $from       = (!empty($_POST['from'])) ? $_POST['from'] : "";
    $to         = (!empty($_POST['to'])) ? $_POST['to'] : "";
    $status     = (!empty($_POST['filterStatus'])) ? $_POST['filterStatus'] : "";

    echo"<script>  location.href='index.php?hal=master/laporan_pengeluaran/list&from=$from&to=$to&status=$status' </script>";

    exit;
}

*/
/*if (isset($_POST['resetFilter'])) {  

    echo"<script>  location.href='index.php?hal=master/laporan_pengeluaran/list' </script>";

    exit;
}*/

/*if (isset($_POST['print'])){  echo "print"; exit();



}*/

    $sql="SELECT * FROM
                     `note`
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
          

    $sql.="WHERE note_date BETWEEN '".$outFrom."' AND '".$outTo."'";

    } 

    if (!empty($_GET['status']) && empty($_GET['from']) && empty($_GET['to'])) {
        if($_GET['status']==""){
            $sql .= "
               
            ";
        }elseif($_GET['status']=="m"){
             $sql .= "
                WHERE note_status='m'
            ";
        }elseif($_GET['status'] == "k"){
             $sql .= "
                 WHERE note_status='k';
            ";
        }
    }


    if (!empty($_GET['status']) && !empty($_GET['from']) && !empty($_GET['to'])) {
        if($_GET['status']==""){
            $sql .= "
               
            ";
        }elseif($_GET['status']=="m"){
             $sql .= "
                AND note_status='m'
            ";
        }elseif($_GET['status'] == "k"){
             $sql .= "
                 AND note_status='k';
            ";
        }
    }

     if (!empty($_GET['status']) && empty($_GET['from']) && empty($_GET['to'])) {
        if($_SESSION['filterStatus']==""){
            $sql .= "
               
            ";
        }elseif($_GET['status']=="m"){
             $sql .= "
                WHERE note_status='m'
            ";
        }elseif($_GET['status']=="k"){
             $sql .= "
                WHERE note_status='K';
            ";
        }
    }

    //echo $sql;

    $resultCatatan =mysql_query($sql);

?>
<div class="wrapper">
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    Laporan Pengeluaran
                    <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                        <a href="javascript:;" class="fa fa-times"></a>
                     </span>
                </header>



                <div class="panel-body">
                    <div class="adv-table editable-table ">
                        <div class="clearfix">
                        <!-- start -->

 <form method="post" action="http://kasir.ruangprogrammer.com/master/laporan_pengeluaran/print.php" target="_blank">
               <!--  <form method="post" action="http://localhost/kasir/master/laporan_pengeluaran/print.php" target="_blank"> -->
                    <?php
                                            $from_print       = (!empty($_GET['from'])) ? $_GET['from'] : "";
                                            $to_print         = (!empty($_GET['to'])) ? $_GET['to'] : "";
                                            $status_print     = (!empty($_GET['status'])) ? $_GET['status'] : "";
                                        ?>

                                        <input type="hidden" name="from" value="<?php echo $from_print; ?>">
                                        <input type="hidden" name="to" value="<?php echo $to_print; ?>">
                                        <input type="hidden" name="status" value="<?php echo $status_print; ?>">
                                        
                    <div class="btn-group pull-right">
                         <button type="submit" name="print" class="btn btn-primary">
                            <i class="fa fa-print"></i>   Print
                        </button>
                    </div>
                </form>

                    <form class="form-inline pull-right" role="form" method="POST" action="index.php?hal=master/laporan_pengeluaran/list">
                        
                    <input type="hidden" name="filter_test" value="okay">

                            <div class="form-group custom-date-range" data-date="13/07/2013" data-date-format="mm/dd/yyyy">

                                        <input type="text" class="form-control dpd1" name="from">

                                                <button class="btn btn-default" type="button">To</button>

                                        <input type="text" class="form-control dpd2" name="to">

                            </div>

                            <div class="form-group">
                                         <select name="filterStatus" class="form-control">
                                                    <option value="">All Status</option>
                                                    <option value="k">Pengeluaran</option>
                                                    <option value="m">Pemasukan</option>
                                            </select>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit" name="filter"><i class="fa fa-search"></i> Filter</button> 
                            </div>

                            <div class="form-group">
                            <a href="index.php?hal=master/laporan_pengeluaran/list">
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
                                        <th>Transaksi</th>
                                        <th>Status</th>
                                        <th width="11%">Tanggal</th>
                                        <th width="30%">Catatan</th>
                                        <th>Nominal</th>
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
                                            <td><?php echo $rowCatatan['note_name']; ?></td>
                                            <td>
                                                <?php
                                                if ($rowCatatan['note_status'] == 'k') {
                                                    echo "Pengeluaran";
                                                } else {
                                                    echo "Pemasukan";
                                                }
                                                ?>
                                            </td>
                                            <td><?php echo $rowCatatan['note_date']; ?></td>
                                            <td>
                                                <?php
                                                $deskripsi = substr($rowCatatan['note_desc'], 0, 100);
                                                echo $deskripsi;
                                                echo ".....<br>";
                                                ?>
                                                <?php //echo $rowCatatan['note_desc']?>
                                            </td>
                                            <td> Rp. <?php echo number_format($rowCatatan['note_price'], 0, ',', '.'); ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                     <!--   <tr>
                                            <td colspan="5">Total</td>
                                            <td>Rp. <?php //echo  number_format($total, 0, ',', '.'); ?> 
                                            </td>
                                        </tr>  -->
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
