<section class="table-container">

    <table class="table" id="myTable">
        <thead>
            <tr>
                <th>#</th>
                <!-- <th>fId</th> -->
                <th>Faculty Name</th>
                <th>Description</th>
                <th>Actions</th>

            </tr>
        </thead>
        <tbody>

            <?php

            $counter=0;

            $sql = "SELECT * FROM `faculty_tbl`";
            $result = mysqli_query($conn, $sql);
            $num = mysqli_num_rows($result);

            if ($num > 0) {
                while ($rows = mysqli_fetch_assoc($result)) {
            ?>

                    <tr>
                        <td><?php echo ++$counter; ?></td>
                        <!-- <td><?php echo $rows['fid'] ?></td> -->
                        <td><?php echo $rows['faculty_name'] ?></td>
                        <td><?php echo $rows['description'] ?></td>
                        <td>
                            <div class="actions">
                                <div class="action-btn">
                                    <div>
                                        <button class="edit-btn all-btn" onclick="location.href='updateFaculty.php?fid=<?php echo $rows['fid']; ?>&action=e'"><i class="fa-regular fa-pen-to-square"></i>
                                            Edit</button>
                                    </div>
                                </div>
                                <div class="action-btn">
                                    <div>
                                        <button class="del-btn all-btn" onclick="location.href='updateFaculty.php?fid=<?php echo $rows['fid']; ?>&action=d'"><i class="fa-regular fa-trash-can"></i>
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
