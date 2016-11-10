<?php

function countR(){
    $businessType=$_GET['businessType'];
    try{
        
        require ('db_params.php');
        $pdoObject = new PDO("mysql:host=$dbhost;dbname=$dbname;", $dbuser, $dbpass);
        $sql = "SELECT count(businessTitle) as busCount FROM business,category WHERE business.categoryID=category.categoryID AND business.categoryID=:businessType";
        $statement = $pdoObject->prepare($sql);
        $statement->execute( array(':businessType'=>$businessType));
        $record = $statement->fetch();
        echo " βρέθηκαν ".$record['busCount']." επιχειρήσεις";
        $statement->closeCursor();
        $pdoObject=null;
       
        }catch(PDOException $e) {
         print "Database Error: " . $e->getMessage();
         die("Αδυναμία δημιουργίας PDO Object");
        }
        
}

function getXMLexample(){
    if (file_exists('xmlit.xml')) {
            $xmlData= simplexml_load_file('xmlit.xml');
            //print_r($xmlData);  //τυπώνει πίνακα με μορφοποίηση
        } else {
                exit('Failed to open data.xml.');
            }
    foreach($xmlData->business as $business) {  
        print("<h2>".$business->categoryTitle."</h2><br/>");
        print($business->businessTitle."<br/>");
	print($business->address."<br/>");
        print($business->postalCode."<br/>");
        print($business->phone."<br/>");
        print($business->keywords."<br/>");
        print($business->site."<br/>");
        print("<br/>________________________<br/>");
        print("<br/> <br/>");
    }  
    
    
    
    
}
function getCSS() {
    if (!isset($_COOKIE['css']))
      //αν δεν υπάρχει σχετικό cookie, τότε ο χρήστης
      //ΔΕΝ έχει επιλέξει - δώσε το default
      $css='css/style1.css';
    else
      //αλλιώς δώσε ότι λέει το cookie
      $css= $_COOKIE['css'];
    //επέστρεψε το αποτέλεσμα
    return $css;
  }

function printXml(){
    $search="%".$_GET['search']."%";
    $businessType=$_GET['businessType'];
    if ($businessType==-1)
        $ext="";
    else
        $ext="AND business.categoryID=:businessType";
      
    try{
        
        require ('db_params.php');
        $pdoObject = new PDO("mysql:host=$dbhost;dbname=$dbname;", $dbuser, $dbpass);
        $sql = "SELECT * FROM business,category WHERE business.categoryID=category.categoryID AND (businessTitle LIKE :search OR address LIKE :search OR postalCode LIKE :search OR phone LIKE :search OR keywords LIKE :search OR site LIKE :search) ".$ext;
                
        $statement = $pdoObject -> prepare($sql);
        $statement->execute( array(':search'=>$search,':businessType'=>$businessType));
        header("Content-Type: text/xml; charset=UTF-8");
        echo '<?xml version="1.0" encoding="UTF-8"?'.'>'."\r\n";
        echo '<!DOCTYPE businesses SYSTEM "mydtd.dtd">';
        echo '<businesses>'."\r\n";
        while ($record = $statement->fetch()){
            echo '  <business>';
            echo '      <categoryTitle>'.$record['categoryTitle'].'</categoryTitle>'."\r\n";
            echo '      <businessTitle>'.$record['businessTitle'].'</businessTitle>'."\r\n";
            echo '      <address>'.$record['address'].'</address>'."\r\n";
            echo '      <postalCode>'.$record['postalCode'].'</postalCode>'."\r\n";
            echo '      <phone>'.$record['phone'].'</phone>'."\r\n";
            echo '      <keywords>'.$record['keywords'].'</keywords>'."\r\n";
            echo '      <site>'.$record['site'].'</site>'."\r\n";
            echo '</business>';
        }
       
        echo '</businesses>';
           
        $statement->closeCursor();
        $pdoObject=null;
       
        }catch(PDOException $e) {
         print "Database Error: " . $e->getMessage();
         die("Αδυναμία δημιουργίας PDO Object");
        }
}

function validateWebService(){
    $search=$_GET['search'];
    $businessType=$_GET['businessType'];
	if(empty($_GET['search']) && $businessType==-1) {
	    $msg1="Παρακαλώ επιλέξτε.";
            header('Location: web-service.php?msg1='.$msg1);
            exit();
        }elseif(!empty($_GET['search'])){
            if(!validate_search($search)){
                $msg1="Επτρέπεται μόνο το κόμμα,το κενό και η τελεία.";
                header('Location: web-service.php?msg1='.$msg1);
                exit();
            }
        }

}

function validateSearch(){
$search=$_GET['search'];
$businessType=$_GET['businessType'];
	if(empty($_GET['search']) && $businessType==-1) {
	    $msg1="Παρακαλώ επιλέξτε.";
            header('Location: search.php?msg1='.$msg1);
            exit();
        }elseif(!empty($_GET['search'])){
            if(!validate_search($search)){
                $msg1="Επτρέπεται μόνο το κόμμα,το κενό και η τελεία.";
                header('Location: search.php?msg1='.$msg1);
                exit();
            }
        }
            header('Location: search.php?businessType='.$businessType.'&search='.$search);
	    exit();
        
}


function search(){
    $search="%".$_GET['search']."%";
    $recordsPerPage = 5;
    $businessType=$_GET['businessType'];
    if ($businessType==-1) $ext=""; else $ext="AND business.categoryID=:businessType";
      
        if (isset($_GET['page']))
            $curPage = $_GET['page'];
        else
            $curPage = 1;
        $startIndex = ($curPage-1) * $recordsPerPage;
    try{
        
        require ('db_params.php');
        $pdoObject = new PDO("mysql:host=$dbhost;dbname=$dbname;", $dbuser, $dbpass);
        $sql = "SELECT count(businessTitle) as busCount FROM business,category WHERE business.categoryID=category.categoryID AND (businessTitle LIKE :search OR address LIKE :search OR postalCode LIKE :search OR phone LIKE :search OR keywords LIKE :search OR site LIKE :search) ".$ext;
        $statement = $pdoObject->prepare($sql);
        $statement->execute( array(':search'=>$search,':businessType'=>$businessType));
        $record = $statement->fetch(PDO::FETCH_ASSOC);
        $pages = ceil($record['busCount']/$recordsPerPage);
        $statement->closeCursor();
        $record=null;
        $sql = "SELECT * FROM business,category WHERE business.categoryID=category.categoryID AND (businessTitle LIKE :search OR address LIKE :search OR postalCode LIKE :search OR phone LIKE :search OR keywords LIKE :search OR site LIKE :search) ".$ext." LIMIT $startIndex, $recordsPerPage";
                
        $statement = $pdoObject -> prepare($sql);
        $statement->execute( array(':search'=>$search,':businessType'=>$businessType));
        while ($record = $statement->fetch(PDO::FETCH_ASSOC)){
            echo '<tr><td><a href="search.php?businessTitle='.$record["businessTitle"].'&address='.$record["address"].'&postalCode='.$record["postalCode"].'&phone='.$record["phone"].'&keywords='.$record["keywords"].'&site='.$record["site"].'&businessType='.$record["categoryTitle"].'">'.$record["businessTitle"].'</a></td></tr>';
        }
       
        echo '<tr><td>';
        for ($i= 1  ; $i<=$pages; $i++) {
          // εάν δεν είναι η τρέχουσα σελίδα, φτιάξε link
          if ($i<>$curPage) {
            echo  '<a href="search.php?page='.$i.'&businessType='.$businessType.'&search='.$search.'">'.$i.'</a>&nbsp;&nbsp';  

    // αν είναι η τρέχουσα σελίδα, τύπωσε απλά τον αριθμό της
          } else
             echo $i."&nbsp;&nbsp;";
        }
        echo '</td</tr>';    
        $statement->closeCursor();
        $pdoObject=null;
       
        }catch(PDOException $e) {
         print "Database Error: " . $e->getMessage();
         die("Αδυναμία δημιουργίας PDO Object");
        }
}

function deleteimgdbphp(){
$path=$_GET['file'];
	
    try{
        require ('db_params.php');
        $pdoObject = new PDO("mysql:host=$dbhost;dbname=$dbname;", $dbuser, $dbpass);
        $sql = 'DELETE FROM image WHERE path = :path';
        $statement = $pdoObject -> prepare($sql);
        $statement->execute(array(':path'=>$path));
	$statement->closeCursor();
        $pdoObject=null;
		echo "Επιτυχής διαγραφή!";
		
    }catch(PDOException $e) {
         print "Database Error: " . $e->getMessage();
         die("Αδυναμία δημιουργίας PDO Object");
        }
}





function loadImages($delete){
    if(isset($_POST['businessTitle']))
        $businessTitle=$_POST['businessTitle'];
    else
        $businessTitle=$_GET['businessTitle'];
    try{
        
        require ('db_params.php');
        $pdoObject = new PDO("mysql:host=$dbhost;dbname=$dbname;", $dbuser, $dbpass);
        $sql = 'SELECT * FROM image WHERE businessTitle=:businessTitle';
        $statement = $pdoObject -> prepare($sql);
        $statement->execute( array(':businessTitle'=>$businessTitle));
        
        while ($record = $statement-> fetch()){
	    if($delete==1)
            $ext='<a href="delete-image.php?file='.$record['path'].'">διαγραφή</a>';
        else
            $ext="";
            echo '<tr><td><a href="'.$record['path'].'"><img style="width: 200px;" title="'.$record['description'].'" src="'.$record['path'].'" alt="'.$record['description'].'"/></a></td><td>'.$record['title'].'</br>'.$ext.'</td></tr>';
        }
            
        
        $statement->closeCursor();
        $pdoObject=null;
       
        }catch(PDOException $e) {
         print "Database Error: " . $e->getMessage();
         die("Αδυναμία δημιουργίας PDO Object");
        }
}






function deleteimgphp(){
	if ( !isset( $_GET['file']) || $_GET['file']=='' )
            die("ERROR: Ανεπαρκή δεδομένα για διαγραφή!");
	elseif ( !file_exists($_GET['file']) )
            die("ERROR: Δεν υπάρχει τέτοιο αρχείο στον φάκελο!");
	else
            $fileDelResult=unlink($_GET['file']);
	
	if (!$fileDelResult)
		die("ERROR: Το αρχείο δεν διαγράφηκε!");
	else {
	    header('refresh:3; url = images.php');
		exit("<p>OK: Έγινε Διαγραφή!</p>");
	}





}



function uploadvalidatephp(){
    $uploadType = $_FILES['upload']['type'];
	$result=true;
	$title =$_POST['title'];
	$desc=$_POST['desc'];
	
	if(empty($_POST['title'])){} else {
            if (!validate_keywords($title) || strlen($title)>45)
            {
                $result=false;
                $msg1="Ο τίτλος της εικόνας πρέπει να </br> είναι ως 45 </br>χαρακτήρες (απαγορεύονται οι ειδικοί χαρακτήρες)";
            }	
	}
		 
		 
	if(empty($_POST['desc'])){} else {
	    if (!validate_keywords($desc) || strlen($desc)>100)
            {
                $result=false;
                $msg2="Η περιγραφή της εικόνας πρέπει να </br> είναι ως 100 </br>χαρακτήρες (απαγορεύονται οι ειδικοί χαρακτήρες)";
            }	
	}
   
   
	if ($uploadType!="image/png" && $uploadType!="image/gif" && $uploadType!="image/jpeg"){
	    $msg3="Το αρχείο πρέπει να είναι png, jpeg ή gif";
            $result=false;	
		
	}
		if(!$result) {
		
			header('Location: images.php?msg1='.$msg1.'&msg2='.$msg2.'&msg3='.$msg3.'&businessTitle='.$_POST['businessTitle']);
			exit();
		}
	
	
}


function upload(){
    $uploadFile = $_FILES['upload']['tmp_name'];
    $uploadName = $_FILES['upload']['name'];
    $uploadType = $_FILES['upload']['type'];
    if(!empty($_POST['title']))
        $title = $_POST['title'];
    else
        $title=null;
    if(!empty($_POST['desc']))
        $desc = $_POST['desc'];
    else
        $desc = null;
    if($uploadType=="image/jpeg")
        $filename = 'Uploads/'.uniqid().'.jpg';
    elseif($uploadType=="image/png")
        $filename = 'Uploads/'.uniqid().'.png';
    else
        $filename = 'Uploads/'.uniqid().'.gif';
    
    
    $businessTitle=$_POST['businessTitle'];
    if(!isset($_POST['title'])){
        $uploadTitle=null;
    }else{
        $uploadTitle = $_POST['title'];
    }
    if(!isset($_POST['uploadDesc'])){
        $uploadDesc=null;
    }else{
        $uploadDesc = $_POST['desc'];
    }
       
    
    try{
        require ('db_params.php');
        $pdoObject = new PDO("mysql:host=$dbhost;dbname=$dbname;", $dbuser, $dbpass);
        $sql = 'INSERT INTO image VALUES (:path,:title,:description,:businessTitle)';
        $statement = $pdoObject -> prepare($sql);
        $statement->execute(array(':path'=>$filename,':title'=>$title,':description'=>$desc,':businessTitle'=>$businessTitle));
        if (copy($_FILES['upload']['tmp_name'], $filename)) {
            header('refresh:3; url = images.php');
		exit("<p>File stored successfully as $filename.</p>");
        } else {
		header('refresh:3; url = index.php');
		exit("<p>Could not save file as $filename!</p>");
        }

        $statement->closeCursor();
        $pdoObject=null;

        }catch(PDOException $e) {
         print "Database Error: " . $e->getMessage();
         die("Αδυναμία δημιουργίας PDO Object");
        }

}

function businessDelete(){
    $businessTitle=$_POST['businessTitle'];
    try{
        require ('db_params.php');
        $pdoObject = new PDO("mysql:host=$dbhost;dbname=$dbname;", $dbuser, $dbpass);
        $sql = 'DELETE FROM business WHERE businessTitle= :businessTitle';
        $statement = $pdoObject -> prepare($sql);
        $statement->execute( array(':businessTitle'=>$businessTitle));
        
        
        $statement->closeCursor();
        $pdoObject=null;
        }catch(PDOException $e) {
         print "Database Error: " . $e->getMessage();
         die("Αδυναμία δημιουργίας PDO Object");
        }
}

function businessInfo($update){
    $businessTitle=$_POST['businessTitle'];
    if($businessTitle==-1)
        {
            $msg='Παρακαλώ επιλέξτε μία επιχείρηση';
            header('Location: businesses.php?msg='.$msg);
            exit();
        }else{
    try{
        require ('db_params.php');
        $pdoObject = new PDO("mysql:host=$dbhost;dbname=$dbname;", $dbuser, $dbpass);
        $sql = 'SELECT business.businessTitle,business.address,business.postalCode,business.phone,business.keywords,business.site,category.categoryTitle,business.categoryID FROM business,category WHERE business.businessTitle= :businessTitle AND business.categoryID=category.categoryID';
        $statement = $pdoObject -> prepare($sql);
        $statement->execute( array(':businessTitle'=>$businessTitle));
        $record = $statement-> fetch();
           $address=$record['address'];
           $postalCode=$record['postalCode'];
           $phone=$record['phone'];
           $businessType=$record['categoryTitle'];
           $keywords=$record['keywords'];
           $site=$record['site'];
           if($update==1){
            $update="&update=".$businessTitle;
            $businessType=$record['categoryID'];
           }else{$update="";}
            header('Location: businesses.php?businessTitle='.$businessTitle.'&address='.$address.'&postalCode='.$postalCode.'&phone='.$phone.'&keywords='.$keywords.'&site='.$site.'&businessType='.$businessType.$update);
            exit();
        
        $statement->closeCursor();
        $pdoObject=null;
        }catch(PDOException $e) {
         print "Database Error: " . $e->getMessage();
         die("Αδυναμία δημιουργίας PDO Object");
        }
        }
}

function load_businesses($selected) {
  //Πρώτα θα φτιάξουμε την ψευδοεπιλογή.
  //Αποφασίζουμε αν θα την προεπιλέξουμε:
  $username=$_SESSION['username'];
  if ($selected == -1) 
    $extra_attribute='selected="selected"';
  else $extra_attribute='';
  //Γράφουμε τον HTML κώδικα της ψευδοεπιλογής
  echo '<option value="-1"'.$extra_attribute.'>--επέλεξε--</option>';

  //Τώρα θα φτιάξουμε τα <options> που αντιστοιχούν στις
  //εγγραφές του πίνακα $table (παράμετρος της συνάρτησης)
  try {
    //ενσωμάτωση παραμέτρων σύνδεσης
    require('db_params.php');    
    //ενεργοποίηση PDO και δημιουργία ερωτήματος
    $pdoObject = new PDO("mysql:host=$dbhost;dbname=$dbname;", $dbuser, $dbpass);   
    $sql = 'SELECT * FROM business WHERE username= :username';
    $statement = $pdoObject -> prepare($sql);
    $statement->execute( array(':username'=>$username));
    //ακολουθεί απευθείας εκτέλεση του ερωτήματος καθώς δεν υπάρχουν
    //δεδομένα από εξωτερικό χρήστη ώστε να απαιτούνται παράμετροι και prepare
    
    //ακολουθεί loop "κατανάλωσης" αποτελεσμάτων ερωτήματος
    while ( $record = $statement->fetch() ) {
      //αποφασίζουμε αν θα προεπιλέξουμε αυτό το <option>
        if ($record[0]==$selected)      
            $extra_attribute='selected="selected"';
        else $extra_attribute='';
      //και τελικά γράφουμε το <option>
      echo '<option value="'.$record[0].'"'.$extra_attribute.' >'.$record[0].'</option>';
      //ΣΗΜΕΙΩΣΗ: προσέξτε πώς χρησιμοποιήσαμε τον πίνακα του $record
      //με αριθμητικούς δείκτες και όχι την associative εκδοχή με τους 
      //λεκτικούς δείκτες γιατί έτσι η συνάρτηση αυτή θα δουλεύει για πολλούς 
      //πίνακες, δεδομένου και του ότι ο πίνακας περνά ως παράμετρος
      //στην κλίση της συνάρτησης.
    }
    //εκκαθάριση PDO
    $statement->closeCursor();
    $pdoObject=null;
  } catch (PDOException $e) {   //block για exception handling
      header('Location: error.php?msg=Database Error: '. $e->getMessage());
      exit();
  } 
}

function registerBusiness(){
    $username=$_SESSION['username'];
    $businessTitle=$_POST['businessTitle'];
    if(!isset($_POST['address'])){
        $address=null;
    }else{
        $address=$_POST['address'];
    }
    if(!isset($_POST['postalCode'])){
        $postalCode=null;
    }else{
        $postalCode=$_POST['postalCode'];
    }
    if(!isset($_POST['phone'])){
        $phone=null;
    }else{
        $phone=$_POST['phone'];
    }
    $businessType=$_POST['businessType'];
    if(!isset($_POST['keywords'])){
        $keywords=null;
    }else{
        $keywords=$_POST['keywords'];
    }
    if(!isset($_POST['site'])){
        $site=null;
    }else{
        $site=$_POST['site'];
    }
    
    
    
    try{
        require ('db_params.php');
        $pdoObject = new PDO("mysql:host=$dbhost;dbname=$dbname;", $dbuser, $dbpass);
        $sql = 'SELECT * FROM business WHERE businessTitle= :businessTitle';
        $statement = $pdoObject -> prepare($sql);
        $statement->execute( array(':businessTitle'=>$businessTitle));
        if ( $record = $statement-> fetch() ) {
            $msg1="ο τίτλος επιχείρησης υπάρχει είδη";
            header('Location: business.php?msg1='.$msg1);
            exit();
        }else{
            $pdoObject = new PDO("mysql:host=$dbhost;dbname=$dbname;", $dbuser, $dbpass);
            $sql = 'INSERT INTO business VALUES (:businessTitle,:address,:postalCode,:phone,:keywords,:site,:username,:categoryID)';
            $statement = $pdoObject->prepare($sql);
            $statement->execute(array(':businessTitle'=>$businessTitle,':address'=>$address,':postalCode'=>$postalCode,':phone'=>$phone,':keywords'=>$keywords,'site'=>$site,'username'=>$username,'categoryID'=>$businessType));
            header("refresh:3; url = index.php");
            exit("Success!");
        }
        $statement->closeCursor();
        $pdoObject=null;
        }catch(PDOException $e) {
         print "Database Error: " . $e->getMessage();
         die("Αδυναμία δημιουργίας PDO Object");
        }

}

function businessvalidatephp(){
    $result=true;
    if(empty($_POST['businessTitle'])){
        $result=false;
        $msg1="Παρακαλώ συμπληρώστε τον τίτλο της επιχείρησης";
    }else{
        $businessTitle = $_POST['businessTitle'];
        if (!validate_businessTitle($businessTitle) || strlen($businessTitle)<4 || strlen($businessTitle)>30)
        {
            $result=false;
            $msg1="Ο τίτλος της επιχείρησης πρέπει να </br> είναι από 4 ως 30 </br>χαρακτήρες (απαγορεύονται οι ειδικοί χαρακτήρες)";
        }
    }
    
    $address = $_POST['address'];
    if ($address==""){}
    elseif (!validate_address($address) || strlen($address)>45)
    {
        $result=false;
        $msg2="Το πεδίο address πρέπει να είναι λιγότερο απο 45 χαρακτήρες";
    }
    
    
    $postalCode=$_POST['postalCode'];
    if ($postalCode==""){}
    elseif(!is_numeric($postalCode) || strlen($postalCode)!=5){
        $msg3="Το πεδίο Τ.Κ. πρέπει να είναι ένας πενταψήφιος ακέραιος αριθμός!";
        $result=false;
    }
    
    $phone=$_POST['phone'];
    if ($phone==""){}
    elseif(!is_numeric($phone) || strlen($phone)!=10){
        $msg4="Το πεδίο τηλέφωνο πρέπει να είναι ένας δεκαψήφιος ακέραιος αριθμός!";
        $result=false;
    }
    
    $businessType=$_POST['businessType'];
    if($businessType==-1){
        $msg5="παρακαλώ επιλέξτε έναν τύπο επιχείρησης";
        $result=false;
    }
    
    $keywords=$_POST['keywords'];
    
    if ($keywords==""){}
    elseif (!validate_keywords($keywords) || strlen($keywords)>100){
        $msg6="Το πεδίο λέξεις κλειδιά πρέπει να περιέχει μόνο γράμματα, αριθμούς και κόμματα!";
        $result=false;
    }
    
    $site=$_POST['site'];
    if ($site=="" || $site=="http://"){}
    else{
        $filter_result = filter_input( INPUT_POST, 'site' , FILTER_VALIDATE_URL);
        if(!$filter_result)
        {
            $result=false;
            $msg7="Το website δεν είναι αποδεκτό!";
        }
        
    }
    
    
    if(!$result){
        header('Location: business.php?msg1='.$msg1.'&msg2='.$msg2.'&msg3='.$msg3.'&msg4='.$msg4.'&msg5='.$msg5.'&msg6='.$msg6.'&msg7='.$msg7.'&businessTitle='.$businessTitle.'&address='.$address.'&postalCode='.$postalCode.'&phone='.$phone.'&keywords='.$keywords.'&site='.$site.'&businessType='.$businessType);
        exit();
    }
    


}

function load_options($selected) {
  //Πρώτα θα φτιάξουμε την ψευδοεπιλογή.
  //Αποφασίζουμε αν θα την προεπιλέξουμε:
  if ($selected == -1) 
    $extra_attribute='selected="selected"';
  else $extra_attribute='';
  //Γράφουμε τον HTML κώδικα της ψευδοεπιλογής
  echo '<option value="-1" '.$extra_attribute.'>--επέλεξε--</option>';

  //Τώρα θα φτιάξουμε τα <options> που αντιστοιχούν στις
  //εγγραφές του πίνακα $table (παράμετρος της συνάρτησης)
  try {
    //ενσωμάτωση παραμέτρων σύνδεσης
    require('db_params.php');    
    //ενεργοποίηση PDO και δημιουργία ερωτήματος
    $pdoObject = new PDO("mysql:host=$dbhost;dbname=$dbname;", $dbuser, $dbpass);   
    $sql = "SELECT * FROM category";
    //ακολουθεί απευθείας εκτέλεση του ερωτήματος καθώς δεν υπάρχουν
    //δεδομένα από εξωτερικό χρήστη ώστε να απαιτούνται παράμετροι και prepare
    $statement = $pdoObject->query($sql);
    //ακολουθεί loop "κατανάλωσης" αποτελεσμάτων ερωτήματος
    while ( $record = $statement->fetch() ) {
      //αποφασίζουμε αν θα προεπιλέξουμε αυτό το <option>
        if ($record[0]==$selected)      
            $extra_attribute='selected="selected"';
        else $extra_attribute='';
      //και τελικά γράφουμε το <option>
      echo '<option value="'.$record[0].'"'.$extra_attribute.' >'.$record[1].'</option>';
      //ΣΗΜΕΙΩΣΗ: προσέξτε πώς χρησιμοποιήσαμε τον πίνακα του $record
      //με αριθμητικούς δείκτες και όχι την associative εκδοχή με τους 
      //λεκτικούς δείκτες γιατί έτσι η συνάρτηση αυτή θα δουλεύει για πολλούς 
      //πίνακες, δεδομένου και του ότι ο πίνακας περνά ως παράμετρος
      //στην κλίση της συνάρτησης.
    }
    //εκκαθάριση PDO
    $statement->closeCursor();
    $pdoObject=null;
  } catch (PDOException $e) {   //block για exception handling
      header('Location: error.php?msg=Database Error: '. $e->getMessage());
      exit();
  } 
}

function login(){
    $username=$_POST['usernameL'];
    $password=$_POST['passwordL'];
    try{
        require ('db_params.php');
        $pdoObject = new PDO("mysql:host=$dbhost;dbname=$dbname;", $dbuser, $dbpass);
        $sql = 'SELECT * FROM user WHERE username= :username';
        $statement = $pdoObject -> prepare($sql);
        $statement->execute( array(':username'=>$username));
        if ( $record = $statement-> fetch() ) {
            if($record['authenticated']!=true)
            {
                $msg1L="Ο λογαριασμός δεν είναι ενεργοποιημένος.";
                header('Location: activate.php?msg1L='.$msg1L);
                exit();
            }
            
            $passwordHash=crypt($password,$record['salt']);
            if ($passwordHash!=$record['passwordHash']){
                $msg2L="Λάθος εισαγωγή password.";
                header('Location: index.php?msg2L='.$msg2L);
                exit();
            }else{
                $_SESSION['username']=$username;
                header('Location: index.php');
                exit();
            }
        }else{
            $msg1L="Το username δεν υπάρχει";
            header('Location: index.php?msg1L='.$msg1L);
            exit();
        }
        $statement->closeCursor();
        $pdoObject=null;
        }catch(PDOException $e) {
         print "Database Error: " . $e->getMessage();
         die("Αδυναμία δημιουργίας PDO Object");
        }
}

function loginvalidatephp(){
    
    $result=true;
    
    if(empty($_POST['usernameL'])){
        $result=false;
        $msg1L="Empty username";
    }else{
        $username = $_POST['usernameL'];
        if (!validate_alphanumeric_underscore($username) || strlen($username)<4 || strlen($username)>8)
        {
            $result=false;
            $msg1L="Invalid username";
        }
    }

    if(empty($_POST['passwordL'])){
        $result=false;
        $msg2L="Empty password";
    }else{
        $password=$_POST['passwordL'];
        if (strlen($password)<8 || strlen($password)>12)
        {
            $result=false;
            $msg2L="Invalid password";
        }
    }
    
    if($result==false)
    {
        header('Location: index.php?msg1L='.$msg1L.'&msg2L='.$msg2L.'&usernameL='.$username);
        exit();
    }
    
}

function activate(){
    $username=$_POST['username'];
    $password=$_POST['password'];
    $activateKey=$_POST['activateKey'];
    $flag=true;
    if(($_SESSION['security_code'] == $_POST['security_code']))
    {
    try{
        require ('db_params.php');
        $pdoObject = new PDO("mysql:host=$dbhost;dbname=$dbname;", $dbuser, $dbpass);
        $sql = 'SELECT * FROM user WHERE username= :username';
        $statement = $pdoObject -> prepare($sql);
        $statement->execute( array(':username'=>$username));
        if ( $record = $statement-> fetch() ) {
            if($record['authenticated']==true)
            {
                $msg1="Ο λογαριασμός είναι ήδη ενεργοποιημένος";
                header('Location: activate.php?msg1='.$msg1);
                exit();
            }
            if($record['salt']!=$activateKey){
                $msg3="Το activate key δεν είναι σωστό.";
                $flag=false;
            }
            $passwordHash=crypt($password,$record['salt']);
            if ($passwordHash!=$record['passwordHash']){
                $msg2="Λάθος εισαγωγή password.";
                $flag=false;
            }
            if(!$flag){
                header('Location: activate.php?msg2='.$msg2.'&msg3='.$msg3.'&username='.$username);
                exit();
            }
            else{
                
                $sql = 'UPDATE user SET authenticated = true WHERE username = :username';
                $statement = $pdoObject -> prepare($sql);
                $statement->execute( array(':username'=>$username));
                $_SESSION['username']=$username;
                header("refresh:3; url = index.php");
                exit("Ο λογαριασμός ενεργοποιήθηκε!");
                }
            
        }else{
            $msg1="Το username δεν υπάρχει.";
            header('Location: activate.php?msg1='.$msg1);
            exit();
        }
            
            
    
        $statement->closeCursor();
        $pdoObject=null;
        }catch(PDOException $e) {
         print "Database Error: " . $e->getMessage();
         die("Αδυναμία δημιουργίας PDO Object");
        }
    }else{
        $msg4="Το πεδίο activate key δεν συμπίπτει.";
        header('Location: activate.php?msg4='.$msg4.'&username='.$username);
    }
}

function activalidatephp(){
    $result=true;
    $msg1="";
    $msg2="";
    $msg3="";
    if(empty($_POST['username'])){
        $result=false;
        $msg1="Παρακαλώ συμπληρώστε το πεδίο username";
    }else{
        $username = $_POST['username'];
        if (!validate_alphanumeric_underscore($username) || strlen($username)<4 || strlen($username)>8)
            {
                $result=false;
                $msg1="Το username πρέπει να είναι από 4 ως 8 χαρακτήρες, αριθμοί ή underscore!";
            }
    }

    if(empty($_POST['password'])){
        $result=false;
        $msg2="Παρακαλώ συμπληρώστε το πεδίο password";
    }else{
        $password=$_POST['password'];
        if (strlen($password)<8 || strlen($password)>12)
        {
            $result=false;
            $msg2="Το password πρέπει να είναι απο 8 ως 12 χαρακτήρες!";
        }
    }
    
    if(empty($_POST['activateKey'])){
        $result=false;
        $msg3="Παρακαλώ συμπληρώστε το πεδίο Activate key";
    }else{
        $activateKey=$_POST['activateKey'];
        if(!is_numeric($activateKey) || $activateKey>99999 || $activateKey<10000 || strlen($activateKey)!=5){
            $msg3="Το πεδίο ActivateKey πρέπει να είναι ένας πενταψήφιος ακέραιος αριθμός!";
            $result=false;
        }
        else{
        $msg3="";
        }
    }
    
    if(empty($_POST['security_code'])){
        $result=false;
        $msg4="Παρακαλώ συμπληρώστε το πεδίο Security Code";
    }else{
        $security_code=$_POST['security_code'];
        if(strlen($security_code)!=5){
            $msg4="Το πεδίο security code πρέπει να είναι 5 χαρακτήρες.";
            $result=false;
        }
        else{
        $msg4="";
        }
    }
	
	
	
	
	
    if($result==false)
    {
        header('Location: activate.php?msg1='.$msg1.'&msg2='.$msg2.'&msg3='.$msg3.'&msg4='.$msg4.'&username='.$username);
        exit();
    }
}

//validate with php
function regvalidatephp()
{

$result=true;
$msg1="";
$msg2="";
$msg3="";
$msg4="";

if(empty($_POST['username'])){
    $result=false;
    $msg1="Παρακαλώ συμπληρώστε το πεδίο username";
}else{
    $username = $_POST['username'];
    if (!validate_alphanumeric_underscore($username) || strlen($username)<4 || strlen($username)>8)
        {
            $result=false;
            $msg1="Το username πρέπει να είναι από 4 ως 8 χαρακτήρες, αριθμοί ή underscore!";
        }
}

if(empty($_POST['password'])){
    $result=false;
    $msg2="Παρακαλώ συμπληρώστε το πεδίο password";
}else{
    $password=$_POST['password'];
    if (strlen($password)<8 || strlen($password)>12)
    {
        $result=false;
        $msg2="Το password πρέπει να είναι απο 8 ως 12 χαρακτήρες!";
    }
}


if(empty($_POST['confirmPassword'])){
    $result=false;
    $msg3="Παρακαλώ συμπληρώστε το πεδίο confirm password";
}else{
    $confirmPassword=$_POST['confirmPassword'];
    if ($password!=$confirmPassword)
    {
    $result=false;
    $msg3="Τα passwords δεν συμπίπτουν!";
    }
}

if(empty($_POST['email'])){
    $result=false;
    $msg4="Παρακαλώ συμπληρώστε το πεδίο email";
}else{
    $email=$_POST['email'];
    $filter_result = filter_input( INPUT_POST, 'email' , FILTER_VALIDATE_EMAIL);
    if(!$filter_result)
    {
        $result=false;
        $msg4="Το email δεν είναι αποδεκτό!";
    }
}



if($result==false)
{
    header('Location: register.php?msg1='.$msg1.'&msg2='.$msg2.'&msg3='.$msg3.'&msg4='.$msg4.'&username='.$username.'&email='.$email);
    exit();
}else
{

    
}
}

function validate_businessTitle($str){
    return preg_match('/^[A-Za-z0-9 .]+$/',$str); 
}
function validate_address($str){
    return preg_match('/^[A-Za-z0-9 ]+$/',$str);
}
function validate_keywords($str){
    return preg_match('/^[A-Za-z0-9 ,]+$/',$str);
}

function validate_alphanumeric_underscore($str) 
{
    return preg_match('/^[A-Za-z0-9_]+$/',$str);
}
function validate_search($str) 
{
    return preg_match('/^[A-Za-z0-9 ,.]+$/',$str);
}

//register in db and send email
function register ($username,$password,$email)
{
    $username=$_POST['username'];
    $password=$_POST['password'];
    $email=$_POST['email'];
    $salt=rand(10000,99999);
    $passwordHash=crypt($password,$salt);
    $authenticated=false;
    $flag=true;
    
        try{
            require ('db_params.php');
         $pdoObject = new PDO("mysql:host=$dbhost;dbname=$dbname;", $dbuser, $dbpass);
         $sql = 'SELECT * FROM user WHERE username= :username';
        $statement = $pdoObject -> prepare($sql);
        $statement->execute( array(':username'=>$username));
        if ( $record = $statement-> fetch() ) {
            $msg1="Το username υπάρχει!";
            $flag=false;
            
            }
        $sql = 'SELECT * FROM user WHERE email= :email';
        $statement = $pdoObject -> prepare($sql);
        $statement->execute( array(':email'=>$email));
        if ( $record = $statement-> fetch() ) {
            $msg4="Το email υπάρχει!";
            $flag=false;
            }
        else{
            $pdoObject = new PDO("mysql:host=$dbhost;dbname=$dbname;", $dbuser, $dbpass);
            $sql = 'INSERT INTO user VALUES (:username,:passwordHash,:email,:salt,:authenticated)';
            $statement = $pdoObject->prepare($sql);
            $statement->execute(array(':username'=>$username,':passwordHash'=>$passwordHash,':email'=>$email,':salt'=>$salt,':authenticated'=>$authenticated));
        }
        $statement->closeCursor();
        $pdoObject=null;
        }catch(PDOException $e) {
         print "Database Error: " . $e->getMessage();
         die("Αδυναμία δημιουργίας PDO Object");
        }
    
        
        if (!$flag)
        {
            header('Location: register.php?msg4='.$msg4.'&msg1='.$msg1);
            exit;
        }else{
            $subject="Ενεργοποίηση λογαριασμού";
            $to=$email;
            $message="Γειά σου $username, Καλωσόρισες στο webINDEX. Για να ενεργοποιήσεις το λογαριασμό σου πρέπει να χρησιμοποιήσεις τον κωδικό $salt";
            if (mail($to, $subject, $message)) {
                echo '<p>Mail sent successfully</p>';
            } else {
            echo '<p>Mail could not be sent</p>';
            }
            header("refresh:3; url = index.php");
            exit("Επιτυχής Εγγραφή");
        }

}
?>