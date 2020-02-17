<?php require_once('includes/header.php'); ?>
<?php require_once("includes/userAuth.php"); ?>


<div class="fluid-container">
    <?php require_once('includes/nav.php'); ?>
    <!--End nav-->
    <section id="main" class="mx-lg-5 mx-md-2 mx-sm-2">

        <?php
        if (isset($_POST['add-category'])) {
            $cat_title = trim($_POST['cat-title']);
            if (empty($cat_title)) {
                $error = "<div class='alert alert-danger'style='text-align:center'><strong>Please Add Category</strong></div>";
            } else {
                $query = "INSERT INTO categories (cat_title) VALUES (:title)";
                $stmt = $pdo->prepare($query);
                $stmt->execute([':title' => $cat_title]);
                header("Location:categories.php");
            }
        }
        ?>

        <form class="py-4" action="categories.php" method="POST">
            <div class="row">
                <div class="col">
                    <input type="text" name="cat-title" class="form-control" placeholder="Enter Category name">
                </div>
                <div class="col">
                    <input type="submit" name="add-category" class="form-control btn btn-success" value="Add New Category">
                    <?php if (isset($error)) {
                        echo $error;
                    } ?>
                </div>
            </div>
        </form>


        <?php
        if (isset($_POST['edit-category'])) {
            $id = $_POST['edit-cat-id'];
            $title = $_POST['edit-cat-title']; ?>
            <form class="py-4" action="categories.php" method="POST">
                <div class="row">
                    <div class="col">
                        <input type="hidden" value="<?php echo $id; ?>" name="id" />
                        <input type="text" value="<?php echo $title; ?>" name="title" class="form-control" placeholder="Enter Category name" />
                    </div>
                    <div class="col">
                        <input type="submit" name="update-category" class="form-control btn btn-primary" value="Update Category">
                    </div>
                </div>
            </form>
        <?php }
        if (isset($_POST['update-category'])) {
            $catTitle = trim($_POST['title']);
            if (empty($catTitle)) {
                echo "<div class='alert alert-danger'style='text-align:center'><strong>Field Can't Blank!</strong></div>";
            } else {
                $catID = $_POST['id'];
                $query3 = "UPDATE categories SET cat_title = :title WHERE cat_id =:id";
                $stmt3 = $pdo->prepare($query3);
                $stmt3->execute([
                    ':title' => $catTitle,
                    ':id' => $catID,
                ]);
                header("Location:categories.php");
            }
        }
        ?>
        <?php 
        if (isset($_POST['del-category'])) {
            $id = $_POST['del-cat-id'];
            $title = $_POST['del-cat-tile'];
            $query4 = "DELETE FROM categories WHERE cat_id =:id";
            $stmt4 = $pdo->prepare($query4);
            $stmt4->execute([
                ':id' => $id
            ]);
            header("Location:categories.php");
        }
        
        ?>

        <h2>All Categories</h2>
        <table class="table table-sm">
            <thead class="thead-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Category name</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $query2 = "SELECT * FROM categories";
                $stmt2 = $pdo->prepare($query2);
                $stmt2->execute();
                while ($categories = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                    $cat_id = $categories['cat_id'];
                    $cat_title = $categories['cat_title']; ?>
                    <tr>
                        <td><?php echo $cat_id; ?></td>
                        <td><?php echo $cat_title; ?></td>
                        <td>
                            <form action="categories.php" method="POST">
                                <input type="hidden" name="edit-cat-id" value="<?php echo $cat_id ?>" />
                                <input type="hidden" name="edit-cat-title" value="<?php echo $cat_title; ?>" />
                                <input type="submit" name="edit-category" class="btn btn-primary" value="Edit" />
                            </form>

                        </td>
                        <td>
                            <form action="categories.php" method="POST">
                                <input type="hidden" name="del-cat-id" value="<?php echo $cat_id ?>" />
                                <input type="hidden" name="del-cat-title" value="<?php echo $cat_title; ?>" />
                                <input type="submit" name="del-category" class="btn btn-danger" value="Delete" />
                            </form>
                        </td>
                    </tr>
                <?php }

                ?>

            </tbody>
        </table>
    </section>

</div>
<?php require_once('../includes/footer.php'); ?>