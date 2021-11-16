<?php
require_once 'connect.php';

$complete = mysqli_real_escape_string($conn, $_REQUEST['complete']);

$category = mysqli_real_escape_string($conn, $_REQUEST['cat']);
$text = mysqli_real_escape_string($conn, $_REQUEST['text']);
$date = mysqli_real_escape_string($conn, $_REQUEST['date']);
$complete = mysqli_real_escape_string($conn, $_REQUEST['complete']);

$query = "INSERT INTO goals (goal_category, goal_text, goal_date, goal_complete) VALUES ";
$query .= "('" . $category . "',";
$query .= "'" . $text . "',";
$query .=  "'" . $date . "',";
$query .= "'" .$complete . "')";

$result = mysqli_query($conn, $query);

$goals = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo json_encode($goals);

echo "<script>location.href='index.php'</script>";
?>