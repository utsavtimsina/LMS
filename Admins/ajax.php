<?php
require('../config.php');

if (isset($_POST['bid'])) {
    $bid = $_POST['bid'];
    $sql = "SELECT * FROM `book_details_tbl` WHERE `bid`=$bid";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
?>

    <!-- <div class="form-control">
        <label>Room no.</label> -->
        <select name="bname">            
             <option value=<?php echo $row['book_id'] ?>><?php echo $row['book_id'] ?></option>        
        </select>
    <!-- </div> -->

<?php
}

?>