<?php session_start(); ?>
<?php require ('head.php');?>
<?php require ('functions.js');?>
<?php $active="search" ?>
<?php require ('menu.php');?>
<div id="content">
        <div class="tail-right">
          <div class="wrapper">
            <div class="col-1">
              <div class="indent">
                <div class="indent1">
                    <div id="registerForm">
                        <?php if(isset($_GET['businessTitle'])){ ?><h4 style="text-align: center;"><?php echo $_GET['businessTitle']; ?></h4>
                        <table cellspacing=10>
                                <tr>
                                    <td>διεύθυνση επιχείρησης:</td><td><?php echo $_GET['address'];?></td>
                                 </tr>
                                 <tr>
                                    <td>Τ.Κ.:</td><td><?php if(isset($_GET['postalCode'])) echo $_GET['postalCode']?></td>
                                 </tr>
                                 <tr>
                                    <td>τηλέφωνο:</td><td><?php if(isset($_GET['phone'])) echo $_GET['phone'];?></td>
                                 </tr>
                                 <tr>
                                    <td>τύπος επιχείρησης</td><td><?php if(isset($_GET['businessType'])) echo $_GET['businessType'];?></td>
                                 </tr>
                                <tr>
                                    <td>λέξεις κλειδιά:</td><td><?php if(isset($_GET['keywords'])) echo $_GET['keywords'];?></td>
                                 </tr>
                                 <tr>
                                    <td>web site:</td><td><?php if(isset($_GET['site']))echo $_GET['site'];?></td>
                                 </tr>
                                 <?php if(isset($_GET['businessTitle'])) loadImages(0); ?>
                        </table>         
                        <?php }else { ?>
                        <form name="form1" method="get" action="search-results.php" onsubmit="return searchvalidatejs();" >
                            <h4>Αναζήτηση</h4>
                            <table cellspacing=10>
                                <tr>
                                    <td>Αναζήτηση: </td><td><input type="text" name="search" id="search"  value="<?php if(isset($_GET['keywords'])) echo $_GET['keywords']; ?>"/></td><td class="redwarning" id="warningSearch"><?php if(isset($_GET['msg1'])) echo $_GET['msg1']; ?></td>
                                 </tr>
                                 <tr>
                                    <td>τύπος επιχείρησης: </td><td><select onchange="ajaxFunction();" name="businessType" id="businessType"><?php if(isset($_GET['businessType'])) $selected=$_GET['businessType']; else $selected=-1; load_options($selected); ?></select></td><td id="countResults"></td>
                                 </tr>
                                <tr>
                                <td><p><input name="submit" type="submit" value="Αναζήτηση"/></p></td>
                                </tr>
                                <?php if(isset($_GET['businessType']) || isset($_GET['search'])) search();?>
                            </table>
                        </form>
                        <?php }?>
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
