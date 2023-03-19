<?php
session_start();

require('config.php');


if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql_lib = "SELECT * FROM `lib_tbl` WHERE email= '$email'";
    $result_lib = mysqli_query($conn, $sql_lib);
    $num_lib = mysqli_num_rows($result_lib);
    $row_lib = mysqli_fetch_assoc($result_lib);

    if ($num_lib > 0) {
        $lid = $row_lib['lid'];
        $role = $row_lib['role'];
        $lib_id = $row_lib['empid'];
        $lib_password = $row_lib['password'];
        $name = $row_lib['fname'] . " " . $row_lib['mname'] . " " . $row_lib['lname'];

        if ($password === $lib_password) {
            $_SESSION['lib_uid'] = $lib_id;
            $_SESSION['lid'] = $lid;
            $_SESSION['role'] = $role;
            $_SESSION['name'] = $name;
            header("location:Admins/adminHome.php");
        } else {
            $msg = 'Login failed: Email or Password donot match';
            header("location:login.php?msg=$msg");
        }
    }

    $sql_user = "SELECT * FROM `user_tbl` WHERE email= '$email'";
    $result_user = mysqli_query($conn, $sql_user);
    $num_user = mysqli_num_rows($result_user);
    $row_user = mysqli_fetch_assoc($result_user);

    if ($num_user > 0) {
        $id = $row_user['id'];
        $role = $row_user['role'];
        $user_uid = $row_user['user_uid'];
        $name = $row_user['fname'] . " " . $row_user['mname'] . " " . $row_user['lname'];
        $user_password = $row_user['password'];

        if ($password === $user_password) {
            $_SESSION['id'] = $id;
            $_SESSION['user_uid'] = $user_uid;
            $_SESSION['role'] = $role;
            $_SESSION['name'] = $name;
            header("location:Users/userHome.php");
        } else {
            $msg = 'Login failed: Email or Password donot match';
            header("location:login.php?msg=$msg");
        }
        // echo $role;
    }

    // echo $num_lib . " " . $num_user;
    if ($num_lib <= 0 && $num_user <= 0) {
        $msg = 'user not found';
        header("location:login.php?msg=$msg");
    }
    // header("location:login.php?msg=$msg");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Here</title>
    <link rel="stylesheet" href="css/login.css">

    <script src="./Assets/fontawesome/js/all.js"></script>
</head>

<body>
    <div class="logo-img">
        <div>
            <img src="Image/lmsdg.png" alt="LMS Logo" class="logo">
        </div>
    </div>
    <!-- message -->

    <div class="alert">
        <?php
        if (isset($_GET['msg']) && !empty($_GET['msg'])) {
        ?>
            <div class="msg" id="impmsg">
                <i class="fa-solid fa-plus cross" onclick="location.href='login.php'"></i>
                <?php
                @$msg = $_GET['msg'];
                echo $msg;
                ?>
            </div>
        <?php } ?>
    </div>

    <!-- msg end -->
    <div class="content">

        <main class="login-box">
            <div class="user-icon">
                <h2>Login</h2>
                <img src="Image/user-icon.png" alt="Avatar" class="avatar">
            </div>
            <section class="login-container">
                <div class="login-form">
                    <form action="#" method="POST">
                        <div class="form-group">
                            <label for="email">Email <span style="color: red;">*</span></label>
                            <input type="email" placeholder="Enter Your Email" id="email" onkeyup="validateEmail()" name="email" required>
                            <div id="email-error"></div>
                        </div>
                        <div class="form-group">
                            <label for="password" name="password" id="password">Password <span style="color: red;">*</span></label>
                            <input type="password" placeholder="Enter Password" name="password" onkeyup="validatePassword()" id="pass" required">
                            <div id="password-error"></div>
                        </div>
                        <div class="pshow">
                            <input type="checkbox" id="checkbox" onclick="ShowPassword();">
                            <label for="checkbox" id="s-pw">Show Password</label>
                        </div>
                        <div class="form-btn">
                            <input type="submit" class="fbtn" name="login" value="Login">
                        </div>
                    </form>
                </div>
            </section>

        </main>
    </div>
    <script>
        function ShowPassword() {
            var show = document.getElementById("pass");
            if (show.type === "password") {
                show.type = "text";
            } else
                show.type = "password";
        }
    </script>
    <script src="./js/formvalidate.js"></script>
</body>

</html>