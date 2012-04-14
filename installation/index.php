<?php
    require('includes/header.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
    <h3>Install PHPTimeclock 3</h3>

    <h2>Database Credentials</h2>

    <?php show_notices() ?>
    <form action="actions/db_creds.php" method="POST">
        <?php
            table_open();
                form_text('DB Host', 'dbHost', isset($_SESSION['dbHost']) ? $_SESSION['dbHost'] : '');
                form_text('DB Username', 'dbUser', isset($_SESSION['dbUser']) ? $_SESSION['dbUser'] : '');
                form_text('DB Password', 'dbPass', isset($_SESSION['dbPass']) ? $_SESSION['dbPass'] : '');
                form_text('DB Name', 'dbName', isset($_SESSION['dbName']) ? $_SESSION['dbName'] : '');

                form_label('Table prefix (usually can be left empty)');
                form_text('Table prefix', 'tablePrefix', isset($_SESSION['tablePrefix']) ? $_SESSION['tablePrefix'] : '');

                form_submit('Next');
            table_close();
        ?>
    </form>
<?php
    require('includes/footer.php');
?>
