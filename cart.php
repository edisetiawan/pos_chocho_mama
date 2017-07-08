<?php
session_start();
//error_reporting(0);
include "config.php";
include "tanggal.php";
$mod = $_GET['mod'];
$act = $_GET['act'];


if ($mod == 'basket' AND $act == 'add') {

    $sid = session_id();

    $sql = mysql_query("SELECT product_stock FROM product WHERE product_id='$_GET[id]'");
    $s = mysql_fetch_array($sql);
    $stok = $s['product_stock']; //echo $stok; exit();

    if ($stok == 0) {
         echo "<script> alert('stock habis'); location.href='index.php?hal=pos' </script>";
         exit();
    } else {
        // check if the product is already
        // in cart table for this session
        $sql_temp = mysql_query("SELECT * FROM orders_temp
			WHERE product_id='$_GET[id]' AND id_session='$sid'");
        $data_tmp=mysql_fetch_array($sql_temp);
        $ketemu = mysql_num_rows($sql_temp);
        if(!empty($data_tmp['stok_temp'])) {
           // exit();
           // echo $data_tmp['jumlah']." - ".$stok; exit();
            if ($data_tmp['jumlah'] >= $stok)  {
                echo "<script> alert('Jumlah yang dibeli sedang kosong'); location.href='index.php?hal=pos' </script>";
                exit();
            }
        }

        if ($ketemu == 0) {
            // put the product in cart table
            mysql_query("INSERT INTO orders_temp (product_id, jumlah, id_session, tgl_order_temp, jam_order_temp, stok_temp)
				VALUES ('$_GET[id]', 1, '$sid', '$tgl_sekarang', '$jam_sekarang', '$stok')");

        } else {
            // update product quantity in cart table
            mysql_query("UPDATE orders_temp 
		        SET jumlah = jumlah + 1
				WHERE id_session ='$sid' AND product_id='$_GET[id]'");
        }
        deleteAbandonedCart();
        echo "<script> alert('Product berhasil dibeli'); location.href='index.php?hal=pos' </script>";
        exit;
    }
} elseif ($mod == 'basket' AND $act == 'del') {
    mysql_query("DELETE FROM orders_temp WHERE id_orders_temp='$_GET[id]'");
    echo "<script> alert('Product berhasil dihapus'); location.href='index.php?hal=pos' </script>";
    exit;
} /*elseif ($mod == 'basket' AND $act == 'update') {
    $id = $_POST[id];
    $jml_data = count($id);
    $jumlah = $_POST[jml]; // quantity
    for ($i = 1; $i <= $jml_data; $i++) {
        $sql2 = mysql_query("SELECT stok_temp FROM orders_temp	WHERE id_orders_temp='" . $id[$i] . "'");
        while ($r = mysql_fetch_array($sql2)) {
            if ($jumlah[$i] > $r[stok_temp]) {
                echo "<script>window.alert('Jumlah yang dibeli melebihi stok yang ada');
window.location=('cart')</script>";
            } elseif ($jumlah[$i] == 0) {
                echo "<script>window.alert('Anda tidak boleh menginputkan angka 0 atau mengkosongkannya!');
window.location=('keranjang-belanja.html')</script>";
            } // tambahan update ada disini
            else {
                mysql_query("UPDATE orders_temp SET jumlah = '" . $jumlah[$i] . "'
WHERE id_orders_temp = '" . $id[$i] . "'");
                header('Location:cart');
            }
        }
    }
}*/


/*
	Delete all cart entries older than one day
*/
function deleteAbandonedCart()
{
    $kemarin = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') - 1, date('Y')));
    mysql_query("DELETE FROM orders_temp 
	        WHERE tgl_order_temp < '$kemarin'");
}

?>
