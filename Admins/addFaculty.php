<?php

require('../config.php');

if (isset($_POST['submit'])) {

    $facname = $_POST['facname'];
    $description = $_POST['description'];

    $chk_query = "SELECT * FROM faculty_tbl WHERE `faculty_name`='$facname'";
    $chk_res = mysqli_query($conn, $chk_query);
    if (mysqli_num_rows($chk_res) <= 0) {

        $sql = "INSERT INTO `faculty_tbl`(`faculty_name`, `description`) VALUES ('$facname','$description')";

        $result = mysqli_query($conn, $sql) or die('error1');
        if ($result) {
            $msg = 'Added Successfully!!!';
        } else {
            $msg = 'Failed to Add!!!';
        }
    } else {
        $msg = 'Record Already Exists';
    }
    header("location:addFaculty.php?msg=$msg");
}

?>

<?php require('adminHeader.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/table.css">
    <link rel="stylesheet" href="css/addForm.css">


    
    <!-- <link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" /> -->

    <!-- <script type="text/javascript" src="DataTables/datatables.min.js"></script> -->
    <title>Add Faculty</title>
</head>

<body>

    <header>
        <div class="title">
            <h4>Add Faculty</h4>
        </div>
    </header>
    <div class="content">

        <!-- message -->
        <?php
        if (isset($_GET['msg']) && !empty($_GET['msg'])) {
        ?>
            <div class="msg" id="impmsg">
                <i class="fa-solid fa-plus cross" onclick="location.href='addFaculty.php'"></i>
                <!-- window.location.reload('true');
                document.getElementById('impmsg').style.display='none'; -->
                <?php
                @$msg = $_GET['msg'];
                echo $msg;
                ?>
            </div>
        <?php } ?>
        <main class="form-container">
            <form action="#" method="POST" class="studentForm">
                <div class="form-group">
                    <label for="facname">Faculty Name<span style="color: red;">*</span></label>
                    <input type="text" name="facname" placeholder="Faculty Name" required>
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
       
        <?php require('displayFaculty.php') ?>
        

    </div>

<?php require('dataTable.php') ?>
</body>

</html>