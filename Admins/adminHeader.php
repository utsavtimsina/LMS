<?php 
session_start();
if((!isset($_SESSION['role']) || empty($_SESSION['role'])) || ($_SESSION['role']!= 'admin' && $_SESSION['role'] != 'librarian')){
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
           <a href="adminHome.php"> <img src="../Image/lmswhite.png" alt="LMS Logo"></a>
        </figure>
        <nav class="nav-bar">
            <ul>
                <li><a href="adminHome.php"><span><i class="fa-solid fa-house-chimney"></i></span> Home</a></li>
                <li><a href="#"><span><i class="fa-solid fa-bars"></i></span> Actions</a>
                <div class="sub-menu">
                    <ul>
                    <li><a href="addFaculty.php">Add Faculty</a></li>
                        <li><a href="addBookCategory.php">Add Book Category</a></li>
                        <li><a href="addStudent.php">Add Users</a></li>
                        <li><a href="displayStudent.php">Manage Users</a></li>
                        <li><a href="addBookDetails.php">Book Details Entry</a></li>
                        <li><a href="addBook.php">Add Book</a></li>
                        <li><a href="displayBookDetails.php">Manage Book</a></li>
                        <?php if(($_SESSION['role']) == 'admin'){ ?> <li><a href="addLibrarian.php">Add Librarian</a></li><?php } ?>
                        
                        <li><a href="issueBook.php">Issue Book</a></li>
                        <li><a href="returnBook.php">Return Book</a></li>
                        <li><a href="transactions.php">Transactions</a></li>
                    </ul>
                </div>
            </li>
            </ul>
        </nav>
        <div class="other-menu nav-bar">
            <ul>
                <li><a href="adminChangePassword.php?a=2"><span><i class="fa-solid fa-key"></i></span> Change Password</a></li>
                <li><a href="../logout.php"><span><i class="fa-solid fa-arrow-right-from-bracket"></i></span> Logout</a></li>
                <li><a href="adminHome.php">Hello, <?php echo $_SESSION['role'].'<br>'.$_SESSION['name'];?></a></li>
            </ul>
        </div>
    </main>
</body>
</html>