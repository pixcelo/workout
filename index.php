<?php
  include("includes/config.php"); // DB Connect
  include("includes/classes/Account.php"); // DB Insert
  include("includes/classes/User.php"); // Get User Info
  include("includes/classes/Workout.php"); // Record Workout Info

  // display of Number of workouts
  $flag = 0;

  if (isset($_SESSION['userLoggedIn'])) {
    $userLoggedIn = new User($con, $_SESSION['userLoggedIn']);
    $username = $userLoggedIn->getUsername();

      // ワークアウトがある場合のみワークアウト履歴を表示
      $query = mysqli_query($con, "SELECT * FROM workouts WHERE user='$username'");
      $result = mysqli_num_rows($query);
      
      if ($result > 1) {
        $flag = 1;
        $workout = new Workout($con, $username);
      }
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

  <header class="headerContainer show">

    <div>
        <a href="index.php"><img src="assets/images/icons/logo_transparent.png" class="logo" alt="logo"></a>
    </div>

    <nav>
      <ul>
        <li><a href=""></a></li>
        <li><a href=""><?php echo !empty($username) ? '<a href="profile.php">' . $username . '</a>' : '<a href="login.php">Log in</a>'; ?></a></li>
        <li><a href="register.php">Sign up</a></li> 
        <li><a href="">Contact</a></li> 
        <li><a href="" class="logout">Log out</a></li> 
      </ul>
    </nav>
  </header>

  <div class="container">

    <aside class="sideContainer">
      <div>
        <h3>Number of workouts</h3>
        <ul>
          <!-- <li class="number">Total:<span class="times">0</span> times</li> -->
          <?php 
            if($flag == 1) {
                echo $workout->getTotalCount($username);
                echo $workout->getPlayCount($username, 'pushup');
                echo $workout->getPlayCount($username, 'squat');
            } else {
                echo '<p>No play records.</p>';
            }
          ?>
        </ul>
      </div>
      <div>

      </div>
    </aside>

    <main class="mainContainer">

      <p class="wordwrap">Welcome to our page! You can watch the workout animation for free. It's also possible to record daily exercises by logging in. Let's workout!</p>

      <h1>Work out</h1>
      <div class="viewContainer">
          <div class="circle none" id="count"></div>
            
          <div class="timezone none" id="timer">30</div>
          <div class="pushup none"></div>
          <div class="squat none"></div>
          <audio controls  controlslist="nodownload" id="countTimerSound" src="assets/sounds/Countdown01-2.mp3"></audio>
          <audio controls  controlslist="nodownload" id="workoutSound" src="assets/sounds/Loop03.mp3"></audio>
      </div>
      <div class="timeContainer">
        <div class="controls">
              <button class="btn" id="start">start</button>
              <button class="btn" id="testbtn">test</button>
              <button id="modal-btn">ボタン</button>
          <div id="result"></div>
        </div>
      </div>
      <div class="menuContainer">
          <h2>【Workout Menu】</h2>
          <ul>
            <form name="typeForm">
              <li class="menu"><input type="radio" name="type" value="pushup" checked="checked">pushup<span>: Train your pectoralis major</span></li>
              <li class="menu"><input type="radio" name="type" value="squat">squat<span>: Train your quads</span></li>
              <li class="menu"><input type="radio" name="type" value="situp">situp<span>: Train your abs</span></li>
              <li class="menu"><input type="radio" name="type" value="bicycle">bicycle<span>: Train your abs</span></li>
            </form>
          </ul>
      </div>
    <main>

  </div>

  <div class="credit">
    <a rel="license" href="http://creativecommons.org/licenses/by/4.0/"><img alt="クリエイティブ・コモンズ・ライセンス" style="border-width:0" src="https://i.creativecommons.org/l/by/4.0/80x15.png" /></a>
    <small>Sound material : OtoLogic (https://otologic.jp)</small>
  </div>

  <script src="assets/js/script.js"></script>
  <?php
    if (isset($_SESSION['userLoggedIn'])) {

        // if user log in, record workout to Database
        echo "<script>
                  start.addEventListener('click', () => {
                      const postData = new FormData;
                      postData.set('workoutName', checkedType);
                      postData.set('user', '$username');
                      postData.set('playCount', 1);
                    
                      const data = {
                        method: 'POST',
                        body: postData
                      };
                    
                      fetch('includes/handlers/ajax/workout.php', data)
                        .then((res) => res.text())
                        .then(console.log)

                  });
              </script>";
    }

  ?>
</body>
</html>