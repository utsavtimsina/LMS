<?php require('adminHeader.php');
require('../config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/addForm.css">
    <title>Book Details Entry</title>
</head>

<body>
    <header>
        <div class="title">
            <h4>Book Details Entry</h4>
        </div>
        <div class="ex-link">
            <a href="displayBookDetails.php">Manage Book Details</a>
        </div>
        <div class="ex-link">
            <a href="addBookCategory.php">Add Book Category</a>
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
                <i class="fa-solid fa-plus cross" onclick="location.href='addBookDetails.php'"></i>
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
            <form action="insertBookDetails.php" method="POST" class="bookentry">
                <div class="form-row">
                    <div class="form-group">
                        <label for="bname">Book Name (e.g. name e1 - for edition 1) <span style="color: red;">*</span></label>
                        <input type="text" name="bname" placeholder="Book Name" required>
                    </div>
                    <div class="form-group">
                        <label for="bFaculty">Faculty <span style="color: red;">*</span></label>
                        <select name="faculty" required>
                            <option value="none" disabled selected>Select Faculty</option>

                            <?php
                            $query = "SELECT `faculty_name` FROM faculty_tbl";
                            $result = mysqli_query($conn, $query);
                            $num = mysqli_num_rows($result);
                            if (mysqli_num_rows($result) > 0) {
                                while ($rows = mysqli_fetch_assoc($result)) { ?>

                                    <option value="<?php echo $rows['faculty_name']  ?>"><?php echo $rows['faculty_name']  ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subcode">Subject Code <span style="color: red;">*</span></label>
                        <input type="text" name="subcode" placeholder="Subject Code">
                    </div>
                </div>
                <div class="form-row">

                    <div class="form-group">
                        <label for="year">Year <span style="color: red;">*</span></label>
                        <select name="year" id="year" required>

                        <option value="none" disabled selected>Select Year</option>
                        <option value="1st">1st</option>
                        <option value="2nd">2nd</option>
                        <option value="3rd">3rd</option>
                        <option value="4th">4th</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sem">Semester</label>
                        <select name="semester" id="sem" required>

                        <option value="none" disabled selected>Select Semester</option>
                        <option value="1st">1st</option>
                        <option value="2nd">2nd</option>
                        <option value="3rd">3rd</option>
                        <option value="4th">4th</option>
                        <option value="5th">5th</option>
                        <option value="6th">6th</option>
                        <option value="7th">7th</option>
                        <option value="8th">8th</option>

                        </select>
                    </div>


                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="edition">Edition (e.g. 1 for First edition) <span style="color: red;">*</span></label>
                        <input type="text" name="edition" placeholder="Edition" required>
                    </div>

                    <div class="form-group">
                        <label for="category">Category <span style="color: red;">*</span></label>
                        <select name="category" required>
                            <option value="none" disabled selected>Select Category</option>

                            <?php
                            $query = "SELECT `category_name` FROM book_category_tbl";
                            $result = mysqli_query($conn, $query);
                            $num = mysqli_num_rows($result);
                            if (mysqli_num_rows($result) > 0) {
                                while ($rows = mysqli_fetch_assoc($result)) { ?>

                                    <option value="<?php echo $rows['category_name']  ?>"><?php echo $rows['category_name']  ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="rackno">Rack No. <span style="color: red;">*</span></label>
                        <input type="text" name="rackno" placeholder="Enter rack no." required>
                    </div>

                </div>


                <div class="form-row">

                    <div class="form-group">
                        <label for="Publication">Publication <span style="color: red;">*</span></label>
                        <input type="text" name="publication" placeholder="Publication" required>
                    </div>
                    <div class="form-group">
                        <label for="Author">Author <span style="color: red;">*</span></label>
                        <input type="text" name="author" placeholder="author" required>
                    </div>
                    <div class="form-group">
                        <label for="Price">Price (in Rs.) <span style="color: red;">*</span></label>
                        <input type="text" name="price" placeholder="Price of Book" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-btn">
                        <input type="submit" class="fbtn" name="submitbd" value="Add">
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