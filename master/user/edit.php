<?php 
error_reporting(0);
$id = $_GET['id']; //echo $id; exit();
$queryRowUser = mysql_query("SELECT * FROM user WHERE user_id = '".$id."'");
$rowUser = mysql_fetch_array($queryRowUser);  
    if (isset($_POST['ubah'])) { 

      if (!empty($_FILES) && $_FILES['user_foto']['size'] >0 && $_FILES['user_foto']['error'] == 0 ){ 
            $random = substr(number_format(time() * rand(),0,'',''),0,10); 
            $foto = $random.$_FILES['user_foto']['name'];   
            $move = move_uploaded_file($_FILES['user_foto']['tmp_name'],'assets/images/user/'.$foto);

        if($move){ 
                $queryUpdate  = mysql_query("UPDATE user SET 
                                            user_foto = '".$foto."',
                                            user_name = '".$_POST['user_name']."',
                                            user_level = '".$_POST['user_level']."',
                                            user_status = '".$_POST['user_status']."'
                                            WHERE user_id = '".$id."'
                                             ");
        
            }
        }else{  
                       $queryUpdate  = mysql_query("UPDATE user SET 
                                            user_name = '".$_POST['user_name']."',
                                            user_level = '".$_POST['user_level']."',
                                            user_status = '".$_POST['user_status']."'
                                            WHERE user_id = '".$id."'
                                             ");
                 
                }

      if ($queryUpdate) {
         echo "<script> alert('Data Berhasil Disimpan'); location.href='index.php?hal=master/user/list' </script>";exit;
      }
    }


    if(isset($_POST['updatePassword'])){
        if(!empty($_POST['frm_password'])){
          $queryUpdate  = mysql_query("UPDATE user SET 
                                            user_password = '".md5($_POST['frm_password'])."'
                                            WHERE user_id = '".$_POST['user_id']."'
                                             ");  
            }
    
      if ($queryUpdate) {
         echo "<script> alert('Password Berhasil diubah'); location.href='index.php?hal=master/user/list' </script>";exit;

    }
}

 ?>
               <section class="panel">
                        <header class="panel-heading">
                           ADD USER
                        </header>
                        <div class="panel-body">
                            <div class=" form">
                                <form class="cmxform form-horizontal adminex-form" id="commentForm" method="POST" enctype="multipart/form-data" action="">
                                    <div class="form-group ">
                                        <label for="cname" class="control-label col-lg-2">Nama </label>
                                        <div class="col-lg-7">
                                            <input class=" form-control" id="cname" name="user_name" minlength="2" type="text" value="<?php echo $rowUser['user_name'] ?>"/>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="cname" class="control-label col-lg-2">Foto</label>
                                        <div class="col-lg-7">
                                            <img src="assets/images/user/<?php echo $rowUser['user_foto']; ?>" width="20%">
                                            <input class=" form-control" id="cname" name="user_foto" minlength="2" type="file" value="<?php echo $rowUser['user_foto'] ?>"/>
                                        </div>
                                    </div>
                                     <div class="form-group ">
                                        <label for="cname" class="control-label col-lg-2">Password</label>
                                        <div class="col-lg-7"> ***************************
                                   
                                            
                                            <i class="fa fa-pencil pull-right" data-toggle="modal" data-target="#myModal" style="color: #424f63;"></i>
                                    
                                        </div>
                                    </div>
                                     <div class="form-group ">
                                        <label for="cemail" class="control-label col-lg-2">Level</label>
                                        <div class="col-lg-7">
                                            <select name="user_level" class="form-control " >
                                                <option value="">--pilih level--</option>
                                                <?php if($rowUser['user_level'] == 'Admin'){ ?>
                                                     <option value="Admin" selected="">Admin</option>
                                                     <option value="Kasir">Kasir</option>
                                                     <option value="Pemilik">Pemilik</option>
                                                <?php }elseif ($rowUser['user_level'] == 'Kasir'){ ?>
                                                     <option value="Admin">Admin</option>
                                                     <option value="Kasir" selected="">Kasir</option>
                                                     <option value="Pemilik">Pemilik</option>
                                                <?php }elseif ($rowUser['user_level'] == 'Pemilik'){ ?>
                                                     <option value="Admin">Admin</option>
                                                     <option value="Kasir">Kasir</option>
                                                     <option value="Pemilik" selected="">Pemilik</option>
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="cemail" class="control-label col-lg-2">Status</label>
                                        <div class="col-lg-3">
                                            <select name="user_status" class="form-control " >
                                                <option value="">-- status --</option>
                                                <?php 
                                                if($rowUser['user_status'] == 'Y' ){
                                                ?>
                                                <option value="Y" selected="">Active</option>
                                                <option value="N">Not Active</option>
                                                <?php
                                                }else{
                                                ?>
                                                <option value="Y">Active</option>
                                                <option value="N">Not Active</option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-7">
                                            <button class="btn btn-primary" type="submit" name="ubah">Save</button>
                                            <a href="?hal=master/user/list">
                                            <button class="btn btn-default" type="button">Cancel</button>
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <!--body wrapper end-->
                               <!-- Modal -->
                                            <div id="myModal" class="modal fade" role="dialog">
                                              <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title"><i class="fa fa-warning"></i> Ganti Password</h4>
                                                  </div>
                                                  <div class="modal-body text-left">
                                                                    
                                                <form class="form-horizontal" method="POST" action="">
                                       
                                              

                                                <div class="form-group">
                                                    <label for="inputEmail1" class="col-lg-4 col-sm-4 control-label" style="text-align: left;">Password Baru</label>
                                                    <div class="col-lg-8">
                                                        <input type="hidden" name="user_id" value="<?php echo $rowUser['user_id']; ?>">
                                                        <input class="form-control" name="frm_password" id="inputEmail1" placeholder="Password Baru" type="password">
                                                    </div>
                                                </div>

                                            
                                                <div class="pull-right">

                                                </div>

                            
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button class="btn btn-primary btn-sm" name="updatePassword"  type="submit"><i class="fa fa-check-square-o"></i> OK</button>
                                                    <button class="btn btn-danger btn-sm" data-dismiss="modal" aria-hidden="true" type="button"><i class="fa fa-times"></i> Cancel</button>
                                                   </form>
                                                  </div>
                                                </div>

                                              </div>
                                            </div>
                        <!-- start modal end -->