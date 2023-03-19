<?php
require('userHeader.php');
require('../config.php');

$action=$_GET['action'];
$stuid =$_SESSION['user_uid'];

if ($action == 'p') {

    $sql = "SELECT * FROM `student_tbl` WHERE `stuid`='$stuid'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);


    $batch = $row['batch'];
    $stuid = $row['stuid'];
    $phone = $row['phone'];
    $gender = $row['gender'];
    $idno = $row['idno'];
    $address = $row['address'];
    $fid = $row['faculty_id'];

    $query = "SELECT * FROM `faculty_tbl` WHERE `fid`=$fid";
$res = mysqli_query($conn, $query);
$rowf = mysqli_fetch_assoc($res);

    $facname = $rowf['faculty_name'];



    $sql1 = "SELECT * FROM user_tbl WHERE user_uid= '$stuid' AND `role`='student'";
    $result1 = mysqli_query($conn, $sql1);
    $row1 = mysqli_fetch_assoc($result1);

    $fname = $row1['fname'];
    $mname = $row1['mname'];
    $lname = $row1['lname'];
    $email = $row1['email'];

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
    <!-- <link rel="stylesheet" href="./css/addForm.css"> -->
    <link rel="stylesheet" href="../css/table.css">
    <title>Student Profile</title>
</head>

<body>
    <header>
        <div class="title">
            <h4>Student Profile</h4>
        </div>
    </header>

    <div class="profile-content">

        <div class="profile-dtl">
            <div class="topic">
                <h3>Name : <h4><?php echo $fullname; ?></h4>
                </h3>
            </div>
            <div class="topic">
                <h3>Batch : <h4><?php echo $batch; ?></h4>
                </h3>
            </div>
            <div class="topic">
                <h3>Faculty: <h4><?php echo $facname; ?></h4>
                </h3>
            </div>
            <div class="topic">
                <h3>Email : <h4><?php echo $email; ?></h4>
                </h3>
            </div>
            <div class="topic">
                <h3>Student Id : <h4><?php echo $stuid; ?></h4>
                </h3>
            </div>

            <div class="topic">
                <h3>Phone : <h4><?php echo $phone; ?></h4>
                </h3>
            </div>
            <div class="topic">
                <h3>Gender : <h4><?php echo $gender; ?></h4>
                </h3>
            </div>
            <div class="topic">
                <h3>ID No. (Citizenship no.) : <h4><?php echo $idno; ?></h4>
                </h3>
            </div>
            <div class="topic">
                <h3>Address : <h4><?php echo $address; ?></h4>
                </h3>
            </div>
            <!-- <div class="topic">
                <h3>Category : <h4>ffffff</h4> </h3>
            </div>
             -->
        </div>
    </div>
    <br><br>
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
                    

                </tr>
            </thead>
            <tbody>

                <?php
                $counter=0;

                $sql = "SELECT * FROM `issue_tbl` WHERE user_uid='$stuid' AND return_status='issued'";
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


                            $query2 = "SELECT * FROM user_tbl WHERE `user_uid`='$user_uid'";
                            $result2 = mysqli_query($conn, $query2);
                            $num2 = mysqli_num_rows($result2);
                            if ($num > 0) {
                                $row2 = mysqli_fetch_assoc($result2);
                                $fname = $row2['fname'];
                                $mname = $row2['mname'];
                                $lname = $row2['lname'];

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
                 $counter=0;
                $sql = "SELECT * FROM `issue_tbl` WHERE user_uid='$stuid' AND return_status='returned'";
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


                            $query2 = "SELECT * FROM user_tbl WHERE `user_uid`='$user_uid'";
                            $result2 = mysqli_query($conn, $query2);
                            $num2 = mysqli_num_rows($result2);
                            if ($num > 0) {
                                $row2 = mysqli_fetch_assoc($result2);
                                $fname = $row2['fname'];
                                $mname = $row2['mname'];
                                $lname = $row2['lname'];

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