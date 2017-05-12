function validateName () {
    var user_name = document.forms["updateUserProfile"]["user_name"].value;
    var user_error_id="error_name";
    var nameExpr = /^[A-Za-z]+$/;
    if (!user_name.match(nameExpr)) {
        showerror('Name',user_error_id);
        return false;   
    }
    else {
        functionSuccess(user_error_id);
        return true;
    }  
}

function userMobile () {
    var user_mobile = document.forms["updateUserProfile"]["user_mobile"].value;
    var phoneExpr = /^[0-9]+$/;
    var number_error_id="error_number";
    if (user_mobile.length !== 10 || !user_mobile.match(phoneExpr)) {
        showerror('MobileNumber',number_error_id);
    }
    else {
        functionSuccess(number_error_id);  
    }
}

function validateupdate () {
	validateName();
    userMobile();
}

function showerror(value,error_id) {
    document.getElementById("profileUpdate").disabled = true;
    document.getElementById(error_id).innerHTML = "Incorrect " + value;
    document.getElementById(error_id).style.color="red";
}

function functionSuccess(error_id) {
    document.getElementById("profileUpdate").disabled = false;
    document.getElementById(error_id).innerHTML = "";
}
