<?php 
    if (isset($_POST['create_post'])) {
        $post_title = $_POST['title'];
        $post_author = $_POST['author'];
        $post_category_id = $_POST['post_category_id'];
        $post_status = $_POST['post_status'];
        
        $post_image = $_FILES['image'] ['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];

        $post_content = $_POST['post_content'];
        $post_date = date('d-m-y');
        $post_tags = $_POST['post_tags'];       
        // $post_comment_count =4;


        move_uploaded_file($post_image_temp,"../images/$post_image");
    
        $query = "INSERT INTO `posts`(`post_id`, `post_category_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_status`) 
                    VALUES ('','$post_category_id','$post_title','$post_author',now(),'$post_image','$post_content','$post_tags','$post_status')";
    
        $create_post = mysqli_query($connection,$query);
        confirm($create_post);
    }




?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>




    
    <div class="form-group">
        <label for="post_category_id">Post Category Id</label>
        <br>
        <select name="post_category_id" id="">
                <?php 
                    $query = "SELECT * FROM categories";
                    $select_id_categories_query = mysqli_query($connection,$query);
                    confirm($select_id_categories_query);
                    
                    while ($row = mysqli_fetch_assoc($select_id_categories_query)) :
                        $cat_title = $row['cat_title'];
                        $cat_id = $row['cat_id'];       ?>                      
                    <option value="<?php echo $cat_id ?>"  > <?php echo $cat_title?> </option>
                    <?php endwhile; ?>
        </select>
    </div>







    <div class="form-group">
        <label for="author">Author</label>
        <input type="text" class="form-control" name="author">
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" class="form-control" name="post_status">
    </div>

    <div class="form-group">
        <label for="image">Post Image</label>
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows="10">
        </textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
    </div>
</form>