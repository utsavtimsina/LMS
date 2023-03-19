<section class="table-container">
    <table class="table" id="myTable">
        <thead>
            <tr>
                <th>#</th>
                <!-- <th>cId</th> -->
                <th>Category Name</th>
                <th>Description</th>
                <th>Actions</th>

            </tr>
        </thead>
        <tbody>

            <?php

            $counter = 0;

            $sql = "SELECT * FROM `book_category_tbl`";
            $result = mysqli_query($conn, $sql);
            $num = mysqli_num_rows($result);


            
            if ($num > 0) {
                while ($rows = mysqli_fetch_assoc($result)) {
            ?>

                    <tr>
                        <td><?php echo ++$counter; ?></td>
                        <!-- <td><?php echo $rows['cid'] ?></td> -->
                        <td><?php echo $rows['category_name'] ?></td>
                        <td><?php echo $rows['description'] ?></td>
                        <td>


                            <div class="actions">
                                <!-- <div class="action-btn">
                                        <div>
                                            <button class="view-btn all-btn" onclick="location.href='view.php?<?php echo $rows['id'] ?>'"><i class="fa-regular fa-eye"></i> View</button>
                                        </div>
                                    </div> -->
                                <div class="action-btn">
                                    <div>
                                        <button class="edit-btn all-btn" onclick="location.href='updateBookCategory.php?cid=<?php echo $rows['cid']; ?>&action=e'"><i class="fa-regular fa-pen-to-square"></i>
                                            Edit</button>
                                    </div>
                                </div>
                                <div class="action-btn">
                                    <div>
                                        <button class="del-btn all-btn" onclick="location.href='updateBookCategory.php?cid=<?php echo $rows['cid']; ?>&action=d'"><i class="fa-regular fa-trash-can"></i>
                                            Delete</button>
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
