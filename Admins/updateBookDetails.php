<?php
require('adminHeader.php');
require('../config.php');
$bid = $_GET['bid'];
$action = $_GET['action'];
// $action='e';
//getting fac and cat name

// $facname=$_GET['faculty_name'];
// $cname=$_GET['category_name'];

//prev bookid select
$sql22 = "SELECT * FROM `book_details_tbl` WHERE bid=$bid";
$result22 = mysqli_query($conn, $sql22) or die('ggfhf');
$row22 = mysqli_fetch_assoc($result22);
$bookidp = $row22['book_id'];

//edit

if ($action == 'e') {

    $sql = "SELECT * FROM `book_details_tbl` WHERE bid=$bid";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $bname = $row['bname'];
    $faculty_id = $row['faculty_id'];
    $subcode = $row['subcode'];
    $year = $row['year'];
    $semester = $row['semester'];
    $edition = $row['edition'];
    $category_id = $row['category_id'];
    $publication = $row['publication'];
    $author = $row['author'];
    $price = $row['price'];
    $rack = $row['rack_no'];




    $query1 = "SELECT category_name FROM book_category_tbl WHERE cid= $category_id;";
    $res1 = mysqli_query($conn, $query1);
    $row1 = mysqli_fetch_assoc($res1);
    $cname = $row1['category_name'];


    $query2 = "SELECT faculty_name FROM faculty_tbl WHERE fid= $faculty_id";
    $res2 = mysqli_query($conn, $query2);
    $row2 = mysqli_fetch_assoc($res2);
    $facname = $row2['faculty_name'];
    // print_r($row);
    // print_r($row1);
    // print_r($row2);






    if (isset($_POST['updatebd'])) {

        //reset
        if ($res1 && $res2) {


            $reset = "UPDATE `book_details_tbl` SET `book_id`='dummy' WHERE bid=$bid";
            $r = mysqli_query($conn, $reset);

            if (!$r) {
                $msg = 'Couldnt update';
                header("location:displayBookDetails.php?msg=$msg");
                exit;
            }
        }

        $bname = $_POST['bname'];
        $faculty = $_POST['faculty'];
        $subcode = $_POST['subcode'];
        $year = $_POST['year'];
        $semester = $_POST['semester'];
        $edition = $_POST['edition'];
        $category = $_POST['category'];
        $publication = $_POST['publication'];
        $author = $_POST['author'];
        $price = $_POST['price'];
        $rack_no = $_POST['rackno'];

        $book_id = $edition . $faculty . $subcode;
        $query1 = "SELECT fid FROM faculty_tbl WHERE faculty_name ='$faculty'";

        $query2 = "SELECT cid FROM book_category_tbl WHERE category_name = '$category'";

        $result1 = mysqli_query($conn, $query1);
        $row1 = mysqli_fetch_assoc($result1);

        $result2 = mysqli_query($conn, $query2);
        $row2 = mysqli_fetch_assoc($result2);

        $faculty_id = $row1['fid'];
        $category_id = $row2['cid'];



        $chk_query = "SELECT * FROM book_details_tbl WHERE `book_id`='$book_id'";
        $chk_res = mysqli_query($conn, $chk_query);
        if (mysqli_num_rows($chk_res) <= 0) {

            $flag = true;

            mysqli_autocommit($conn, false);

            echo "first" . $book_id . "<br>";

            $update_sql = "UPDATE `book_details_tbl` SET `bid`='$bid',`bname`='$bname',`book_id`='$book_id',`faculty_id`='$faculty_id',`subcode`='$subcode',`year`='$year',`semester`='$semester',`edition`='$edition',`category_id`='$category_id',`publication`='$publication',`author`='$author',`rack_no`='$rack_no',`price`='$price' WHERE bid=$bid";


            $update_b = "UPDATE `book_tbl` SET `bookid`='$book_id' WHERE bookid='$bookidp'";


            $res_u = mysqli_query($conn, $update_sql);
            if (!$res_u) {
                $flag = false;
                // echo "Error: " . mysqli_error($conn) . ".";
                $msg = "Error: " . mysqli_error($conn) . ".";
            }

            $res_b = mysqli_query($conn, $update_b);
            if (!$res_b) {
                $flag = false;
                // echo "Error: " . mysqli_error($conn) . ".";
                $msg = "Error: " . mysqli_error($conn) . ".";
            }

            if ($flag) {
                mysqli_commit($conn);

                $selb = "SELECT * FROM `book_tbl` WHERE bookid='$book_id'";
                $selb_res = mysqli_query($conn, $selb);
                mysqli_commit($conn);
                $selb_num = mysqli_num_rows($selb_res);

                if ($selb_num > 0) {
                    while ($selb_row = mysqli_fetch_assoc($selb_res)) {

                        $sn = $selb_row['sn'];
                        $snb = $selb_row['bookuid'];
                        $book_uid = $book_id . $sn;


                        echo $book_id . "<br>";
                        echo $sn . "<br>";
                        // echo $snb . "<br>";
                        echo "fst".$book_uid . "<br>";


                        $null_b = "UPDATE `book_tbl` SET `bookuid`='dummy' WHERE bookid='$book_id' AND `sn`='$sn'";
                        $null_r = mysqli_query($conn, $null_b) or die($msg = 'vayena');
                        mysqli_commit($conn);

                        if ($null_r) {
                            echo "sec".$book_uid . "<br>";

                            $null_update = "UPDATE `book_tbl` SET `bookuid`='$book_uid' WHERE bookid='$book_id' AND `sn`='$sn'";
                            $null_res = mysqli_query($conn, $null_update);
                            mysqli_commit($conn);

                            if (!$null_res) {

                                //3
                                // echo 'sfoom';
                                $msg = 'cant update in book';
                            }
                           // 4
                            // else{
                            //     echo 'sucbbuid';
                            // }

                        }
                        // else {
                        //     echo 'no null';
                        // }
                    }
                }
                $msg = 'Updated Successfully!!!';
            } else {
                mysqli_rollback($conn);
                // echo 'f';
                $msg = 'Failed to Update!!!';
            }
        } else {

            $set = "UPDATE `book_details_tbl` SET `book_id`='$bookidp' WHERE bid=$bid";
            $s = mysqli_query($conn, $set);

            if ($s) {
                $msg = 'Record Already Exists';
                header("location:displayBookDetails.php?msg=$msg");
                exit;
            }
            $msg = 'Record Already Exists';
        }

        header("location:displayBookDetails.php?msg=$msg");
    }
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/addForm.css">
        <title>Update Book Details</title>
    </head>

    <body>
        <header>
            <div class="title">
                <h4>Update Book Details</h4>
            </div>
        </header>
        <div class="content">
            <main class="form-container">
                <form action="#" method="POST" class="bookentry">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="bname">Book Name (e.g. name e1 - for edition 1) <span style="color: red;">*</span></label>
                            <input type="text" value="<?php echo $bname; ?>" name="bname" placeholder="Book Name" required>
                        </div>
                        <div class="form-group">
                            <label for="bFaculty">Faculty <span style="color: red;">*</span></label>
                            <select name="faculty">
                                <option value="none" disabled <?php if ($facname == 'none') {
                                                                    echo 'selected';
                                                                } ?>>Select Faculty</option>

                                <?php
                                $query = "SELECT `faculty_name` FROM faculty_tbl";
                                $result = mysqli_query($conn, $query);
                                $num = mysqli_num_rows($result);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($rows = mysqli_fetch_assoc($result)) { ?>

                                        <option value="<?php echo $rows['faculty_name']  ?>" <?php if ($facname == $rows['faculty_name']) {
                                                                                                    echo 'selected';
                                                                                                } ?>><?php echo $rows['faculty_name']  ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="subcode">Subject Code <span style="color: red;">*</span></label>
                            <input type="text" value="<?php echo $subcode; ?>" name="subcode" placeholder="Subject Code">
                        </div>
                    </div>
                    <div class="form-row">

                        <div class="form-group">
                            <label for="year">Year <span style="color: red;">*</span></label>
                            <select name="year" id="year">

                                <option value="none" disabled <?php if ($year == 'none') {
                                                                    echo 'selected';
                                                                } ?>>Select Year</option>
                                <option value="1st" <?php if ($year == '1st') {
                                                        echo 'selected';
                                                    } ?>>1st</option>
                                <option value="2nd" <?php if ($year == '2nd') {
                                                        echo 'selected';
                                                    } ?>>2nd</option>
                                <option value="3rd" <?php if ($year == '3rd') {
                                                        echo 'selected';
                                                    } ?>>3rd</option>
                                <option value="4th" <?php if ($year == '4th') {
                                                        echo 'selected';
                                                    } ?>>4th</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sem">Semester</label>
                            <select name="semester" id="sem">

                                <option value="none" disabled <?php if ($semester == 'none') {
                                                                    echo 'selected';
                                                                } ?>>Select Semester</option>
                                <option value="1st" <?php if ($semester == '1st') {
                                                        echo 'selected';
                                                    } ?>>1st</option>
                                <option value="2nd" <?php if ($semester == '2nd') {
                                                        echo 'selected';
                                                    } ?>>2nd</option>
                                <option value="3rd" <?php if ($semester == '3rd') {
                                                        echo 'selected';
                                                    } ?>>3rd</option>
                                <option value="4th" <?php if ($semester == '4th') {
                                                        echo 'selected';
                                                    } ?>>4th</option>
                                <option value="5th" <?php if ($semester == '5th') {
                                                        echo 'selected';
                                                    } ?>>5th</option>
                                <option value="6th" <?php if ($semester == '6th') {
                                                        echo 'selected';
                                                    } ?>>6th</option>
                                <option value="7th" <?php if ($semester == '7th') {
                                                        echo 'selected';
                                                    } ?>>7th</option>
                                <option value="8th" <?php if ($semester == '8th') {
                                                        echo 'selected';
                                                    } ?>>8th</option>

                            </select>
                        </div>


                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="edition">Edition (e.g. 1 for First edition) <span style="color: red;">*</span></label>
                            <input type="text" value="<?php echo $edition; ?>" name="edition" placeholder="Edition" required>
                        </div>

                        <div class="form-group">
                            <label for="category">Category <span style="color: red;">*</span></label>
                            <select name="category">
                                <option value="none" disabled <?php if ($cname == 'none') {
                                                                    echo 'selected';
                                                                } ?>>Select Category</option>

                                <?php
                                $query = "SELECT `category_name` FROM book_category_tbl";
                                $result = mysqli_query($conn, $query);
                                $num = mysqli_num_rows($result);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($rows = mysqli_fetch_assoc($result)) { ?>

                                        <option value="<?php echo $rows['category_name']  ?>" <?php if ($cname == $rows['category_name']) {
                                                                                                    echo 'selected';
                                                                                                } ?>><?php echo $rows['category_name']  ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="rackno">Rack No. <span style="color: red;">*</span></label>
                            <input type="text" value="<?php echo $rack; ?>" name="rackno" placeholder="Enter rack no." required>
                        </div>

                    </div>


                    <div class="form-row">

                        <div class="form-group">
                            <label for="Publication">Publication <span style="color: red;">*</span></label>
                            <input type="text" value="<?php echo $publication; ?>" name="publication" placeholder="Publication" required>
                        </div>
                        <div class="form-group">
                            <label for="Author">Author <span style="color: red;">*</span></label>
                            <input type="text" value="<?php echo $author; ?>" name="author" placeholder="author" required>
                        </div>
                        <div class="form-group">
                            <label for="Price">Price (in Rs.) <span style="color: red;">*</span></label>
                            <input type="text" value="<?php echo $price; ?>" name="price" placeholder="Price of Book" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-btn">
                            <input type="submit" class="fbtn" name="updatebd" value="Update">
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
//delete

if ($action === 'd') {
    $sql = "DELETE FROM `book_details_tbl` WHERE bid=$bid";
    $result = mysqli_query($conn, $sql);
    if ($result) {

        $msg = 'Deleted Successfully!!!';
    } else {
        // echo "<script>alert('Failed to update Category');</script>";
        $msg = 'Failed to Delete!!!';
    }
    header("location:displayBookDetails.php?msg=$msg");
}

?>