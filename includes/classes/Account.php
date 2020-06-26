<?php
  class Account {

    private $con;
    private $errorArray;

    public function __construct($con) {
      $this->con = $con;
      $this->errorArray = array();
    }

    public function register($un, $fn, $ln, $em, $em2, $pw, $pw2) {
        $this->validateUserName($un);
        $this->validateFirstName($fn);
        $this->validateLastName($ln);
        $this->validateEmails($em, $em2);
        $this->validatePasswords($pw, $pw2);

        if(empty($this->errorArray)) {
            return $this->insertUserDetails($un, $fn, $ln, $em, $pw);
        } else {
            return false;
        }
    }

    public function getError($error) {
      if(!in_array($error, $this->errorArray)) {
          $error = "";
      }
      return "<span class='errorMessage'>$error</span>";
    }

    // ログイン処理：ユーザーネームとパスワード判定
    public function login($un, $pw) {
        $query = mysqli_query($this->con, "SELECT password FROM users WHERE username='$un'");
        $pass = mysqli_fetch_row($query);
   
        if (password_verify($pw, $pass[0])) {
            return true;
        } else {
            array_push($this->errorArray, Constants::$loginFailed);
            return false;
        }
    }

    // アカウント登録：DB挿入
    private function insertUserDetails($un, $fn, $ln, $em, $pw) {
        $encryptedPw = password_hash($pw, PASSWORD_DEFAULT);
        $date = date("Y-m-d");
        $result = mysqli_query($this->con, "INSERT INTO users VALUES (NULL, '$un', '$fn', '$ln', '$em', '$encryptedPw', '$date')");

        return $result;
    }

    
    // 入力項目のバリデーション
    private function validateUserName($un) {
        if(strlen($un) > 25 || strlen($un) < 3) {
            array_push($this->errorArray, Constants::$userNameCharacters);
            return;
        }

        // ユーザーネームの重複チェック
        $checkUsernameQuery = mysqli_query($this->con, "SELECT username FROM users WHERE username='$un'");
        if(mysqli_num_rows($checkUsernameQuery) != 0) {
          array_push($this->errorArray, Constants::$usernameTaken);
        }
    }
    
    private function validateFirstName($fn) {
        if(strlen($fn) > 25 || strlen($fn) < 2) {
          array_push($this->errorArray, Constants::$firstNameCharacters);
          return;
        }
    }
    
    private function validateLastName($ln) {
        if (strlen($ln) > 25 || strlen($ln) < 2) {
          array_push($this->errorArray, Constants::$lastNameCharacters);
          return;
        }
    }

    private function validateEmails($em, $em2) {
        if($em != $em2) {
            array_push($this->errorArray, Constants::$emailsDoNotMatch);
            return;
        }

        if(!filter_var($em, FILTER_VALIDATE_EMAIL)) {
            array_push($this->errorArray, Constants::$emailInvalid);
            return;
        }

        $checkEmailQuery = mysqli_query($this->con, "SELECT email FROM users WHERE email='$em'");
        if(mysqli_num_rows($checkEmailQuery) != 0) {
            array_push($this->errorArray, Constants::$emailTaken);
            return;
        }
    }
    
    private function validatePasswords($pw, $pw2) {
        if($pw != $pw2) {
            array_push($this->errorArray, Constants::$passwordsDoNoMatch);
            return;
        }

        // 正規表現チェック ^はnotの意味
        if(preg_match('/[^A-Za-z0-9]/', $pw)) {
            array_push($this->errorArray, Constants::$passwordNotAlphanumeric);
            return;
        }

        if(strlen($pw) > 30 || strlen($pw) < 5) {
            array_push($this->errorArray, Constants::$passwordCharacters);
            return;
        }
    }
  }