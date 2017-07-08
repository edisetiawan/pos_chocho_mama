<?php 
      if (isset($_GET['hapus'])) {
        $queryHapus = mysql_query("DELETE FROM user where user_id = '".$_GET['hapus']."'");
        if ($queryHapus) {
          echo "<script> alert('Data Berhasil Dihapus'); location.href='index.php?hal=master/user/list' </script>";exit;
        }
      }
 ?>

  <div class="wrapper">
             <div class="row">
                <div class="col-sm-12">
                <section class="panel">
                <header class="panel-heading">
                    Data User
                    <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                        <a href="javascript:;" class="fa fa-times"></a>
                     </span>
                </header>
                <div class="panel-body">
                <div class="adv-table editable-table ">
                <div class="clearfix">
                    <div class="btn-group">
                        <a href="?hal=master/user/add">
                        <button  data-toggle="modal" class="btn btn-primary" data-target="#myModal">
                            Add New <i class="fa fa-plus"></i>
                        </button>
                        </a>
                    </div>
                    <div class="btn-group pull-right">
                        <!-- <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="#">Print</a></li>
                            <li><a href="#">Save as PDF</a></li>
                            <li><a href="#">Export to Excel</a></li>
                        </ul> -->
                    </div>
                </div>
                <div class="space15"></div>
                <table class="table table-striped table-hover table-bordered" id="editable-sample">
                <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Password</th>
                    <th>Level</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                 <?php 
                      $no = 0;
                      $queryUsers = mysql_query("SELECT * FROM user ORDER BY user_id DESC");
                      while ($rowUsers  = mysql_fetch_array($queryUsers)) {
                   ?>
                <tr class="">
                    <td width="25px"><img src="assets/images/user/<?php echo $rowUsers['user_foto']; ?>" width="100px" ></td>
                    <td><?php echo $rowUsers['user_name']; ?></td>
                    <td><?php echo $rowUsers['user_password']; ?></td>
                    <td><?php echo $rowUsers['user_level'];?></td>
                    <td><?php if($rowUsers['user_status'] == 'Y'){?>
                        <button class="btn btn-success" type="submit"><i class="fa fa-check-square-o"></i> Active</button>

                        <?php }else{ ?>
                        <button class="btn btn-danger" type="submit"><i class="fa fa-ban"></i> Not Active</button>

                        <?php    } ?></td>
                    <td>
                <a href="?hal=master/user/edit&id=<?php echo $rowUsers['user_id']; ?>">
                <button class="btn btn-primary" type="submit"><i class="fa fa-edit" aria-hidden="true"></i> Edit</button></a>
                 <a href="?hal=master/user/list&hapus=<?php echo $rowUsers['user_id']; ?>">
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



             <!--  <div class="modal fade" id="myModal" role="dialog">

                                                                 
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header"
                                         >
                                        <button type="button" class="close"
                                                data-dismiss="modal"
                                                aria-label="Tutup"><span
                                                    aria-hidden="true">&times;</span>
                                        </button>
                                        <h4 class="modal-title">Ulasan Product</h4>
                                    </div>
                                    <div class="modal-body">

                                        <form method="POST" action="">

                                          
                                            <div class="form-group">
                                               <label>Nama</label>
                                                <input type="text" name="review_title"  class="form-control" placeholder="judul..">
                                            </div>
                                            <div class="form-group">
                                                
                                                <textarea name="review_desc"
                                                      class="form-control" placeholder="Pesan..."></textarea>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button"
                                                        class="btn btn-default"
                                                        data-dismiss="modal">Tutup
                                                </button>
                                                <input type="hidden"
                                                       name="addRating">
                                                <input type="submit" name="Kirim"
                                                       value="Kirim"
                                                       class="btn btn-primary">
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
</div>

 -->