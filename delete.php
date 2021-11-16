<?php
require_once 'connect.php';

$id = $_GET['id'];

$query = "DELETE FROM goals WHERE goal_id = '" . $id . "'";

if(mysqli_query($conn, $query)){
  print ("Stored");
} else {
  print("Failed");
}

echo "<script>location.href='index.php'</script>";
?>