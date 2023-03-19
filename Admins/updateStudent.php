<?php require('adminHeader.php');
require('../config.php');

$sid = $_GET['sid'];
$action = $_GET['action'];

// @$facname = $_GET['faculty_name'];

if ($action == 'e') {

    $sql = "SELECT * FROM `student_tbl` WHERE `sid`=$sid";
    $result = mysqli_query($conn, $sql) or die('error0');
    $row = mysqli_fetch_assoc($result);

    $batch = $row['batch'];
    $rollno = $row['rollno'];
    $stuid = $row['stuid'];
    $phone = $row['phone'];
    $gender = $row['gender'];
    $idno = $row['idno'];
    $address = $row['address'];
    $fid = $row['faculty_id'];

    $query = "SELECT * FROM faculty_tbl WHERE fid ='$fid'";

    $res = mysqli_query($conn, $query);
    $rowf = mysqli_fetch_assoc($res);

    $facname = $rowf['faculty_name'];

    $sql1 = "SELECT * FROM user_tbl WHERE user_uid= '$stuid' AND `role`='student'";
    $result1 = mysqli_query($conn, $sql1);
    $row1 = mysqli_fetch_assoc($result1);

    $id = $row1['id'];
    $fname = $row1['fname'];
    $mname = $row1['mname'];
    $lname = $row1['lname'];
    $email = $row1['email'];

    $fullname = $fname . " " . $mname . " " . $lname;

    // print_r($row);


    if (isset($_POST['update'])) {

        //reset
        if ($result) {


            $reset = "UPDATE `user_tbl` SET `email`='dummy',`user_uid`='dummy' WHERE `id`='$id'";
            $r = mysqli_query($conn, $reset);

            if (!$r) {
                $msg = 'Couldnt update';
                header("location:displayStudent.php?msg=$msg");
                exit;
            }
        }



        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $mname = $_POST['mname'];
        $faculty = $_POST['faculty'];
        $batch = $_POST['batch'];
        $rollno = $_POST['rollno'];
        $uemail = $_POST['email'];
        $phone = $_POST['phone'];
        $gender = $_POST['gender'];
        $idno = $_POST['idno'];
        $address = $_POST['address'];

        $role = 'student';



        // $password = $fname;


        $query = "SELECT * FROM faculty_tbl WHERE fid ='$faculty'";

        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);

        $faculty_name = $row['faculty_name'];

        $ustuid = $batch . $faculty_name . $rollno;

        $chk_query = "SELECT * FROM user_tbl WHERE `email`='$uemail' OR `user_uid`='$ustuid'";
        $chk_res = mysqli_query($conn, $chk_query);
        if (mysqli_num_rows($chk_res) <= 0) {

            $flag = true;
            mysqli_autocommit($conn, false);


            $update_sql1 = "UPDATE `student_tbl` SET `sid`='$sid',`faculty_id`='$faculty',`batch`='$batch',`rollno`='$rollno',`phone`='$phone',`gender`='$gender',`idno`='$idno',`address`='$address' WHERE `sid`=$sid";


            $update_sql2 = "UPDATE `user_tbl` SET `fname`='$fname',`mname`='$mname',`lname`='$lname',`email`='$uemail',`role`='$role',`user_uid`='$ustuid' WHERE `id`=$id";

            $res1 = mysqli_query($conn, $update_sql1);
            if (!$res1) {
                $flag = false;
                // echo "Error: " . mysqli_error($conn) . ".";
                $msg = "Error: " . mysqli_error($conn) . ".";
            }

            $res2 = mysqli_query($conn, $update_sql2);
            if (!$res2) {
                $flag = false;
                // echo "Error: " . mysqli_error($conn) . ".";
                $msg = "Error: " . mysqli_error($conn) . ".";
            }

            if ($flag) {
                mysqli_commit($conn);
                // echo "Book Issued successfully";
                $msg = 'Updated successfully';
            } else {
                mysqli_rollback($conn);
                // echo "Something went wrong. Book cannot be issued";
                $msg = 'Update Failed..!!!';
            }
        } else {
            $set = "UPDATE `user_tbl` SET `email`='$email',`user_uid`='$stuid' WHERE `id`='$id'";
            $s = mysqli_query($conn, $set);

            if ($s) {
                $msg='User Already Exists';
                header("location:displayStudent.php?msg=$msg");
                exit;
            }
        }



        header("location:displayStudent.php?msg=$msg");
    }
?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/addForm.css">
        <title>Student Form</title>
    </head>

    <body>

        <header>
            <div class="title">
                <h4>Student Registration</h4>
            </div>
            <div class="ex-link">
                <a href="addOtherUser.php">Other User Registration</a>
            </div>
            <div class="ex-link">
                <a href="addFaculty.php">Add Faculty</a>
            </div>
        </header>
        <div class="content">

            <main class="form-container">
                <form action="#" method="POST" class="studentForm">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="fname">First Name <span style="color: red;">*</span></label>
                            <input type="text" value="<?php echo $fname; ?>" name="fname" placeholder="First Name" required>
                        </div>
                        <div class="form-group">
                            <label for="mname">Middle Name</label>
                            <input type="text" value="<?php echo $mname; ?>" name="mname" placeholder="Middle Name">
                        </div>
                        <div class="form-group">
                            <label for="lname">Last Name <span style="color: red;">*</span></label>
                            <input type="text" value="<?php echo $lname; ?>" name="lname" placeholder="Last Name" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="Faculty">Faculty <span style="color: red;">*</span></label>
                            <select name="faculty">
                                <option value="none" disabled selected <?php if ($facname == 'none') {
                                                                            echo 'selected';
                                                                        } ?>>Select Faculty</option>

                                <?php
                                $query = "SELECT * FROM faculty_tbl";
                                $result = mysqli_query($conn, $query);
                                $num = mysqli_num_rows($result);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($rows = mysqli_fetch_assoc($result)) { ?>

                                        <option value="<?php echo $rows['fid']  ?>" <?php if ($facname == $rows['faculty_name']) {
                                                                                        echo 'selected';
                                                                                    } ?>><?php echo $rows['faculty_name']  ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <?php

                        ?>
                        <div class="form-group">
                            <label for="batch">Batch <span style="color: red;">*</span></label>
                            <input type="number" value="<?php echo $batch; ?>" name="batch" min="2000" max="2099" step="1" value="2022" required>
                        </div>
                        <div class="form-group">
                            <label for="roll-no">Roll No.<span style="color: red;">*</span></label>
                            <input type="number" value="<?php echo $rollno; ?>" name="rollno" min="0" step="1" placeholder="Enter Roll No." required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="email">E-Mail <span style="color: red;">*</span></label>
                            <input type="email" value="<?php echo $email; ?>" name="email" placeholder="xyz@gmail.com" required>
                        </div>
                        <div class="form-group">
                            <label for="Phone">Phone No. <span style="color: red;">*</span></label>
                            <input type="tel" value="<?php echo $phone; ?>" name="phone" placeholder="Phone Number" required>
                        </div>
                    </div>
                    <div class="form-row">

                        <div class="form-group">
                            <label for="gender"> Gender <span style="color: red;">*</span> </label>
                            <select name="gender">
                                <option value="none" disabled selected <?php if ($gender == 'none') {
                                                                            echo 'selected';
                                                                        } ?>>Select Your Gender</option>
                                <option value="male" <?php if ($gender == 'male') {
                                                            echo 'selected';
                                                        } ?>>Male</option>
                                <option value="female" <?php if ($gender == 'female') {
                                                            echo 'selected';
                                                        } ?>>Female</option>
                                <option value="other" <?php if ($gender == 'other') {
                                                            echo 'selected';
                                                        } ?>>Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="idno">ID No. (Citizenship No.) <span style="color: red;">*</span></label>
                            <input type="text" value="<?php echo $idno; ?>" name="idno" placeholder="ID Number" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Address<span style="color: red;">*</span></label>
                            <input type="text" class="address" value="<?php echo $address; ?>" name="address" placeholder="Enter Address" required>
                        </div>
                    </div>
                    <div class="form-row">
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

<?php }

if ($action === 'd') {

    $sql = "SELECT * FROM `student_tbl` WHERE `sid`=$sid";
    $result = mysqli_query($conn, $sql) or die('error0');
    $row = mysqli_fetch_assoc($result);

    $stuid = $row['stuid'];
    
    $sql1 = "DELETE FROM `user_tbl` WHERE `user_uid`='$stuid'";
    $result1 = mysqli_query($conn, $sql1);

    if ($result1) {
        $delsql = "DELETE FROM `student_tbl` WHERE `sid`=$sid";
        $delres = mysqli_query($conn, $delsql) or die($msg='error del');

        if ($delres) {
            $msg = 'Deleted';
        } else {
            $msg = 'Deletion Failed';
        }
    } else {
        $msg = 'Failed to Delete!!!';
    }
    header("location:displayStudent.php?msg=$msg");
}

?>