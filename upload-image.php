<?php

session_start();
if(!isset($_SESSION['username'])){exit("u r not permited to be here!");}
require ('functions.php');
uploadvalidatephp();
upload();
?> 