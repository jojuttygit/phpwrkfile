function validateAddBook () {
	var book_title = document.forms["bookupload"]["book_title"].value;
    var book_author = document.forms["bookupload"]["book_author"].value;
    var book_publisher = document.forms["bookupload"]["book_publisher"].value;
    var book_type = document.forms["bookupload"]["book_type"].value;
    var book_description = document.forms["bookupload"]["book_description"].value;
    var cover_image = document.forms["bookupload"]["cover_image"].value;
    var upload_book = document.forms["bookupload"]["upload_book"].value;
    var nameExpr = /^[A-Za-z]+$/; 
    var author_error_id="error_author_name";
    var book_type_error_id = "error_book_type";
    var error_image = "error_image";
    var error_doc = "error_doc";
    var image_extension = cover_image.substring(
                    cover_image.lastIndexOf('.') + 1).toLowerCase();
    var doc_extension = upload_book.substring(
                    upload_book.lastIndexOf('.') + 1).toLowerCase();
    console.log(doc_extension);

    if (!book_author.match(nameExpr)) {
        showerror('Name',author_error_id);
        
        
    }
    else {
        functionSuccess(author_error_id);
        
    }
   
    if (!book_type.match(nameExpr)) {
        showerror('Type',book_type_error_id);
        
        
    }
    else {
        functionSuccess(book_type_error_id);
        
    }
    if (image_extension == "gif" || image_extension == "png" || image_extension == "bmp"
                    || image_extension == "jpeg" || image_extension == "jpg") {
    	functionSuccess(error_image);
    	
    }
    else {
    	showerror('extension',error_image);
    	
    }
    if (doc_extension == "doc" || doc_extension == "docx" || doc_extension == "pdf") {
    	functionSuccess(error_doc);
    	
    }
    else {
    	showerror('extension',error_doc);
    	
    }
    
}
function showerror(value,error_id) {
    document.getElementById("bookupload").disabled = true;
    document.getElementById(error_id).innerHTML = "Incorrect " + value;
    document.getElementById(error_id).style.color="red";
    return false;
}
function functionSuccess(error_id) {
    document.getElementById("bookupload").disabled = false;
    document.getElementById(error_id).innerHTML = "";
    return true;
    
}