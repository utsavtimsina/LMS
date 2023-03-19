<?php

require('../config.php');

$searchTerm = $_GET['term'];
$data = array();

$query = "SELECT * FROM `book_tbl` WHERE `bookuid` LIKE '%" . $searchTerm . "%'";
$select = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($select)) {

    array_push($data, $row['bookuid']);
}
//return json data

echo json_encode($data);
?>