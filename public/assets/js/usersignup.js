function userName () {
    var user_name = document.forms["signup"]["user_name"].value;
    var nameExpr = /^[A-Za-z]+$/;
    var name_error_id="errorname"; 
    if (!user_name.match(nameExpr)) {
        showerror('Name',name_error_id);   
    }
    else {
        functionSuccess(name_error_id);
    }
}
function userMobile () {
    var user_mobile = document.forms["signup"]["user_mobile"].value;
    var phoneExpr = /^[0-9]+$/;
    var number_error_id="errornumber";
    if (user_mobile.length !== 10 || !user_mobile.match(phoneExpr)) {
        showerror('MobileNumber',number_error_id);
    }
    else {
        functionSuccess(number_error_id);  
    }
}

function userEmail () {
    var user_email = document.forms["signup"]["user_email"].value;
    var atposition = user_email.indexOf("@");  
    var dotposition = user_email.lastIndexOf(".");
    var mail_error_id = "erroremail";
    if (atposition<1 || dotposition<atposition+2 || atposition+2>=user_email.length) {
        showerror('Email',mail_error_id);
    }
    else {
        functionSuccess(mail_error_id);
    }
}

function password () {
    var user_password = document.forms["signup"]["user_pwd"].value;
    var pwdExpr = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z])/;
    var pwd_error_id = "errorpassword";
    if (user_password.length < 6 || !user_password.match(pwdExpr) || user_password.length >= 16) {
        showerror('password',pwd_error_id); 
    }
    else {
        functionSuccess(pwd_error_id);
    }
}

function confirmPassword () {
    var user_password = document.forms["signup"]["user_pwd"].value;
    var user_confirmpassword = document.forms["signup"]["user_confirm_pwd"].value;
    var pwdconfirm_error_id="errorconfirmpassword";
    if (user_password != user_confirmpassword) {
        showerror('password Match',pwdconfirm_error_id);
    }
    else {
        functionSuccess(pwdconfirm_error_id);
    }
}

function usersignup () {
    userName();
    userMobile();
    userEmail();
    password();
    confirmPassword();
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