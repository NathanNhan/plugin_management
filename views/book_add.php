<?php wp_enqueue_media(); ?>
<div class="container-fluid">
    <div class="row">
        <div class="alert alert-info">
            Book Add 
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Add Book</div>
            <div class="panel-body">
                <form action="javascript:void(0)" id="frmAddBook">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                    
                </div>


           

                <div class="mb-3">
                    <label for="author" class="form-label">Author</label>
                    <select name="author" id="author" class="form-control">
                        <option value="-1">-- Choose Author --</option>
                        <?php
                           global $wpdb; 
                           $authors = $wpdb->get_results("SELECT * from wp_my_authors ORDER by id ASC", ARRAY_A);
                           foreach ($authors as $key => $value) {
                              ?>
                                <option value="<?php echo esc_html($value['name']); ?>"><?php echo esc_html( $value['name'] )  ?></option>
                              <?php 
                           }
                        
                        ?>
                    </select>
                    
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">About</label>
                    <textarea name="about" id="" cols="30" rows="10" class="form-control" name="about" required>

                    </textarea>
                    
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Upload book Image:</label>
                    <input type="button" class="btn btn-info" value='Upload Image' id='btn_upload' />
                    <span id="show_image"></span>
                    <input type="hidden" name="image_value" id="image_value">
                </div>
                
               
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>