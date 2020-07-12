<?php
  // php.ini エラー表示の切り替え
  ini_set('display_errors', 1);

  // 出力のバッファリングを有効にする（計算した結果をすぐに表示せずに貯めておく）
  ob_start();
  session_start();

  $timezone = date_default_timezone_set('Asia/Tokyo');

  // 引数（hostName, userName, password, databaseName）
  $con = mysqli_connect('localhost', 'gvbfuqnk_tetsu', '{OJ@FnDHnh!bB*q5Oj', 'gvbfuqnk_workout');

  if(mysqli_connect_error()) {
    echo "Failed to connect: ". mysqli_connect_error();
  }