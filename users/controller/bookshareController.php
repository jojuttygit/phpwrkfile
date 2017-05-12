<?php
class bookshareController {
    public $user_conn_obj,$pagination_count,$page,$total_pages;
    public $user_books = array();

    public function __construct($connObj) { 
        $this->user_conn_obj = $connObj;
    }

    public function selectMyBooks () {
        if (isset($_GET["page"])) { 
        	$page  = $_GET["page"]; 
        } 
        else { 
            $page = 1; 
        }
        if(!empty($_POST['searchbtn'])) {
            $search_item = $_POST['search_item'];      
        } 
        else {
        	$search_item = "";
        }
        $start_from = ($page-1) * $this->pagination_count; 
        $query = "SELECT 
                    *FROM tbl_user_books 
                    AS books 
                    JOIN tbl_users 
                    AS users 
                    ON books.book_user_id = users.user_id 
                    WHERE book_status = 'for_rent' 
                    AND book_title like '%".$search_item."%'";    
        $tbl_user_books = $this->user_conn_obj->query($query);
        $total_records = $tbl_user_books->num_rows;
        
        $this->total_pages = ceil($total_records / $this->pagination_count);

    	$sql = "SELECT 
    			*FROM tbl_user_books 
    			AS books 
    			JOIN tbl_users 
    			AS users 
    			ON books.book_user_id = users.user_id 
    			WHERE book_status = 'for_rent' 
    			AND book_title like '%".$search_item."%'  
    			LIMIT $start_from, $this->pagination_count";
            
    	$result_set = $this->user_conn_obj->query($sql);
    		if ($result_set->num_rows > 0) {
    			while ($row = $result_set->fetch_assoc()) {
    				$user_books[$row['book_id']]['book_id'] = $row['book_id'];
    				$user_books[$row['book_id']]['book_image_name'] = $row['book_image_name'];
                	$user_books[$row['book_id']]['book_title'] = $row['book_title'];
                	$user_books[$row['book_id']]['book_type'] = $row['book_type'];
                	$user_books[$row['book_id']]['book_author'] = $row['book_author'];
                	$user_books[$row['book_id']]['book_publisher'] = $row['book_publisher'];
                	$user_books[$row['book_id']]['book_description'] = $row['book_description'];
    			}
    		return $user_books; 
    		}
    }
}      
?>