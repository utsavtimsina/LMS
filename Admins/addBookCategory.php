<?php

require('../config.php');

if (isset($_POST['submit'])) {

    $cname = $_POST['cname'];
    $description = $_POST['description'];

    $chk_query = "SELECT * FROM book_category_tbl WHERE `category_name`='$cname'";
    $chk_res = mysqli_query($conn, $chk_query);
    if (mysqli_num_rows($chk_res) <= 0) {

        $sql = "INSERT INTO `book_category_tbl`(`category_name`, `description`) VALUES ('$cname','$description')";

        $result = mysqli_query($conn, $sql);
        if ($result) {
            $msg = 'Added Successfully!!!';
        } else {
            $msg = 'Failed to Add!!!';
        }
    } else {
        $msg = 'Record Already Exists';
    }
    header("location:addBookCategory.php?msg=$msg");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/addForm.css">
    <link rel="stylesheet" href="../css/table.css">
    <link rel="stylesheet" href="css/pagination.css">
    <title>Add Book Categories</title>
</head>

<body>
    <?php require('adminHeader.php') ?>
    <header>
        <div class="title">
            <h4>Add Book Categories</h4>
        </div>
    </header>

    <div class="content">

        <!-- message -->
        <?php
        if (isset($_GET['msg']) && !empty($_GET['msg'])) {
        ?>
            <div class="msg" id="impmsg">
                <i class="fa-solid fa-plus cross" onclick="location.href='addBookCategory.php'"></i>
                <!-- window.location.reload('true');
                document.getElementById('impmsg').style.display='none'; -->
                <?php
                @$msg = $_GET['msg'];
                echo $msg;
                ?>
            </div>
        <?php } ?>

        <!-- msg end -->

        <!-- Category Form -->

        <main class="form-container">
            <form action="#" method="POST" class="studentForm">
                <div class="form-group">
                    <label for="cname">Category Name<span style="color: red;">*</span></label>
                    <input type="text" name="cname" placeholder="Category Name" required>
                </div>
                <div class="form-group">
                    <label for="description">Description (max. 250 Characters)</label>
                    <textarea name="description" id="description" placeholder="Description....." cols="30" rows="10" maxlength="250"></textarea>
                </div>

                <div class="form-row">
                    <div class="form-btn">
                        <input type="submit" class="fbtn" name="submit" value="Add">
                    </div>
                    <div class="form-btn">
                        <input type="reset" class="fbtn" name="reset" value="Reset">
                    </div>
                </div>
            </form>
        </main>
        <?php 
        // <!-- Display Category -->

        require('displayBookCategory.php') ?>
    </div>

    <?php require('dataTable.php') ?>
</body>

</html>