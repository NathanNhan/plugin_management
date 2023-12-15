<?php 
//get all book 
global $wpdb; 

$all_students = $wpdb->get_results("SELECT * from wp_my_students ORDER by id DESC", ARRAY_A);

// print_r($all_books);

?>
<div class="container-fluid">
    <div class="row">
        <div class="alert alert-info">My Student List</div>
    <div class="panel panel-primary">
        <div class="panel-heading">Panel Content</div>
        <div class="panel-body">
        <table id="my_book" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Username</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>
         <tbody>
            <?php 
               if(count($all_students) > 0) {
                $i = 1; 
                foreach($all_students as $key => $value) {
                    $userDetail = get_userdata( $value['user_login_id'] )
                    ?>

                    <tr>
                        <td><?php  echo $i++ ?></td>
                        <td><?php echo $value['name'] ?></td>
                        <td><?php  echo$value['email'] ?></td>
                        <td><?php echo $userDetail->user_login ?></td>
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