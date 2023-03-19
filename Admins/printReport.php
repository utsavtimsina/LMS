<?php
require('../config.php');

if (isset($_GET['start'])) {

    $startdate = $_GET['start'];
    $enddate = $_GET['end'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @page {
            size: auto;
            margin: 2cm;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
        }
    </style>
    <title>Print</title>
</head>

<body onload="print();">

    <?php if (isset($_GET['start']) && isset($_GET['end'])) {
    ?>

        <p style="background-color: white; padding:5px;border-radius:5px;"> <?php if (!empty($_GET['start']) && !empty($_GET['end'])) {
                                                                            ?><b>Report From: <span id="date1"><?php echo $startdate ?></span> To: <span id="date2"><?php echo $enddate ?></span></b></p>
    <?php
                                                                            } else {
                                                                                echo '<b>Report Until Today</b>';
                                                                            }

    ?>

<?php
    } ?>

<!-- issued -->
<section class="table-container">
    <table class="table">
        <caption>
            <h3>Issued Book</h3>
        </caption>
        <thead>
            <tr>
                <th>#</th>
                <th>Txn No.</th>
                <th>Book uId</th>
                <th>Book Name</th>
                <th>User uId</th>
                <th>User Name</th>
                <th>Issued Date</th>
                <th>Returned Date</th>
                <th>Fine</th>
                <th>Return Status</th>

            </tr>
        </thead>
        <tbody>

            <?php
            $counter = 0;

            if (isset($_GET['start']) && isset($_GET['end']) && !empty($startdate) && !empty($enddate)) {


                $sql = "SELECT * FROM `issue_tbl` WHERE CAST(`issued_date` AS DATE) BETWEEN DATE('$startdate') AND DATE('$enddate') ORDER BY `issued_date` DESC";
                $result = mysqli_query($conn, $sql);
                $num = mysqli_num_rows($result);
            } else {

                $sql = "SELECT * FROM `issue_tbl` ORDER BY `timestamp` DESC";
                $result = mysqli_query($conn, $sql);
                $num = mysqli_num_rows($result);
            }





            if ($num > 0) {
                while ($rows = mysqli_fetch_assoc($result)) {

                    $txn_no = $rows['txn_no'];
                    $book_uid = $rows['book_uid'];
                    $user_uid = $rows['user_uid'];
                    $issued_date = $rows['issued_date'];
                    $returnrd_date = $rows['returned_date'];
                    $fine = $rows['fine'];
                    $return_status = $rows['return_status'];
            ?>

                    <tr>
                        <?php

                        $query1 = "SELECT book_details_tbl.bname FROM book_details_tbl INNER JOIN book_tbl ON book_details_tbl.book_id = book_tbl.bookid INNER JOIN issue_tbl ON book_tbl.bookuid=issue_tbl.book_uid WHERE issue_tbl.book_uid='$book_uid'";

                        $result1 = mysqli_query($conn, $query1);
                        $row1 = mysqli_fetch_assoc($result1);

                        $bname = $row1['bname'];

                        $query3 = "SELECT * FROM user_tbl WHERE `user_uid`='$user_uid'";
                        $result3 = mysqli_query($conn, $query3);
                        $num3 = mysqli_num_rows($result3);

                        if ($num3 > 0) {
                            $row3 = mysqli_fetch_assoc($result3);
                            $fname = $row3['fname'];
                            $mname = $row3['mname'];
                            $lname = $row3['lname'];

                            $name = $fname . " " . $mname . " " . $lname;
                        }






                        ?>
                        <td><?php echo ++$counter; ?></td>
                        <td><?php echo $txn_no; ?></td>
                        <td><?php echo $book_uid; ?></td>
                        <td><?php echo $bname; ?></td>
                        <td><?php echo $user_uid; ?></td>
                        <td><?php echo $name; ?></td>
                        <td><?php echo $issued_date; ?></td>
                        <td><?php echo $returnrd_date; ?></td>
                        <td><?php echo $fine; ?></td>
                        <td><?php echo $return_status; ?></td>
                    </tr>

            <?php }
            }

            ?>



        </tbody>
    </table>
</section>
<!-- end issued -->

<br><br>
<!-- returned -->
<section class="table-container">
    <table class="table">
        <caption>
            <h3>Returned Book</h3>
        </caption>
        <thead>
            <tr>
                <th>#</th>
                <th>Txn No.</th>
                <th>Book uId</th>
                <th>Book Name</th>
                <th>User uId</th>
                <th>User Name</th>
                <th>Issued Date</th>
                <th>Returned Date</th>
                <th>Fine</th>
                <th>Return Status</th>


            </tr>
        </thead>
        <tbody>

            <?php
            $counter = 0;

            if (isset($_GET['start']) && isset($_GET['end']) && !empty($startdate) && !empty($enddate)) {

                $sql1 = "SELECT * FROM `issue_tbl` WHERE `return_status`='returned' AND CAST(`returned_date` AS DATE) BETWEEN DATE('$startdate') AND DATE('$enddate') ORDER BY `returned_date` DESC";
                $res = mysqli_query($conn, $sql1);
                $num1 = mysqli_num_rows($res);
            } else {

                $sql1 = "SELECT * FROM `issue_tbl` WHERE `return_status`='returned' ORDER BY `timestamp` DESC";
                $res = mysqli_query($conn, $sql1);
                $num1 = mysqli_num_rows($res);
            }





            if ($num1 > 0) {
                while ($rows = mysqli_fetch_assoc($res)) {

                    $txn_no = $rows['txn_no'];
                    $book_uid = $rows['book_uid'];
                    $user_uid = $rows['user_uid'];
                    $issued_date = $rows['issued_date'];
                    $returnrd_date = $rows['returned_date'];
                    $fine = $rows['fine'];
                    $return_status = $rows['return_status'];
            ?>

                    <tr>
                        <?php

                        $query1 = "SELECT book_details_tbl.bname FROM book_details_tbl INNER JOIN book_tbl ON book_details_tbl.book_id = book_tbl.bookid INNER JOIN issue_tbl ON book_tbl.bookuid=issue_tbl.book_uid WHERE issue_tbl.book_uid='$book_uid'";

                        $result1 = mysqli_query($conn, $query1);
                        $row1 = mysqli_fetch_assoc($result1);

                        $bname = $row1['bname'];

                        $query3 = "SELECT * FROM user_tbl WHERE `user_uid`='$user_uid'";
                        $result3 = mysqli_query($conn, $query3);
                        $num3 = mysqli_num_rows($result3);

                        if ($num3 > 0) {
                            $row3 = mysqli_fetch_assoc($result3);
                            $fname = $row3['fname'];
                            $mname = $row3['mname'];
                            $lname = $row3['lname'];

                            $name = $fname . " " . $mname . " " . $lname;
                        }






                        ?>
                        <td><?php echo ++$counter; ?></td>
                        <td><?php echo $txn_no; ?></td>
                        <td><?php echo $book_uid; ?></td>
                        <td><?php echo $bname; ?></td>
                        <td><?php echo $user_uid; ?></td>
                        <td><?php echo $name; ?></td>
                        <td><?php echo $issued_date; ?></td>
                        <td><?php echo $returnrd_date; ?></td>
                        <td><?php echo $fine; ?></td>
                        <td><?php echo $return_status; ?></td>

                    </tr>

            <?php }
            }

            ?>



        </tbody>
    </table>
</section>
<!-- end return -->
<br>
<br>


<div>
    Total Issued:<?php echo $num ?><br>
    Total Returned:<?php echo $num1 ?>
</div>

</body>

</html>