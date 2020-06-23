<?php
  include("includes/config.php"); // DB Connect
  include("includes/classes/Account.php"); // DB Insert
  include("includes/classes/User.php"); // Get User Info
  include("includes/handlers/ajax/workouts.php"); // Get User Info

  if(isset($_SESSION['userLoggedIn'])) {
      $userLoggedIn = new User($con, $_SESSION['userLoggedIn']);
  }

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700|Noto+Sans+JP:400,700" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
  <title>workout</title>
</head>
<body>

  <!-- <header class="headerContainer show">

    <div>
        <img src="" class="" alt="">
    </div>

    <nav>
      <ul>
        <li><a href=""><?php echo $userLoggedIn->getUsername(); ?></a><</li>
        <li><a href="">Log in</a></li>
        <li><a href="register.php">Sign up</a></li> 
        <li><a href="">contact</a></li> 
      </ul>
    </nav>
  </header> -->

  <div class="container">

    <aside class="sideContainer">
      <div>
        <h3>Number of workouts</h3>
        <ul>
          <li class="number">Total:<span class="times">0</span> times</li>
          <li class="number">This month:<span>0</span> times</li>
          <li class="number">This week:<span>0</span> times</li>
        </ul>
      </div>
      <div>

      </div>
    </aside>

    <main class="mainContainer">
      <h1>Work out</h1>
      <div class="viewContainer">
          <div class="circle none" id="count"></div>
          <div class="timezone none" id="timer">30</div>
          <div class="pushup none"></div>
      </div>
      <div class="timeContainer">
        <div class="controls">
          <form id="myForm">
              <input type="hidden" name="workoutName" value="pushup">
              <input type="hidden" name="workoutName" value="pushup">
              <button class="btn" id="start" type="submit">start</button>
          </form>
          <div id="result"></div>
        </div>
      </div>
      <div class="menuContainer">
          <h3>【トレーニングメニュー】</h2>
          <ul>
            <li class="menu">プッシュアップ</li>
            <li class="menu">バイシクル</li>
            <li class="menu">スクワット</li>
          </ul>
      </div>
    <main>

  </div>

  <script src="assets/js/script.js"></script>
  <script>
   
  const myForm = document.getElementById('myForm')
  
  myForm.addEventListener('submit', function (e) {
      e.preventDefault();
      const data = new URLSearchParams();


      fetch('test.php', {
          method: 'POST',
          body: formData
      }).then(function (response) {
          return response.text();
      }).then(function (text) {
          console.log(text);
      }).catch( function (error) {
          console.log(error);
      })
  });
  
  </script>
  
</body>
</html>