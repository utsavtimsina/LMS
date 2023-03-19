<?php require('adminHeader.php');
require('../config.php');

if (isset($_POST['issue'])) {

    // $bookuid=$_POST['bookuid'];
    $bookuid = strtoupper($_POST['bookuid']);
    $useruid = strtoupper($_POST['useruid']);

    //fetch book
    $issueQuery1 = "SELECT * FROM book_tbl WHERE bookuid='$bookuid'";
    $issueResult1 = mysqli_query($conn, $issueQuery1);
    $issueRow1 = mysqli_fetch_assoc($issueResult1);

    if (mysqli_num_rows($issueResult1) > 0) {
        $isreturned = $issueRow1['isreturned'];
        $book_id = $issueRow1['bookid'];

        if ($isreturned === 'true') {

            //fetch user
            $issueQuery2 = "SELECT * FROM user_tbl WHERE user_uid='$useruid'";
            $issueResult2 = mysqli_query($conn, $issueQuery2);
            $issueRow2 = mysqli_fetch_assoc($issueResult2);

            if (mysqli_num_rows($issueResult2) > 0) {
                $user_uid = $issueRow2['user_uid'];
            }

            // //fetch student
            // $issueQuery3 = "SELECT * FROM student_tbl WHERE stuid='$useruid'";
            // $issueResult3 = mysqli_query($conn, $issueQuery3);
            // $issueRow3 = mysqli_fetch_assoc($issueResult3);

            // if (mysqli_num_rows($issueResult3) > 0) {
            //     $stuid = $issueRow3['stuid'];
            // }
            //book issue


            if ($useruid == $user_uid) {

                date_default_timezone_set("Asia/Kathmandu");
                $issued_date = date('Y-m-d H:i:s');
                $timestamp = date('Y-m-d H:i:s');
                // echo $issued_date;

                $return_status = 'issued';


                mysqli_autocommit($conn, false);

                $flag = true;

                $sql1 = "INSERT INTO `issue_tbl`(`book_uid`, `user_uid`, `issued_date`, `returned_date`, `return_status`, `fine`,`timestamp`) VALUES ('$bookuid','$useruid','$issued_date',NULL,'$return_status',0,'$timestamp')";

                $sql2 = "UPDATE `book_tbl` SET `issued_date`='$issued_date',`returned_date`=NULL,`isreturned`='false',`takenby`='$useruid' WHERE bookuid='$bookuid' ";

                $sql3 = "UPDATE `book_details_tbl` SET `issued_qty`=issued_qty+1,`available_qty`=available_qty-1 WHERE book_id='$book_id'";

                $res1 = mysqli_query($conn, $sql1);
                if (!$res1) {
                    $flag = false;
                    // echo "Error: " . mysqli_error($conn) . ".";
                    $msg = "Error: " . mysqli_error($conn) . ".";
                }

                $res2 = mysqli_query($conn, $sql2);
                if (!$res2) {
                    $flag = false;
                    // echo "Error: " . mysqli_error($conn) . ".";
                    $msg = "Error: " . mysqli_error($conn) . ".";
                }

                $res3 = mysqli_query($conn, $sql3);
                if (!$res3) {
                    $flag = false;
                    // echo "Error: " . mysqli_error($conn) . ".";
                    $msg = "Error: " . mysqli_error($conn) . ".";
                }

                if ($flag) {
                    mysqli_commit($conn);
                    // echo "Book Issued successfully";
                    $msg = 'Book Issued successfully';
                } else {
                    mysqli_rollback($conn);
                    // echo "Something went wrong. Book cannot be issued";
                    $msg = 'Something went wrong. Book cannot be issued..!!!';
                }
            } else {
                // echo "user not found";
                $msg = 'user not found ...!!!';
            }
        } else {
            // echo "already issued";
            $msg = 'The book has been already issued to other user';
        }
    } else {
        // echo "Records not found";
        $msg = 'Records not found....!!!';
    }

    // echo $isreturned;
    header("location:issueBook.php?msg=$msg");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/addForm.css">
    <link rel="stylesheet" href="../css/table.css">
    <link rel="stylesheet" href="../Assets/jquery-ui-1.13.1/jquery-ui.css">

    <title>Issue Book</title>
</head>

<body>
    <header>
        <div class="title">
            <h4>Issue Book</h4>
        </div>
    </header>

    <div class="content">
        <!-- message -->
        <?php
        if (isset($_GET['msg']) && !empty($_GET['msg'])) {
        ?>
            <div class="msg" id="impmsg">
                <i class="fa-solid fa-plus cross" onclick="location.href='issueBook.php'"></i>

                <?php
                @$msg = $_GET['msg'];
                echo $msg;
                ?>
            </div>
        <?php } ?>

        <!-- msg end -->
        <main class="form-container">
            <form action="#" method="POST" class="studentForm">

                <?php if (isset($_GET['b'])) {

                    @$book = $_GET['b'];

                ?> <div class="form-group">
                        <label for="bookid">Book uId<span style="color: red;">*</span></label>
                        <input type="text" id="issue-book" value="<?php echo $book ?>" name="bookuid" placeholder="Book Unique Ids" required>
                    </div>
                <?php } else { ?>
                    <div class="form-group">
                        <label for="bookid">Book uId<span style="color: red;">*</span></label>
                        <input type="text" id="issue-book" name="bookuid" placeholder="Book Unique Ids" required>
                    </div> <?php } ?>

                <div class="form-group">
                    <label for="userid">User uId<span style="color: red;">*</span></label>
                    <input type="text" id="user-lib" name="useruid" placeholder="User Unique Ids" required>
                </div>

                <div class="form-row">
                    <div class="form-btn">
                        <input type="submit" class="fbtn" name="issue" value="Issue">
                    </div>
                    <div class="form-btn">
                        <input type="reset" class="fbtn" name="reset" value="Reset">
                    </div>
                </div>
            </form>
        </main>


        <!-- edit issue -->
        <?php require('updateIssueBook.php') ?>
        <!-- Display Category -->

        <?php require('displayIssueBook.php') ?>

    </div>
    <?php require('dataTable.php') ?>
    <script src="../Assets/jquery-ui-1.13.1/jquery-ui.min.js"></script>
    <script type="text/javascript">
        $(function() {
            $("#issue-book").autocomplete({
                source: 'autoCompleteBook.php'
            });

            $("#user-lib").autocomplete({
                source: 'autoComplete.php'
            });
        });
    </script>
</body>

</html>