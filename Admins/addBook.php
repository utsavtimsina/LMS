<?php require('adminHeader.php');
require('../config.php');

if (isset($_POST['submitb'])){

    $bid=$_POST['bname'];
    $bookid=$_POST['bookid'];
    $sn=$_POST['sn'];
    $isbn=$_POST['isbn'];
    $bookuid=$bookid.$sn;

    //checking bookuid exists or not

    $sql4="SELECT bookuid FROM book_tbl WHERE sn=$sn AND bookid='$bookid'";
    $res4=mysqli_query($conn,$sql4) or die("error4");
    $num4=mysqli_num_rows($res4);

    if(mysqli_num_rows($res4)>0){
        $msg='Record Already Exist, Enter next SN';
    }
    else{
//fetch book id and name if details exists or not

    $sql1="SELECT bname,book_id FROM book_details_tbl WHERE bid='$bid' AND book_id='$bookid'";
    $res1=mysqli_query($conn,$sql1) or die("error");
    $num=mysqli_num_rows($res1);

    if(mysqli_num_rows($res1)>0){
//checking isbn

        $sql2="SELECT bookid FROM book_tbl WHERE isbn=$isbn";
        $res2=mysqli_query($conn,$sql2) or die("error2");
        $num2=mysqli_num_rows($res2);

        if(mysqli_num_rows($res2)>0){
            $msg='Record Already Exist with Same ISBN';
        }else{
            
            $sql="INSERT INTO `book_tbl`(`bookid`, `sn`, `bookuid`, `isbn`) VALUES ('$bookid','$sn','$bookuid','$isbn') ";
            $result=mysqli_query($conn,$sql);
            
            if($result){
                $sql3="UPDATE `book_details_tbl` SET `total_qty`=total_qty+1 , `available_qty`=available_qty+1 WHERE book_id='$bookid' ";
                $res3=mysqli_query($conn,$sql3); 

                if($res3){
                    $msg= 'Added Successfully';
                }
                else{
                    $msg='Failed to add';
                }
            }
            else{
                $msg='Failed to add';
            }
        }

    }
    else{
        $msg='Enter Correct Details';
      }

    }
    
    echo $num;

    header("location:addBook.php?msg=$msg");

print_r($_POST);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/addForm.css">
    <script src="../Assets/jquery-3.6.0.js"></script>
    <script>
        $(document).ready(function() {
            $(".book_name").change(function() {
                var bid = $(this).val();
                $.ajax({
                    url: "ajax.php",
                    method: "POST",
                    data: {
                        bid: bid
                    },
                    success: function(data) {
                        $(".book_id").html(data);
                    }
                });
            });
        });
    </script>
    <title>Add Book</title>
</head>
<body>
    <header>
        <div class="title">
            <h4>Add Book</h4>
        </div>
        <div class="ex-link">
            <a href="addBookDetails.php">Add Book Details</a>
        </div>
    </header>
    <div class="content">
        <!-- message -->
     <?php
        if (isset($_GET['msg']) && !empty($_GET['msg'])) {
        ?>
            <div class="msg" id="impmsg">
                <i class="fa-solid fa-plus cross" onclick="location.href='addBook.php'"></i>
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
            <form action="#" method="POST" class="studentForm">
               
                <div class="form-group">
                    <label for="bname">Book Name <span style="color: red;">*</span></label>
                    <select name="bname" class="book_name" required>
                            <option value="none" disabled selected>Select Book Name</option>

                            <?php
                            $query = "SELECT `bid`,`bname` FROM book_details_tbl";
                            $result = mysqli_query($conn, $query);
                            $num = mysqli_num_rows($result);
                            if (mysqli_num_rows($result) > 0) {
                                while ($rows = mysqli_fetch_assoc($result)) { ?>

                                    <option value="<?php echo $rows['bid']  ?>"><?php echo $rows['bname']  ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                </div>
                <div class="form-group">
                    <label for="bokid">Book Id <span style="color: red;">*</span></label>
                    <select name="bookid" class="book_id" required>
                            <option value="none" disabled selected>Select Book Id</option>

                            <?php
                            $query = "SELECT `book_id` FROM book_details_tbl";
                            $result = mysqli_query($conn, $query);
                            $num = mysqli_num_rows($result);
                            if (mysqli_num_rows($result) > 0) {
                                while ($rows = mysqli_fetch_assoc($result)) { ?>

                                    <option value="<?php echo $rows['book_id']  ?>"><?php echo $rows['book_id']  ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                </div>
                <div class="form-group">
                    <label for="isbn">ISBN No. <span style="color: red;">*</span></label>
                    <input type="text" name="isbn" placeholder="ISBN No." required>
                </div>
                <div class="form-group">
                    <label for="sn">Serial No. <span style="color: red;">*</span></label>
                    <input type="number" name="sn" min='1' placeholder="Serial No." required>
                </div>
                <div class="form-row">
                    <div class="form-btn">
                        <input type="submit" class="fbtn" name="submitb" value="Add Book">
                    </div>

                    
                    <!-- <div class="form-btn">
                        <input type="reset" class="fbtn" name="reset" value="Reset">
                    </div> -->
                </div>
            </form>
        </main>
    </div> 
     
</body>
</html>