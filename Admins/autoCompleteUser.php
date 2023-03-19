<?php

require('../config.php');

$searchTerm = $_GET['term'];
$data = array();

$query = "SELECT * FROM `user_tbl` WHERE `user_uid` LIKE '%" . $searchTerm . "%'";
$select = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($select)) {

    array_push($data, $row['user_uid']);
}
//return json data

echo json_encode($data);
?>