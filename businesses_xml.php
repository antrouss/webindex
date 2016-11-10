<?php
  
  require('db_params.php');

  //Ελέξτε την παρουσία παραμέτρου genreID στο url.
  //Αν δεν υπάρχει τερματίστε με μήνυμα σφάλματος.
  if (!isset($_GET['genreID']))
    die('ERROR: Please provide a genreID.');

  //database tasks       
  try {
    //σύνδεση σε database μέσω PDO library 
    $pdoObject = new PDO("mysql:host=$dbhost;dbname=$dbname;", $dbuser, $dbpass);
    //SQL ερώτημα (παραμετροποιημένο σύμφωνα με PDO)
    $sql = "SELECT movieID, movies.genreID, genreTitle, movieTitle, movieYear
            FROM movies INNER JOIN genre ON movies.genreID = genre.genreID
            WHERE movies.genreID = :myGenreID 
            ORDER BY movieYear ASC";
    //λοιπά βήματα PDO (μέχρι πριν το while loop)        
    $statement = $pdoObject->prepare($sql);
    $statement->execute( array(':myGenreID'=>$_GET['genreID']));

    //Πριν μπούμε στο loop κατανάλωσης των αποτελεσμάτων, 
    //στείλτε κατάλληλο header στον browser ώστε να ξέρει 
    //ότι το αποτέλεσμα είναι XML (και όχι HTML) 
    header("Content-Type: text/xml; charset=UTF-8");

    //εδώ αρχίζει η παραγωγή του XML - το "\r\n" στο τέλος κάθε γραμμής 
    //είναι για να γίνεται αλλαγή γραμμής και στο XML που παράγεται ώστε
    //αν αποθηκευτεί σε αρχείο να μην είναι μια τεράστια γραμμή!
    echo '<?xml version="1.0" encoding="UTF-8"?'.'>'."\r\n";
    echo '<movies>'."\r\n";
    //εδώ αρχίζει το loop κατανάλωσης των αποτελεσμάτων του SQL query
    while ( $record = $statement->fetch() ) {
      echo '  <movie id="'.$record['movieID'].'">'."\r\n";
      echo '    <title>'.$record['movieTitle'].'</title>'."\r\n";
      echo '    <genre id="'.$record['genreID'].'">'.$record['genreTitle'].'</genre>'."\r\n";
      echo '    <year>'.$record['movieYear'].'</year>'."\r\n";
      echo '  </movie>'."\r\n";
    }
    //κλείνουμε και το root element
    echo '</movies>';
    //απόσύνδεση από database    
    $statement->closeCursor();
    $pdoObject = null;  
  } catch (PDOException $e) {   
     die( "PDOException: ".$e->getMessage() ); 
    }
?>

