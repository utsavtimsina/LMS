

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../Assets/fontawesome/js/all.js"></script>
    <script src="./js/userHome.js"></script>
    <link rel="stylesheet" href="../css/home.css">
    <title>Home Page</title>
</head>
<body>
<?php require('userHeader.php') ?>
    <main class="container">
        <header>
            <div class="title">
                <h4>Home</h4>
            </div>
        </header>
        <section class="content">
            <div class="card" onclick="viewProfile();">
                <span><i class="fa-solid fa-user-tie"></i></span><h3>View Profile</h3>
            </div>
            <div class="card" onclick="viewBook();">
                <span><i class="fa-solid fa-book"></i></span><h3>View Book</h3>
            </div>
        </section>
    </main>
</body>
</html>