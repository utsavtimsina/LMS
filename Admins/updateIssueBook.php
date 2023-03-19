<?php 
    
            @$txn_no=$_GET['txn_no'];
            @$stat=$_GET['stat'];
            if($stat==='e'){

                $query ="SELECT * FROM issue_tbl WHERE txn_no=$txn_no";
                $res=mysqli_query($conn,$query);
                $row = mysqli_fetch_assoc($res);

                $bookuid=$row['book_uid'];
                $fine=$row['fine'];

                if(isset($_POST['add'])){
                   $fine= $_POST['fine'];

                   date_default_timezone_set("Asia/Kathmandu");
                $timestamp = date('Y-m-d H:i:s');

                   $update_sql = "UPDATE `issue_tbl` SET `txn_no`='$txn_no',`fine`='$fine',`timestamp`='$timestamp' WHERE txn_no=$txn_no";
                   $result = mysqli_query($conn, $update_sql);
                   if($result){
                       $msg='Fine Added';
                   }
                   header("location:issueBook.php?msg=$msg");

                }?>

                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Add Fine</title>
                </head>
                <body>
                <div class="content">
    <!-- Category Form -->

    <main class="form-container">
        <form action="#" method="POST" class="studentForm">
            <div class="form-group">
                <label for="txn">Txn No. : <?php echo $txn_no;?></label>
            </div>
            <div class="form-group">
            <label for="fine">Fine (in Rs.)<span style="color: red;">*</span></label>
                <input type="text" value="<?php echo $fine ?>" name="fine" placeholder="Fine..." required>
            </div>

            <div class="form-row">
                <div class="form-btn">
                    <input type="submit" class="fbtn" name="add" value="Add">
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


<?php

            }

    ?>
