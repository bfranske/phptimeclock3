<?php
    require('includes/header.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
    <h3>Install PHPTimeclock 3</h3>

    <h2>Config</h2>

    <?php show_notices() ?>
    <form action="actions/config.php" method="POST">
        <?php
            table_open();
                echo '<tr><td>Timezone</td><td>';
                    echo select_timezone();
                echo '</td></tr>';
                form_text('Company Name', 'companyName', isset($_SESSION['companyName']) ? $_SESSION['companyName'] : '');

                echo '<tr><td>Language</td>';
                echo '<td><select name="language">';
                    form_select('English US', 'en_US', false, 1);
                    form_select('English GB', 'en_GB', false);
                    form_select('Spanish', 'spanish', false);
                    form_select('Portuguese', 'portuguese');
                    form_select('German', 'german', false);
                    form_select('Estonian', 'estonian', false);
                echo '</select></td></tr>';

                form_submit('Submit');
            table_close();
        ?>
    </form>
<?php
    require('includes/footer.php');
?>
