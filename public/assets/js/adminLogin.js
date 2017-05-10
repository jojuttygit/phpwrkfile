function validateAdminLogin () {

	var admin_email = document.forms["admin_login"]["admin_email"].value;
	var admin_pwd = document.forms["admin_login"]["admin_pwd"].value;
	var pwdExpr = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z])/;
    var atposition = admin_email.indexOf("@");  
    var dotposition = admin_email.lastIndexOf(".");
    var pwd_error_id = "errorpwd";
    var mail_error_id = "errormail";

    if (atposition<1 || dotposition<atposition+2 || atposition+2>=admin_email.length || admin_email == "") {
       showerror('Email',mail_error_id);
       return false;
    }
    else {
        functionSuccess(mail_error_id);
    }
    if (admin_pwd.length < 6 || !admin_pwd.match(pwdExpr) || admin_pwd.length >= 16 ||admin_pwd == "") {
        showerror('password',pwd_error_id);
        return false;
    }
    else {
        functionSuccess(pwd_error_id);

    }
}

function showerror(value,error_id) {
    document.getElementById("login").disabled = true;
    document.getElementById(error_id).innerHTML = "Incorrect " + value;
    document.getElementById(error_id).style.color="red";
    
}
function functionSuccess(error_id) {
    document.getElementById("login").disabled = false;
    document.getElementById(error_id).innerHTML = "";
    return true;
}
