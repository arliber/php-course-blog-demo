<?php

  require_once "db.php";

  class User {

    private $_db;

    // User fields
    private $userId;
    private $email;
    private $password;

    // Methods
    public function __construct() {
      $this->_db = DB::getInstance();
    }

    public function __set($name, $value) {
      if (isset($this->$name)) {
        if ($name == 'password') {
          $value = md5($value);
        }
        $this->$name = $value;
      }
    }

    public function __get($name) {
      if (isset($this->$name)) {
        return $this->$name;
      }
      return NULL;
    }

    public function create($email, $password) {
      $this->userId = NULL;
      $this->email = $email;
      $this->password = md5($password);
    }

    public function save() {
      $params = array(
        ':email' => $this->email,
        ':password' => $this->password,
      );
      
      if (empty($this->userId)) {
        $query = 'INSERT INTO users(email, password_hash) VALUES (:email, :password)';
      } else {
        $params[':userId'] = $this->userId;
        $query = 'UPDATE users SET email=:email, password_hash=:password WHERE userId=:userId';
      }

      $this->_db->query($query, $params);
    }

    public function getUserById($userId) {
      $params = array(
        ':userId' => $userId
      );
      $query = 'SELECT * FROM users WHERE userId = :userId';
      $this->_db->query($query, $params);
      if($this->_db->count > 0) {
        $this->email = $this->_db->result[0]['email'];
        $this->password = $this->_db->result[0]['password_hash'];
      }
    }

    public function getAllUsers() {
      $users = array();
      $query = 'SELECT * FROM users';
      $this->_db->query($query, array());

      foreach($this->_db->result as $user) {
        $tempUser = new User();
        $tempUser->create($user['email'], $user['password']);
        $users[] = $tempUser;
      }

      return $users;
    }

    public function isUserCredentialsCorrect($email, $password) {
      $params = array(
        ':email' => $email
      );
      $query = 'SELECT * FROM users WHERE email = :email';
      $this->_db->query($query, $params);

      if($this->_db->count > 0 && $this->_db->result[0]['password_hash'] == md5($password)) {
        $this->email = $this->_db->result[0]['email'];
        $this->password = $this->_db->result[0]['password_hash'];
        return true;
      } else {
        return false;
      }
    }

  }