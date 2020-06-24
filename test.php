<?php
include('includes/config.php');

$workoutName =  $_POST['workoutName'];
$playCount = $_POST['playCount'];
$playDate = date("Y-m-d");

$checkQuery = mysqli_query($con, "SELECT * FROM workouts WHERE workoutName='$workoutName'");

if (mysqli_num_rows($checkQuery > 1)) {
  echo "ok";
}

// if() {
//   $query = "INSERT INTO workouts VALUES (NULL, '$workoutName', '$playDate', '$playCount')";
// }else {
//     $query = "INSERT INTO workouts VALUES (NULL, '$workoutName', '$playDate', '$playCount')";
// }
//   mysqli_query($con, $query);