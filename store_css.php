<?php

  
  if (isset($_COOKIE['css']))
    setcookie ("css", "", time()-3600);

  //έστω μια νέα ημ/νία λήξης, 120 μέρες μετά
  $expire=time()+60*60*24*120;

  
  $style = 'css/style1.css';

  //προσδιορισμός του css με βάση την επιλογή του χρήστη
  if ( isset($_GET['style']) ) {

    if ($_GET['style']=='1')
      $style = 'css/style1.css';

    if ($_GET['style']=='2')
      $style = 'css/style2.css';
  }

  //βάζουμε το νέο cookie στον browser του χρήστη
  setcookie("css", $style, $expire);

  //ανακατευθύνουμε στην αρχική
  header("Location: index.php");
  exit();

 ?>