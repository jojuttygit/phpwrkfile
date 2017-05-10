
function usersignup () {
	var user_name = document.forms["signup"]["user_name"].value;
    var user_mobile = document.forms["signup"]["user_mobile"].value;
    var user_email = document.forms["signup"]["user_email"].value;
    var user_password = document.forms["signup"]["user_pwd"].value;
    var user_confirmpassword = document.forms["signup"]["user_confirm_pwd"].value;
    var pwdExpr = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z])/;
    var atposition = user_email.indexOf("@");  
    var dotposition = user_email.lastIndexOf(".");
    var name_error_id="errorname";
    var number_error_id="errornumber";
    var mail_error_id = "erroremail";
    var pwd_error_id = "errorpassword";
    var pwdconfirm_error_id="errorconfirmpassword";
    var phoneExpr = /^[0-9]+$/;
    var nameExpr = /^[A-Za-z]+$/; 
   
    if (!user_name.match(nameExpr)) {
        showerror('Name',name_error_id);
        
    }
    else {
        functionSuccess(name_error_id);
    }

    if (user_mobile.length !== 10 || !user_mobile.match(phoneExpr)) {
        showerror('MobileNumber',number_error_id);
        
    }
    else {
        functionSuccess(number_error_id);  
    }
    
    if (atposition<1 || dotposition<atposition+2 || atposition+2>=user_email.length) {
       showerror('Email',mail_error_id);
       
    }
    else {
        functionSuccess(mail_error_id);
    }
    
    if (user_password.length < 6 || !user_password.match(pwdExpr) || user_password.length >= 16) {
        showerror('password',pwd_error_id);
        
    }
    else {
        functionSuccess(pwd_error_id);
    }
    
    if (user_password != user_confirmpassword) {
        showerror('password Match',pwdconfirm_error_id);
        
    }
    else {
        functionSuccess(pwdconfirm_error_id);
    }
}

function showerror(value,error_id) {
    document.getElementById("useraccount").disabled = true;
    document.getElementById(error_id).innerHTML = "Incorrect " + value;
    document.getElementById(error_id).style.color="red";
    return false;
}
function functionSuccess(error_id) {
    document.getElementById("useraccount").disabled = false;
    document.getElementById(error_id).innerHTML = "";
    return true;
}