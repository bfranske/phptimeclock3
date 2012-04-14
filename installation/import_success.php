<?php
    require('includes/header.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
    <h3>Install PHPTimeclock 3</h3>

    <?php show_notices() ?>

    <?php
        echo $_SESSION['import_success_message'];

        if ($_SESSION['dbImported']){
            echo '<h2>Import Successful</h2>';
            echo "<form action='config.php'>";
                form_submit('Continue');
            echo '</form>';
        }
        else {
            echo '<h2>Import Failed</h2>';
            echo '<a href="setup.php">Go Back</a>';
        }
    ?>
<?php
    require('includes/footer.php');
?>
