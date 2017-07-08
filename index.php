<?php
session_start();
//error_reporting(0);
include 'config.php';   //  echo $_SESSION['username']; exit();
if (!empty($_SESSION["username"]) && !empty($_SESSION['password'])) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="keywords"
              content="admin, dashboard, bootstrap, template, flat, modern, theme, responsive, fluid, retina, backend, html5, css, css3">
        <meta name="description" content="">
        <meta name="author" content="ThemeBucket">
        <link rel="shortcut icon" href="#" type="assets/image/png">

        <title>Chocho Mama</title>

        <!--icheck-->
        <!--   <link href="assets/js/iCheck/skins/minimal/minimal.css" rel="stylesheet">
          <link href="assets/js/iCheck/skins/square/square.css" rel="stylesheet">
          <link href="assets/js/iCheck/skins/square/red.css" rel="stylesheet">
          <link href="assets/js/iCheck/skins/square/blue.css" rel="stylesheet"> -->

        <!-- data picker -->

        <link rel="stylesheet" type="text/css" href="assets/js/bootstrap-datepicker/css/datepicker-custom.css"/>
        <link rel="stylesheet" type="text/css" href="assets/js/bootstrap-timepicker/css/timepicker.css"/>
        <link rel="stylesheet" type="text/css" href="assets/js/bootstrap-colorpicker/css/colorpicker.css"/>
        <link rel="stylesheet" type="text/css" href="assets/js/bootstrap-daterangepicker/daterangepicker-bs3.css"/>
        <link rel="stylesheet" type="text/css" href="assets/js/bootstrap-datetimepicker/css/datetimepicker-custom.css"/>


        <!-- data picker end -->

        <!-- cart jancuk -->
        <link href="assets/js/iCheck/skins/square/square.css" rel="stylesheet">
        <link href="assets/js/iCheck/skins/square/red.css" rel="stylesheet">
        <link href="assets/js/iCheck/skins/square/blue.css" rel="stylesheet">

        <!--dashboard calendar-->
        <link href="assets/css/clndr.css" rel="stylesheet">

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="assets/js/morris-chart/morris.css">

        <!--common-->
        <link href="assets/css/style.css" rel="stylesheet">
        <link href="assets/css/style-responsive.css" rel="stylesheet">


        <!-- cart jancuk -->

        <!--dashboard calendar-->
        <!--   <link href="assets/css/clndr.css" rel="stylesheet">
         -->

        <!--common-->
        <!--   <link href="assets/css/style.css" rel="stylesheet">
          <link href="assets/css/style-responsive.css" rel="stylesheet"> -->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="sticky-header">

    <section>
        <!-- left side start-->
        <?php include("sidebar.php"); ?>
        <!-- left side end-->

        <!-- main content start-->
        <div class="main-content">
            <?php include("header.php"); ?>
            <!--body wrapper start-->
            <?php
            // include 'menuatas-member.php';
            if (isset($_GET['hal']) && strlen($_GET['hal']) > 0) {
                $hal = str_replace(".", "/", $_GET['hal']) . ".php";
            } else {
                $hal = "dashboard.php";
            }
            if (file_exists($hal)) {
                include($hal);
            } else {
                include("dashboard.php");
            }
            ?>
            <!--body wrapper end-->
            <!--footer section start-->
            <?php include("footer.php"); ?>
            <!--footer section end-->
        </div>
        <!-- main content end-->
    </section>

    <!-- Placed js at the end of the document so the pages load faster -->
    <script src="assets/js/jquery-1.10.2.min.js"></script>
    <script src="assets/js/jquery-ui-1.9.2.custom.min.js"></script>
    <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/modernizr.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js"></script>

    <script src="assets/js/easypiechart/jquery.easypiechart.js"></script>
    <script src="assets/js/easypiechart/easypiechart-init.js"></script>

    <script src="assets/js/sparkline/jquery.sparkline.js"></script>
    <script src="assets/js/sparkline/sparkline-init.js"></script>

    <script src="js/iCheck/jquery.icheck.js"></script>
    <script src="js/icheck-init.js"></script>

    <script src="assets/js/flot-chart/jquery.flot.js"></script>
    <script src="assets/js/flot-chart/jquery.flot.tooltip.js"></script>
    <script src="assets/js/flot-chart/jquery.flot.resize.js"></script>
    <script src="assets/js/flot-chart/jquery.flot.pie.resize.js"></script>
    <script src="assets/js/flot-chart/jquery.flot.selection.js"></script>
    <script src="assets/js/flot-chart/jquery.flot.stack.js"></script>
    <script src="assets/js/flot-chart/jquery.flot.time.js"></script>
    <script src="assets/js/main-chart.js"></script>

    <!--common scripts for all pages-->
    <!-- <script src="assets/js/scripts.js"></script> -->
    
    <script type="text/javascript">
/*
    var tanpa_rupiah = document.getElementById('tanpa-rupiah');
    tanpa_rupiah.addEventListener('keyup', function(e)
    {
        tanpa_rupiah.value = formatRupiah(this.value);
    });
    

    var dengan_rupiah = document.getElementById('dengan-rupiah');
    dengan_rupiah.addEventListener('keyup', function(e)
    {
        dengan_rupiah.value = formatRupiah(this.value, 'Rp. ');
    });
    

    function formatRupiah(angka, prefix)
    {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split   = number_string.split(','),
            sisa    = split[0].length % 3,
            rupiah  = split[0].substr(0, sisa),
            ribuan  = split[0].substr(sisa).match(/\d{3}/gi);
            
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }*/
    </script>


    <script src="assets/js/jquery-1.10.2.min.js"></script>

    <script type="text/javascript">
       /* $(document).ready(function () {
            $('#bayar').keyup(function () {

                //var total_bayar = 0;
                var grand_total = $('#grand_total').val();
                var bayar = $('#bayar').val();
                if (bayar == null) {
                    $('#Tbayar').val(
                    );
                }

                var total_bayar = bayar - grand_total;
                $('#Tbayar').val(total_bayar);
            });
        });*/
    </script>


    <script src="assets/js/jquery-ui-1.9.2.custom.min.js"></script>
    <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/modernizr.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js"></script>


    <script type="text/javascript" src="assets/js/data-tables/jquery.dataTables.js"></script>
    <script type="text/javascript" src="assets/js/data-tables/DT_bootstrap.js"></script>

    <script src="assets/js/editable-table.js"></script>

    <script src="assets/asseys/js/editable-table.js"></script>

    <script type="text/javascript" src="js/jquery.validate.min.js"></script>
    <script src="js/validation-init.js"></script>

    <!-- cart -->
    <?php
    if ($_GET['hal'] == 'dashboard') {
        ?>
        <!-- Placed js at the end of the document so the pages load faster -->
        <!-- <script src="assets/js/jquery-1.10.2.min.js"></script>
        <script src="assets/js/jquery-ui-1.9.2.custom.min.js"></script>
        <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/modernizr.min.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>


        <script src="assets/js/easypiechart/jquery.easypiechart.js"></script>
        <script src="assets/js/easypiechart/easypiechart-init.js"></script>

        <script src="assets/js/sparkline/jquery.sparkline.js"></script>
        <script src="assets/js/sparkline/sparkline-init.js"></script>


        <script src="assets/js/iCheck/jquery.icheck.js"></script>
        <script src="assets/js/icheck-init.js"></script>

        <script src="assets/js/flot-chart/jquery.flot.js"></script>
        <script src="assets/js/flot-chart/jquery.flot.tooltip.js"></script>
        <script src="assets/js/flot-chart/jquery.flot.resize.js"></script>

        -->
        <script src="assets/js/morris-chart/morris.js"></script>
        <script src="assets/js/morris-chart/raphael-min.js"></script>

        <!--
        <script src="assets/js/calendar/clndr.js"></script>
        <script src="assets/js/calendar/evnt.calendar.init.js"></script>
        <script src="assets/js/calendar/moment-2.2.1.js"></script>
        -->
        <script src="assets/js/underscore-min.js"></script>


        <!-- <script src="assets/js/scripts.js"></script>  -->
        <script src="assets/js/dashboard-chart-init-edi.js"></script>
        <!--Dashboard Charts-->

        <?php
    }
    ?>
    <!-- cart -->
    <script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap-daterangepicker/moment.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>

    <script src="assets/js/pickers-init.js"></script>

    <script src="assets/js/scripts.js"></script>

    <script>
   

    
        jQuery(document).ready(function () {
            EditableTable.init();
        });
    </script>

    </body>
    </html>
    <?php
} else {
    header("Location: login.php");
}

?>