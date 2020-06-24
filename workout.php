<?php
include('includes/config.php');

// startボタンクリックでworkoutの情報を取得
$workoutName =  $_POST['workoutName'];
$playCount = $_POST['playCount'];
$playDate = date("Y-m-d");

// DBのworkout履歴チェック
$checkQuery = mysqli_query($con, "SELECT * FROM workouts WHERE workoutName='$workoutName'");

// ユーザーデータのレコードを更新するWHERE文を追加する

// workoutが2回目以降なら回数を更新、新規ならレコード作成
if(mysqli_num_rows($checkQuery) == 1) {
  // echo "データあり";
    $query = "UPDATE workouts SET playCount = playCount + 1";
}else {
    $query = "INSERT INTO workouts VALUES (NULL, '$workoutName', '$playDate', '$playCount')";
}

mysqli_query($con, $query);