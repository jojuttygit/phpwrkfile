


function validateCurrentPwd() {
	var current_pwd = document.forms["changepassword"]["current_pwd"].value;
    var pwdExpr = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z])/;
    var pwd_error_id = "error_current_pwd";

    if (current_pwd.length < 6 || !current_pwd.match(pwdExpr) || current_pwd.length >= 16) {
        showerror('current password',pwd_error_id);
        return false;
    }
    else {
        functionSuccess(pwd_error_id);
    }
}

function validateNewPwd () {
	var new_pwd = document.forms["changepassword"]["new_pwd"].value;
	var new_pwd_error_id = "error_new_pwd";
	var pwdExpr = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z])/;
	if (new_pwd.length < 6 || !new_pwd.match(pwdExpr) || new_pwd.length >= 16) {
        showerror('New password',new_pwd_error_id);
        return false;
    }
    else {
        functionSuccess(new_pwd_error_id);
    }
}

function validateConfirmPwd () {
	var confirm_pwd = document.forms["changepassword"]["confirm_pwd"].value;
	var new_pwd = document.forms["changepassword"]["new_pwd"].value;
	var confirm_pwd_error_id = "error_confirm_pwd";

    if (confirm_pwd != new_pwd) {
        showerror('Password Match',confirm_pwd_error_id);
        return false;
    }
    else {
        functionSuccess(confirm_pwd_error_id);
    }
}

function changePassword() {
	validateCurrentPwd();
	validateNewPwd();
	validateConfirmPwd();
}

function showerror(value,error_id) {
    document.getElementById("changepwd").disabled = true;
    document.getElementById(error_id).innerHTML = "Incorrect " + value;
    document.getElementById(error_id).style.color="red";
    return false;
}
function functionSuccess(error_id) {
    document.getElementById("changepwd").disabled = false;
    document.getElementById(error_id).innerHTML = "";
    return true;
}