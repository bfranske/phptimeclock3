<?php
    session_start();
    require_once('../includes/functions.php');
    require_once('../includes/interface_functions.php');
    require_once('../includes/db_functions.php');
    require_once('../classes/PclZip.php');

    $dbHost = (isset($_SESSION['dbHost']) ? $_SESSION['dbHost'] : '');
    $dbUser = (isset($_SESSION['dbUser']) ? $_SESSION['dbUser'] : '');
    $dbPass = (isset($_SESSION['dbPass']) ? $_SESSION['dbPass'] : '');
    $dbName = (isset($_SESSION['dbName']) ? $_SESSION['dbName'] : '');
    $tablePrefix = (isset($_SESSION['tablePrefix']) ? $_SESSION['tablePrefix'] : '');

    define("DB_HOST", $dbHost);
    define("DB_USER", $dbUser);
    define("DB_PASS", $dbPass);
    define("DB_NAME", $dbName);
    define("TABLE_PREFIX", '');

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

    $timezone = (isset($_POST['timezone']) ? sanitize($_POST['timezone']) : '');
    $companyName = (isset($_POST['companyName']) ? sanitize($_POST['companyName']) : '');
    $language = (isset($_POST['language']) ? sanitize($_POST['language']) : '');

    if(!(strlen($companyName))){
        add_error('Please enter company name!!!');
        header('Location:  ../config.php');
        die();
    }

    update_session();
//    dump($_POST);
//    dump($_SESSION);
//    die();

    PDO_query('UPDATE '.TABLE_PREFIX.'config SET value = :value WHERE `option` = "timezone"', array('value' => $timezone));
    PDO_query('UPDATE '.TABLE_PREFIX.'config SET value = :value WHERE `option` = "companyName"', array('value' => $companyName));
    PDO_query('UPDATE '.TABLE_PREFIX.'config SET value = :value WHERE `option` = "language"', array('value' => $language));
    $baseURL = str_replace('installation/actions/config.php', '' ,curPageURL());
    PDO_query('UPDATE '.TABLE_PREFIX.'config SET value = :value WHERE `option` = "base_url"', array('value' => $baseURL));
    $useSSL = strpos($baseURL, 'https://' !== false ? 1 : 0);
    PDO_query('UPDATE '.TABLE_PREFIX.'config SET value = :value WHERE `option` = "useSSL"', array('value' => $useSSL));
    
/*
 * Unzip Files
 */
         $archive = new PclZip('phptc3.zip');

         unlink('../../index.php');

        if (! ($v_result_list = $archive->extract(PCLZIP_OPT_PATH, "../../"))) {
            dump($v_result_list);
            die("Error : ".$archive->errorInfo(true));
        }

/*
 * Output Config Files
 */
        require_once('../includes/new_config.php');

        create_new_config();

        create_new_db_config($options);

    header('Location: ../quickstart.php');
?>