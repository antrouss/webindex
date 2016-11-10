<script type="text/javascript">
function looks_like_email(str) {
  var result = true;
  var ampersatPos = str.indexOf("@");    //η θεση του @ στο str
  var dotPos = str.indexOf(".");         //η θεση της . στο str
  var dotPosAfterAmpersat = str.indexOf(".", ampersatPos); //η θεση της . μετά το @
  // αν το @ δεν βρεθεί, η indexOf επιστρέφει -1 ενώ αν είναι πρώτος χαρακτήρας
  // επιστρέφει 0. Σε κάθε περίτπωση δεν είναι αποδεκτό email
  if (ampersatPos<=0) result = false; 
  // αν δεν υπάρει καθόλου τελεία δεν είναι email
  if (dotPos<0) result = false; 
  // αν δεν υπάρχει . μετά το @ αλλά όχι αμέσως μετά, τότε δεν είναι email
  if (dotPosAfterAmpersat-ampersatPos<=1) result = false; 
  // αν ο πρώτος ή ο τελευταίος χαρακτήρας είναι . τότε δεν είναι email
  if ( str.indexOf(".")==0  ||  str.lastIndexOf(".")==str.length-1 ) result = false; 
  // πιθανώς να απαιτούνται επιπλέον έλεγχοι - ας αρκεστούμε σε αυτούς
  return result;
}
function regvalidatejs() {

	var result=true;  
	
	var username=document.getElementById("username").value;
	var password=document.getElementById("password").value;
	var confirmPassword=document.getElementById("confirmPassword").value;
	var email=document.getElementById("email").value;

	var illegalChars = /\W/;
	
	if(username==""){
	  var warningUsername=document.getElementById("warningUsername").innerHTML="Παρακαλώ συμπληρώστε το πεδίο username";
	  result=false;
	}else{
	  if (illegalChars.test(username) || username.length>8 || username.length<4) {
	    result=false;
	    var warningUsername=document.getElementById("warningUsername").innerHTML="Το username πρέπει να είναι από 4 ως 8 χαρακτήρες, \n αριθμοί ή underscore!";
	  }else
	    var warningUsername=document.getElementById("warningUsername").innerHTML="";
	}

	if(password==""){
	  result=false;
	  var warningPassword=document.getElementById("warningPassword").innerHTML="Παρακαλώ συμπληρώστε το πεδίο password";
	}else{
	  if (password.length<8 || password.length>12) {
	    result=false;
	    var warningPassword=document.getElementById("warningPassword").innerHTML="Το password πρέπει να είναι από 8 ως 12 χαρακτήρες!";
	  }else
	    var warningPassword=document.getElementById("warningPassword").innerHTML="";
	}
        
        if(confirmPassword==""){
	  result=false;
	  var warningConfirmPassword=document.getElementById("warningConfirmPassword").innerHTML="Παρακαλώ συμπληρώστε το πεδίο confirm password";
	}else{
	  if (password!=confirmPassword) {
	    result=false;
	    var warningConfirmPassword=document.getElementById("warningConfirmPassword").innerHTML="Τα passwords δεν συμπίπτουν!";
	  }else
	  var warningConfirmPassword=document.getElementById("warningConfirmPassword").innerHTML="";
	}

	if(email==""){
	  result=false;
	  var warningEmail=document.getElementById("warningEmail").innerHTML="Παρακαλώ συμπληρώστε το πεδίο email";
	}else{
	  if ( !looks_like_email(email) ) {
	    result=false;
	    var warningEmail=document.getElementById("warningEmail").innerHTML="Το email δεν είναι αποδεκτό!";
	  }else
	    var warningEmail=document.getElementById("warningEmail").innerHTML="";
	}
        return result;
}
</script>
