<?php
require('adminHeader.php');
require('../config.php');
$biid = $_GET['biid'];
$action = $_GET['action'];
// $status = $_GET['status'];

// @$facname = $_GET['faculty_name'];
// @$cname = $_GET['category_name'];

// echo $status;
$sql = "SELECT * FROM `book_tbl` WHERE biid=$biid";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$bookid = $row['bookid'];

if ($action === 'e') {

    $sql = "SELECT * FROM `book_tbl` WHERE biid=$biid";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $bookid = $row['bookid'];
    $isbn = $row['isbn'];
    $sn = $row['sn'];

    $query = "SELECT bid,bname FROM book_details_tbl WHERE book_id='$bookid'";
    $res1 = mysqli_query($conn, $query);
    $row1 = mysqli_fetch_assoc($res1);
    $bname = $row1['bname'];
    $bid=$row1['bid'];
    // echo $bname;

    if (isset($_POST['update'])) {

        $bname = $_POST['bname'];
        $bookid = $_POST['bookid'];
        $sn = $_POST['sn'];
        $isbn = $_POST['isbn'];
        $bookuid = $bookid . $sn;


        //checking bookuid exists or not

        $sql4 = "SELECT bookuid FROM book_tbl WHERE sn=$sn AND bookid='$bookid'";
        $res4 = mysqli_query($conn, $sql4) or die("error4");
        $num4 = mysqli_num_rows($res4);

        if (mysqli_num_rows($res4) > 0) {
            $msg='Record Already Exist';
        } else {
            //fetch book id and name if details exists or not

            $sql1 = "SELECT bid,bname,book_id FROM book_details_tbl WHERE bname='$bname' AND book_id='$bookid'";
            $res1 = mysqli_query($conn, $sql1) or die("error");
            $num = mysqli_num_rows($res1);

            $row1 = mysqli_fetch_assoc($res1);


            if (mysqli_num_rows($res1) > 0) {
                //checking isbn

                $sql2 = "SELECT bookid FROM book_tbl WHERE isbn=$isbn";
                $res2 = mysqli_query($conn, $sql2) or die("error2");
                $num2 = mysqli_num_rows($res2);

                if (mysqli_num_rows($res2) > 0) {
                    $msg='Record Already Exist with Same ISBN';
                } else {

                    $sql = "UPDATE `book_tbl` SET `biid`='$biid',`bookid`='$bookid',`sn`='$sn',`bookuid`='$bookuid',`isbn`='$isbn' WHERE biid=$biid ";
                    $result = mysqli_query($conn, $sql);

                    if ($result) {

                       
                        $msg='Update Success';

                    } else {
                       
                        $msg='Failed to update Record Already Exists';
                    }
                }
            } else {
    
                $msg='Enter Correct Details';
            }
        }

        header("location:profileBookDetails.php?msg=$msg&bid=$bid&action=p");

    } ?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/addForm.css">
        <title>Update Book</title>
    </head>

    <body>

        <header>
            <div class="title">
                <h4>Update Book</h4>
            </div>
            <div class="ex-link">
                <a href="profileBookDetails.php?bid=<?php echo $bid;?>&action=p">Go Back</a>
            </div>
        </header>
        <div class="content">

            <main class="form-container">
                <form action="#" method="POST" class="studentForm">

                    <div class="form-group">
                        <label for="bname">Book Name <span style="color: red;">*</span></label>
                        <select name="bname" required>
                            <option value="none" disabled selected>Select Book Name</option>

                            <?php
                            $query = "SELECT `bname` FROM book_details_tbl";
                            $result = mysqli_query($conn, $query);
                            $num = mysqli_num_rows($result);
                            if (mysqli_num_rows($result) > 0) {
                                while ($rows = mysqli_fetch_assoc($result)) { ?>

                                    <option value="<?php echo $rows['bname']  ?>" <?php if ($bname == $rows['bname']) { echo 'selected'; } ?>><?php echo $rows['bname']  ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="bokid">Book Id <span style="color: red;">*</span></label>
                        <select name="bookid" required>
                            <option value="none" disabled selected>Select Book Id</option>

                            <?php
                            $query = "SELECT `book_id` FROM book_details_tbl";
                            $result = mysqli_query($conn, $query);
                            $num = mysqli_num_rows($result);
                            if (mysqli_num_rows($result) > 0) {
                                while ($rows = mysqli_fetch_assoc($result)) { ?>

                                    <option value="<?php echo $rows['book_id']  ?>" <?php if ($bookid == $rows['book_id']) {echo 'selected'; } ?>><?php echo $rows['book_id']  ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="isbn">ISBN No. <span style="color: red;">*</span></label>
                        <input type="text" name="isbn" value="<?php echo $isbn; ?>" placeholder="ISBN No." required>
                    </div>
                    <div class="form-group">
                        <label for="sn">Serial No. <span style="color: red;">*</span></label>
                        <input type="text" name="sn" value="<?php echo $sn; ?>" placeholder="Serial No." required>
                    </div>
                    <div class="form-row">
                        <div class="form-btn">
                            <input type="submit" class="fbtn" name="update" value="Update">
                        </div>


                        <div class="form-btn">
                            <input type="reset" class="fbtn" name="reset" value="Reset">
                        </div>
                    </div>
                </form>
            </main>
        </div>
    </body>

    </html>

<?php
}

if ($action === 'd') {



    //delete

    $sql = "DELETE FROM `book_tbl` WHERE biid=$biid";
    $result = mysqli_query($conn, $sql);
    if ($result) {

        $sql2 = "UPDATE `book_details_tbl` SET `total_qty`=total_qty-1 , `available_qty`=available_qty-1 WHERE book_id='$bookid'";

        $res2 = mysqli_query($conn, $sql2);

        if ($res2) {
            // echo '<script type="text/javascript">'; 
            // echo 'alert("Deleted successfully");'; 
            // echo 'window.location= "displayBookDetails.php";';
            // echo '</script>'; 

            $msg = 'Deleted Successfully';
        } else {
            // echo '<script type="text/javascript">'; 
            // echo 'alert("Failed");'; 
            // echo 'window.location= "displayBookDetails.php";';
            // echo '</script>'; 
            $msg='Failed to delete';
        }
    } else {
        // echo '<script type="text/javascript">'; 
        //     echo 'alert("Failed");'; 
        //     echo 'window.location= "displayBookDetails.php";';
        //     echo '</script>';
        
        $msg='Deletion Failed';

    }


    $delsql = "SELECT bid FROM book_details_tbl WHERE book_id='$bookid'";
    $delres = mysqli_query($conn,$delsql) or die("error");
    $num = mysqli_num_rows($delres);

    $delrow = mysqli_fetch_assoc($delres);
    $bid = $delrow['bid'];


    header("location:profileBookDetails.php?msg=$msg&bid=$bid&action=p");
}

?>