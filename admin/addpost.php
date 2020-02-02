<?php include 'inc/header.php'?>
<?php include 'inc/sidebar.php'?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New Post</h2>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == 'POST') {
            $postTitle = $_POST['title'];
            $postCategory = $_POST['category'];
            $postBody = $_POST['body'];
            $postAuthor = $_POST['author'];
            $postTaggs = $_POST['taggs'];

            $permited  = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));  //JPG -> jpg
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;   //unique name
            

            if (empty($file_name) || $postTitle == NULL || $postCategory == NULL || $postBody == NULL || $postAuthor == NULL || $postTaggs == NULL) {
               echo "<span class='error'>The filds should not be empty !</span>";
           }elseif ($file_size >1048567) {
               echo "<span class='error'>Image Size should be less then 1MB!
               </span>";
           } elseif (in_array($file_ext, $permited) === false) {
               echo "<span class='error'>You can upload only:-"
               .implode(', ', $permited)."</span>";
           } else{
                $uploaded_image = "upload/".$unique_image;
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "INSERT INTO  tbl_post (category, title, body, image, author, tags) 
                VALUES('$postCategory','$postTitle','$postBody','$uploaded_image','$postAuthor','$postTaggs')";
                $inserted_rows = $db->insert($query);
                if ($inserted_rows) {
                   echo "<span class='success'>Image Inserted Successfully.
                   </span>";
               }else {
                   echo "<span class='error'>Image Not Inserted !</span>";
               }
            }

        }
   ?>


   <div class="block">               
     <form action="" method="post" enctype="multipart/form-data">
        <table class="form">
            <tr>
                <td>
                    <label>Title</label>
                </td>
                <td>
                    <input type="text" name="title" placeholder="Enter Post Title..." class="medium" />
                </td>
            </tr>

            <tr>
                <td>
                    <label>Category</label>
                </td>
                <td>
                    <select id="select" name="category">
                        <?php 

                        $query = $db->select("SELECT * FROM tbl_category");

                        if ($query) {
                            while ($result = $query->fetch_assoc()) {
                                ?>

                                <option value="<?php echo $result['id']; ?>"><?php echo $result['name']; ?></option>

                            <?php }
                        } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Upload Image</label>
                </td>
                <td>
                    <input name="image" type="file" />
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top; padding-top: 9px;">
                    <label>Content</label>
                </td>
                <td>
                    <textarea name="body" class="tinymce"></textarea>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Author</label>
                </td>
                <td>
                    <input type="text" name="author" placeholder="Enter Author Name..." class="medium" />
                </td>
            </tr>
            <tr>
                <td>
                    <label>Taggs</label>
                </td>
                <td>
                    <input type="text" name="taggs" placeholder="Taggs eg:php, java..." class="medium" />
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" name="submit" Value="Save" />
                </td>
            </tr>
        </table>
    </form>
</div>
</div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<?php include 'inc/footer.php';?>


