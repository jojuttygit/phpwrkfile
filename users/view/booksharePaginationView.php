<div class="container-fluid">
    <div class="row" id="searchbox">
        <div class="col-lg-5">
            <form action="" method="POST">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search" name="search_item">
                    <div class="input-group-btn">
                        <button class="btn btn-default" name="searchbtn" value="search" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <ul class="pagination pagination">
                <?php
                    echo "<li><a href=".$_SERVER["PHP_SELF"]."?page=1'>".'<'."</a></li> ";
                    for ($i=1; $i <= $page_count; $i++) { 
                        echo "<li><a href=".$_SERVER["PHP_SELF"]."?page=".$i."'>".$i."</a></li> "; 
                    }
                    echo "<li><a href=".$_SERVER["PHP_SELF"]."?page=$page_count'>".'>'."</a></li> ";
                ?>
            </ul>
        </div>
    </div>
</div>
<div class="container-fluid">
<?php
if($user_book_data) {
foreach ($user_book_data as $row) {
?>
    <div class="row text-left">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-2">
                            <img class="img-thumbnail img-responsive" src=<?php echo "../../public/assets/images/".constant('cover_image_folder')."/".$row['book_image_name'] ?> alt=<?php echo $row['book_title']?> width="180" height="180">
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4 class="text-success">Book Title : <?php echo $row['book_title']?></h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <p class="text-info">Book Type : <?php echo $row['book_type']?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <p class="text-info">Author : <?php echo $row['book_author']?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <p class="text-info">Publisher : <?php echo $row['book_publisher']?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <p class="text-info">Description : <?php echo $row['book_description']?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <input type="button" class="btn btn-warning" value="Make Rent" onclick="makeRent(<?php echo $row['book_id']?>)">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } 
    }
    else {
        echo "<strong>No Book Found</strong>";
    } 
    ?>
</div>