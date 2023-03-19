<?php 
session_start();
if((!isset($_SESSION['role']) || empty($_SESSION['role'])) || ($_SESSION['role']!= 'student' && $_SESSION['role'] != 'staff')){
    header("location:../login.php?msg=Access Denied !!!");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../Assets/fontawesome/js/all.js"></script>
    <link rel="stylesheet" href="../css/header.css">
</head>
<body>
    <main class="header-container">
        <figure class="logo">
           <a href="userHome.php"> <img src="../Image/lmswhite.png" alt="LMS Logo"></a>
        </figure>
        <nav class="nav-bar">
            <ul>
                <li><a href="userHome.php"><span><i class="fa-solid fa-house-chimney"></i></span> Home</a></li>
                <li><a href="#"><span><i class="fa-solid fa-bars"></i></span> Actions</a>
                <div class="sub-menu">
                    <ul>
                        <li><a href="userStudentProfile.php?action=p">View Profile</a></li>
                        <li><a href="userViewBook.php">View Book</a></li>
                    </ul>
                </div>
            </li>
            </ul>
        </nav>
        <div class="other-menu nav-bar">
            <ul>
                <li><a href="userChangePassword.php?a=1"><span><i class="fa-solid fa-key"></i></span> Change Password</a></li>
                <li><a href="../logout.php"><span><i class="fa-solid fa-arrow-right-from-bracket"></i></span> Logout</a></li>
                <li><a href="">Hello, <?php echo $_SESSION['name'];?></a></li>
            </ul>
        </div>
    </main>
</body>
</html>