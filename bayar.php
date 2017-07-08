<?php
function isi_keranjang()
{
    $isikeranjang = array();
    $sid = session_id();
    $sql = mysql_query("SELECT * FROM orders_temp WHERE id_session='$sid'");

    while ($r = mysql_fetch_array($sql)) {
        $isikeranjang[] = $r;
    }
    return $isikeranjang;
}

$tgl_skrg = date("Ymd");
$jam_skrg = date("H:i:s");

// simpan data pemesanan
mysql_query("INSERT INTO orders(nama_kustomer, alamat, telpon, email, tgl_order, jam_order, id_kota,kodepos,id_bank) 
				 VALUES('$_POST[nama]','$_POST[alamat]','$_POST[telpon]','$_POST[email]',NOW(),'$jam_skrg','$_POST[kota]','$_POST[kode]','$_POST[nobank]')");

// mendapatkan nomor orders
$id_orders = mysql_insert_id();
// panggil fungsi isi_keranjang dan hitung jumlah produk yang dipesan
$isikeranjang = isi_keranjang();
$jml = count($isikeranjang);

// simpan data detail pemesanan
for ($i = 0; $i < $jml; $i++) {
    mysql_query("INSERT INTO orders_detail(id_orders, id_produk, jumlah) 
				   VALUES('$id_orders',{$isikeranjang[$i]['id_produk']}, {$isikeranjang[$i]['jumlah']})");
}

// setelah data pemesanan tersimpan, hapus data pemesanan di tabel pemesanan sementara (orders_temp)
for ($i = 0; $i < $jml; $i++) {
    mysql_query("DELETE FROM orders_temp WHERE id_orders_temp = {$isikeranjang[$i]['id_orders_temp']}");
}

echo "<h2 class='title text-center' style='margin-top: 30px;'>Proses Pemesanan Selesai</h2>";

echo "<div class='rBox'><div class='prod_box_big'>
	  <div class='top_prod_box_big'></div>
			<div class='center_prod_box_big'>            
			  <div class='details_big_cari'>
		  
		  <div><p>Terimakasih telah berbelanja bersama kami.</p>
				<p>Berikut ini adalah ringkasan informasi yang kami terima</p>
		  <table>
		  <tr><td><p>Nama           </td><td><p> : <b>$_POST[nama]</b></p> </td></tr>
		  <tr><td><p>Alamat Lengkap </td><td><p> : $_POST[alamat], $_POST[kode] </p></td></tr>
		  <tr><td><p>Telpon         </td><td><p> : $_POST[telpon] </p></td></tr>
		  <tr><td><p>E-mail         </td><td><p> : $_POST[email] </p></td></tr></table><br />
		  
		  <p>Nomor Order: <b> <span class='table6'>$id_orders</b><br /><br />";

$daftarproduk = mysql_query("SELECT * FROM orders_detail,buku 
									 WHERE orders_detail.id_produk=buku.id_buku 
									 AND id_orders='$id_orders'");


$no = 1;
while ($d = mysql_fetch_array($daftarproduk)) {
    $subtotalberat = $d['berat'] * $d['jumlah']; // total berat per item produk
    $totalberat = $totalberat + $subtotalberat; // grand total berat all produk yang dibeli


    $disc = ($d['diskon'] / 100) * $d['harga'];
    $hargadisc = number_format(($d['harga'] - $disc), 0, ",", ".");
    $subtotal = ($d['harga'] - $disc) * $d['jumlah'];

    $total = $total + $subtotal;
    $subtotal_rp = format_rupiah($subtotal);
    $total_rp = format_rupiah($total);
    $harga = format_rupiah($d['harga']);

    echo "<tr>
		<td class='center'><p>$no.</td>
		<td><p>$d[judul]</td>
		<td class='center'><p>$d[berat]</td>
		<td class='center'><p>$d[jumlah]</td>
		<td><p>$harga,-</td><td><p> $subtotal_rp,-</td></tr>";

    $pesan .= "$d[jumlah] buah buku berjudul $d[judul] -> Rp. $harga (diskon $d[diskon]%)-> Subtotal: Rp. $subtotal_rp <br />";
    $pesan2 .= "$d[jumlah] buah buku berjudul $d[judul] -> Rp. $harga (diskon $d[diskon]%)-> Subtotal: Rp. $subtotal_rp <br />";
    $no++;
}
?>