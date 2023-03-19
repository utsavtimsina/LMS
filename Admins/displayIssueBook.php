<section class="table-container">
    <table class="table" id="myTable">
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
                <th>Actions</th>

            </tr>
        </thead>
        <tbody>

            <?php
            $counter = 0;

            $sql = "SELECT * FROM `issue_tbl` WHERE `return_status`='issued' ORDER BY `issued_date` DESC";
            $result = mysqli_query($conn, $sql);
            $num = mysqli_num_rows($result);



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
                        <td>


                            <div class="actions">
                                <div class="action-btn">
                                    <div>

                                        <?php if ($return_status == 'issued') { ?>
                                            <button class="edit-btn all-btn" onclick="location.href='issueBook.php?txn_no=<?php echo $txn_no; ?>&stat=e'"><i class="fa-regular fa-pen-to-square"></i>
                                                Edit</button>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>

            <?php }
            }

            ?>



        </tbody>
    </table>
</section>
