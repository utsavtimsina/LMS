<?php require('adminHeader.php');
require('../config.php');

if (isset($_POST['register'])) {

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $mname = $_POST['mname'];
    $faculty = $_POST['faculty'];
    $batch = $_POST['batch'];
    $rollno = $_POST['rollno'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $idno = $_POST['idno'];
    $address = $_POST['address'];

    $password = $fname;
    $role = 'student';

    $query = "SELECT * FROM faculty_tbl WHERE fid ='$faculty'";

    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    $faculty_name = $row['faculty_name'];

    $stuid = $batch . $faculty_name . $rollno;

    $chk_query = "SELECT * FROM user_tbl WHERE `email`='$email' OR `user_uid`='$stuid'";
    $chk_res = mysqli_query($conn, $chk_query);
    if (mysqli_num_rows($chk_res) <= 0) {



        $flag = true;

        mysqli_autocommit($conn, false);

        $sql1 = "INSERT INTO `user_tbl`(`fname`, `mname`, `lname`, `email`, `role`, `user_uid`, `password`) VALUES ('$fname','$mname','$lname','$email','$role','$stuid','$password')";

        $sql2 = "INSERT INTO `student_tbl`(`faculty_id`, `batch`, `rollno`, `stuid`, `phone`, `gender`, `idno`, `address`) VALUES ('$faculty','$batch','$rollno','$stuid','$phone','$gender','$idno','$address')";

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

        if ($flag) {
            mysqli_commit($conn);
            // echo "Book Issued successfully";
            $msg = 'Registered successfully';
        } else {
            mysqli_rollback($conn);
            // echo "Something went wrong. Book cannot be issued";
            $msg = 'Something went wrong. Registration Failed..!!!';
        }
    } else {
        $msg = 'User Already Exists';
    }

    header("location:addStudent.php?msg=$msg");
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
        <!-- message -->
        <?php
        if (isset($_GET['msg']) && !empty($_GET['msg'])) {
        ?>
            <div class="msg" id="impmsg">
                <i class="fa-solid fa-plus cross" onclick="location.href='addStudent.php'"></i>
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
                <div class="form-row">
                    <div class="form-group">
                        <label for="fname">First Name <span style="color: red;">*</span></label>
                        <input type="text" name="fname" placeholder="First Name" required>
                    </div>
                    <div class="form-group">
                        <label for="mname">Middle Name</label>
                        <input type="text" name="mname" placeholder="Middle Name">
                    </div>
                    <div class="form-group">
                        <label for="lname">Last Name <span style="color: red;">*</span></label>
                        <input type="text" name="lname" placeholder="Last Name" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="Faculty">Faculty <span style="color: red;">*</span></label>
                        <select name="faculty">
                            <option value="none" selected>Select Faculty</option>

                            <?php
                            $query = "SELECT * FROM faculty_tbl";
                            $result = mysqli_query($conn, $query);
                            $num = mysqli_num_rows($result);
                            if (mysqli_num_rows($result) > 0) {
                                while ($rows = mysqli_fetch_assoc($result)) { ?>

                                    <option value="<?php echo $rows['fid']  ?>"><?php echo $rows['faculty_name']  ?></option>
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
                        <input type="number" name="batch" min="2000" max="2099" step="1" value="2022" required>
                    </div>
                    <div class="form-group">
                        <label for="roll-no">Roll No.<span style="color: red;">*</span></label>
                        <input type="number" name="rollno" min="0" step="1" placeholder="Enter Roll No." required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="email">E-Mail <span style="color: red;">*</span></label>
                        <input type="email" name="email" placeholder="xyz@gmail.com" required>
                    </div>
                    <div class="form-group">
                        <label for="Phone">Phone No. <span style="color: red;">*</span></label>
                        <input type="tel" name="phone" placeholder="Phone Number" required>
                    </div>
                </div>
                <div class="form-row">
                    <!-- <div class="form-group">
                        <label for="dob">DOB (AD.) <span style="color: red;">*</span></label>
                        <input type="date" name="dob" required>
                    </div> -->

                    <div class="form-group">
                        <label for="gender"> Gender <span style="color: red;">*</span> </label>
                        <select name="gender">
                            <option value="none" selected>Select Your Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="idno">ID No. (Citizenship No.) <span style="color: red;">*</span></label>
                        <input type="text" name="idno" placeholder="ID Number" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address<span style="color: red;">*</span></label>
                        <input type="text" class="address" name="address" placeholder="Enter Address" required>
                    </div>
                </div>
                <div class="form-row">

                    <!-- <div class="form-group">
                        <label for="saddress">Street Address (Address line 2.) <span style="color: red;">*</span></label>
                        <input type="text" class="address" name="saddress" placeholder="Enter Street Address" required>
                    </div> -->
                </div>
                <div class="form-row">
                    <div class="form-btn">
                        <input type="submit" class="fbtn" name="register" value="Register">
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