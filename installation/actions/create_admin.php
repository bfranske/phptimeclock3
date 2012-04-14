<?php
    session_start();
    require_once('../includes/functions.php');
    require_once('../includes/interface_functions.php');
    require_once('../includes/db_functions.php');

    $dbHost = (isset($_SESSION['dbHost']) ? $_SESSION['dbHost'] : '');
    $dbUser = (isset($_SESSION['dbUser']) ? $_SESSION['dbUser'] : '');
    $dbPass = (isset($_SESSION['dbPass']) ? $_SESSION['dbPass'] : '');
    $dbName = (isset($_SESSION['dbName']) ? $_SESSION['dbName'] : '');

    $connect = mysql_connect($dbHost, $dbUser, $dbPass);
    if (! $connect){
        add_error('Could not connect to database, please check credentials!!!');
        header('Location:  ../index.php');
        die();
    }

    if (! mysql_select_db($dbName)){
        add_error('Connected to db, provided DB Name does not exist!!!');
        header('Location:  ../index.php');
        die();
    }

    update_session();
//    dump($_POST);
//    dump($_SESSION);
//    die();

    
    define("DB_HOST", $dbHost);
    define("DB_USER", $dbUser);
    define("DB_PASS", $dbPass);
    define("DB_NAME", $dbName);
    define("TABLE_PREFIX", '');

    $dbCredentials['dbHost'] = $dbHost;
    $dbCredentials['dbUser'] = $dbUser;
    $dbCredentials['dbPass'] = $dbPass;
    $dbCredentials['dbName'] = $dbName;

    initialize_db($dbCredentials);

    $username = (isset($_POST['username']) ? sanitize($_POST['username']) : '');
    $password = (isset($_POST['password']) ? sanitize($_POST['password']) : '');
    $password2 = (isset($_POST['password2']) ? sanitize($_POST['password2']) : '');
    $firstName = (isset($_POST['firstName']) ? sanitize($_POST['firstName']) : '');
    $lastName = (isset($_POST['lastName']) ? sanitize($_POST['lastName']) : '');
    $email = (isset($_POST['email']) ? sanitize($_POST['email']) : '');

    if(!($username AND $password AND $firstName AND $lastName AND $email)){
        add_error('Please fill in all fields!!!');
        header('Location:  ../setup.php');
        die();
    }
    if ($password != $password2){
        add_error('Passwords do not match!!!');
        header('Location:  ../setup.php');
        die();
    }
    if (! validEmail($email)){
        add_error('Email appears to be invalid!!!');
        header('Location:  ../setup.php');
        die();
    }

    else{
        create_admin($username, $password, $firstName, $lastName);
    }
    


    header('Location: ../config.php');
    die();
?>