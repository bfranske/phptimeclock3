<?php
    session_start();
    require_once('../includes/functions.php');
    require_once('../includes/interface_functions.php');
    require_once('../includes/db_functions.php');

    $dbHost = (isset($_SESSION['dbHost']) ? $_SESSION['dbHost'] : '');
    $dbUser = (isset($_SESSION['dbUser']) ? $_SESSION['dbUser'] : '');
    $dbPass = (isset($_SESSION['dbPass']) ? $_SESSION['dbPass'] : '');
    $dbName = (isset($_SESSION['dbName']) ? $_SESSION['dbName'] : '');
    $tablePrefix = (isset($_SESSION['tablePrefix']) ? $_SESSION['tablePrefix'] : '');

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
    define("TABLE_PREFIX", $tablePrefix);

    $dbImportHost = (isset($_POST['dbImportHost']) ? sanitize($_POST['dbImportHost']) : '');
    $dbImportUser = (isset($_POST['dbImportUser']) ? sanitize($_POST['dbImportUser']) : '');
    $dbImportPass = (isset($_POST['dbImportPass']) ? sanitize($_POST['dbImportPass']) : '');
    $dbImportName = (isset($_POST['dbImportName']) ? sanitize($_POST['dbImportName']) : '');
    $sourceDBPrefix = (isset($_POST['sourceDBPrefix']) ? sanitize($_POST['sourceDBPrefix']) : '');

    initialize_db();

    $dbCredentials['dbHost'] = $dbImportHost;
    $dbCredentials['dbUser'] = $dbImportUser;
    $dbCredentials['dbPass'] = $dbImportPass;
    $dbCredentials['dbName'] = $dbImportName;

    

    if(!($dbImportHost AND $dbImportUser AND $dbImportPass AND $dbImportName)){
        add_error('Please fill in all fields!!!');
        header('Location:  ../setup.php');
        die();
    }
    
    else{
        import_from_db($dbCredentials, $sourceDBPrefix);
    }



    header('Location: ../import_success.php');
?>