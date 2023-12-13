<?php 
$book_id = isset($_GET['edit']) ? intval($_GET['edit']) : 0;

global $wpdb;

if($book_id) {
    $book_detail = $wpdb->get_row($wpdb->prepare("SELECT * FROM wp_my_books where %d", $book_id), ARRAY_A);

}
// print_r($book_detail);


?>


<?php wp_enqueue_media(); ?>
<div class="container-fluid">
    <div class="row">
        <div class="alert alert-info">
            Book Update 
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Update Book</div>
            <div class="panel-body">
                <form action="javascript:void(0)" id="frmEditBook">
                <input type="hidden" name="book_id" value=<?php echo $_GET['edit']; ?> />
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value=<?php echo $book_detail["name"] ?>>
                    
                </div>

                <div class="mb-3">
                    <label for="author" class="form-label">Author</label>
                    <input type="text" class="form-control" id="author" name="author" value=<?php echo $book_detail["author"] ?>>
                    
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">About</label>
                    <textarea name="about" id="" cols="30" rows="10" class="form-control" name="about" >
                    <?php echo $book_detail["about"] ?>
                    </textarea>
                    
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Upload book Image:</label>
                    <input type="button" class="btn btn-info" value='Upload Image' id='btn_upload' />
                    <span id="show_image">
                        <img src="<?php echo $book_detail["image"] ?>" width="80" height="80" />
                    </span>
                    <input type="hidden" name="image_value" id="image_value" value="<?php echo $book_detail["image"] ?>">
                </div>
                
               
                <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>