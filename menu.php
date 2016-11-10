<body id="page1">
<div class="tail-top">
  <div class="tail-bottom">
    <div class="body-bg">
      <!-- HEADER -->
      <div id="header">
        <div class="extra"></div>
        <div class="row-1">
	    
	    <form name="login" method="post" action="login.php" onsubmit="return loginvalidatejs();">
	    
	      <table class="fright">
		<tr>
		  <td><?php if(isset($_SESSION['username'])) echo $_SESSION['username'].', <a href="logout.php">logout</a></td></tr></table>';else {?>username:</td><td>password:</td>
		</tr>
		<tr>
		  <td><input type="text" name="usernameL" id="usernameL"/></td><td><input type="password" name="passwordL" id="passwordL"/></td><td><input name="submit" type="submit" value="Login"></td>
		</tr>
		<tr>
		  <td class="redwarning" id="warningUsernameL"><?php if(isset($_GET['msg1L'])) echo $_GET['msg1L']; ?></td><td class="redwarning" id="warningPasswordL"><?php if(isset($_GET['msg2L'])) echo $_GET['msg2L']; ?></td>
		</tr>
		
		
	      </table>
		<?php }?> 
	    </form>
	    
	    <div class="fleft"><a href="store_css.php?style=1">CSS Blue</a>  <a href="store_css.php?style=2">CSS Black</a></div>
	  
          
        </div>
        <div class="row-2">
          <ul>
            <li class="m1"><a href="index.php" <?php if($active=="index")echo 'class="active"'?>>Home</a></li>
            <li class="m2"><a href="web-service.php"<?php if($active=="webservice")echo 'class="active"'?>>web</br> service</a></li>
            <li class="m3"><a href="search.php"<?php if($active=="search")echo 'class="active"'?>>Search</a></li>
            <?php if(!isset($_SESSION['username'])){?><li class="m4"><a href="register.php"<?php if($active=="register")echo 'class="active"'?>>Register</a></li><?php }else{?><li class="m4"><a href="images.php"<?php if($active=="images")echo 'class="active"'?>>images</a></li><?php } ?>
            <?php if(!isset($_SESSION['username'])){?><li class="m5"><a href="activate.php"<?php if($active=="activate")echo 'class="active"'?>>Account Activation</a></li><?php }else{?><li class="m5"><a href="businesses.php"<?php if($active=="businesses")echo 'class="active"'?>>my <br/>businesses</a></li><?php } ?>
	    <?php if(!isset($_SESSION['username'])){ }else{?><li class="m6"><a href="business.php"<?php if($active=="business")echo 'class="active"'?>>business registration</a></li><?php } ?>
            
          </ul>
        </div>
        <div class="row-3">
          <h1>webINDEX</h1>
        </div>
      </div>

