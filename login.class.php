<?php

  require_once 'user.class.php';

  class Login
  {

      public $user;
      public $errors = array();
      public $messages = array();

      public function __construct()
      {
          // create/read session, absolutely necessary
          session_start();

          // Init user object
          $this->user = new User();

          if (isset($_GET["logout"])) {
              $this->doLogout();
          } elseif (isset($_POST["login"])) {
              $this->dologinWithPostData();
          } elseif (isset($_POST["register"])) {
            $this->doRegister();
        }
      }

      private function dologinWithPostData()
      {
          // check login form contents
          if (empty($_POST['email'])) {
              $this->errors[] = "Email field was empty.";
          } elseif (empty($_POST['password'])) {
              $this->errors[] = "Password field was empty.";
          } else {

              if($this->user->isUserCredentialsCorrect($_POST['email'], $_POST['password'])) {
                $_SESSION['email'] = $this->user->email;
                $_SESSION['user_login_status'] = 1;
              } else {
                $this->errors[] = "Incorrect login, please try again.";
              }
              
          }
      }

      public function doLogout()
      {
          $_SESSION = array();
          session_destroy();
          $this->messages[] = "You have been logged out.";
      }

      public function doRegister() {
        $this->user->create($_POST['email'], $_POST['password']);
        $this->user->save();
        $this->messages[] = "You have been registered.";
      }

      public function isUserLoggedIn()
      {
          if (isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] == 1) {
              return true;
          }
          return false;
      }
  }