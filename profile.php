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
        <li><a href=""><?php echo !empty($username) ? $username : '<a href="login.php">Log in</a>'; ?></a></li>
        <li><a href="register.php">Sign up</a></li> 
        <li><a href="">Contact</a></li> 
        <li><a href="" class="logout">Log out</a></li> 
      </ul>
    </nav>
  </header>

  <div class="container">

    <aside class="sideContainer">
      <div>
       
      </div>
    </aside>

    <main class="profileContainer">

      <div class="">image</div>
      <h2>Profile</h2>
      <p>name:</p>
      <p>comment</p>
        
    <main>

    

  </div>


  <script src="assets/js/script.js"></script>
</body>
</html>