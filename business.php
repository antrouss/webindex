<?php session_start();?>
<?php if(!isset($_SESSION['username'])){exit("u r not permited to be here!");}?>
<?php require ('head.php');?>
<?php require ('functions.js');?>
<?php $active="business" ?>
<?php require ('menu.php');?>
<div id="content">
        <div class="tail-right">
          <div class="wrapper">
            <div class="col-1">
              <div class="indent">
                <div class="indent1">
                    <div id="registerForm">
                        <form name="form1" method="post" action="business-submit.php" onsubmit="return businessvalidatejs();" >
                            <h4>Εγγραφή</h4>
                            <table cellspacing=10>
                                <tr>
                                    <td>τίτλος επιχείρησης: </td><td><input type="text" name="businessTitle" id="businessTitle"  value="<?php if(isset($_GET['businessTitle'])) echo $_GET['businessTitle']; ?>"/></td><td class="redwarning" id="warningBusinessTitle"><?php if(isset($_GET['msg1'])) echo $_GET['msg1']; ?></td>
                                 </tr>
                                 <tr>
                                    <td>διεύθυνση επιχείρησης: </td><td><input type="text" name="address" id="address"  value="<?php if(isset($_GET['address'])) echo $_GET['address']; ?>"/></td><td class="redwarning" id="warningAddress"><?php if(isset($_GET['msg2'])) echo $_GET['msg2']; ?></td>
                                 </tr>
                                 <tr>
                                    <td>Τ.Κ.: </td><td><input type="text" name="postalCode" id="postalCode"  value="<?php if(isset($_GET['postalCode'])) echo $_GET['postalCode']; ?>"/></td><td class="redwarning" id="warningPostalCode"><?php if(isset($_GET['msg3'])) echo $_GET['msg3']; ?></td>
                                 </tr>
                                 <tr>
                                    <td>τηλέφωνο: </td><td><input type="text" name="phone" id="phone"  value="<?php if(isset($_GET['phone'])) echo $_GET['phone']; ?>"/></td><td class="redwarning" id="warningPhone"><?php if(isset($_GET['msg4'])) echo $_GET['msg4']; ?></td>
                                 </tr>
                                 <tr>
                                    <td>τύπος επιχείρησης </td><td><select name="businessType" id="businessType"><?php if(isset($_GET['businessType'])) $selected=$_GET['businessType']; else $selected=-1; load_options($selected);  ?></select></td><td class="redwarning" id="warningBusinessType"><?php if(isset($_GET['msg5'])) echo $_GET['msg5']; ?></td>
                                 </tr>
                                 <tr>
                                    <td>λέξεις κλειδιά: </td><td><input type="text" name="keywords" id="keywords"  value="<?php if(isset($_GET['keywords'])) echo $_GET['keywords']; ?>"/></td><td class="redwarning" id="warningKeywords"><?php if(isset($_GET['msg6'])) echo $_GET['msg6']; ?></td>
                                 </tr>
                                 <tr>
                                    <td>web site: </td><td><input type="text" name="site" id="site"  value="<?php if(isset($_GET['site'])) echo $_GET['site'];else{echo("http://");} ?>"/></td><td class="redwarning" id="warningSite"><?php if(isset($_GET['msg7'])) echo $_GET['msg7']; ?></td>
                                 </tr>
                                <tr>
                                <td><p><input name="submit" type="submit" value="Καταχώρηση στοιχείων"></p></td>
                                </tr>
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
