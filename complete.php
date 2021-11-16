<?php
require_once 'connect.php';

$id = $_GET['id'];

$query = "UPDATE goals SET goal_complete = '1' WHERE goal_id = '" . $id . "'";

if(mysqli_query($conn, $query)){
  print ("Stored");
} else {
  print("Failed");
}

echo "<script>location.href='index.php'</script>";
?>