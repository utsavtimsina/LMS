<?php require('adminHeader.php');
require('../config.php');

if(isset($_POST['register'])){

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $mname = $_POST['mname'];
    $email = $_POST['email'];
    $empid = $_POST['empid'];

    $role='staff';


    

    $password=$fname;

    // print_r($_POST);
    // echo $fullname;
    $chk_query = "SELECT * FROM user_tbl WHERE `email`='$email' OR `user_uid`='$empid'";
    $chk_res =mysqli_query($conn,$chk_query);
    if(mysqli_num_rows($chk_res)<=0){

    $sql="INSERT INTO `user_tbl`(`fname`, `mname`, `lname`, `email`, `role`, `user_uid`, `password`) VALUES ('[$fname','$mname','$lname','$email','$role','$empid','$password')";

    $res=mysqli_query($conn,$sql);
    if ($res) {
            $msg='Registered Succesfully';
    } 
    else {
        $msg = 'Registration Failed!!!';
    }
}else{
    $msg='User Already Exists';
}
    header("location:addOtherUser.php?msg=$msg");

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
    <title>Add Other User</title>
</head>
<body>
<header>
        <div class="title">
            <h4>Other User Registration</h4>
        </div>
        <div class="ex-link">
            <a href="addStudent.php">Student Registration</a>
        </div>
    </header>

    <div class="content">
         <!-- message -->
         <?php
        if (isset($_GET['msg']) && !empty($_GET['msg'])) {
        ?>
            <div class="msg" id="impmsg">
                <i class="fa-solid fa-plus cross" onclick="location.href='addOtherUser.php'"></i>
                <?php
                @$msg = $_GET['msg'];
                echo $msg;
                ?>
            </div>
        <?php } ?>

        <!-- msg end -->
    <main class="form-container">
            <form action="#" method="POST" class="studentForm">
                <div class="form-row">
                    <div class="form-group">
                        <label for="fname">First Name <span style="color: red;">*</span></label>
                        <input type="text" name="fname" placeholder="First Name" required>
                    </div>
                    <div class="form-group">
                        <label for="mname">Middle Name</label>
                        <input type="text" name="mname" placeholder="Middle Name">
                    </div>
                    <div class="form-group">
                        <label for="lname">Last Name <span style="color: red;">*</span></label>
                        <input type="text" name="lname" placeholder="Last Name" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="email">E-Mail <span style="color: red;">*</span></label>
                        <input type="email" name="email" placeholder="xyz@gmail.com" required>
                    </div>
                    <div class="form-group">
                        <label for="empid">Empyoyee ID <span style="color: red;">*</span></label>
                        <input type="text" name="empid" placeholder="Employee ID" required>
                    </div>
                </div>
    
                <div class="form-row">
                    <div class="form-btn">
                        <input type="submit" class="fbtn" name="register" value="Register">
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