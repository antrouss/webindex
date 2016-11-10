<?php session_start(); ?>
<?php require ('head.php');?>
<?php $active="index"; ?>
<?php require ('functions.js'); ?>
<?php require ('menu.php'); ?>
<div id="content">
        <div class="tail-right">
          <div class="wrapper">
            <div class="col-1">
              <div class="indent">
                <div class="indent1">
                <h3>Καλώς όρισες<?php if(isset($_SESSION['username']))echo " ".$_SESSION['username'];?>!</h3>
                <p>To webINDEX  είναι μια on-line υπηρεσία  καταλόγου (ευρετήριο) για επιχειρήσεις κάθε είδους.</p>
                <p>Το βασικό σενάριο χρήσης αφορά στην εγγραφή ενός  "ιδιοκτήτη"  στην υπηρεσία, ώστε να μπορέσει να καταχωρήσει σε αυτή πληροφορίες για την επιχείρησή του.</p>
                <p>Κάθε εγγεγραμμένος χρήστης έχει δικαίωμα να  κάνει <strong>πολλές</strong> καταχωρήσεις. Οι χρήστες του site (εγγεγραμμένοι και μη) μπορούν να ψάξουν τον κατάλογο με κάποια κριτήρια αναζήτησης και να δουν πληροφορίες για τις καταχωρημένες επιχειρήσεις.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
<?php require ('footer.php');?>