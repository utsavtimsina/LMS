<?php require('adminHeader.php');
require('../config.php');
$fid=$_GET['fid'];
$action=$_GET['action'];

if($action== 'e'){

    $sql="SELECT * FROM `faculty_tbl` WHERE fid=$fid";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);

    $facname=$row['faculty_name'];
    $description=$row['description'];

    if (isset($_POST['update'])) {

        $facname = $_POST['facname'];
        $description = $_POST['description'];
    
        $update_sql = "UPDATE `faculty_tbl` SET `fid`='$fid',`faculty_name`='$facname',`description`='$description' WHERE fid=$fid";
    
        $result = mysqli_query($conn, $update_sql);
        if ($result) {
            $msg='Updated Successfully!!!';
            
        } else {
            $msg='Failed to Update!!!';
        }
        header("location:addFaculty.php?msg=$msg");
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/table.css">
    <link rel="stylesheet" href="css/addForm.css">
    <title>Add Faculty</title>
</head>

<body>

    <header>
        <div class="title">
            <h4>Add Faculty</h4>
        </div>
        <div class="ex-link">
            <a href="addFaculty.php">Add New Faculty</a>
        </div>
    </header>
    <div class="content">

     <!-- message -->
     <?php
        if (isset($_GET['msg']) && !empty($_GET['msg'])) {
        ?>
            <div class="msg" id="impmsg">
                <i class="fa-solid fa-plus cross" onclick="location.href='addFaculty.php'"></i>
                <?php
                @$msg = $_GET['msg'];
                echo $msg;
                ?>
            </div>
        <?php } ?>

        <!-- msg end -->
        <main class="form-container">
            <form action="#" method="POST" class="studentForm">
                    <div class="form-group">
                        <label for="facname">Faculty Name<span style="color: red;">*</span></label>
                        <input type="text" value="<?php echo $facname;?>" name="facname" placeholder="Faculty Name" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description (max. 250 Characters)</label>
                        <textarea name="description" id="description" placeholder="Description....." cols="30" rows="10" maxlength="250"><?php echo $description; ?></textarea>
                    </div>

                <div class="form-row">
                    <div class="form-btn">
                        <input type="submit" class="fbtn" name="update" value="Update">
                    </div>
                    <div class="form-btn">
                        <input type="reset" class="fbtn" name="reset" value="Reset">
                    </div>
                </div>
            </form>
        </main>
    </div>
    <?php require('displayFaculty.php')?>
</body>

</html>

<?php }

//delete

if($action==='d'){
    $sql="DELETE FROM `faculty_tbl` WHERE fid=$fid";
    $result=mysqli_query($conn,$sql);
    if ($result) {
        $msg='Deleted Successfully!!!';
        
    } else {
        $msg='Failed to Delete!!!';
    }
    header("location:addFaculty.php?msg=$msg");

    
}

?>