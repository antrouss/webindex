<?php session_start();?>
<?php if(!isset($_SESSION['username'])){exit("u r not permited to be here!");}?>
<?php require ('head.php');?>
<?php require ('functions.js');?>
<?php $active="images" ?>
<?php require ('menu.php');?>
<div id="content">
        <div class="tail-right">
          <div class="wrapper">
            <div class="col-1">
              <div class="indent">
                <div class="indent1">
                    <div id="registerForm">
                        <form name="form1" method="post" onsubmit="return uploadvalidatejs();" action="upload-image.php" enctype="multipart/form-data">
                            <h4>Εικόνες</h4>
                            <table cellspacing=10>
                            <?php $msg=""; if(isset($_POST['businessTitle'])) if ($_POST['businessTitle']==-1) $msg="Παρακαλώ επιλέξτε μία επιχείρηση"; else $msg="" ?>
                                 <tr>
                                    <td>επιχειρήσεις</td><td style="width: 250px;"><select name="businessTitle" id="businessTitle"><?php if(isset($_POST['businessTitle'])) $selected=$_POST['businessTitle']; elseif(isset($_GET['businessTitle'])) $selected=$_GET['businessTitle']; else $selected=-1; load_businesses($selected); ?></select><input name="submit" type="submit" value="Επιλογή επιχείρησης" onclick="form1.action='images.php';return true;"/></td><td id="warningBusinessTitle" class="redwarning"><?php echo $msg?></td>
                                 </tr>
                                 <?php if((isset($_POST['businessTitle'])&& $_POST['businessTitle']!=-1) || (isset($_GET['businessTitle'])))	{?><tr>
                                    <td>τίτλος επιχείρησης:</td><td> <?php if(isset($_POST['businessTitle'])) echo $_POST['businessTitle']; else if(isset($_GET['businessTitle'])) echo $_GET['businessTitle']; ?></td>
                                 </tr>
                                 <tr>
                                    <td>Τίτλος Εικόνας</td><td><input type="text" id="title" name="title" maxlength="45"/></td><td class="redwarning" id="warningTitle"><?php if(isset($_GET['msg1'])) echo $_GET['msg1']; ?></td>
                                 </tr>
                                 <tr>
                                    <td>Περιγραφή</td><td><input type="text" id="desc" name="desc" maxlength="100"/></td><td class="redwarning" id="warningDesc"><?php if(isset($_GET['msg2'])) echo $_GET['msg2']; ?></td>
                                 </tr>
                                 <tr>
                                    <td>Εικόνα</td><td><input id="upload" type="file" name="upload"/></td><td id=></td><td class="redwarning" id="warningUpload"><?php if(isset($_GET['msg3'])) echo $_GET['msg3']; ?></td>
                                 </tr>
                                 <tr>
                                    <td></td><td><input type="submit" value="Ανέβασμα εικόνας" ></td>
                                 </tr><?php }?>
                                 <tr><td><?php if(isset($_POST['businessTitle'])) loadImages(1); ?>      </td></tr>
                            </table>
                            
                        </form>
                        
                    </div>  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>








 <div class="tail-right">
          <div class="wrapper">
          <div id="leftSpace">
          <br/>
          </div>
            
          </div>
          
                    
                
        </div>
      </div>
<?php require ('footer.php');?>
