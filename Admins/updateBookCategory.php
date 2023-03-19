<?php 

require('../config.php');
$cid=$_GET['cid'];
$action=$_GET['action'];

// edit

if($action==='e'){ 
    
    $sql="SELECT * FROM `book_category_tbl` WHERE cid=$cid";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);

    $cname=$row['category_name'];
    $description=$row['description'];

if (isset($_POST['update'])) {

    $cname = $_POST['cname'];
    $description = $_POST['description'];

    $update_sql = "UPDATE `book_category_tbl` SET `cid`='$cid',`category_name`='$cname',`description`='$description' WHERE cid=$cid";

    $result = mysqli_query($conn, $update_sql);
    if ($result) {
        // echo "<script>alert('Updated Successfully');
        // windows.location='addBookCategory.php'</script>";
        $msg='Updated Successfully!!!';
        
    } else {
        // echo "<script>alert('Failed to update Category');</script>";
        $msg='Failed to Update!!!';
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
    <title>Update Book Categories</title>
</head>

<body>
    <?php require('adminHeader.php') ?>
    <header>
        <div class="title">
            <h4>Update Book Categories</h4>
        </div>
        <div class="ex-link">
            <a href="addBookCategory.php">Add New Category</a>
        </div>
    </header>
    <div class="content">
        <main class="form-container">
            <form action="#" method="POST" class="studentForm">
                <div class="form-group">
                    <label for="cname">Category Name<span style="color: red;">*</span></label>
                    <input type="text" name="cname" placeholder="Category Name" value="<?php echo $cname; ?>" required>
                </div>
                <div class="form-group">
                    <label for="description">Description (max. 250 Characters)</label>
                    <textarea name="description" id="description" placeholder="Description....." cols="30" rows="10" maxlength="250" ><?php echo $description; ?></textarea>
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


    <?php require('displayBookCategory.php')?>
</body>

</html>
<?php }

//delete

if($action==='d'){
    $sql="DELETE FROM `book_category_tbl` WHERE cid=$cid";
    $result=mysqli_query($conn,$sql);
    if ($result) {
        // echo "<script>alert('Updated Successfully');
        // windows.location='addBookCategory.php'</script>";
        $msg='Deleted Successfully!!!';
        
    } else {
        // echo "<script>alert('Failed to update Category');</script>";
        $msg='Failed to Delete!!!';
    }
    header("location:addBookCategory.php?msg=$msg");

    
}

?>
