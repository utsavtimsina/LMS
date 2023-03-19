<?php require('adminHeader.php');
require('../config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/table.css">
    <link rel="stylesheet" href="./css/addForm.css">
    <link rel="stylesheet" href="./css/pagination.css">
    <title>Manage Other Users</title>
</head>

<body>
    <header>
        <div class="title">
            <h4>Other User Details</h4>
        </div>
        <div class="ex-link">
            <a href="displayStudent.php">Manage Student</a>
        </div>
    </header>
    <div class="content">
   
         <!-- message -->
         <?php
        if (isset($_GET['msg']) && !empty($_GET['msg'])) {
        ?>
            <div class="msg" id="impmsg">
                <i class="fa-solid fa-plus cross" onclick="location.href='displayOtherUser.php'"></i>
                <?php
                @$msg = $_GET['msg'];
                echo $msg;
                ?>
            </div>
        <?php } ?>

        <!-- msg end -->
        <section class="table-container">
            <table class="table" id="myTable">
                <thead>
                    <tr>
                    <th>#</th>
                    <!-- <th>oId</th> -->
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Employee ID</th>
                    <th>Actions</th>

                    </tr>
                </thead>
                <tbody>

                    <?php
                    $counter = 0;


                    $sql = "SELECT * FROM `user_tbl` WHERE `role`='staff'";
                    $result = mysqli_query($conn, $sql);
                    $num = mysqli_num_rows($result);



                    if ($num > 0) {
                        while ($rows = mysqli_fetch_assoc($result)) {

                    ?>

                            <tr>
                            <td><?php echo ++$counter; ?></td>
                            <!-- <td><?php echo $rows['id'] ?></td> -->
                            <td><?php echo $rows['fname']." ".$rows['mname']." ".$rows['lname'] ?></td>
                            <td><?php echo $rows['email'] ?></td>
                            <td><?php echo $rows['password'] ?></td>
                            <td><?php echo $rows['user_uid'] ?></td>

                                <td>
                                    <div class="actions">
                                        <div class="action-btn">
                                            <div>
                                                <button class="view-btn all-btn" onclick="location.href='profileOtherUser.php?id=<?php echo $rows['id'] ?>&action=p'"><i class="fa-regular fa-eye"></i> View</button>
                                            </div>
                                        </div>
                                        <div class="action-btn">
                                            <div>
                                                <button class="edit-btn all-btn" onclick="location.href='updateOtherUser.php?id=<?php echo $rows['id']; ?>&action=e'"><i class="fa-regular fa-pen-to-square"></i>
                                                    Edit</button>
                                            </div>
                                        </div>
                                        <div class="action-btn">
                                            <div>
                                                <button class="del-btn all-btn" onclick="location.href='updateOtherUser.php?id=<?php echo $rows['id']; ?>&action=d'"><i class="fa-regular fa-trash-can"></i>
                                                    Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                    <?php }
                    }

                    ?>



                </tbody>
            </table>

        </section>

        <?php require('dataTable.php') ?>
    </div>

</body>

</html>