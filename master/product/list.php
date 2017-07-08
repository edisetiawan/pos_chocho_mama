<?php 
      if (isset($_GET['hapus'])) {   
        $queryHapus = mysql_query("DELETE FROM product where product_id = '".$_GET['hapus']."'");
        if ($queryHapus) {
          echo "<script> alert('Data Berhasil Dihapus'); location.href='index.php?hal=master/product/list' </script>";exit;
        }
      }
 ?>
  <div class="wrapper">
             <div class="row">
                <div class="col-sm-12">
                <section class="panel">
                
                <header class="panel-heading">
                    Data Product
                    <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                        <a href="javascript:;" class="fa fa-times"></a>
                     </span>
                </header>

                <div class="panel-body">
                <div class="adv-table editable-table ">
                <div class="clearfix">

                    <div class="btn-group">
                        <a href="?hal=master/product/add">
                        <button  data-toggle="modal" class="btn btn-primary" >
                            Add New <i class="fa fa-plus"></i>
                        </button>
                        </a>
                    </div>
                
                    <div class="btn-group pull-right">
                    </div>
                </div>
                <div class="space15"></div>
                <table class="table table-striped table-hover table-bordered" id="editable-sample">
                <thead>
                <tr>
                    <th width="30%">Foto</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Stock</th>
                    <th>Deskripsi</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                      $no = 0;
                      $queryProduct = mysql_query("SELECT * FROM product ORDER BY product_id DESC");
                      while ($rowProduct  = mysql_fetch_array($queryProduct)) {
                   ?>
                <tr class="">
                    <td><img src="assets/images/product/<?php echo $rowProduct['product_images']; ?>" width="50%"></td>
                    <td><?php echo $rowProduct['product_name'] ?></td>
                    <td>Rp. <?php echo number_format($rowProduct['product_price'], 0, ',', '.'); ?></td>
                    <td><?php echo $rowProduct['product_stock']?></td>
                    <td><?php echo $rowProduct['product_desc']?></td>
                    <td>
                        <a href="?hal=master/product/edit&id=<?php echo $rowProduct['product_id']; ?>">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-edit" aria-hidden="true"></i> Edit</button></a>
                        <a href="?hal=master/product/list&hapus=<?php echo $rowProduct['product_id']; ?>">
                            <button class="btn btn-danger" type="submit" name="hapus"><i class="fa fa-trash-o"></i> Delete</button>
                        </a>
                    </td>
                </tr>
               <?php } ?>
      
                </tbody>
                </table>
                </div>
                </div>
                </section>
                </div>
                </div>
        </div>


