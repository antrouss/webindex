<script type="text/javascript">

function ajaxFunction() {
	var xmlhttp;
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else if (window.ActiveXObject) {
		// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	else {
		alert("Your browser does not support XMLHTTP!");
  }
	xmlhttp.onreadystatechange=function() {
		if(xmlhttp.readyState==4) {
			document.getElementById("countResults").innerHTML = xmlhttp.responseText; 
      //document.myForm.time.value=xmlhttp.responseText;
		}
	}
  

  var url= "count.php?businessType="+document.getElementById("businessType").value;
  // alert(url);
	xmlhttp.open("GET",url,true);
	xmlhttp.send(null);
}

function looks_like_email(str){
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

function businessesval(){
  var businessTitle=document.getElementById("businessTitle").value;
  if(businessTitle==-1){
    var warningBusinessTitle = document.getElementById("warningBusinessTitle").innerHTML="Παρακαλώ επιλέξτε μία επιχείρηση";
    return false;
  }else
    return true;
}

function searchvalidatejs(){
  var letters = /^[A-Za-z0-9 .,]+$/;
  var search=document.getElementById("search").value;
  var businessType=document.getElementById("businessType").value;

  if(search=="" && businessType==-1) {
		
		var warningsearch=document.getElementById("warningSearch").innerHTML="Παρακαλώ επιλέξτε.";
		return false; } 
	else if (search!=""){
		if(!search.match(letters)){
			var warningsearch=document.getElementById("warningSearch").innerHTML="Επτρέπεται μόνο το κόμμα,το κενό και η τελεία.";
			return false;}
	}
	return true;
}

function testTitle(str){
  var letters = /^[A-Za-z0-9 .]+$/;
  if(str.match(letters))
    return true;
  else
    return false;
}

function testAddress(str){
  var letters = /^[A-Za-z0-9 ]+$/;
  if(str.match(letters))
    return true;
  else 
    return false;
}

function testKeywords(str){
  var letters = /^[A-Za-z0-9, ]+$/;
  if(str.match(letters))
    return true;
  else
    return false;
}

function testUrl(str){
  var letters = /^(ht|f)tps?:\/\/[a-z0-9-\.]+\.[a-z]{2,4}\/?([^\s<>\#%"\,\{\}\\|\\\^\[\]`]+)?$/;
  if(str.match(letters))
    return true;
  else
    return false;
}

function uploadvalidatejs(){
  var result=true;
  var title = document.getElementById("title").value;
  var desc = document.getElementById("desc").value;
  var upload = document.getElementById("upload").value;
  if (title==""){
  var warningTitle=document.getElementById("warningTitle").innerHTML="";
  }else{
    if(!testTitle(title) || title.length>45){
      result=false;
      var warningTitle=document.getElementById("warningTitle").innerHTML="Ο τίτλος της εικόνας πρέπει να </br> είναι ως 45 </br>χαρακτήρες (απαγορεύονται οι ειδικοί χαρακτήρες)";
    }else{
      var warningTitle=document.getElementById("warningTitle").innerHTML="";
  }
  }


  if (desc==""){
    var warningDesc=document.getElementById("warningDesc").innerHTML="";
  }else{
    if(!testTitle(desc) || desc.length>100){
      result=false;
      var warningDesc=document.getElementById("warningDesc").innerHTML="Η περιγραφή της εικόνας πρέπει να </br> είναι ως 100 </br>χαρακτήρες (απαγορεύονται οι ειδικοί χαρακτήρες)";
    }else{
      var warningDesc=document.getElementById("warningDesc").innerHTML="";
    }
  }
  
  if(upload==""){
    result=false;
    var warningUpload=document.getElementById("warningUpload").innerHTML="Παρακαλώ επιλέξτε μία εικόνα";
  }

  return result;
  
}

function businessvalidatejs(){
  var result=true;
  var businessTitle = document.getElementById("businessTitle").value;
  var address = document.getElementById("address").value;
  var postalCode = document.getElementById("postalCode").value;
  var phone = document.getElementById("phone").value;
  var businessType=document.getElementById("businessType").value;
  var keywords = document.getElementById("keywords").value;
  var site = document.getElementById("site").value;
  if (businessTitle==""){
    var warningBusinessTitle=document.getElementById("warningBusinessTitle").innerHTML="Παρακαλώ συμπληρώστε τον τίτλο της επιχείρησης";
    result=false;
  }else{
    
    if(!testTitle(businessTitle) || businessTitle.length<4 || businessTitle.length>30){
      result=false;
      var warningBusinessTitle=document.getElementById("warningBusinessTitle").innerHTML="Ο τίτλος της επιχείρησης πρέπει να </br> είναι από 4 ως 30 </br>χαρακτήρες (απαγορεύονται οι ειδικοί χαρακτήρες)";
    }else{
    var warningBusinessTitle=document.getElementById("warningBusinessTitle").innerHTML="";
  }
  }
  
  if(address==""){var warningBusinessTitle=document.getElementById("warningAddress").innerHTML="";}
  else if(!testAddress(address) || businessTitle.length>45){
      result=false;
      var warningAddress=document.getElementById("warningAddress").innerHTML="Η διεύθυνση πρέπει να </br> είναι ως 30 </br>χαρακτήρες και αριθμοί (απαγορεύονται οι ειδικοί χαρακτήρες)";
    }else{
    var warningBusinessTitle=document.getElementById("warningAddress").innerHTML="";
  }
  
  if(postalCode==""){var warningPostalCode=document.getElementById("warningPostalCode").innerHTML="";}
  else if(isNaN(postalCode) || postalCode<10000 || postalCode>99999 || postalCode.length!=5){
	    result=false;
	    var warningPostalCode=document.getElementById("warningPostalCode").innerHTML="Το πεδίο Τ.Κ. πρέπει να είναι ένας πενταψήφιος ακέραιος αριθμός!";
	  }else{
	    var warningPostalCode=document.getElementById("warningPostalCode").innerHTML="";
	  }
  
  if(phone==""){var warningPhone=document.getElementById("warningPhone").innerHTML="";}
  else if(isNaN(phone) || phone.length!=10){
	    result=false;
	    var warningPhone=document.getElementById("warningPhone").innerHTML="Το πεδίο τηλέφωνο πρέπει να είναι ένας δεκαψήφιος ακέραιος αριθμός!";
	  }else{
	    var warningPhone=document.getElementById("warningPhone").innerHTML="";
	  }

  if(businessType==-1){
    var warningBusinessType=document.getElementById("warningBusinessType").innerHTML="Παρακαλώ επιλέξτε έναν τύπο επιχείρησης";
    result=false;
  }else{
    var warningBusinessType=document.getElementById("warningBusinessType").innerHTML="";
  }
  
  if(keywords==""){var warningKeywords=document.getElementById("warningKeywords").innerHTML="";}
  else if(!testKeywords(keywords) || keywords.length>100){
    result=false;
    var warningKeywords=document.getElementById("warningKeywords").innerHTML="Το πεδίο λέξεις κλειδιά πρέπει να περιέχει μόνο γράμματα, αριθμούς και κόμματα!";
  }else{
    var warningKeywords=document.getElementById("warningKeywords").innerHTML="";
  }
  
  if(site=="" || site=="http://"){var warningSite=document.getElementById("warningSite").innerHTML="";}
  else if(!testUrl(site) || site.length>45){
    result=false;
    var warningSite=document.getElementById("warningSite").innerHTML="Το website δεν είναι αποδεκτό";
    }else{
      var warningSite=document.getElementById("warningSite").innerHTML="";
    }
  
  if(!result)
  {
    return false;
  }
}

function loginvalidatejs(){
  var result=true;
  var username=document.getElementById("usernameL").value;
  var password=document.getElementById("passwordL").value;
  var illegalChars = /\W/;
  
  if(username==""){
	  var warningUsername=document.getElementById("warningUsernameL").innerHTML="Empty Username";
	  result=false;
	}else{
	  if (illegalChars.test(username) || username.length>8 || username.length<4) {
	    result=false;
	    var warningUsername=document.getElementById("warningUsernameL").innerHTML="Invalid username";
	  }else
	    var warningUsername=document.getElementById("warningUsernameL").innerHTML="";
	}
	if(password==""){
	  result=false;
	  var warningPassword=document.getElementById("warningPasswordL").innerHTML="Empty password";
	}else{
	  if (password.length<8 || password.length>12) {
	    result=false;
	    var warningPassword=document.getElementById("warningPasswordL").innerHTML="Invalid password";
	  }else
	    var warningPassword=document.getElementById("warningPasswordL").innerHTML="";
	}
	return result;
}

function activalidatejs() {
  var result=true;
  var username=document.getElementById("username").value;
  var password=document.getElementById("password").value;
  var activateKey=document.getElementById("activateKey").value;
  var security_code=document.getElementById("security_code").value;

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
	if(activateKey==""){
	  result=false;
	  var warningActivateKey=document.getElementById("warningActivateKey").innerHTML="Παρακαλώ συμπληρώστε το πεδίο Activate key";
	}else if(isNaN(activateKey) || activateKey.length!=5){
	    result=false;
	    var warningActivateKey=document.getElementById("warningActivateKey").innerHTML="Το πεδίο ActivateKey πρέπει να είναι ένας πενταψήφιος ακέραιος αριθμός!";
	}else var warningActivateKey=document.getElementById("warningActivateKey").innerHTML="";
	
		if(security_code==""){
	  result=false;
	  var warningSecurityCode=document.getElementById("warningSecurityCode").innerHTML="Παρακαλώ συμπληρώστε το πεδίο Security Code";
	}else if(security_code.length!=5){
	    result=false;
	    var warningSecurityCode=document.getElementById("warningSecurityCode").innerHTML="Το πεδίο security code πρέπει να είναι 5 χαρακτήρες.";
	}else warningSecurityCode=document.getElementById("warningSecurityCode").innerHTML="";
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
