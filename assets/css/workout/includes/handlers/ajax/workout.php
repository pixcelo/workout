<?php
include('../../config.php');

// startボタンクリックでworkoutの情報を取得
$workoutName =  $_POST['workoutName'];
$user = $_POST['user'];
$playCount = $_POST['playCount'];
$playDate = date("Y-m-d");

// Check logged-in user and workout type
$checkQuery = mysqli_query($con, "SELECT * FROM workouts WHERE workoutName='$workoutName' AND user='$user'");

// workoutが2回目以降なら回数を更新、新規ならレコード作成
if(mysqli_num_rows($checkQuery) == 1) {
    // echo "データあり";
    $query = "UPDATE workouts SET playCount = playCount + 1 WHERE workoutName='$workoutName' AND user='$user'";
} else {
    $query = "INSERT INTO workouts VALUES (NULL, '$workoutName', '$user', '$playDate', '$playCount')";
}

mysqli_query($con, $query);