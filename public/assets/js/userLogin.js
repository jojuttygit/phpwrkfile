function validateUserLogin () {

	var user_email = document.forms["loginform"]["user_login_email"].value;
	var user_pwd = document.forms["loginform"]["user_login_pwd"].value;
	var pwdExpr = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z])/;
    var atposition = user_email.indexOf("@");  
    var dotposition = user_email.lastIndexOf(".");
    var mail_error_id = "erroremail";
    var pwd_error_id = "errorpassword";

    if (atposition<1 || dotposition<atposition+2 || atposition+2>=user_email.length) {
       showerror('Email',mail_error_id);
       return false;
    }
    else {
        functionSuccess(mail_error_id);

    }
    if (user_pwd.length < 6 || !user_pwd.match(pwdExpr) || user_pwd.length >= 16) {
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
