
<?php

require ('db_params.php');
    $username="user1";
        try{
         $pdoObject = new PDO("mysql:host=$dbhost;dbname=$dbname;", $dbuser, $dbpass);
         $sql = 'SELECT * FROM user WHERE username= :username';
        $statement = $pdoObject -> prepare($sql);
        $statement->execute( array(':username'=>$username));
        while ( $record = $statement-> fetch() ) {
            echo $record['username'].$record['password'].$record['email'];
            }
        $statement->closeCursor();
        $pdoObject=null;
        }catch(PDOException $e) {
         print "Database Error: " . $e->getMessage();
         die("Αδυναμία δημιουργίας PDO Object");
        }
        
?>
