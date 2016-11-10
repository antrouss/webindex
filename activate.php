<?php require ('head.php');?>
<?php require ('functions.js');?>
<?php $active="activate"; ?>
<?php require ('menu.php');?>
<div id="content">
        <div class="tail-right">
          <div class="wrapper">
            <div class="col-1">
              <div class="indent">
                <div class="indent1">
                <div id="registerForm">
                    <form name="form1" method="post" action="activate-account.php" onsubmit="return activalidatejs();" >
                            <h4>Ενεργοποίηση</h4>
                            <table cellspacing=10>
                                <tr>
                                    <td>username: </td><td><input type="text" name="username" id="username"  value="<?php if(isset($_GET['username'])) echo $_GET['username']; ?>"/></td><td class="redwarning" id="warningUsername"><?php if(isset($_GET['msg1'])) echo $_GET['msg1']; ?></td>
                                 </tr>
                                <tr>
                                    <td>password: </td><td><input type="password" name="password" id="password"/></td><td class="redwarning" id="warningPassword"><?php if(isset($_GET['msg2'])) echo $_GET['msg2']; ?></td>
                                </tr>
                                <tr>
                                    <td>activate <br/> key: </td><td><input type="text" name="activateKey" id="activateKey"/></td><td class="redwarning" id="warningActivateKey"><?php if(isset($_GET['msg3'])) echo $_GET['msg3']; ?></td>
                                </tr>
                                <tr>
                                        <td></td>
					<td><img src="CaptchaSecurityImages.php?width=100&height=40&characters=5"  alt="" /></td>
				</tr>
				<tr> 
					<td>Security Code: </td>
					<td><input id="security_code" name="security_code" type="text" /></td><td class="redwarning" id="warningSecurityCode"> <?php if(isset($_GET['msg4'])) echo $_GET['msg4']; ?></td>
				</tr>
				<tr>
                                        <td></td>				
                                        <td><p><input name="submit" type="submit" value="Ενεργοποίηση"></p></td>
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
