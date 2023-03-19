<?php
require('adminHeader.php');
require('../config.php');
$id = $_GET['id'];
$action = $_GET['action'];


if ($action == 'p') {

    $sql = "SELECT * FROM `user_tbl` WHERE `id`=$id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $fname = $row['fname'];
    $mname = $row['mname'];
    $lname = $row['lname'];
    $email = $row['email'];
    $empid = $row['user_uid'];

    $fullname = $fname . " " . $mname . " " . $lname;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/profile.css">
    <link rel="stylesheet" href="./css/addForm.css">
    <link rel="stylesheet" href="../css/table.css">
    <title>Other User Profile</title>
</head>

<body>
    <header>
        <div class="title">
            <h4>Other User Profile</h4>
        </div>
    </header>

    <div class="profile-content">

        <div class="profile-dtl">
            <div class="topic">
                <h3>Name : <h4><?php echo $fullname; ?></h4>
                </h3>
            </div>

            <div class="topic">
                <h3>Email : <h4><?php echo $email; ?></h4>
                </h3>
            </div>
            <div class="topic">
                <h3>Employee Id : <h4><?php echo $empid; ?></h4>
                </h3>
            </div>

            <!-- <div class="topic">
                <h3>Category : <h4>ffffff</h4> </h3>
            </div>
             -->
        </div>
    </div>
    <br>

    <!-- issued book -->
    <section class="table-container">

        <table class="table">
            <caption>
                <h3>Issued Book</h3>
            </caption>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Txn No.</th>
                    <th>Book uId</th>
                    <th>Book Name</th>
                    <th>User uId</th>
                    <th>User Name</th>
                    <th>Issued Date</th>
                    <th>Returned Date</th>
                    <th>Fine</th>
                    <th>Return Status</th>
                    <th>Actions</th>

                </tr>
            </thead>
            <tbody>

                <?php
                $counter = 0;

                $sql = "SELECT * FROM `issue_tbl` WHERE user_uid='$empid' AND return_status='issued'";
                $result = mysqli_query($conn, $sql);
                $num = mysqli_num_rows($result);



                if ($num > 0) {
                    while ($rows = mysqli_fetch_assoc($result)) {

                        $txn_no = $rows['txn_no'];
                        $b_id = $book_uid = $rows['book_uid'];
                        $u_id = $user_uid = $rows['user_uid'];
                        $issued_date = $rows['issued_date'];
                        $returnrd_date = $rows['returned_date'];
                        $fine = $rows['fine'];
                        $return_status = $rows['return_status'];

                ?>

                        <tr>
                            <?php

                            $query1 = "SELECT book_details_tbl.bname FROM book_details_tbl INNER JOIN book_tbl ON book_details_tbl.book_id = book_tbl.bookid INNER JOIN issue_tbl ON book_tbl.bookuid=issue_tbl.book_uid WHERE issue_tbl.book_uid='$book_uid'";

                            $result1 = mysqli_query($conn, $query1);
                            $row1 = mysqli_fetch_assoc($result1);

                            $bname = $row1['bname'];

                            $query3 = "SELECT * FROM user_tbl WHERE `user_uid`='$user_uid'";
                            $result3 = mysqli_query($conn, $query3);
                            $num3 = mysqli_num_rows($result3);

                            if ($num3 > 0) {
                                $row3 = mysqli_fetch_assoc($result3);
                                $fname = $row3['fname'];
                                $mname = $row3['mname'];
                                $lname = $row3['lname'];

                                $name = $fname . " " . $mname . " " . $lname;
                            }

                            ?>
                            <td><?php echo ++$counter; ?></td>
                            <td><?php echo $txn_no; ?></td>
                            <td><?php echo $book_uid; ?></td>
                            <td><?php echo $bname; ?></td>
                            <td><?php echo $user_uid; ?></td>
                            <td><?php echo $name; ?></td>
                            <td><?php echo $issued_date; ?></td>
                            <td><?php echo $returnrd_date; ?></td>
                            <td><?php echo $fine; ?></td>
                            <td><?php echo $return_status; ?></td>
                            <td>


                                <div class="actions">
                                    <div class="action-btn">
                                        <div>
                                            <button class="edit-btn all-btn" onclick="location.href='issueBook.php?txn_no=<?php echo $txn_no; ?>&action=e'"><i class="fa-regular fa-pen-to-square"></i>
                                                Edit</button>
                                        </div>
                                    </div>
                                    <div class="action-btn">
                                        <div>
                                            <button class="return-btn all-btn" onclick="location.href='returnBook.php?b=<?php echo $b_id ?>&u=<?php echo $u_id ?>'"><i class="fa-solid fa-rotate-left"></i> Return</button>
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


    <!-- returned book -->



    <section class="table-container">

        <table class="table">
            <caption>
                <h3>Returned Book</h3>
            </caption>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Txn No.</th>
                    <th>Book uId</th>
                    <th>Book Name</th>
                    <th>User uId</th>
                    <th>User Name</th>
                    <th>Issued Date</th>
                    <th>Returned Date</th>
                    <th>Fine</th>
                    <th>Return Status</th>


                </tr>
            </thead>
            <tbody>

                <?php
                $counter = 0;

                $sql = "SELECT * FROM `issue_tbl` WHERE user_uid='$empid' AND return_status='returned'";
                $result = mysqli_query($conn, $sql);
                $num = mysqli_num_rows($result);



                if ($num > 0) {
                    while ($rows = mysqli_fetch_assoc($result)) {

                        $txn_no = $rows['txn_no'];
                        $book_uid = $rows['book_uid'];
                        $user_uid = $rows['user_uid'];
                        $issued_date = $rows['issued_date'];
                        $returnrd_date = $rows['returned_date'];
                        $fine = $rows['fine'];
                        $return_status = $rows['return_status'];

                ?>

                        <tr>
                            <?php

                            $query1 = "SELECT book_details_tbl.bname FROM issue_tbl INNER JOIN book_tbl ON issue_tbl.book_uid = book_tbl.bookuid INNER JOIN book_details_tbl ON book_tbl.bookid=book_details_tbl.book_id WHERE issue_tbl.book_uid='$book_uid'";

                            $result1 = mysqli_query($conn, $query1);
                            $row1 = mysqli_fetch_assoc($result1);

                            $bname = $row1['bname'];

                            $query3 = "SELECT * FROM user_tbl WHERE `user_uid`='$user_uid'";
                            $result3 = mysqli_query($conn, $query3);
                            $num3 = mysqli_num_rows($result3);

                            if ($num3 > 0) {
                                $row3 = mysqli_fetch_assoc($result3);
                                $fname = $row3['fname'];
                                $mname = $row3['mname'];
                                $lname = $row3['lname'];

                                $name = $fname . " " . $mname . " " . $lname;
                            }

                            ?>
                            <td><?php echo ++$counter; ?></td>
                            <td><?php echo $txn_no; ?></td>
                            <td><?php echo $book_uid; ?></td>
                            <td><?php echo $bname; ?></td>
                            <td><?php echo $user_uid; ?></td>
                            <td><?php echo $name; ?></td>
                            <td><?php echo $issued_date; ?></td>
                            <td><?php echo $returnrd_date; ?></td>
                            <td><?php echo $fine; ?></td>
                            <td><?php echo $return_status; ?></td>

                        </tr>

                <?php }
                }

                ?>



            </tbody>
        </table>
    </section>
</body>

</html>