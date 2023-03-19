<?php
require('adminHeader.php');
require('../config.php');
$bid = $_GET['bid'];
$action = $_GET['action'];
// $action='e';
//getting fac and cat name

// @$facname = $_GET['faculty_name'];
// @$cname = $_GET['category_name'];

if ($action == 'p') {

    // @$facname = $_GET['faculty_name'];
    // @$cname = $_GET['category_name'];

    $sql = "SELECT * FROM `book_details_tbl` WHERE bid=$bid";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $bname = $row['bname'];
    $book_id = $row['book_id'];
    $year = $row['year'];
    $semester = $row['semester'];
    $edition = $row['edition'];
    $publication = $row['publication'];
    $author = $row['author'];
    $total_qty = $row['total_qty'];
    $fid = $row['faculty_id'];
    $catid = $row['category_id'];

    $query = "SELECT * FROM `faculty_tbl`,`book_category_tbl` WHERE `fid`=$fid AND `cid`=$catid";
    $result1 = mysqli_query($conn, $query);
    $row1 = mysqli_fetch_assoc($result1);

    $facname = $row1['faculty_name'];
    $cname = $row1['category_name'];

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/profile.css">
        <link rel="stylesheet" href="../css/table.css">
        <link rel="stylesheet" href="./css/addForm.css">
        <!-- <link rel="stylesheet" href="css/pagination.css"> -->
        <title>Profile</title>
    </head>

    <body>
        <header>
            <div class="title">
                <h4>Book Details Profile</h4>
            </div>
        </header>
        <div class="content">
            <div class="profile-content">
                <!-- message -->
                <?php
                if (isset($_GET['msg']) && !empty($_GET['msg'])) {
                ?>
                    <div class="msg" id="impmsg">
                        <i class="fa-solid fa-plus cross" onclick='location.href="profileBookDetails.php?bid=<?php echo $bid; ?>&action=p"'></i>
                        <?php
                        @$msg = $_GET['msg'];
                        echo $msg;
                        ?>
                    </div>
                <?php } ?>
                <!-- msg end -->

                <div class="profile-dtl">
                    <div class="topic">
                        <h3>Book Name : <h4><?php echo $bname; ?></h4>
                        </h3>
                    </div>
                    <div class="topic">
                        <h3>Book Id : <h4><?php echo $book_id; ?></h4>
                        </h3>
                    </div>
                    <div class="topic">
                        <h3>Year / Semester : <h4><?php echo $year . " / " . $semester; ?></h4>
                        </h3>
                    </div>
                    <div class="topic">
                        <h3>Edition : <h4><?php echo $edition; ?></h4>
                        </h3>
                    </div>
                    <div class="topic">
                        <h3>Publication : <h4><?php echo $publication; ?></h4>
                        </h3>
                    </div>
                    <div class="topic">
                        <h3>Author : <h4><?php echo $author; ?></h4>
                        </h3>
                    </div>
                    <div class="topic">
                        <h3>Total Qty : <h4><?php echo $total_qty; ?></h4>
                        </h3>
                    </div>
                    <div class="topic">
                        <h3>Category : <h4><?php echo $cname; ?></h4>
                        </h3>
                    </div>
                    <div class="topic">
                        <h3>Faculty : <h4><?php echo $facname; ?></h4>
                        </h3>
                    </div>
                    <!-- <div class="topic">
                <h3>Category : <h4>ffffff</h4> </h3>
            </div>
             -->
                </div>
            </div>




            <section class="table-container">
                <table class="table" id="myTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <!-- <th>biId</th> -->
                            <th>Book Name</th>
                            <th>Book uId</th>
                            <th>ISBN NO.</th>
                            <th>Issued Date</th>
                            <th>Returned Date</th>
                            <th>isReturned?</th>
                            <th>Taken By</th>
                            <th>Actions</th>

                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $counter = 0;

                        $sql = "SELECT * FROM `book_tbl` WHERE bookid='$book_id' ORDER BY `bookuid`";
                        $result = mysqli_query($conn, $sql);
                        $num = mysqli_num_rows($result);



                        if ($num > 0) {
                            while ($rows = mysqli_fetch_assoc($result)) {


                                $query = "SELECT bname FROM book_details_tbl WHERE book_id='$book_id'";
                                $res1 = mysqli_query($conn, $query);
                                $row1 = mysqli_fetch_assoc($res1);

                                $b_id = $rows['bookuid'];
                                $u_id = $rows['takenby'];
                        ?>



                                <tr>
                                    <td><?php echo ++$counter; ?></td>
                                    <!-- <td><?php echo $rows['biid'] ?></td> -->
                                    <td><?php echo $row1['bname'] ?></td>
                                    <td><?php echo $rows['bookuid'] ?></td>
                                    <td><?php echo $rows['isbn'] ?></td>
                                    <td><?php echo $rows['issued_date'] ?></td>
                                    <td><?php echo $rows['returned_date'] ?></td>
                                    <td><?php echo $rows['isreturned'] ?></td>
                                    <td><?php echo $rows['takenby'] ?></td>
                                    <td>

                                        <div class="actions">
                                            <?php
                                            if ($rows['isreturned'] === 'true') {
                                            ?>

                                                <div class="action-btn">
                                                    <div>
                                                        <button class="edit-btn all-btn" onclick="location.href='updateBook.php?biid=<?php echo $rows['biid']; ?>&action=e'"><i class="fa-regular fa-pen-to-square"></i>
                                                            Edit</button>
                                                    </div>
                                                </div>
                                                <div class="action-btn">
                                                    <div>
                                                        <button class="issue-btn all-btn" onclick="location.href='issueBook.php?b=<?php echo $b_id;?>'"><i class="fas fa-book-reader"></i> Issue</button>
                                                    </div>
                                                </div>
                                                <div class="action-btn">
                                                    <div>
                                                        <button class="del-btn all-btn" onclick="location.href='updateBook.php?biid=<?php echo $rows['biid']; ?>&action=d'"><i class="fa-regular fa-trash-can"></i>
                                                            Delete</button>
                                                    </div>
                                                </div><?php
                                                    } else { ?>


                                                <div class="action-btn">
                                                    <div>
                                                        <button class="return-btn all-btn" onclick="location.href='returnBook.php?b=<?php echo $b_id ?>&u=<?php echo $u_id ?>'"><i class="fa-solid fa-rotate-left"></i> Return</button>
                                                    </div>
                                                </div>


                                            <?php


                                                    }

                                            ?>
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


<?php
}
?>