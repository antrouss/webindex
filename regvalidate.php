<?php
require ('db_params.php');
require ('functions.php');
regvalidatephp();
register($_POST['username'],$_POST['password'],$_POST['email']);





?>
