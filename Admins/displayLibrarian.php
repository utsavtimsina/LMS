<section class="table-container">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th>#</th>
                    <!-- <th>lId</th> -->
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Employee ID</th>
                    <th>Actions</th>

                </tr>
            </thead>
            <tbody>

                <?php
                $counter =0;
                $sql = "SELECT * FROM `lib_tbl`";
                $result = mysqli_query($conn, $sql);
                $num = mysqli_num_rows($result);



                if ($num > 0) {
                    while ($rows = mysqli_fetch_assoc($result)) {
                ?>

                        <tr>
                            <td><?php echo ++$counter; ?></td>
                            <!-- <td><?php echo $rows['lid'] ?></td> -->
                            <td><?php echo $rows['fname']." ".$rows['mname']." ".$rows['lname'] ?></td>
                            <td><?php echo $rows['email'] ?></td>
                            <td><?php echo $rows['password'] ?></td>
                            <td><?php echo $rows['empid'] ?></td>
                            <td>

                            
                                <div class="actions">
                                    <div class="action-btn">
                                        <div>
                                            <button class="edit-btn all-btn" onclick="location.href='updateLibrarian.php?lid=<?php echo $rows['lid']; ?>&action=e'"><i class="fa-regular fa-pen-to-square"></i>
                                                Edit</button>
                                        </div>
                                    </div>
                                    <div class="action-btn">
                                        <div>
                                            <button class="del-btn all-btn" onclick="location.href='updateLibrarian.php?lid=<?php echo $rows['lid']; ?>&action=d'"><i class="fa-regular fa-trash-can"></i>
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
    