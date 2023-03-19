<?php require('adminHeader.php');
require('../config.php');

if (isset($_POST['return'])) {

    // $bookuid=$_POST['bookuid'];
    $bookuid = strtoupper($_POST['bookuid']);
    $useruid = strtoupper($_POST['useruid']);

    //fetch book
    $issueQuery1 = "SELECT * FROM issue_tbl WHERE book_uid='$bookuid' AND user_uid='$useruid'";
    $issueResult1 = mysqli_query($conn, $issueQuery1);
    // $issueRow1 = mysqli_fetch_assoc($issueResult1);

    if (mysqli_num_rows($issueResult1) > 0) {

        while ($issueRow1 = mysqli_fetch_assoc($issueResult1)) {

            $return_status = $issueRow1['return_status'];
            $txn_no = $issueRow1['txn_no'];

            if ($return_status === 'issued') {

                //fetch book tbl
                $issueQuery2 = "SELECT * FROM book_tbl WHERE bookuid='$bookuid'";
                $issueResult2 = mysqli_query($conn, $issueQuery2);
                $issueRow2 = mysqli_fetch_assoc($issueResult2);

                if (mysqli_num_rows($issueResult2) > 0) {
                    $bookid = $issueRow2['bookid'];
                }


                //book return

                date_default_timezone_set("Asia/Kathmandu");
                $returned_date = date('Y-m-d H:i:s');
                $timestamp = date('Y-m-d H:i:s');
                // echo $returned_date;


                mysqli_autocommit($conn, false);

                $flag = true;

                $sql1 = "UPDATE `issue_tbl` SET `txn_no`='$txn_no',`returned_date`='$returned_date',`return_status`='returned',`timestamp`='$timestamp' WHERE `txn_no`=$txn_no";

                $sql2 = "UPDATE `book_tbl` SET `returned_date`='$returned_date',`isreturned`='true' WHERE bookuid='$bookuid' ";

                $sql3 = "UPDATE `book_details_tbl` SET `issued_qty`=issued_qty-1,`available_qty`=available_qty+1 WHERE book_id='$bookid'";

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
                    $msg = 'Book Returned successfully';
                } else {
                    mysqli_rollback($conn);
                    // echo "Something went wrong. Book cannot be issued";
                    $msg = 'Something went wrong. Book cannot be returned..!!!';
                }
            } else {
                // echo "already issued";
                $msg = 'The book is not issued to user';
            }
        }
    } else {
        // echo "Records not found";
        $msg = 'Records not found....!!!';
    }

    // echo $isreturned;
    header("location:returnBook.php?msg=$msg");
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

  
    <title>Return Book</title>
</head>

<body>
    <header>
        <div class="title">
            <h4>Return Book</h4>
        </div>
    </header>

    <div class="content">
        <!-- message -->
        <?php
        if (isset($_GET['msg']) && !empty($_GET['msg'])) {
        ?>
            <div class="msg" id="impmsg">
                <i class="fa-solid fa-plus cross" onclick="location.href='returnBook.php'"></i>
                <!-- window.location.reload('true');
                document.getElementById('impmsg').style.display='none'; -->
                <?php
                @$msg = $_GET['msg'];
                echo $msg;
                ?>
            </div>
        <?php } ?>

        <!-- msg end -->
        <main class="form-container">
            <form action="#" method="POST" class="studentForm">

                <?php if (isset($_GET['b']) && isset($_GET['u'])) {

                    @$book = $_GET['b'];
                    @$user = $_GET['u'];
                ?>

                    <div class="form-group">
                        <label for="bookid">Book uId<span style="color: red;">*</span></label>
                        <input type="text" id="return-book" value="<?php echo $book ?>" name="bookuid" placeholder="Book Unique Ids" required>
                    </div>
                    <div class="form-group">
                        <label for="userid">User uId<span style="color: red;">*</span></label>
                        <input type="text" id="user-lib" value="<?php echo $user ?>" name="useruid" placeholder="User Unique Ids" required>
                    </div>
                <?php  } else {
                ?>

                    <div class="form-group">
                        <label for="bookid">Book uId<span style="color: red;">*</span></label>
                        <input type="text" id="return-book" name="bookuid" placeholder="Book Unique Ids" required>
                    </div>
                    <div class="form-group">
                        <label for="userid">User uId<span style="color: red;">*</span></label>
                        <input type="text" id="user-lib" name="useruid" placeholder="User Unique Ids" required>
                    </div>

                <?php
                }
                ?>




                <div class="form-row">
                    <div class="form-btn">
                        <input type="submit" class="fbtn" name="return" value="Return">
                    </div>
                    <div class="form-btn">
                        <input type="reset" class="fbtn" name="reset" value="Reset">
                    </div>
                </div>
            </form>
        </main>

        <!-- Display Category -->

        <?php require('displayReturnBook.php') ?>
    </div>

    <?php require('dataTable.php') ?>
    <script src="../Assets/jquery-ui-1.13.1/jquery-ui.min.js"></script>
    <script type="text/javascript">
        $(function() {
            $("#return-book").autocomplete({
                source: 'autoCompleteBook.php'
            });

            $("#user-lib").autocomplete({
                source: 'autoCompleteUser.php'
            });
        });
    </script>
</body>

</html>