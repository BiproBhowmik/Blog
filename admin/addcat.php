<?php include 'inc/header.php'?>
<?php include 'inc/sidebar.php'?>
<?php include '../helpers/helper.php'?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Category</h2>
               <div class="block copyblock"> 

                <?php

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $vld = new helper();
                        $catName = $vld->validation($_POST['name']);
                        if (empty($catName)) {
                            echo "Invalide Category Name";
                        }
                        else
                        {
                            $query = "INSERT INTO tbl_category (name) VALUES ('$catName')";
                            $catin = $db->insert($query);
                            if ($catin != false) {
                                echo "Inserted";
                            }
                            else
                            {
                                echo "Not Inserted";
                            }
                        }
                    }

                 ?>

                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="name" placeholder="Enter Category Name..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
        <?php include 'inc/footer.php';?>