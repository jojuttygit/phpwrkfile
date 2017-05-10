function confirmDelete (book_id) {
	var value = confirm("Do you want to delete the record?");
    if (value == true) {
        window.location.href = '../../users/controller/bookDeleteController.php?book_id='+book_id;
    } 
    else {
        window.location.href = 'userBooks.php';
    }	
}
function makeRent (book_id) {

	window.location.href = '../../users/controller/bookRentController.php?book_id='+book_id;
}
