<?php 

/* 
Template Name: Book Page Content

*/

get_header();

?>
  <div class="container">
    <div class="row">
        <div class="col-12">
            <div class="alert alert-success" style="background: #d3f585!important;">
                <h1>Online Web Tutor</h1>
            </div>


            <?php echo do_shortcode("[book_page]"); ?>
        </div>
    </div>
  </div>




<?php 





get_footer( );