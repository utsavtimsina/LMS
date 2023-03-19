<?php 
    require('userHeader.php');
    require('../config.php');

    $a = $_GET['a'];

    if(isset($_POST['change']) && $a==1){

        $old_password=$_POST['opass'];
        $new_password=$_POST['npass'];
        $re_password=$_POST['rpass'];

        // print_r($_POST);
        if($new_password===$re_password){
            $sql= "SELECT * FROM `user_tbl` WHERE `user_uid`='$_SESSION[user_uid]'";
            $result = mysqli_query($conn,$sql);
            if(mysqli_num_rows($result)>0){
                $row=mysqli_fetch_assoc($result);

                if($old_password===$row['password']){
                    $change_sql="UPDATE `user_tbl` SET `password`='$new_password' WHERE `user_uid`='$_SESSION[user_uid]'";

                    $result_pass = mysqli_query($conn,$change_sql);
                    if($result_pass){
                        $msg='Password Changed Successfully';
                    }else{
                        $msg='Couldnot change Password';
                    }
                }else{
                    $msg='Old and new password donot match';
                }

            }else{
                $msg= 'user not found';
            }
            
        }else{
            $msg = 'Password And Re-Password donot match';
        }

        header("location:userChangePassword.php?a=1&msg=$msg");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Admins/css/addForm.css">
    <title>Change Password</title>
</head>

<body>
    <header>
        <div class="title">
            <h4>Change Password</h4>
        </div>
    </header>

    <div class="content">
        <!-- message -->
        <?php
        if (isset($_GET['msg']) && !empty($_GET['msg'])) {
        ?>
            <div class="msg" id="impmsg">
                <i class="fa-solid fa-plus cross" onclick="location.href='userChangePassword.php?a=1'"></i>
                <?php
                @$msg = $_GET['msg'];
                echo $msg;
                ?>
            </div>
        <?php } ?>

        <!-- msg end -->
        <main class="form-container">
            <form action="#" method="POST">
                <div class="form-group">
                    <label>Old Password<span style="color: red;">*</span></label>
                    <input type="password" name="opass" id="opass" placeholder="Enter Old Password" required>
                </div>
                <div class="form-group">
                    <label>New Password<span style="color: red;">*</span></label>
                    <input type="password" name="npass" id="npass" placeholder="Enter New Password" required>
                </div>
                <div class="form-group">
                    <label>Re-Type New Password<span style="color: red;">*</span></label>
                    <input type="password" name="rpass" id="rpass" placeholder="Re-Enter New Password" required>
                </div>
                <div class="pshow">
                            <input type="checkbox" id="checkbox" onclick="ShowPassword();">
                            <label for="checkbox" id="s-pw">Show Password</label>
                        </div>

                <div class="form-row">
                    <div class="form-btn">
                        <input type="submit" class="fbtn" name="change" value="Change Password">
                    </div>
                    <div class="form-btn">
                        <input type="reset" class="fbtn" name="reset" value="Reset">
                    </div>
                </div>
            </form>
        </main>
    </div>
    <script>
        function ShowPassword() {
            var oshow = document.getElementById("opass");
            var nshow = document.getElementById("npass");
            var rshow = document.getElementById("rpass");
            if (oshow.type === "password") {
                oshow.type = "text";
            } else{
                oshow.type = "password";}

                if (nshow.type === "password") {
                nshow.type = "text";
            } else{
                nshow.type = "password";}

                if (rshow.type === "password") {
                rshow.type = "text";
            } else{
                rshow.type = "password";}
        }
    </script>
   
</body>

</html>