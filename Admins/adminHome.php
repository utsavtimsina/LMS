<?php
require('adminHeader.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../Assets/fontawesome/js/all.js"></script>
    <link rel="stylesheet" href="../css/home.css">
    <title>Home Page</title>
</head>

<body>

    <main class="container">
        <header>
            <div class="title">
                <h4>Home</h4>
            </div>
        </header>
        <section class="content">
            <?php if (($_SESSION['role']) == 'admin') { ?>
                <div class="card" onclick="addLibrarian();">
                    <span><i class="fa-solid fa-book-open-reader"></i></span>
                    <h3>Add Librarians</h3>
                </div>
            <?php } ?>
            <div class="card" onclick="addUser();">
                <span><i class="fa-solid fa-user-plus"></i></span>
                <h3>Add Users</h3>
            </div>
            <div class="card" onclick="manageUser();">
                <span><i class="fa-solid fa-people-roof"></i></span>
                <h3>Manage Users</h3>
            </div>

            <div class="card" onclick="bookDetails();">
                <span><i class="fa-solid fa-list-check"></i></span> <span><i class="fa-solid fa-book"></i></span>
                <h3>Book Details Entry</h3>
            </div>
            <div class="card" onclick="addBook();">
                <span><i class="fa-solid fa-plus"></i></span><span><i class="fa-solid fa-book"></i></span>
                <h3>Add Book</h3>
            </div>
            <div class="card" onclick="manageBook();">
                <span><i class="fa-solid fa-circle-info"></i></span> <span><i class="fa-solid fa-book"></i></span>
                <h3>Manage Book</h3>
            </div>


            <div class="card" onclick="issueBook();">
                <span><i class="fa-solid fa-arrow-up-from-bracket"></i></span><span><i class="fa-solid fa-book"></i></span>
                <h3>Issue Book</h3>
            </div>
            <div class="card" onclick="returnBook();">
                <span><i class="fa-solid fa-download"></i></span><span><i class="fa-solid fa-book"></i></span>
                <h3>Return Book</h3>
            </div>
            <div class="card" onclick="transactions();">
                <span><i class="fa-solid fa-arrow-right-arrow-left"></i></span>
                <h3>Transactions</h3>
            </div>
        </section>
    </main>

    <script src="./js/home.js"></script>
</body>

</html>