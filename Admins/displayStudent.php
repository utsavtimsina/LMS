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
    <title>Manage Student</title>
</head>

<body>
    <header>
        <div class="title">
            <h4>Student Details</h4>
        </div>
        <div class="ex-link">
            <a href="displayOtherUser.php">Manage Other User</a>
        </div>
    </header>
    <div class="content">
   
         <!-- message -->
         <?php
        if (isset($_GET['msg']) && !empty($_GET['msg'])) {
        ?>
            <div class="msg" id="impmsg">
                <i class="fa-solid fa-plus cross" onclick="location.href='displayStudent.php'"></i>
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
                        <!-- <th>sId</th> -->
                        <th>Full Name</th>
                        <th>Faculty Name</th>
                        <th>Batch</th>
                        <th>Roll</th>
                        <th>Email</th>
                        <th>Stu Id</th>
                        <th>Phone</th>
                        <th>Gender</th>
                        <th>ID No.</th>
                        <th>Address</th>
                        <th>Password</th>
                        <th>Actionss</th>

                    </tr>
                </thead>
                <tbody>

                    <?php

                   
                    $counter = 0;



                    // $sql = "SELECT * FROM `student_tbl` LIMIT $offset,$limit";

                    $sql="SELECT * FROM student_tbl ";
                    $result = mysqli_query($conn, $sql);
                    $num = mysqli_num_rows($result);



                    if ($num > 0) {
                        while ($rows = mysqli_fetch_assoc($result)) {

                            $query1 = "SELECT * FROM user_tbl WHERE user_uid='$rows[stuid]' AND `role`='student'";
                            $res1 = mysqli_query($conn, $query1);
                            $row1 = mysqli_fetch_assoc($res1);

                            $query2 = "SELECT faculty_name FROM faculty_tbl WHERE fid= $rows[faculty_id]";
                            $res2 = mysqli_query($conn, $query2);
                            $row2 = mysqli_fetch_assoc($res2);
                    ?>

                            <tr>
                                <td><?php echo ++$counter; ?></td>
                                <!-- <td><?php echo $rows['sid'] ?></td> -->
                                <td><?php echo $row1['fname']." ".$row1['mname']." ".$row1['lname'] ?></td>
                                <td><?php echo $row2['faculty_name'] ?></td>
                                <td><?php echo $rows['batch'] ?></td>
                                <td><?php echo $rows['rollno'] ?></td>
                                <td><?php echo $row1['email'] ?></td>
                                <td><?php echo $rows['stuid'] ?></td>
                                <td><?php echo $rows['phone']; ?></td>
                                <td><?php echo $rows['gender'] ?></td>
                                <td><?php echo $rows['idno'] ?></td>
                                <td><?php echo $rows['address'] ?></td>
                                <td><?php echo $row1['password'] ?></td>

                                <td>


                                    <div class="actions">
                                        <div class="action-btn">
                                            <div>
                                                <button class="view-btn all-btn" onclick="location.href='profileStudent.php?sid=<?php echo $rows['sid'] ?>&action=p'"><i class="fa-regular fa-eye"></i> View</button>
                                            </div>
                                        </div>
                                        <div class="action-btn">
                                            <div>
                                                <button class="edit-btn all-btn" onclick="location.href='updateStudent.php?sid=<?php echo $rows['sid']; ?>&action=e'"><i class="fa-regular fa-pen-to-square"></i>
                                                    Edit</button>
                                            </div>
                                        </div>
                                        <div class="action-btn">
                                            <div>
                                                <button class="del-btn all-btn" onclick="location.href='updateStudent.php?sid=<?php echo $rows['sid']; ?>&action=d'"><i class="fa-regular fa-trash-can"></i>
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

        
    </div>
    <?php require('dataTable.php') ?>
</body>

</html>