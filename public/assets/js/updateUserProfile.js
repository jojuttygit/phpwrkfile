function validateupdate () {
	var user_name = document.forms["updateUserProfile"]["user_name"].value;
    var nameExpr = /^[A-Za-z]+$/; 
    var user_error_id="error_name";

    if (!user_name.match(nameExpr)) {
        showerror('Name',user_error_id);
        return false;   
    }
    else {
        functionSuccess(user_error_id);
        return true;
    } 
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
