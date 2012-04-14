<?php
    session_start();
    require_once('includes/functions.php');
    require_once('includes/interface_functions.php');
?>
<html>
    <head>
        <title>PHP Timeclock Version 3 Installer</title>

        <link rel="stylesheet" href="css/layout.css" type="text/css" />

        <script type="text/javascript" src="includes/js/jquery-1.4.2.min.js"></script>
        <script type="text/javascript" src="includes/js/jquery-ui-1.8.4.custom.min.js"></script>
        <script type="text/javascript" src="includes/js/gen_validatorv31.js"></script>
        <script type="text/javascript" src="includes/js/jquery.tipTip.minified.js"></script>

        <script type="text/javascript" src="includes/js/jquery_functions.js"></script>

        <!-- J-Query UI !-->
        <link href="css/jquery/jquery-ui-1.8.4.custom.css" media="screen" rel="stylesheet" type="text/css" />

        <!-- CSS DropDown Begin !-->

        <link href="css/tipTip.css" media="screen" rel="stylesheet" type="text/css" />

        <!-- tipTip !-->

        <!-- Beginning of compulsory code below -->

        <link href="css/dropdown/dropdown.css" media="screen" rel="stylesheet" type="text/css" />
        <link href="css/dropdown/themes/default/default.css" media="screen" rel="stylesheet" type="text/css" />

        <!--[if lt IE 7]>
        <script type="text/javascript" src="js/jquery/jquery.js"></script>
        <script type="text/javascript" src="js/jquery/jquery.dropdown.js"></script>
        <![endif]-->

        <!-- / END -->

        <!-- CSS DropDown End !-->
    </head>
    <body>
        <div id="wrapper">

            <div id="header">

            </div>

            <div id="body">

<?php //dump($_SESSION) ?>