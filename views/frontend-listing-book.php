<?php
global $user_ID;
global $wpdb;
//get All books
  $all_books = $wpdb->get_results("SELECT * FROM wp_my_books ORDER BY id", ARRAY_A);

?>


<div class="row">
    <?php
      if(count($all_books) > 0) {
        foreach ($all_books as $key => $value) {
            
            ?>
                <div class="col-sm-4 owt-layout">
                    <p><img src="<?php echo $value['image'] ?>" alt="" srcset="" style="width:100px; height:100px; margin: 0 auto;"></p>
                    <p><?php echo $value['name'] ?></p>
                    <p><?php
                         echo $value['author'];
                    ?></p>
                    <p>
                    <?php
                      if($user_ID > 0) {
                        ?>
                         <form action="javascript:void(0)" id="trackCourse">
                           <button class="btn btn-success owl-button" href="javascript:void(0)" type="submit">Enroll Now</button>
                           <input type="hidden" name="user_id" value=<?php echo $user_ID ?>>
                           <input type="hidden" name="book_id" value=<?php echo $value['id']; ?>>
                      </form>
                        <?php 
                      } else {
                        ?>
                           <form action="javascript:void(0)" id="trackCourse">
                             <button class="btn btn-success owl-button" href="<?php echo wp_login_url(); ?>" type="submit">Login to Enroll</button>
                             <input type="hidden" name="user_id" value=<?php echo $user_ID ;?>>
                             <input type="hidden" name="book_id" value=<?php echo $value['id']; ?>>
                           </form>
                        <?php 
                      }
                    ?>
                 
                    </p>
                </div>



            <?php
        }
      }
    ?>
    
   
</div>


