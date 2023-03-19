<?php require('adminHeader.php');
require('../config.php');

?>
<?php if (isset($_POST['filter'])) {

    $startdate = $_POST['start'];
    $enddate = $_POST['end'];
} else {
    $startdate = '';
    $enddate = '';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions</title>
</head>

<body>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="../Assets/fontawesome/js/all.js"></script>
        <link rel="stylesheet" href="css/addForm.css">
        <link rel="stylesheet" href="../css/table.css">
        
        <title>Transactions</title>
    </head>

    <body>
        <header>
            <div class="title">
                <h4>Transactions</h4>
            </div>
        </header>

        <div class="content">

            <form action="" method="post">
                <div class="form-row">
                    <div class="form-group">
                        <label for="startdate">From:</label>
                        <input type="date" min="2000-01-01" class="rdate" name="start" id="startdate" onblur="lastDate();">
                    </div>

                    <div class="form-group">
                        <label for="startdate">To:</label>
                        <input type="date" class="rdate" name="end" id="enddate">
                    </div>
                    <div class="btns">
                        <div class="report-btn">
                            <button type="submit" class="rbtn" name="filter"><i class="fa-solid fa-filter"></i> Filter</button>

                        </div>
                        <div class="report-btn">
                            <button type="button" class="rbtn" onclick="location.href='transactions.php'"><i class="fa-solid fa-repeat"></i> Reload</button>
                        </div>

                        <div class="report-btn">
                            <button type="button" name="print" class="rbtn" onclick="location.href='printReport.php?start=<?php echo $startdate ?>&end=<?php echo $enddate ?>'"><i class="fa-solid fa-print"></i> Print</button>
                        </div>
                        <!-- <div class="report-btn">
                            <button type="button" name="print" class="rbtn" onclick="window.print();"><i class="fa-solid fa-print"></i> testPrint</button>
                        </div> -->

                    </div>

                </div>

            </form>

            <br>
            <br>
            <?php if (isset($_POST['filter']) && !empty($_POST['start']) && !empty($_POST['end'])) {

                $startdate = $_POST['start'];
                $enddate = $_POST['end']; ?>

                <p style="background-color: white; padding:5px;border-radius:5px;"><b>Report From: <span id="date1"><?php echo $startdate ?></span> To: <span id="date2"><?php echo $enddate ?></span></b></p>


            <?php
            } ?>


            <!-- edit issue -->
            <?php require('updateIssueBook.php') ?>
            <!-- Display Category -->

            <?php require('displayTransactions.php') ?>

        </div>
        <?php require('dataTable.php') ?>
    </body>

    </html>

    <script>
        


        var todaysDate = new Date(); // Gets today's date

        // Max date attribute is in "YYYY-MM-DD".  Need to format today's date accordingly

        var year = todaysDate.getFullYear(); // YYYY
        var month = ("0" + (todaysDate.getMonth() + 1)).slice(-2); // MM
        var day = ("0" + todaysDate.getDate()).slice(-2); // DD
        var maxDate = (year + "-" + month + "-" + day); // Results in "YYYY-MM-DD" for today's date 

        // mxa value attr
        document.getElementById('startdate').setAttribute('max', maxDate);

        document.getElementById('enddate').setAttribute('max', maxDate);

        function lastDate() {
            minDate = document.getElementById('startdate').value;
            console.log(minDate);
            document.getElementById('enddate').setAttribute('min', minDate);
            document.getElementById('enddate').value = minDate;
        }
        document.getElementById('startdate').value = document.getElementById('date1').innerHTML;
        document.getElementById('enddate').value = document.getElementById('date2').innerHTML;
    </script>
</body>

</html>