<?php require('adminHeader.php');
require('../config.php');

$id = $_GET['id'];
$action = $_GET['action'];

if ($action == 'e') {

    $sql = "SELECT * FROM `user_tbl` WHERE `id`=$id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $fname = $row['fname'];
    $mname = $row['mname'];
    $lname = $row['lname'];
    $email = $row['email'];
    $empid = $row['user_uid'];

    // $sql2 = "SELECT * FROM `login_tbl` WHERE `uid`= '$empid'";
    // $result2 = mysqli_query($conn, $sql2) or die('error1');
    // $row2 = mysqli_fetch_assoc($result2);

    // $logid = $row2['logid'];


    if (isset($_POST['update'])) {

        //reset
        if ($result) {


            $reset = "UPDATE `user_tbl` SET `email`='dummy',`user_uid`='dummy' WHERE `id`='$id'";
            $r = mysqli_query($conn, $reset);

            if (!$r) {
                $msg = 'Couldnt update';
                header("location:displayOtherUser.php?msg=$msg");
                exit;
            }
        }

        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $uemail = $_POST['email'];
        $uempid = $_POST['empid'];
        $role ='staff';

        // $password = $fname;

        $chk_query = "SELECT * FROM user_tbl WHERE `email`='$uemail' OR `user_uid`='$uempid'";
        $chk_res =mysqli_query($conn,$chk_query);
        if(mysqli_num_rows($chk_res)<=0){

            $update_sql = "UPDATE `user_tbl` SET `id`='$id',`fname`='$fname',`mname`='$mname',`lname`='$lname',`email`='$uemail',`role`='$role',`user_uid`='$uempid' WHERE `id`=$id";

            $result = mysqli_query($conn, $update_sql);
    
            if ($result) {
                    $msg = 'Updated Succesfully';
            } else {
                $msg = 'Update Failed!!!';
            }
        }

        else{
            // echo $email.$empid."shgdshghgs".$id.$uemail;

            $set = "UPDATE `user_tbl` SET `email`='$email',`user_uid`='$empid' WHERE `id`='$id'";
            $s = mysqli_query($conn, $set);

            if ($s) {
                $msg='User Already Exists';
                header("location:displayOtherUser.php?msg=$msg");
                exit;
            }
            
        }


       

        header("location:displayOtherUser.php?msg=$msg");
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
    <title>Update Other User</title>
</head>
<body>
<header>
        <div class="title">
            <h4>Update Other User</h4>
        </div>
        <div class="ex-link">
            <a href="addOtherUser.php">Add Other User</a>
        </div>
    </header>
    <div class="content">

        <main class="form-container">
            <form action="#" method="POST" class="studentForm">
                <div class="form-row">
                    <div class="form-group">
                        <label for="fname">First Name <span style="color: red;">*</span></label>
                        <input type="text" value="<?php echo $fname; ?>" name="fname" placeholder="First Name" required>
                    </div>
                    <div class="form-group">
                        <label for="mname">Middle Name</label>
                        <input type="text" value="<?php echo $mname; ?>" name="mname" placeholder="Middle Name">
                    </div>
                    <div class="form-group">
                        <label for="lname">Last Name <span style="color: red;">*</span></label>
                        <input type="text" value="<?php echo $lname; ?>" name="lname" placeholder="Last Name" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="email">E-Mail <span style="color: red;">*</span></label>
                        <input type="email" value="<?php echo $email; ?>" name="email" placeholder="xyz@gmail.com" required>
                    </div>
                    <div class="form-group">
                        <label for="empid">Empyoyee ID <span style="color: red;">*</span></label>
                        <input type="text" value="<?php echo $empid; ?>" name="empid" placeholder="Employee ID" required>
                    </div>
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
    
</body>
</html>

<?php }

if($action==='d'){

    $sql="DELETE FROM `user_tbl` WHERE `id`=$id";
    $result=mysqli_query($conn,$sql);

    if ($result) {
            $msg='Deleted';
            
    } else {
        $msg='Failed to Delete!!!';
    }
    header("location:displayOtherUser.php?msg=$msg");

    
}

?>
