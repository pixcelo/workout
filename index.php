<?php
  include("includes/config.php"); // DB Connect
  include("includes/classes/Account.php"); // DB Insert
  include("includes/classes/User.php"); // Get User Info

  if (isset($_SESSION['userLoggedIn'])) {
    $userLoggedIn = new User($con, $_SESSION['userLoggedIn']);
    $username = $userLoggedIn->getUsername();
    $userId = $userLoggedIn->getUserId();
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
        <img src="" class="" alt="">
    </div>

    <nav>
      <ul>
        <li><a href=""></a></li>
        <li><<a href=""><?php echo !empty($username) ? $username : ''; ?></a></li>
        <li><a href="login.php">Log in</a></li>
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
          <li class="number">Total:<span class="times">0</span> times</li>
          <li class="number">This month:<span>0</span> times</li>
          <li class="number">This week:<span>0</span> times</li>
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
      </div>
      <div class="timeContainer">
        <div class="controls">
              <button class="btn" id="start">start</button>
          <div id="result"></div>
        </div>
      </div>
      <div class="menuContainer">
          <h3>【Workout Menu】</h2>
          <ul>
            <li class="menu">Push-ups: Train your pectoralis major</li>
            <li class="menu">Squat: Train your quads</li>
            <li class="menu">Sit-ups: Train your abs</li>
            <li class="menu">Bicycle: Train your abs</li>
          </ul>
      </div>
    <main>

  </div>

  <script src="assets/js/script.js"></script>
  <script>
    start.addEventListener('click', () => {
        const postData = new FormData;
        postData.set('workoutName', 'pushup');
        postData.set('playCount', 1);
        postData.set('id', <?php $userId ?>);
      
        const data = {
          method: 'POST',
          body: postData
        };
      
        fetch('workout.php', data)
          .then((res) => res.text())
          .then(console.log);
    });

  </script>
</body>
</html>