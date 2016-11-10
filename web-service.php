<?php session_start(); ?>
<?php require ('head.php');?>
<?php require ('functions.js');?>
<?php $active="webservice" ?>
<?php require ('menu.php');?>
<div id="content">
        <div class="tail-right">
          <div class="wrapper">
            <div class="col-1">
              <div class="indent">
                <div class="indent1">
                    <div id="registerForm">
                        <form name="form1" method="get" action="web-service-results.php" onsubmit="return searchvalidatejs();" >
                            <br/><h4>Web Service</h4>
                            <table cellspacing=10>
                                <tr>
                                    <td>αναζήτηση: </td><td><input type="text" name="search" id="search"  value="<?php if(isset($_GET['keywords'])) echo $_GET['keywords']; ?>"/></td><td class="redwarning" id="warningSearch"><?php if(isset($_GET['msg1'])) echo $_GET['msg1']; ?></td>
                                 </tr>
                                 <tr>
                                    <td>τύπος επιχείρησης: </td><td><select name="businessType" id="businessType"><?php if(isset($_GET['businessType'])) $selected=$_GET['businessType']; else $selected=-1; load_options($selected); ?></select></td>
                                 </tr>
                                <tr>
                                <td><p><input name="submit" type="submit" value="Αναζήτηση"/></p></td>
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
      
<?php require ('footer.php');?>
