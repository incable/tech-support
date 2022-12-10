function validateFormOnLogin(theForm) {

var uname=theForm.textfield1.value;
var reason1 = "";
reason1 +=valmyuser(uname);

var mypass=theForm.textfield2.value;
var reason2 = "";
reason2 += validatePassword(mypass);

if(reason1 =="false")
{
return false;
}

else if(reason2 =="false")
{
return false;
}
else
{
return true;
}


}

/* *******************Newwwwwwwww Functions**************** */

function valmyuser(uname)
{
var illegalChars = /^(?=.*[\d])(?=.*[A-Z])(?=.*[a-z])[\w\d!@#$%_]{6,40}$/;
var usname="";
usname+=uname;
	if(usname=="")
	{
	    document.getElementById("reply1").innerHTML="<img src='assets/img/cross.gif' width='15px' height='15px' style='float:left;margin-left:5px;'/><b style='color:#E41B17;font:10px verdana;font-weight:bold;'>&nbsp;&nbsp;Username is Required</b>";
    return false;
  }
  
 	/*else if (illegalChars.test(usname)) {
  document.getElementById("reply1").innerHTML="<img src='img/cross.gif' width='15px' height='15px' style='float:left;margin-left:5px;'/><b style='color:#E41B17;font:10px verdana;font-weight:bold;'>&nbsp;&nbsp;Must Contain only Letters &amp; numbers</b>";
    return false;
    } */
	
  else
  {
   document.getElementById("reply1").innerHTML="";
  return true;
  }


}




function validatePassword(pass) {

    var illegalChars = /[\W_]/; // allow only letters and numbers 
 
    if (pass == "") {
 document.getElementById("reply2").innerHTML="<img src='assets/img/cross.gif' width='15px' height='15px' style='float:left;margin-left:5px;'/><b style='color:#E41B17;font:10px verdana;font-weight:bold;'>&nbsp;&nbsp;Password is Required</b>";
    return false;
    } 
     else {
        document.getElementById("reply2").innerHTML="";
return true;
    }

}  



