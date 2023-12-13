<?php 
//get all book 
global $wpdb; 

$all_books = $wpdb->get_results("SELECT * from wp_my_enroll ORDER by id DESC", ARRAY_A);

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
                <th>Name</th>
                <th>Course</th>
                <th>Created At</th>
            </tr>
        </thead>
        <!-- <tbody>
            <?php 
               if(count($all_books) > 0) {
                $i = 1; 
                foreach($all_books as $key => $value) {
                    ?>

                    <tr>
                        <td><?php  echo $i++ ?></td>
                        <td><?php echo $value['name'] ?></td>
                        <td><?php  echo$value['author'] ?></td>
                        <td><?php echo $value['about'] ?></td>
                        <td><?php  echo$value['created_at'] ?></td>
                        <td><img src='<?php  echo$value['image'] ?>' width="80" height="80" /></td>
                        <td>
                            <a class="btn btn-info m-3" href="http://web1.test/wp-admin/admin.php?page=edit-book&edit=<?php echo $value['id']; ?>">Edit</button>
                            <a class="btn btn-danger btn_book_delete"  href="javascript:void(0)" data-id="<?php echo $value['id']; ?>">Delete</button>
                        </td>
                    </tr>


                    <?php 
                }
               }
            
            ?>
            
        </tbody> -->
       
    </table>
        </div>
    </div>

    </div>
</div>