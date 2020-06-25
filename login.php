<?php
  include("includes/config.php"); // DB Connect
  include("includes/classes/Account.php"); // DB Insert
  include("includes/classes/Constants.php"); // Validate Message

  $account = new Account($con);

  include("includes/handlers/login-handler.php"); // Sanitize

  // inputのvalueにPOSTで渡った値を表示
  function getInputValue($name) {
    if(isset($_POST[$name])) {
      echo $_POST[$name];
    }
  }
?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700|Noto+Sans+JP:400,700" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/register.css">
  <title>login</title>
</head>
<body>

  <header class="headerContainer">

    <div>
          <img src="" class="" alt="">
    </div>

    <nav>
      <ul>
        <li><a href="login.php">Log in</a></li>
        <li><a href="register.php">Sign up</a></li> 
        <li><a href="">contact</a></li> 
      </ul>
    </nav>
  </header>

  <div class="container">

    <main class="loginContainer">

      <div class="inputContainer">
          <form id="loginForm" action="login.php" method="POST">
            <h2>Log in</h2>
            <p>
              <?php echo $account->getError(Constants::$loginFailed); ?>
              <label for="username">user name</label>
              <input id="username" name="username" type="text" placeholder="e.g. Johnny" value="<?php getInputValue('username') ?>" required>
            </p>

            <p>
              <label for="password">password</label>
              <input id="password" name="password" type="password" placeholder="your password" required autocomplete="off">
            </p>

            <button type="submit" name="loginButton">Log in</button>
            <a href="index.php">Back to Home</a>
          </form>
      </div>

    <main>

  </div>

</body>
</html>