<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tep";
$id = $_GET['id'];
// print_r($id);exit;
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// sql to delete a record
$sql = "DELETE FROM feedback WHERE feedback_id='$id'";

if (mysqli_query($conn, $sql)) {
  echo "Record deleted successfully";
//   exit;
} else {
  echo "Error deleting record: " . mysqli_error($conn);
//   exit;
}

header('Location: dashboard.php');
mysqli_close($conn);
?>