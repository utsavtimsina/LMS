<?php
require('../config.php');

if (isset($_POST['submitbd'])) {

    $bname = $_POST['bname'];
    $faculty = $_POST['faculty'];
    $subcode = strtoupper($_POST['subcode']);
    $year = $_POST['year'];
    $semester = $_POST['semester'];
    $edition = $_POST['edition'];
    $category = $_POST['category'];
    $publication = $_POST['publication'];
    $author = $_POST['author'];
    $price = $_POST['price'];
    $rackno = $_POST['rackno'];

    print_r($_POST);

    $book_id = $edition . $faculty . $subcode;
    $query = "SELECT faculty_tbl.fid, book_category_tbl.cid
        FROM faculty_tbl , book_category_tbl 
        WHERE faculty_tbl.faculty_name ='$faculty' AND book_category_tbl.category_name = '$category'";

    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    $faculty_id = $row['fid'];
    $category_id = $row['cid'];

    // echo $row['fid']." ".$row['cid'];


    // print_r($_POST);
    // echo $book_id;
    $chk_query = "SELECT * FROM book_details_tbl WHERE `book_id`='$book_id'";
    $chk_res = mysqli_query($conn, $chk_query);
    if (mysqli_num_rows($chk_res) <= 0) {

        $sql = "INSERT INTO `book_details_tbl`(`bname`, `book_id`, `faculty_id`, `subcode`, `year`, `semester`, `edition`,`rack_no`, `category_id`, `publication`, `author`, `price`) VALUES ('$bname','$book_id','$faculty_id','$subcode','$year','$semester','$edition','$rackno','$category_id','$publication','$author','$price')";

        $result1 = mysqli_query($conn, $sql) or die('ghhsdh');
        if ($result1) {
            $msg = 'Added Successfully!!!';
        } else {
            $msg = 'Failed to Add!!!';
        }
    } else {
        $msg = 'Record Already Exists';
    }
    header("location:addBookDetails.php?msg=$msg");
}
