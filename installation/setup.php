<?php
    require('includes/header.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
    <h3>Install PHPTimeclock 3</h3>

    <h2>Create Admin User</h2>

    <?php show_notices() ?>
    <form action="actions/create_admin.php" method="POST">
        <?php
            table_open();
                form_text('Admin Username', 'username', isset($_SESSION['username']) ? $_SESSION['username'] : '');
                form_pass('Password', 'password', isset($_SESSION['password']) ? $_SESSION['password'] : '');
                form_pass('Confirm', 'password2', isset($_SESSION['password2']) ? $_SESSION['password2'] : '');

                form_text('First Name', 'firstName', isset($_SESSION['firstName']) ? $_SESSION['firstName'] : '');
                form_text('Last Name', 'lastName', isset($_SESSION['lastName']) ? $_SESSION['lastName'] : '');
                form_text('Email', 'email', isset($_SESSION['email']) ? $_SESSION['email'] : '');

                form_submit('Create Admin User');
            table_close();
        ?>
    </form>

    <h2>OR Import from existing installation</h2>

    <?php show_notices() ?>
    <form action="actions/import_db.php" method="POST">
        <?php
            table_open();
                form_text('DB Host', 'dbImportHost', isset($_SESSION['dbImportHost']) ? $_SESSION['dbImportHost'] : '');
                form_text('DB Username', 'dbImportUser', isset($_SESSION['dbImportUser']) ? $_SESSION['dbImportUser'] : '');
                form_text('DB Password', 'dbImportPass', isset($_SESSION['dbImportPass']) ? $_SESSION['dbImportPass'] : '');
                form_text('DB Name', 'dbImportName', isset($_SESSION['dbImportName']) ? $_SESSION['dbImportName'] : '');

                form_label('Table prefix (usually can be left empty)');
                form_text('Table prefix', 'sourceDBPrefix', isset($_SESSION['sourceDBPrefix']) ? $_SESSION['sourceDBPrefix'] : '');

                form_submit('Import From Existing Database');
            table_close();
        ?>
    </form>
<?php
    require('includes/footer.php');
?>
