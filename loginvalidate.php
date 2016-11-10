<?php



$username = $_POST['usernameL'];
$password = $_POST['passwordL'];
$result = true;
$msg = "";
loginvalidate($username,$password);

function loginvalidate($username,$password) {



try {
require('db_params.php');
$pdoObject = new PDO("mysql:host=$dbhost;dbname=$dbname;",$dbuser,$dbpass);
$sql = 'SELECT * FROM user WHERE username = :username';
 $statement = $pdoObject -> prepare($sql);
        $statement->execute( array(':username'=>$username));

		if ( $record = $statement-> fetch() ) {
            echo "MINDK";
		}




	} catch (PDOException $e) {
         print "Database Error: " . $e->getMessage();
         die("FAILED");
		}
	}	
?>