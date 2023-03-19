<?php require('adminHeader.php');
require('../config.php');

$lid = $_GET['lid'];
$action = $_GET['action'];

if ($action == 'e') {

    $sql = "SELECT * FROM `lib_tbl` WHERE lid=$lid";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $fname = $row['fname'];
    $mname = $row['mname'];
    $lname = $row['lname'];
    $email = $row['email'];
    $empid = $row['empid'];


    if (isset($_POST['update'])) {

        //reset
        if ($result) {


            $reset = "UPDATE `lib_tbl` SET `email`='dummy',`empid`='dummy' WHERE `lid`='$lid'";
            $r = mysqli_query($conn, $reset);

            if (!$r) {
                $msg = 'Couldnt update';
                header("location:addLibrarian.php?msg=$msg");
                exit;
            }
        }

        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $uemail = $_POST['email'];
        $uempid = $_POST['empid'];

        // $password = $fname;
        $role = 'librarian';


        $chk_query = "SELECT * FROM lib_tbl WHERE `email`='$uemail' OR `empid`='$uempid'";
        $chk_res = mysqli_query($conn, $chk_query);
        if (mysqli_num_rows($chk_res) <= 0) {

            $update_sql = "UPDATE `lib_tbl` SET `lid`='$lid',`fname`='$fname',`mname`='$mname',`lname`='$lname',`email`='$uemail',`empid`='$uempid',`role` = '$role' WHERE lid=$lid";

        $result = mysqli_query($conn, $update_sql);

        if ($result) {
            $msg = 'Updated Succesfully';
        } else {
            $msg = 'Update Failed!!!';
        }

        } else {

            $set = "UPDATE `lib_tbl` SET `email`='$email',`empid`='$empid' WHERE `lid`='$lid'";
            $s = mysqli_query($conn, $set);

            if ($s) {
                $msg='User Already Exists';
                header("location:addLibrarian.php?msg=$msg");
                exit;
            }
            
        }

        

        header("location:addLibrarian.php?msg=$msg");
    }
?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/table.css">
        <link rel="stylesheet" href="css/addForm.css">
        <title>Update Librarian</title>
    </head>

    <body>
        <header>
            <div class="title">
                <h4>Add Librarian</h4>
            </div>
            <div class="ex-link">
                <a href="addLibrarian.php">Add Librarian</a>
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
                            <label for="email">E-Mail <span style="color: red;">*</span></label>
                            <input type="email" value="<?php echo $email; ?>" name="email" placeholder="xyz@gmail.com" required>
                        </div>
                        <div class="form-group">
                            <label for="empid">Empyoyee ID <span style="color: red;">*</span></label>
                            <input type="text" value="<?php echo $empid; ?>" name="empid" placeholder="Employee ID" required>
                        </div>
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
        <?php require('displayLibrarian.php') ?>
    </body>

    </html>

<?php }

if ($action === 'd') {

    $sql = "DELETE FROM `lib_tbl` WHERE lid=$lid";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        
        $msg = 'Deleted';
        
    } else {
        $msg = 'Failed to Delete!!!';
    }
    header("location:addLibrarian.php?msg=$msg");
}

?>