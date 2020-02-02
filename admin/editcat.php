<?php include 'inc/header.php'?>
<?php include 'inc/sidebar.php'?>
<?php include '../helpers/helper.php'?>

<?php
    $catId = $_GET['editcat'];
    if (!isset($catId) || $catId == NULL) {
        header("Location:catlist.php");
    }
    $query = "SELECT * FROM tbl_category WHERE id='$catId'";
    $result = $db->select($query);
?>


        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Category</h2>
               <div class="block copyblock"> 
                    <?php while ($r = $result->fetch_assoc()) {
                         ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="name" value="<?php echo $r['name']; ?>" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                <?php 
                    } //while end

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $vld = new helper();
                        $catName = $vld->validation($_POST['name']);
                        if (empty($catName)) {
                            echo "Invalide Category Name";
                        }
                        else
                        {
                            $query = "UPDATE tbl_category SET name='$catName' WHERE id=$catId";
                            $catin = $db->update($query);
                            if ($catin != false) {
                                echo "Updated to $catName";
                            }
                            else
                            {
                                echo "Not Updated";
                            }
                        }
                    }

                 ?>
                </div>
            </div>
        </div>
        <?php include 'inc/footer.php';?>