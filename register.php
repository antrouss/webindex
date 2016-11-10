<?php require ('head.php');?>
<?php require ('functions.js');?>
<?php $active="register" ?>
<?php require ('menu.php');?>
<div id="content">
        <div class="tail-right">
          <div class="wrapper">
            <div class="col-1">
              <div class="indent">
                <div class="indent1">
                    <div id="registerForm">
                        <form name="form1" method="post" action="regvalidate.php" onsubmit="return regvalidatejs();" >
                            <h4>Εγγραφή</h4>
                            <table cellspacing=10>
                                <tr>
                                    <td>username: </td><td><input type="text" name="username" id="username"  value="<?php if(isset($_GET['username'])) echo $_GET['username']; ?>"/></td><td class="redwarning" id="warningUsername"><?php if(isset($_GET['msg1'])) echo $_GET['msg1']; ?></td>
                                 </tr>
                                <tr>
                                    <td>password: </td><td><input type="password" name="password" id="password"/></td><td class="redwarning" id="warningPassword"><?php if(isset($_GET['msg2'])) echo $_GET['msg2']; ?></td>
                                </tr>
                                <tr>
                                    <td>confirm <br/> password: </td><td><input type="password" name="confirmPassword" id="confirmPassword"/></td><td class="redwarning" id="warningConfirmPassword"><?php if(isset($_GET['msg3'])) echo $_GET['msg3']; ?></td>
                                </tr>
                                <tr>
                                    <td>e-mail: </td><td><input type="text" name="email" id="email" value="<?php if(isset($_GET['email'])) echo $_GET['email']; ?>"/></td><td class="redwarning" id="warningEmail"><?php if(isset($_GET['msg4'])) echo $_GET['msg4']; ?></td>
                                </tr>
                                <tr>
                                <td><p><input name="submit" type="submit" value="Εγγραφή"></p></td>
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
