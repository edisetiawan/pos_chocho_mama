<?php
$id_session = session_id();   // echo $id_session; exit();
$id_product = $_GET['id'];//
$var_tanggal = date("Y-d-m");

echo $var_tanggal;
exit();
//echo $id_session;

$query_ceck = "select * from cart where cart_session='" . $id_session . "' and product_id='" . $id_product . "'";
$result_check = mysql_query($query_ceck);
$row = mysql_num_rows($result_check);

//$query="insert into tb_cart values ('','$id_session','$var_tanggal','1','$id_product')";

//echo $query;
//exit;

if ($row == 0) {

    $query = "insert into orders_ values ('','$id_session',$var_tanggal,'1','$id_product')";

    $result = mysql_query($query);

} else {
    $sql_cart = "update cart set cart_qty = cart_qty +1 where cart_session='" . $id_session . "' and product_id='" . $id_product . "'";
    $result_u = mysql_query($sql_cart);
}

//header('location: ?hal=pos');
echo "<script> alert('Product berhasil dibeli'); location.href='index.php?hal=pos' </script>";
exit;


?>