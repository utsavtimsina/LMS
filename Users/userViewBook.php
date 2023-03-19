<?php require('userHeader.php');
require('../config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/table.css">
    <link rel="stylesheet" href="../Admins/css/addForm.css">
    <link rel="stylesheet" href="../Admins/css/pagination.css">
    <title>Book Details</title>
</head>

<body>
    <header>
        <div class="title">
            <h4>Book Details</h4>
        </div>
    </header>
    <div class="content">
        <section class="table-container">
            <table class="table" id="myTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Book Name</th>
                        <th>Book Id</th>
                        <th>Faculty</th>
                        <th>Sub Code</th>
                        <th>Year/Sem</th>
                        <th>Edition</th>
                        <th>Category</th>
                        <th>Publications</th>
                        <th>Author</th>
                        <th>Available Qty</th>


                    </tr>
                </thead>
                <tbody>

                    <?php


                    $counter = 0;

                    $sql = "SELECT * FROM `book_details_tbl`";
                    $result = mysqli_query($conn, $sql);
                    $num = mysqli_num_rows($result);


                    
                    if ($num > 0) {
                        while ($rows = mysqli_fetch_assoc($result)) {

                            $query1 = "SELECT faculty_name FROM faculty_tbl WHERE fid= $rows[faculty_id]";
                            $res1 = mysqli_query($conn, $query1);
                            $row1 = mysqli_fetch_assoc($res1);

                            $query2 = "SELECT category_name FROM book_category_tbl WHERE cid= $rows[category_id];";
                            $res2 = mysqli_query($conn, $query2);
                            $row2 = mysqli_fetch_assoc($res2);



                    ?>

                            <tr>
                                <td><?php echo ++$counter; ?></td>
                                <td><?php echo $rows['bname'] ?></td>
                                <td><?php echo $rows['book_id'] ?></td>
                                <td><?php echo $row1['faculty_name'] ?></td>
                                <td><?php echo $rows['subcode'] ?></td>
                                <td><?php echo $rows['year'] . " / " . $rows['semester'] ?></td>
                                <td><?php echo $rows['edition'] ?></td>
                                <td><?php echo $row2['category_name']; ?></td>
                                <td><?php echo $rows['publication'] ?></td>
                                <td><?php echo $rows['author'] ?></td>
                                <td><?php echo $rows['available_qty'] ?></td>

                               
                            </tr>

                    <?php }
                    }

                    ?>



                </tbody>
            </table>

        </section>

        <?php require('../Admins/dataTable.php') ?>
    </div>
</body>

</html>