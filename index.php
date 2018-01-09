<?php

    /**********************************/
    /* EXAMPLE 1 - Using the DB Class */
    /**********************************/

    /*require_once "db.php";
    $db = DB::getInstance();
    $users = $db->query('select * from users')->_result;
    echo json_encode($users);*/

    /************************************/
    /* EXAMPLE 2 - Using the User Class */
    /************************************/

    /*require_once 'user.class.php';
    $user = new User();

    // New user
    $user->create('liberarik2@gmail.com', 'abc123abc');
    echo '<h3>'.$user->email.'</h3>';

    // Save that user
    //$user->save();

    // Get the first user
    $user->getUserById(1);
    echo '<h3>'.$user->email.'</h3>';
    
    // Get all users
    $users = $user->getAllUsers();
    echo '<table border="1">';
    foreach($users as $tempUser) {
      echo '<tr><td>'.$tempUser->email.'</td><td>'.$tempUser->password.'</td></tr>';
    }
    echo '</table>';*/

    /*********************************************/
    /* EXAMPLE 3 - User forms and authentication */
    /*********************************************/

    require_once 'login.class.php';

    $login = new Login();
    if($login->isUserLoggedIn()) {
      include("views/logged_in.php");
    } else {
      include("views/not_logged_in.php");
    }
    
?>