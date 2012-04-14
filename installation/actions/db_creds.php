<?php
    session_start();
    require_once('../includes/functions.php');
    require_once('../includes/interface_functions.php');
    require_once('../includes/db_functions.php');
    
    update_session(false);

    $dbHost = (isset($_SESSION['dbHost']) ? $_SESSION['dbHost'] : '');
    $dbUser = (isset($_SESSION['dbUser']) ? $_SESSION['dbUser'] : '');
    $dbPass = (isset($_SESSION['dbPass']) ? $_SESSION['dbPass'] : '');
    $dbName = (isset($_SESSION['dbName']) ? $_SESSION['dbName'] : '');
    $tablePrefix = (isset($_SESSION['tablePrefix']) ? $_SESSION['tablePrefix'] : '');


    $connect = mysql_connect($dbHost, $dbUser, $dbPass) or die(mysql_error());
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

//    echo 'DB Connect Successful';

    define("DB_HOST", $dbHost);
    define("DB_USER", $dbUser);
    define("DB_PASS", $dbPass);
    define("DB_NAME", $dbName);
    define("TABLE_PREFIX", $tablePrefix);

//    initialize_db();

    header('Location: ../setup.php');
?>