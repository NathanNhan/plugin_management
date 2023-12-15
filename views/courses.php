<?php 
//get all book 
global $wpdb; 

$all_course = $wpdb->get_results("SELECT * from wp_my_enroll ORDER by id DESC", ARRAY_A);

// print_r($all_books);

?>



<div class="container-fluid">
    <div class="row">
        <div class="alert alert-info">My Book List</div>
    <div class="panel panel-primary">
        <div class="panel-heading">Panel Content</div>
        <div class="panel-body">
        <table id="my_book" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Student ID</th>
                <th>Book ID</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>
         <tbody>
            <?php 
               if(count($all_course) > 0) {
                $i = 1; 
                foreach($all_course as $key => $value) {
                    ?>

                    <tr>
                        <td><?php  echo $i++ ?></td>
                        <td><?php echo $value['student_id'] ?></td>
                        <td><?php  echo$value['book_id'] ?></td>

                        <td><?php  echo$value['created_at'] ?></td>

                        <td>

                            <a class="btn btn-danger btn_book_delete"  href="javascript:void(0)" data-id="<?php echo $value['id']; ?>">Delete</button>
                        </td>
                    </tr>


                    <?php 
                }
               }
            
            ?>
            
        </tbody> 
       
    </table>
        </div>
    </div>

    </div>
</div>