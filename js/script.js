jQuery(document).ready(function() {
    //Thêm hình vào media
    jQuery('#btn_upload').on("click",function(){
        var image = wp.media({
            title : "Upload Image for my book",
            multiple: false
        }).open().on("select", function() {
            var uploaded_image = image.state().get("selection");
            var get_image = uploaded_image.toJSON()[0]['url'];
            jQuery('#show_image').html(`<img src=${get_image} style="width:50px; height:50px;" />`);
            jQuery('#image_value').val(get_image);
        })
    })
    jQuery('#my_book').DataTable();
    //validate add book form
    jQuery('#frmAddBook').validate({
        submitHandler:function() {
        
           var post_data =  "param=save_book&"+jQuery('#frmAddBook').serialize();
           console.log(post_data);
           var data = {
            action: "mybooklibrary",
            data : post_data
           }
           jQuery.post(mybookajaxurl.baseURL, data, function(response) {
            var data = jQuery.parseJSON(response);
            if(data.status == 1) {
                jQuery.notifyBar({
                    cssClass: "success",
                    html : data.message
                });

                // setTimeout(() => {
                //     location.reload();
                // }, 3000);
            }
           })

           

        }
    });
    //validate edit book form 
    jQuery('#frmEditBook').validate({
        submitHandler:function() {
           var post_data = "param=update_book&"+ jQuery('#frmEditBook').serialize();
           var data = {
            action: "mybooklibrary",
            data : post_data
           }
           jQuery.post(mybookajaxurl.baseURL, data, function(response) {
            var data = jQuery.parseJSON(response);
            if(data.status == 1) {
                jQuery.notifyBar({
                    cssClass: "success",
                    html : data.message
                });

                setTimeout(() => {
                   window.location("http://web1.test/wp-admin/admin.php?page=list-book");
                }, 1300);
            }
           })
        }
    });

    //Delete
    jQuery(document).on("click",".btn_book_delete",function() {
        var conf = confirm("Are you sure to delete book?");
        if(conf) {
            var book_id = jQuery(this).attr('data-id');
            var post_data = "param=delete_book&id="+ book_id ;
               var data = {
                action: "mybooklibrary",
                data : post_data
               }
               jQuery.post(mybookajaxurl.baseURL, data, function(response) {
                var data = jQuery.parseJSON(response);
                if(data.status == 1) {
                    jQuery.notifyBar({
                        cssClass: "success",
                        html : data.message
                    });

                    setTimeout(() => {
                        window.location("http://web1.test/wp-admin/admin.php?page=list-book");
                     }, 1300);
                    
                }
               })

        }
    })


    //Add author 
    jQuery("#frmAddAuthor").validate({
        submitHandler: function() {
            var data_author = "param=add_author&"+ jQuery('#frmAddAuthor').serialize();
            var data = {
                action : 'myauthor',
                data: data_author
            }
            jQuery.post(mybookajaxurl.baseURL, data, function(response) {
                var data = jQuery.parseJSON(response);
                if(data.status == 1) {
                    jQuery.notifyBar({
                        cssClass: "success",
                        html : data.message
                    });
                    
                    setTimeout(() => {
                        location.reload();
                    }, 3000);
                   
                }
               })
        }
    })


    //Add Student 
    jQuery("#frmAddStudent").validate({
        submitHandler: function() {
            var data_student = "param=add_student&"+ jQuery('#frmAddStudent').serialize();
            var data = {
                action : 'mystudent',
                data: data_student
            }
            jQuery.post(mybookajaxurl.baseURL, data, function(response) {
                var data = jQuery.parseJSON(response);
                if(data.status == 1) {
                    jQuery.notifyBar({
                        cssClass: "success",
                        html : data.message
                    });
                    
                    setTimeout(() => {
                        location.reload();
                    }, 3000);
                   
                } else {
                    jQuery.notifyBar({
                        cssClass: "error",
                        html : data.message
                    });
                    
                    setTimeout(() => {
                        location.reload();
                    }, 3000);
                }
               })
        }
    })


    //Courses Tracking
    jQuery(document).on("click",".owl-button",function(e) {
        var user_id = e.target.nextElementSibling.value;
        var book_id  =e.target.nextElementSibling.nextElementSibling.value;
        var data_course = "param=add_course&studentid="+user_id+"&bookid="+book_id;
        var data = {
            action : 'mycourse',
            data: data_course
        }
        jQuery.post(mybookajaxurl.baseURL, data, function(response) {
            var data = jQuery.parseJSON(response);
            if(data.status == 1) {
                jQuery.notifyBar({
                    cssClass: "success",
                    html : data.message
                });
                
                setTimeout(() => {
                    location.reload();
                }, 3000);
               
            }
           })

    })
    

})