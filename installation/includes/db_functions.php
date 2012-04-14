<?php
    function initialize_db($dbCredentials = false){
//        dump($dbCredentials);
//        die();
        $timeStart = microtime(true);
        $output = '';
        /*
         * Users
         */
            PDO_query('DROP TABLE IF EXISTS `'.TABLE_PREFIX.'users`', false, false, $dbCredentials);
            $query = "CREATE TABLE `".TABLE_PREFIX."users` (
                      `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                      `username` varchar(32) NOT NULL,
                      `password` varchar(56) NOT NULL,
                      `first_name` varchar(32) NOT NULL,
                      `last_name` varchar(32) NULL,
                      `email` varchar(128) DEFAULT NULL,
                      `sys_admin` tinyint(4) DEFAULT NULL,
                      `last_punch_id` mediumint(9) DEFAULT NULL,
                      `enabled` tinyint(4) NOT NULL DEFAULT '1',
                      `must_change_pass` tinyint(4) DEFAULT NULL,
                      `pin` bigint(20) unsigned NULL,
                      `custom_id` bigint(20) unsigned DEFAULT NULL,
                      PRIMARY KEY (`id`)
                    ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
            PDO_query($query, false, false, $dbCredentials);

    /*
     * Groups
     */
            PDO_query('DROP TABLE IF EXISTS `'.TABLE_PREFIX.'groups`', false, false, $dbCredentials);
            $query = "CREATE TABLE `".TABLE_PREFIX."groups` (
                      `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
                      `parent_id` smallint(5) unsigned NOT NULL,
                      `name` varchar(32) NOT NULL,
                      `camera_url` varchar(1024) DEFAULT NULL,
                      `enabled` tinyint(4) NOT NULL DEFAULT '1',
                      PRIMARY KEY (`id`)
                    ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
            PDO_query($query, false, false, $dbCredentials);

    /*
     * User Groups
     */
            PDO_query('DROP TABLE IF EXISTS `'.TABLE_PREFIX.'user_groups`', false, false, $dbCredentials);
            $query = "CREATE TABLE `".TABLE_PREFIX."user_groups` (
                      `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
                      `user_id` smallint(6) unsigned NOT NULL,
                      `group_id` smallint(6) unsigned NOT NULL DEFAULT '1',
                      `permissions` varchar(1024) DEFAULT NULL,
                      PRIMARY KEY (`id`)
                    ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
            PDO_query($query, false, false, $dbCredentials);

    /*
     * Punch Types
     */
            PDO_query('DROP TABLE IF EXISTS `'.TABLE_PREFIX.'punch_types`', false, false, $dbCredentials);
            $query = "CREATE TABLE `".TABLE_PREFIX."punch_types` (
                      `id` tinyint(4) unsigned NOT NULL AUTO_INCREMENT,
                      `status` tinyint(4) unsigned NOT NULL,
                      `name` varchar(32) NOT NULL,
                      `color` varchar(6) NOT NULL,
                      `order` smallint(5) unsigned NOT NULL,
                      `enabled` tinyint(4) unsigned NOT NULL DEFAULT '1',
                      PRIMARY KEY (`id`)
                    ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;";
            PDO_query($query, false, false, $dbCredentials);

            $query = "INSERT INTO `".TABLE_PREFIX."punch_types` (`id`, `status`, `name`, `color`, `order`, `enabled`) VALUES
                        (1, 1, 'In', '009900', 1, 1),
                        (2, 0, 'Lunch', '0000FF', 2, 1),
                        (3, 0, 'Break', 'F90', 3, 1),
                        (4, 0, 'Out', 'FF0000', 4, 1);";
            PDO_query($query, false, false, $dbCredentials);

    /*
     * Punches
     */
            PDO_query('DROP TABLE IF EXISTS `'.TABLE_PREFIX.'punches`', false, false, $dbCredentials);
            $query = "CREATE TABLE `".TABLE_PREFIX."punches` (
                  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                  `user_id` smallint(5) unsigned unsigned NOT NULL,
                  `group_id` smallint(6) unsigned NOT NULL,
                  `punch_type_id` tinyint(3) unsigned NOT NULL,
                  `next_punch_id` int(10) unsigned DEFAULT NULL,
                  `ip_address` varchar(32) NOT NULL,
                  `date_time` datetime NOT NULL,
                  `notes` varchar(1024) DEFAULT NULL,
                  `approved` tinyint(4) NOT NULL DEFAULT '0',
                  `approved_by` mediumint(8) unsigned NULL DEFAULT '0',
                  PRIMARY KEY (`id`),
                  KEY `user_id` (`user_id`)
                ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;;
    ";
            PDO_query($query, false, false, $dbCredentials);

    /*
     * CodeIgniter Sessions
     */
            $query = "CREATE TABLE IF NOT EXISTS`".TABLE_PREFIX."ci_sessions` (
                      `session_id` varchar(32) NOT NULL DEFAULT '',
                      `user_agent` varchar(255) DEFAULT NULL,
                      `ip_address` varchar(20) DEFAULT NULL,
                      `last_activity` int(12) DEFAULT NULL,
                      `user_data` mediumtext,
                      PRIMARY KEY (`session_id`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
            PDO_query($query, false, false, $dbCredentials);

    /*
     * Audit Table
     */
            PDO_query('DROP TABLE IF EXISTS `'.TABLE_PREFIX.'audits`', false, false, $dbCredentials);
            $query = "CREATE TABLE `".TABLE_PREFIX."audits` (
                      `id` mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
                      `punch_id` int(11) unsigned NOT NULL,
                      `editing_user_id` smallint(6) unsigned NOT NULL,
                      `ip_address` char(15) NOT NULL,
                      `reason_for_editing` varchar(512) NOT NULL,
                      `edit_action` varchar(32) NOT NULL,
                      `old_start` datetime DEFAULT NULL,
                      `old_end` datetime DEFAULT NULL,
                      `old_group_id` smallint(6) unsigned DEFAULT NULL,
                      `old_next_punch_id` int(10) unsigned DEFAULT NULL,
                      `old_punch_type_id` smallint(6) unsigned DEFAULT NULL,
                      `old_notes` varchar(512) DEFAULT NULL,
                      `old_tags` varchar(512) DEFAULT NULL,
                      `new_start` datetime DEFAULT NULL,
                      `new_end` datetime DEFAULT NULL,
                      `new_group_id` smallint(6) unsigned DEFAULT NULL,
                      `new_next_punch_id` int(10) unsigned DEFAULT NULL,
                      `new_punch_type_id` tinyint(3) unsigned DEFAULT NULL,
                      `new_notes` varchar(512) DEFAULT NULL,
                      `new_tags` varchar(512) DEFAULT NULL,
                      `when_changed` datetime NOT NULL,
                      PRIMARY KEY (`id`),
                      KEY `punch_id` (`punch_id`)
                    ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
            PDO_query($query, false, false, $dbCredentials);

    /*
     * Punch Tags
     */
            PDO_query('DROP TABLE IF EXISTS `'.TABLE_PREFIX.'punch_tags`', false, false, $dbCredentials);
            $query = "CREATE TABLE `".TABLE_PREFIX."punch_tags` (
                      `id` mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
                      `punch_id` mediumint(9) unsigned NOT NULL,
                      `tag_id` smallint(6) unsigned NOT NULL,
                      PRIMARY KEY (`id`),
                      KEY `punch_id` (`punch_id`),
                      KEY `tag_id` (`tag_id`)
                    ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
            PDO_query($query, false, false, $dbCredentials);


    /*
     *  Tags
     */
            PDO_query('DROP TABLE IF EXISTS `'.TABLE_PREFIX.'tags`', false, false, $dbCredentials);
            $query = "CREATE TABLE `".TABLE_PREFIX."tags` (
                      `id` smallint(6) NOT NULL AUTO_INCREMENT,
                      `name` varchar(64) NOT NULL,
                      `enabled` tinyint(4) NOT NULL DEFAULT '1',
                      PRIMARY KEY (`id`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
";
            PDO_query($query, false, false, $dbCredentials);

    /*
     * Config
     */
            PDO_query('DROP TABLE IF EXISTS `'.TABLE_PREFIX.'config`', false, false, $dbCredentials);
            $query = "CREATE TABLE `".TABLE_PREFIX."config` (
                      `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
                      `option` varchar(128) NOT NULL,
                      `value` varchar(512) NOT NULL,
                      PRIMARY KEY (`id`)
                    ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
            PDO_query($query, false, false, $dbCredentials);

            $query = "INSERT INTO `".TABLE_PREFIX."config` (`id`, `option`, `value`) VALUES
                        (1, 'language', 'en_US'),
                        (2, 'template', 'default'),
                        (3, 'timezone', 'T078'),
                        (4, 'db_version', '3'),
                        (5, 'companyName', 'Nexus'),
                        (6, 'userIdentifier', 'username'),
                        (7, 'punchBoardDays', '7'),
                        (8, 'DeveloperMode', '0'),
                        (9, 'selectGroupDisplay', 'always'),
                        (10, 'selectStatusStyle', 'buttons'),
                        (11, 'lastNameView', 'name'),
                        (12, 'restrictIPAddresses', 'No'),
                        (13, 'base_url', ''),
                        (14, 'useSSL', '0'),
                        (15, 'developerMode', '0'),
                        (16, 'useTags', 'Yes'),
                        (17, 'timeFormat', '12Hr'),
                        (18, 'dateFormat', 'm/d/Y'),
                        (19, 'punchBoardGroup', 'Show'),
                        (20, 'punchBoardNotes', 'Show'),
                        (21, 'minPasswordLength', '8'),
                        (22, 'userIdentifier_punch', 'username'),
                        (23, 'userIdentifier_board', 'username'),
                        (24, 'report_roundingDigits', '4'),
                        (25, 'report_showGroup', '1'),
                        (26, 'report_showTags', '1'),
                        (27, 'report_showDuration', '1'),
                        (28, 'report_enabledDurations', '1,2,3,4'),
                        (29, 'report_enabledTotals', '1,2,3,4'),
                        (30, 'report_durationFormat', 'decimal'),
                        (31, 'report_showOvertime', '0'),
                        (32, 'report_OTperWeekHours', '40'),
                        (33, 'report_OTperDayHours', '8'),
                        (34, 'requireEditReason', '1'),
                        (35, 'APIKey', ''),
                        (36, 'apiEnabled', '')";
            PDO_query($query, false, false, $dbCredentials);


    /*******************************************************************
     *****************             Views             *******************
     ******************************************************************/
        // Punch Log
            PDO_query('DROP TABLE IF EXISTS `'.TABLE_PREFIX.'punch_log`;', false, false, $dbCredentials);

            $punch_log = '
            CREATE OR REPLACE
            VIEW  `'.TABLE_PREFIX.'punch_log` AS
            SELECT p1.id, p1.user_id, p1.group_id, `'.TABLE_PREFIX.'groups`.`name` AS group_name, p1.punch_type_id, p1.date_time,  p2.date_time AS end_time, TIME_TO_SEC( TIMEDIFF( p2.date_time, p1.date_time ) ) AS duration, pt.name AS status_name, pt.status, GROUP_CONCAT(`'.TABLE_PREFIX.'tags`.`name`) AS tags, p1.notes, p1.approved, p1.approved_by
            FROM `'.TABLE_PREFIX.'punches` AS p1
            LEFT JOIN `'.TABLE_PREFIX.'punches` AS p2 ON p2.id = p1.next_punch_id
            LEFT JOIN `'.TABLE_PREFIX.'punch_types` AS pt ON p1.punch_type_id = pt.id
            LEFT JOIN `'.TABLE_PREFIX.'groups` ON p1.group_id = `'.TABLE_PREFIX.'groups`.`id`
            LEFT JOIN `'.TABLE_PREFIX.'punch_tags` ON p1.id = `'.TABLE_PREFIX.'punch_tags`.`punch_id`
            LEFT JOIN `'.TABLE_PREFIX.'tags` ON `'.TABLE_PREFIX.'punch_tags`.`tag_id` = `'.TABLE_PREFIX.'tags`.`id`
            GROUP BY p1.id';

            PDO_query($punch_log, false, false, $dbCredentials);

        // Punch Board
            PDO_query('DROP TABLE IF EXISTS `'.TABLE_PREFIX.'punch_board`;', false, false, $dbCredentials);

            $punch_board = '
            CREATE OR REPLACE
            VIEW  `'.TABLE_PREFIX.'punch_board` AS
            SELECT `'.TABLE_PREFIX.'punches`.`id`, username, first_name, last_name, user_id, group_id, `'.TABLE_PREFIX.'groups`.`name` AS group_name, `'.TABLE_PREFIX.'punch_types`.`name` AS punch_name, punch_type_id, date_time, pt.name AS status_name, pt.status,
            GROUP_CONCAT(`'.TABLE_PREFIX.'tags`.`name`) AS tags, notes, `'.TABLE_PREFIX.'punches`.`approved`, `'.TABLE_PREFIX.'punches`.`approved_by`
            FROM `'.TABLE_PREFIX.'punches`
            LEFT JOIN `'.TABLE_PREFIX.'punch_types` AS pt ON `'.TABLE_PREFIX.'punches`.`punch_type_id` = pt.id
            LEFT JOIN `'.TABLE_PREFIX.'users` ON `'.TABLE_PREFIX.'users`.`id` = user_id
            LEFT JOIN `'.TABLE_PREFIX.'groups` ON `'.TABLE_PREFIX.'punches`.`group_id` = `'.TABLE_PREFIX.'groups`.`id`
            LEFT JOIN `'.TABLE_PREFIX.'punch_tags` ON `'.TABLE_PREFIX.'punches`.`id` = `'.TABLE_PREFIX.'punch_tags`.`punch_id`
            LEFT JOIN `'.TABLE_PREFIX.'punch_types` ON `'.TABLE_PREFIX.'punch_types`.`id` = punch_type_id
            LEFT JOIN `'.TABLE_PREFIX.'tags` ON `'.TABLE_PREFIX.'punch_tags`.`tag_id` = `'.TABLE_PREFIX.'tags`.`id`
            WHERE next_punch_id IS NULL
            GROUP BY `'.TABLE_PREFIX.'punches`.`id`
            ORDER BY username';

            PDO_query($punch_board, false, false, $dbCredentials);


    /*******************************************************************
     *****************       Stored Proceedures      *******************
     ******************************************************************/

    /*
     * Edit Time
     */
            PDO_query('DROP PROCEDURE IF EXISTS `'.TABLE_PREFIX.'edit_time`;', false, false, $dbCredentials);
            PDO_query("
            CREATE PROCEDURE `".TABLE_PREFIX."edit_time` (punchID INT, editingUserID INT, ipAddress VARCHAR(32), reasonForEditing VARCHAR(512), newStart DATETIME, newGroupID INT, newPunchTypeID INT, newNotes VARCHAR(1024), newTags VARCHAR(512), whenChanged DATETIME)
            BEGIN
                SELECT group_id, punch_type_id, next_punch_id, date_time, notes, GROUP_CONCAT(name) AS tags INTO @oldGroupID, @oldPunchTypeID, @nextPunchID, @oldStart, @oldNotes, @oldTags
                FROM `".TABLE_PREFIX."punches`
                LEFT JOIN `".TABLE_PREFIX."punch_tags` ON `".TABLE_PREFIX."punches`.`id` = punch_id
                LEFT JOIN `".TABLE_PREFIX."tags` on `".TABLE_PREFIX."punch_tags`.`tag_id` = `".TABLE_PREFIX."tags`.`id`
                WHERE `".TABLE_PREFIX."punches`.`id` = punchID
                GROUP BY `".TABLE_PREFIX."punches`.`id`;

                SELECT date_time INTO @oldEnd FROM `".TABLE_PREFIX."punches` WHERE id = @nextPunchID;

                UPDATE `".TABLE_PREFIX."punches` SET date_time = newStart, group_id = newGroupID, punch_type_id = newPunchTypeID, notes = newNotes
                WHERE `".TABLE_PREFIX."punches`.`id` = punchID;

                INSERT INTO `".TABLE_PREFIX."audits` (edit_action, punch_id, editing_user_id, ip_address, reason_for_editing, old_start, old_end, old_group_id, old_next_punch_id, old_punch_type_id, old_notes, old_tags,
                                    new_start, new_group_id, new_next_punch_id, new_punch_type_id, new_notes, new_tags, when_changed)
                            VALUES ('edit', punchID, editingUserID, ipAddress, reasonForEditing, @oldStart, @oldEnd, @oldGroupID, @nextPunchID, @oldPunchTypeID, @oldNotes, @oldTags,
                                    newStart, newGroupID, @nextPunchID, newPunchTypeID, newNotes, newTags, whenChanged);

                DELETE FROM `".TABLE_PREFIX."punch_tags` WHERE punch_id = punchID;

                CALL `".TABLE_PREFIX."ensure_tags_exist`(',', newTags);
                CALL `".TABLE_PREFIX."explode`(',', newTags);
                INSERT INTO `".TABLE_PREFIX."punch_tags` (punch_id, tag_id)
                SELECT punchID AS punch_id, `".TABLE_PREFIX."tags`.`id` AS tag_id FROM temp_explode
                LEFT JOIN `".TABLE_PREFIX."tags` on word = name;
            END
            ", false, false, $dbCredentials);

    /*
     * Delete Time
     */
            PDO_query('DROP PROCEDURE IF EXISTS `'.TABLE_PREFIX.'delete_time`;', false, false, $dbCredentials);
            PDO_query("
            CREATE PROCEDURE `".TABLE_PREFIX."delete_time` (punchID INT, editingUserID INT, ipAddress VARCHAR(32), reasonForEditing VARCHAR(512), whenChanged DATETIME)
            BEGIN
                SELECT id INTO @previousPunchID FROM `".TABLE_PREFIX."punches` WHERE next_punch_id = punchID;

                SELECT user_id, group_id, punch_type_id, next_punch_id, date_time, notes, GROUP_CONCAT(name) AS tags INTO @userID, @oldGroupID, @oldPunchTypeID, @nextPunchID, @oldStart, @oldNotes, @oldTags
                FROM `".TABLE_PREFIX."punches`
                LEFT JOIN `".TABLE_PREFIX."punch_tags` ON `".TABLE_PREFIX."punches`.`id` = punch_id
                LEFT JOIN `".TABLE_PREFIX."tags` on `".TABLE_PREFIX."punch_tags`.`tag_id` = `".TABLE_PREFIX."tags`.`id`
                WHERE `".TABLE_PREFIX."punches`.`id` = punchID
                GROUP BY `".TABLE_PREFIX."punches`.`id`;

                UPDATE `".TABLE_PREFIX."punches` SET next_punch_id = @nextPunchID
                WHERE `".TABLE_PREFIX."punches`.`id` = @previousPunchID;

                DELETE FROM `".TABLE_PREFIX."punches`
                WHERE id = punchID;

                INSERT INTO `".TABLE_PREFIX."audits` (edit_action, punch_id, editing_user_id, ip_address, reason_for_editing, old_start, old_end, old_group_id, old_next_punch_id, old_punch_type_id, old_notes, old_tags,
                                    new_start, new_end, new_group_id, new_next_punch_id, new_punch_type_id, new_notes, new_tags, when_changed)
                            VALUES ('delete', punchID, editingUserID, ipAddress, reasonForEditing, @oldStart, @oldEnd, @oldGroupID, @nextPunchID, @oldPunchTypeID, @oldNotes, @oldTags,
                                    NULL, NULL, NULL, @nextPunchID, NULL, NULL, NULL, whenChanged);

                DELETE FROM `".TABLE_PREFIX."punch_tags` WHERE punch_id = punchID;
            END
            ", false, false, $dbCredentials);

    /*
     * Add Time
     */
            PDO_query('DROP PROCEDURE IF EXISTS `'.TABLE_PREFIX.'add_time`;', false, false, $dbCredentials);
            PDO_query("
                CREATE PROCEDURE `".TABLE_PREFIX."add_time` (userID INT, previousPunchID INT, editingUserID INT, ipAddress VARCHAR(32), reasonForEditing VARCHAR(512), newStart DATETIME,  newGroupID INT, newPunchTypeID INT, newNotes VARCHAR(1024), newTags VARCHAR(512), passedNextPunchID INT, whenChanged DATETIME)
                BEGIN
                    SELECT group_id, punch_type_id, next_punch_id, date_time, notes, GROUP_CONCAT(name) AS tags
                     INTO @oldGroupID, @oldPunchTypeID, @nextPunchID, @oldStart, @oldNotes, @oldTags
                    FROM `".TABLE_PREFIX."punches`
                    LEFT JOIN `".TABLE_PREFIX."punch_tags` ON `".TABLE_PREFIX."punches`.`id` = punch_id
                    LEFT JOIN `".TABLE_PREFIX."tags` on `".TABLE_PREFIX."punch_tags`.`tag_id` = `".TABLE_PREFIX."tags`.`id`
                    WHERE `".TABLE_PREFIX."punches`.`id` = previousPunchID
                    GROUP BY `".TABLE_PREFIX."punches`.`id`;

                    IF (@nextPunchID) THEN SET @nextPunchID = @nextPunchID;
                    ELSE SET @nextPunchID = passedNextPunchID;
                    END IF;

                    INSERT INTO `".TABLE_PREFIX."punches` (user_id, group_id, date_time, next_punch_id, punch_type_id, notes)
                                 VALUES (userID, newGroupID, newStart, @nextPunchID, newPunchTypeID, newNotes);
                    SELECT LAST_INSERT_ID() INTO @newPunchID;

                    UPDATE `".TABLE_PREFIX."punches` SET next_punch_id = @newPunchID
                    WHERE id = previousPunchID;

                    INSERT INTO `".TABLE_PREFIX."audits` (edit_action, punch_id, editing_user_id, ip_address, reason_for_editing, old_start, old_end, old_group_id, old_next_punch_id, old_punch_type_id, old_notes, old_tags,
                                        new_start, new_group_id, new_next_punch_id, new_punch_type_id, new_notes, new_tags, when_changed)
                                VALUES ('add', @newPunchID, editingUserID, ipAddress, reasonForEditing, NULL, NULL, NULL, NULL, NULL, NULL, NULL,
                                        newStart, newGroupID, @nextPunchID, newPunchTypeID, newPunchTypeID, newTags, whenChanged);

                    CALL `".TABLE_PREFIX."ensure_tags_exist`(',', newTags);
                    CALL `".TABLE_PREFIX."explode`(',', newTags);
                    INSERT INTO `".TABLE_PREFIX."punch_tags` (punch_id, tag_id)
                    SELECT @newPunchID AS punch_id, `".TABLE_PREFIX."tags`.`id` AS tag_id FROM temp_explode
                    LEFT JOIN `".TABLE_PREFIX."tags` on word = name;
                END
            ", false, false, $dbCredentials);

    /*
     * Ensure Tags Exist
     */
            PDO_query('DROP PROCEDURE IF EXISTS `'.TABLE_PREFIX.'ensure_tags_exist`;', false, false, $dbCredentials);
            PDO_query("
            CREATE PROCEDURE `".TABLE_PREFIX."ensure_tags_exist`( pDelim VARCHAR(32), pStr TEXT)
            BEGIN
              DECLARE n INT DEFAULT 0;
              DECLARE pos INT DEFAULT 1;
              DECLARE strRemain TEXT;
              DECLARE wrd text;
              DECLARE tagID INT;

              SET strRemain = pStr;
              SET pos = LOCATE( pDelim, strRemain );
              WHILE pos != 0 DO
                SET tagID = 0;
                SET n = n + 1;
                SET pos = LOCATE( pDelim, strRemain );

                IF pos=0 THEN SET wrd= strRemain;
                ELSE SET wrd= TRIM(REPLACE(SUBSTRING( strRemain, 1,pos ), pDelim, ''));
                END IF;

                SET strRemain = SUBSTRING( strRemain, pos+1 );

                IF CHAR_LENGTH(TRIM(wrd)) THEN
                    SELECT id INTO tagID FROM `".TABLE_PREFIX."tags` WHERE name = wrd;
                    IF tagID = 0 THEN
                        INSERT INTO `".TABLE_PREFIX."tags` (name, id) VALUES (wrd, tagID);
                    END IF;
                END IF;
              END WHILE;
            END;", false, false, $dbCredentials);

    /*
     * Explode
     */
            PDO_query('DROP PROCEDURE IF EXISTS `'.TABLE_PREFIX.'explode`;', false, false, $dbCredentials);
            PDO_query("
            CREATE PROCEDURE `".TABLE_PREFIX."explode`( pDelim VARCHAR(32), pStr TEXT)
            BEGIN
              DECLARE n INT DEFAULT 0;
              DECLARE pos INT DEFAULT 1;
              DECLARE strRemain TEXT;
              DECLARE wrd text;

              CREATE TEMPORARY TABLE IF NOT EXISTS temp_explode (id INT AUTO_INCREMENT PRIMARY KEY NOT NULL, word VARCHAR(40));
              DELETE FROM temp_explode;
              SET strRemain = pStr;
              SET pos = LOCATE( pDelim, strRemain );
              WHILE pos != 0 DO
                SET n = n + 1;
                SET pos = LOCATE( pDelim, strRemain );

                IF pos=0 THEN SET wrd= strRemain;
                ELSE SET wrd= TRIM(REPLACE(SUBSTRING( strRemain, 1,pos ), pDelim, ''));
                END IF;

                SET strRemain = SUBSTRING( strRemain, pos+1 );
                INSERT INTO temp_explode (word) VALUES (wrd);
              END WHILE;
            END;", false, false, $dbCredentials);

    /*
     * Punch
     */
            PDO_query('DROP PROCEDURE IF EXISTS `'.TABLE_PREFIX.'punch`;', false, false, $dbCredentials);
            PDO_query("
            CREATE PROCEDURE `".TABLE_PREFIX."punch`( userID INT, groupID INT, punchTypeID INT, ipAddress VARCHAR(32), dateTime VARCHAR(64), notes VARCHAR(1024), tags VARCHAR(1024))
            BEGIN
              SELECT id INTO @lastPunchID FROM `".TABLE_PREFIX."punches` WHERE next_punch_id IS NULL AND user_id = userID;

              INSERT INTO `".TABLE_PREFIX."punches` (user_id, group_id, punch_type_id, ip_address, date_time, notes)
                           VALUES (userID, groupID, punchTypeID, ipAddress, dateTime, notes);

              IF @lastPunchID IS NOT NULL THEN
                UPDATE `".TABLE_PREFIX."punches` SET next_punch_id = LAST_INSERT_ID() WHERE id = @lastPunchID;
              END IF;

              SELECT LAST_INSERT_ID() INTO @newPunchID;

              CALL `".TABLE_PREFIX."ensure_tags_exist`(',', tags);
              CALL `".TABLE_PREFIX."explode`(',', tags);
              INSERT INTO `".TABLE_PREFIX."punch_tags` (punch_id, tag_id)
              SELECT @newPunchID AS punch_id, `".TABLE_PREFIX."tags`.`id` AS tag_id FROM temp_explode
              LEFT JOIN `".TABLE_PREFIX."tags` on word = name;
            END;", false, false, $dbCredentials);
    }

    function import_from_db($dbCredentials, $tablePrefix){
        $timeStart = microtime(true);
        $output = '';

        $result = PDO_query('SHOW TABLES', false, false, $dbCredentials);

        $_SESSION['import_success_message'] = '';
        $_SESSION['dbImported'] = false;

        foreach ($result as $row){
            if (in_array($tablePrefix.'dbversion', $row)){
                import_from_v1($dbCredentials,$tablePrefix);
                $_SESSION['dbImported'] = true;
                return true;
                break;
            }
            else if (in_array($tablePrefix.'action_applications', $row)){
                import_from_v2($dbCredentials,$tablePrefix);
                $_SESSION['dbImported'] = true;
                return true;
                break;
            }
            else if (in_array($tablePrefix.'config', $row)){
                import_from_v3($dbCredentials,$tablePrefix);
                $_SESSION['dbImported'] = true;
                return true;
                break;
            }
        }
        
        add_error('Connected to database, but it doesn\'t appear to be a valid PHPTimeclock database!!!');

    }

/********************************
 ******* Version 1 Import *******
 ********************************/
    function import_from_v1($dbCredentials, $tablePrefix){
        $timeStart = microtime(true);
        $output = '';
/*
 * Users
 */
        $nullPasswords = 0;
        $addedUsers = 0;
        $oldUsers = PDO_query('SELECT empfullname, employee_passwd, displayname, email, disabled FROM `'.$tablePrefix.'employees`', false, false, $dbCredentials);
        foreach ($oldUsers as $user){
            extract($user);
            $addedUsers++;
            $data = array();
            $data['username'] = $empfullname;
            if ($employee_passwd == NULL){
                $newPassword = generatePassword();
                $data['password'] = encrypt_password($newPassword);
                @$nullPasswords++;
                @$nullPasswordUsers[$empfullname] = $newPassword;
            }
            else {
                $newPassword = generatePassword();
                $data['password'] = encrypt_password($newPassword);
                @$weakPasswords++;
                @$weakPasswordUsers[$empfullname] = $newPassword;
            }


            if (strpos($empfullname, ' ')){
                $data['first_name'] = substr($empfullname, 0, strrpos($empfullname, ' '));
                $data['last_name'] = substr($empfullname, strrpos($empfullname, ' ') + 1);
            }
            else {
                $data['first_name'] = $empfullname;
                $data['last_name'] = '';
            }

            $data['email'] = $email;
            $data['enabled'] = ! $disabled;
            PDO_query('INSERT INTO `'.TABLE_PREFIX.'users` (username, password, first_name, last_name, email, enabled) VALUES(:username, :password, :first_name, :last_name, :email, :enabled)', $data);
//            $db->insert('users', $data);
        }
        if ($nullPasswords){
            $output .= "<br /><strong>There were $nullPasswords empty passwords, they have been reset<br />";
            $output .= 'The following users were effected: </strong><br />';

            $rowsPerCol = ceil(count($nullPasswordUsers) / 5);
            $row = $col = 1;

         // @TODO Optomize import null/weak password name display
            if (count($nullPasswordUsers) > 1){
                foreach ($nullPasswordUsers as $username => $password){
                    $result = PDO_query('SELECT * FROM `'.TABLE_PREFIX.'users` WHERE username = :username', array('username' => $username));
//                    $result = $db->get_where('users', array('username' => $user));
//                    $result = $result->result();
                    $usernames[$username] = $result[0]['username'];
                    $fullNames[$username] = $result[0]['first_name'] . ' ' . $result[0]['last_name'];

                    $links[$row][$col] =  "<strong>$username:</strong> $password";

                    if ($row == $rowsPerCol){
                        $row = 1;
                    }
                    else {
                        $row++;
                    }

                    if ($col == 5){
                        $col = 1;
                    }
                    else {
                        $col++;
                    }
                }

                $output .= '<table class="everythingTable">';
                    foreach ($links as $row){
                        $output .= '<tr>';
                            foreach ($row as $col){
                                $output .= "<td valign='top'>$col</td>";
                            }
                        $output .= '</tr>';
                    }
                $output .= '</table>';
            }
        }
        $output .=  '<br />';

        if ($weakPasswords){
            $output .= "<br /><strong>There were $weakPasswords passwords that were using a weaker password hash from previous version, they have been reset. <br />";
            $output .= 'The following users were effected: </strong><br />';

            $rowsPerCol = ceil(count($weakPasswordUsers) / 5);
            $row = $col = 1;

            if (count($weakPasswordUsers) > 1){
                foreach ($weakPasswordUsers as $username => $password){
                    $result = PDO_query('SELECT * FROM `'.TABLE_PREFIX.'users` WHERE username = :username', array('username' => $username));
//                    $result = $db->get_where('users', array('username' => $user));
//                    $result = $result->result();
                    $usernames[$username] = $result[0]['username'];
                    $fullNames[$username] = $result[0]['first_name'] . ' ' . $result[0]['last_name'];


                    $links[$row][$col] =  "<strong>$username:</strong> $password";

                    if ($row == $rowsPerCol){
                        $row = 1;
                    }
                    else {
                        $row++;
                    }

                    if ($col == 5){
                        $col = 1;
                    }
                    else {
                        $col++;
                    }
                }

                $output .= '<table class="everythingTable">';
                    foreach ($links as $row){
                        $output .= '<tr>';
                            foreach ($row as $col){
                                $output .= "<td valign='top'>$col</td>";
                            }
                        $output .= '</tr>';
                    }
                $output .= '</table>';
            }
        }

/*
 * User IDs
 */
        $userIDs = array();
        $userNames = PDO_query('SELECT id, username FROM `'.TABLE_PREFIX.'users`');
        foreach ($userNames as $userName){
            $userIDs[$userName['username']] = $userName['id'];
        }
/*
 * Groups
 * 
 */
        PDO_query('INSERT INTO `'.TABLE_PREFIX.'groups` (id, parent_id, name) VALUES (1, 0, "All Users")');
//        $db->insert('groups', array('id' => 1, 'parent_id' => 0, 'name' => 'All Users'));

    // Old Offices
        $addedGroups = 0;
        $oldOffices = PDO_query('SELECT officeid AS office_id, officename AS office_name FROM `'.$tablePrefix.'offices`', false, false, $dbCredentials);
        foreach ($oldOffices as $office){
            $addedGroups++;
            extract($office);
            $data = array();

            $data['id'] = $office_id > 1 ? $office_id : 32767;
            $data['parent_id'] = 1;
            $data['name'] = $office_name;
            PDO_query('INSERT INTO `'.TABLE_PREFIX.'groups` (id, parent_id, name) VALUES (:id, :parent_id, :name)', $data);
//            $db->insert('groups', $data);
        }

    // Old Groups
        $oldGroups = PDO_query('SELECT groupname, groupid, officeid AS office_id FROM `'.$tablePrefix.'groups`', false, false, $dbCredentials);
        foreach ($oldGroups as $group){
            $addedGroups++;
            extract($group);
            $data = array();

            $data['id'] = $groupid > 1 ? ($groupid + 32767) : 32766;
            $data['parent_id'] = $office_id > 1 ? $office_id : 32767;
            $data['name'] = $groupname;
            PDO_query('INSERT INTO `'.TABLE_PREFIX.'groups` (parent_id, name) VALUES (:parent_id, :name)', $data);
//            $db->insert('groups', $data);
        }
// @TODO User Groups on V1 import
/*
 * User Groups
 */
    // Offices
        $query = 'SELECT empfullname, `'.$tablePrefix.'offices`.`officeid`, groupid FROM `'.$tablePrefix.'employees`
                  LEFT JOIN `'.$tablePrefix.'offices` ON `'.$tablePrefix.'offices`.`officename` = `'.$tablePrefix.'employees`.`office`
                  LEFT JOIN `'.$tablePrefix.'groups` ON `'.$tablePrefix.'groups`.`groupname` = `'.$tablePrefix.'employees`.`groups`';
        $oldOffices = PDO_query($query, false, false, $dbCredentials);
        foreach ($oldOffices as $office){
            extract($office);
            $data = array();

            $data['user_id'] = $userIDs[$empfullname];
            $data['group_id'] = $officeid > 1 ? $officeid : 32767;
            PDO_query('INSERT INTO `'.TABLE_PREFIX.'user_groups` (user_id, group_id) VALUES (:user_id, :group_id)', $data);
//            $db->insert('user_groups', $data);

            $data['group_id'] = $groupid > 1 ? ($groupid + 32767) : 32766;
            PDO_query('INSERT INTO `'.TABLE_PREFIX.'user_groups` (user_id, group_Id) VALUES (:user_id, :group_id)', $data);
//            $this->db->insert('user_groups', $data);
        }

/*
 * Add all users to "All Users" group with punch permission
 */
        $result = PDO_query('SELECT empfullname FROM `'.$tablePrefix.'employees`', false, false, $dbCredentials);
        foreach ($result as $row){
            extract($row);

            $data['user_id'] = $userIDs[$empfullname];
            $data['group_id'] = 1;
            $data['permissions'] = 'punch';
            PDO_query('INSERT INTO `'.TABLE_PREFIX.'user_groups` (user_id, group_id, permissions) VALUES (:user_id, :group_id, :permissions)', $data);
//            $db->insert('user_groups', array('user_id' => $userIDs[$empfullname], 'group_id' => 1, 'permissions' => 'punch'));
        }

/*
 * Punch Types
 */
        PDO_query('TRUNCATE `'.TABLE_PREFIX.'punch_types`');
        $oldPunchTypes = PDO_query('SELECT punchitems, in_or_out, color FROM `'.$tablePrefix.'punchlist`', false, false, $dbCredentials);
        foreach ($oldPunchTypes as $punchType){
            extract($punchType);
            $data = array();

            $data['status'] = $in_or_out;
            $data['name'] = $punchitems;
            $data['color'] = str_replace('#', '', $color);
            $data['enabled'] = 1;
            PDO_query('INSERT INTO `'.TABLE_PREFIX.'punch_types` (status, name, color, enabled) VALUES (:status, :name, :color, :enabled)', $data);
//            $db->insert('punch_types', $data);
        }
        PDO_query('UPDATE `'.TABLE_PREFIX.'punch_types` SET `order` = id');

/*
 * Punches
 */


        $statusIDs = array();
        $statusTypes = PDO_query('SELECT id, status, name FROM `'.TABLE_PREFIX.'punch_types`');
        foreach ($statusTypes as $statusType){
            $statusTypeIDs[$statusType['name']] = $statusType['id'];
        }

        $users = PDO_query('SELECT empfullname FROM `'.$tablePrefix.'employees`', false, false, $dbCredentials);
        $addedPunches = 0;
        foreach ($users as $user){
            $numPunches = PDO_query('SELECT COUNT(*) FROM `'.$tablePrefix.'info` WHERE fullname = :empfullname', array('empfullname' => $user['empfullname']), false, $dbCredentials);
            $numPunches = $numPunches[0]['COUNT(*)'];
            $maxInserts = 100;
            $maxLimit = $maxInserts + 1;
            for ($i = 0; $i < $numPunches; $i += $maxInserts){
                $params = array();
                $params['empfullname'] = $user['empfullname'];
                $query = "SELECT fullName, `inout`, `timestamp`, notes, `ipaddress`
                            FROM `".$tablePrefix."info`
                            WHERE fullname = :empfullname
                            ORDER BY `timestamp` ASC
                            LIMIT $i, $maxLimit";
                $oldPunches = PDO_query($query, $params, false, $dbCredentials);
                // @TODO Finish V1 import here
                $query = 'INSERT INTO `'.TABLE_PREFIX.'punches` (`user_id`, `group_id`, `punch_type_id`, `ip_address`, `date_time`, `notes`, `approved`) VALUES
';
                $values = array();
                foreach ($oldPunches as $index => $punch){
                    if ($index != $maxInserts){
                        extract($punch);
                        $data = array();

                        $values[] = $user_id = $userIDs[$fullName];
                        $values[] = $group_id = 1;
                        $values[] = $punch_type_id = $statusTypeIDs[$inout];
//                      $values[] = $next_punch_id = isset($oldPunches[$index + 1]['punch_log_id']) ? $oldPunches[$index + 1]['punch_log_id'] : NULL;
                        $values[] = $ipaddress ? $ipaddress : '';
                        $values[] = date('Y-m-d H:i:s', $timestamp);
                        $values[] = $notes;
                        $values[] = 1;

                        $query .= "(?, ?, ?, ?, ?, ?, ?),";

                        $addedPunches++;
                    }
                }
                $query = substr($query, 0, strlen($query) -1);

                PDO_query($query, $values);
            }
        }

/*
 * Update next_punch_ids
 *
 */
        $users = PDO_query('SELECT * FROM `'.TABLE_PREFIX.'users`');
        foreach($users as $index => $user){
            $punches = PDO_query('SELECT * FROM `'.TABLE_PREFIX.'punches` WHERE user_id = :user_id ORDER BY date_time ASC', array('user_id' => $user['id']));
//            $db->order_by('date_time', 'ASC');
//            $punches = $db->get_where('punches', array('user_id' => $user['id']));
//            $punches = $punches->result();
            foreach($punches as $index => $punch){
                $nextPunchID = isset($punches[$index + 1]) ? $punches[$index + 1]['id'] : NULL;

                PDO_query('UPDATE `'.TABLE_PREFIX.'punches` SET next_punch_id = :next_punch_id WHERE id = :id', array('id' => $punches[$index]['id'], 'next_punch_id' => $nextPunchID));
//                $db->where('id', $punches[$index]->id);
//                $db->update('punches', array('next_punch_id' => $nextPunchID));
            }
        }

/*
 * Permissions
 */
    // Offices
        $query = 'SELECT empfullname, admin, reports, time_admin
                    FROM `'.$tablePrefix.'employees`';
        $userPermissions = PDO_query($query, false, false, $dbCredentials);
        foreach ($userPermissions as $permission){
            extract($permission);

            if ($admin){
                PDO_query('UPDATE `'.TABLE_PREFIX.'users` SET sys_admin = 1 WHERE id = :id', array('id' => $userIDs[$empfullname]));
//                $db->where('id', $userIDs[$empfullname]);
//                $db->update('users', array('sys_admin' => $admin));
            }
            if ($reports){
                $result = PDO_query('SELECT * FROM `'.TABLE_PREFIX.'user_groups` WHERE user_id = :user_id AND group_id = 1', array('user_id' => $userIDs[$empfullname]));
//                $result = $db->get_where('user_groups', array('user_id' => $userIDs[$empfullname], 'group_id' => 1));
                foreach ($result as $user){
                    PDO_query('UPDATE `'.TABLE_PREFIX.'users` SET sys_admin = 1 WHERE id = :id', array('id' => $user['id']), array('permissions' => $user['permissions'] ? "{$user['permissions']}, runReports" : 'runReports'));
//                    $db->where('id', $user->id);
//                    $db->update('user_groups', array('permissions' => $user->permissions ? "$user->permissions, runReports" : 'runReports'));
                }
            }
            if ($time_admin){
                $result = PDO_query('SELECT * FROM `'.TABLE_PREFIX.'user_groups` WHERE user_id = :user_id AND group_id = 1', array('user_id' => $userIDs[$empfullname]));
//                $result = $db->get_where('user_groups', array('user_id' => $userIDs[$empfullname], 'group_id' => 1));
                foreach ($result as $user){
                    PDO_query('UPDATE `'.TABLE_PREFIX.'users` SET sys_admin = 1 WHERE id = :id', array('id' => $user['id']), array('permissions' => $user['permissions'] ? "{$user['permissions']}, editTime" : 'editTime'));
//                    $db->where('id', $user->id);
//                    $db->update('user_groups', array('permissions' => $user->permissions ? "$user->permissions, editTime" : 'editTime'));
                }
            }
        }
        $addedUsers = number_format($addedUsers, 0);
        $output.= "<br />Added $addedUsers Users";
        $addedGroups = number_format($addedGroups, 0);
        $output.= "<br />Added $addedGroups Groups";
        $addedPunches = number_format($addedPunches, 0);
        $output.= "<br />Added $addedPunches Punches";
        $timeElapsed = number_format(microtime(true) - $timeStart, 4);
        $output.= "<br>DB Import ran in $timeElapsed";
        $_SESSION['import_success_message'] = $output;
    }

/********************************
 ******* Version 2 Import *******
 ********************************/

    function import_from_v2($dbCredentials, $tablePrefix){
        $timeStart = microtime(true);
        $output = '';
    /*
     * Users
     */
        $nullPasswords = $weakPasswords = 0;
        $nullPasswordUsers = $weakPasswordUsers = array();
        $addedUsers = 0;
        $oldUsers = PDO_query('SELECT user_id, user_name, full_name, email, user_password, enabled FROM `'.$tablePrefix.'users`', false, false, $dbCredentials);
        foreach ($oldUsers as $user){
            extract($user);
            $addedUsers++;
            $data = array();
            $data['id'] = $user_id;
            $data['username'] = $user_name;
            if ($user_password == NULL){
                $newPassword = generatePassword();
                $data['password'] = encrypt_password($newPassword);
                @$nullPasswords++;
                @$nullPasswordUsers[$user_name] = $newPassword;
            }
            else if (substr($user_password, 0, 2) == 'xy'){
                $newPassword = generatePassword();
                $data['password'] = encrypt_password($newPassword);
                @$weakPasswords++;
                @$weakPasswordUsers[$user_name] = $newPassword;
            }
            else {
                $data['password'] = $user_password;
            }

            if (strpos($full_name, ' ')){
                $data['first_name'] = substr($full_name, 0, strrpos($full_name, ' '));
                $data['last_name'] = substr($full_name, strrpos($full_name, ' ') + 1);
//                if (! $data['last_name'])
//                    $data['last_name'] = ' ';
            }
            else {
                $data['first_name'] = $full_name;
                $data['last_name'] = ' ';
            }

            $data['email'] = $email;
            $data['enabled'] = $enabled;

            PDO_query('INSERT INTO `'.TABLE_PREFIX.'users` (id, username, password, first_name, last_name, email, enabled) VALUES(:id, :username, :password, :first_name, :last_name, :email, :enabled)', $data);
//            $this->db->insert('users', $data);
        }
        if ($nullPasswords){
            $output .= "<br /><strong>There were $nullPasswords empty passwords, they have been reset. <br />";
            $output .= 'The following users were effected: </strong><br />';

            $rowsPerCol = ceil(count($nullPasswordUsers) / 5);
            $row = $col = 1;

            foreach ($nullPasswordUsers as $username => $password){
                $result = PDO_query('SELECT * FROM `'.TABLE_PREFIX.'users` WHERE username = :username', array('username' => $username));
                $usernames[$username] = $result[0]['username'];
                $fullNames[$username] = $result[0]['first_name'] . ' ' . $result[0]['last_name'];


                $links[$row][$col] =  "<strong>$username:</strong> $password";

                if ($row == $rowsPerCol){
                    $row = 1;
                }
                else {
                    $row++;
                }

                if ($col == 5){
                    $col = 1;
                }
                else {
                    $col++;
                }
            }

            $output .= '<table class="everythingTable">';
                foreach ($links as $row){
                    $output .= '<tr>';
                        foreach ($row as $col){
                            $output .= "<td valign='top'>$col</td>";
                        }
                    $output .= '</tr>';
                }
            $output .= '</table>';
        }

        $output .=  '<br />';

        if ($weakPasswords){
            $links = array();
            $output .= "<br /><strong>There were $weakPasswords passwords that were using a weaker password hash from previous version, they have been changed to thier usernames, affected users will be forced to change password on login. <br />";
            $output .= 'The following users were effected: </strong><br />';
            $rowsPerCol = ceil(count($weakPasswordUsers) / 5);
            $row = $col = 1;

            foreach ($weakPasswordUsers as $username => $password){
                $result = PDO_query('SELECT * FROM `'.TABLE_PREFIX.'users` WHERE username = :username', array('username' => $username));
                $usernames[$username] = $result[0]['username'];
                $fullNames[$username] = $result[0]['first_name'] . ' ' . $result[0]['last_name'];


                $links[$row][$col] =  "<strong>$username:</strong> $password";

                if ($row == $rowsPerCol){
                    $row = 1;
                }
                else {
                    $row++;
                }

                if ($col == 5){
                    $col = 1;
                }
                else {
                    $col++;
                }
            }

            $output .= '<table class="everythingTable">';
                foreach ($links as $row){
                    $output .= '<tr>';
                        foreach ($row as $col){
                            $output .= "<td valign='top'>$col</td>";
                        }
                    $output .= '</tr>';
                }
            $output .= '</table>';
        }

        $output .=  '<br />';


    /*
     * Groups
     */
        PDO_query('INSERT INTO `'.TABLE_PREFIX.'groups` (id, parent_id, name) VALUES (1, 0, "All Users")');
        
        // Old Offices
            $addedGroups = 0;
            $oldOffices = PDO_query('SELECT office_id, office_name FROM `'.$tablePrefix.'offices`', false, false, $dbCredentials);
            foreach ($oldOffices as $office){
                $addedGroups++;
                extract($office);
                $data = array();

                $data['id'] = $office_id > 1 ? $office_id : 32767;
                $data['parent_id'] = 1;
                $data['name'] = $office_name;
                PDO_query('INSERT INTO `'.TABLE_PREFIX.'groups` (id, parent_id, name) VALUES (:id, :parent_id, :name)', $data);
//                $this->db->insert('groups', $data);
            }
        // Update Auto Increment
            $maxID = PDO_query('SELECT MAX(office_id) AS maxID FROM `'.$tablePrefix.'offices`', false, false, $dbCredentials);
            $maxID = $maxID[0]['maxID'];
            PDO_query("ALTER TABLE `".TABLE_PREFIX."groups` AUTO_INCREMENT = $maxID") or die(mysql_error());

        // Old Departments
            $oldDepartments = PDO_query('SELECT department_id, office_id, department_name FROM `'.$tablePrefix.'departments`', false, false, $dbCredentials);
            foreach ($oldDepartments as $department){
                $addedGroups++;
                extract($department);
                $data = array();

                $data['id'] = (($department_id > 1) ? ($department_id + 32767) : 32766);
                $data['parent_id'] = $office_id > 1 ? $office_id : 32767;
                $data['name'] = $department_name;
                PDO_query('INSERT INTO `'.TABLE_PREFIX.'groups` (id, parent_id, name) VALUES (:id, :parent_id, :name)', $data);
//                $this->db->insert('groups', $data);
            }

     /*
     * Add all users to "All Users" group with punch permission
     */
            $result = PDO_query('SELECT user_id FROM `'.$tablePrefix.'users`', false, false, $dbCredentials);
            foreach ($result as $row){
                extract($row);

                PDO_query('INSERT INTO `'.TABLE_PREFIX.'user_groups`(user_id, group_id, permissions) VALUES (:user_id, 1, "punch")', array('user_id' => $user_id));
//                $this->db->insert('user_groups', array('user_id' => $user_id, 'group_id' => 1, 'permissions' => 'punch'));
            }

    /*
     * User Groups
     */
            // Departments
            $oldDepartments = PDO_query('SELECT user_id, department_id FROM `'.$tablePrefix.'user_departments`', false, false, $dbCredentials);
            foreach ($oldDepartments as $department){
                extract($department);
                $data = array();

                $data['user_id'] = $user_id;
                $data['group_id'] = $department_id > 1 ? ($department_id + 32768) : 32766;
                PDO_query('INSERT INTO `'.TABLE_PREFIX.'user_groups` (user_id, group_id) VALUES (:user_id, :group_id)', $data);
//                $this->db->insert('user_groups', $data);
            }
        // Offices
            $oldOffices = PDO_query('SELECT user_id, office_id FROM `'.$tablePrefix.'user_offices`', false, false, $dbCredentials);
            foreach ($oldOffices as $office){
                extract($office);
                $data = array();

                $data['user_id'] = $user_id;
                $data['group_id'] = $office_id > 1 ? $office_id : 32766;
                PDO_query('INSERT INTO `'.TABLE_PREFIX.'user_groups` (user_id, group_id) VALUES (:user_id, :group_id)', $data);
//                $this->db->insert('user_groups', $data);
            }

    /*
     * Punches
     */
            $users = PDO_query('SELECT user_id FROM `'.$tablePrefix.'users`', false, false, $dbCredentials);
            $addedPunches = 0;
            foreach ($users as $user){
                $numPunches = PDO_query('SELECT COUNT(*) FROM `'.$tablePrefix.'punch_log` WHERE user_id = :userID', array('userID' => $user['user_id']), false, $dbCredentials);
                $numPunches = $numPunches[0]['COUNT(*)'];
                for ($i = 0; $i < $numPunches; $i += 100){
                    $params = array();
                    $params['userID'] = $user['user_id'];
                    $query = "SELECT punch_log_id, user_id, punch_id, punch_time, ip_address, user_notes, department_id, approved
                                FROM `".$tablePrefix."punch_log`
                                WHERE user_id = :userID
                                ORDER BY punch_time ASC
                                LIMIT $i, 101";
                    $oldPunches = PDO_query($query, $params, false, $dbCredentials);
                    $query = 'INSERT INTO `'.TABLE_PREFIX.'punches` (id, user_id, group_id, punch_type_id, next_punch_id, ip_address, date_time, notes, approved) VALUES ';
                    $values = array();
                    foreach ($oldPunches as $index => $punch){
                        if ($index != 100){
                            extract($punch);
                            $data = array();

                            $values[] = $id = $punch_log_id;
                            $values[] = $user_id = $user_id;
                            $values[] = $group_id = $department_id ? $department_id : 1;
                            $values[] = $punch_type_id = $punch_id;
                            $values[] = $next_punch_id = isset($oldPunches[$index + 1]['punch_log_id']) ? $oldPunches[$index + 1]['punch_log_id'] : NULL;
                            $values[] = $ip_address = $ip_address ? $ip_address : '';
                            $values[] = $date_time = $punch_time;
                            $values[] = $notes = $user_notes;
                            $values[] = $approved = $approved;

                            $query .= "(?, ?, ?, ?, ?, ?, ?, ?, ?),";

                            $addedPunches++;
                        }
                    }
                    $query = substr($query, 0, strlen($query) -1);
                    PDO_query($query, $values);
                }
            }

    /*
     * Permissions
     */
        // Offices
            $query = 'SELECT action_office_id, user_id, office_id, GROUP_CONCAT(DISTINCT allowed_action) AS allowed_actions
                        FROM `'.$tablePrefix.'action_offices`
                        LEFT JOIN `'.$tablePrefix.'actions` ON `'.$tablePrefix.'action_offices`.`action_id` = `'.$tablePrefix.'actions`.`action_id`
                        GROUP BY user_id';
            $officeActions = PDO_query($query, false, false, $dbCredentials);
            foreach ($officeActions as $action){
                extract($action);
                $actions = explode(',', $allowed_actions);

                if (in_array('admin application', $actions) OR in_array('admin user', $actions)){
                    PDO_query('UPDATE `'.TABLE_PREFIX.'users` SET sys_admin = 1 WHERE id = :user_id', array('user_id' => $user_id));
//                    $this->db->where('id', $user_id);
//                    $this->db->update('users', array('sys_admin' => 1));
                }
                if (in_array('admin time', $actions) OR in_array('approve time', $actions)){
                    PDO_query('UPDATE `'.TABLE_PREFIX.'user_groups` SET permissions = "editTime" WHERE group_id = :office_id', array('office_id' => $office_id == 1 ? 32767 : $office_id));
//                    $this->db->where('group_id', $office_id == 1 ? 32767 : $office_id);
//                    $this->db->update('user_groups', array('permissions' => 'editTime'));
                }
            }
        // Departments
            $query = 'SELECT action_department_id, user_id, department_id, GROUP_CONCAT(DISTINCT allowed_action) AS allowed_actions
                        FROM `'.$tablePrefix.'action_departments`
                        LEFT JOIN `'.$tablePrefix.'actions` ON `'.$tablePrefix.'action_departments`.`action_id` = `'.$tablePrefix.'actions`.`action_id`
                        GROUP BY user_id';
            $departmentActions = PDO_query($query, false, false, $dbCredentials);
            foreach ($departmentActions as $action){
                extract($action);
                $actions = explode(',', $allowed_actions);

                if (in_array('admin application', $actions) OR in_array('admin user', $actions)){
                    PDO_query('UPDATE users SET sys_admin = 1 WHERE id = :user_id', array('user_id' => $user_id));
//                    $this->db->where('id', $user_id);
//                    $this->db->update('users', array('sys_admin' => 1));
                }
                if (in_array('admin time', $actions) OR in_array('approve time', $actions)){
                    PDO_query('UPDATE `'.TABLE_PREFIX.'user_groups` SET permissions = "editTime" WHERE group_id = :department_id', array('department_id' => $department_id + 32768));
//                    $this->db->where('group_id', $department_id + 32768);
//                    $this->db->update('user_groups', array('permissions' => 'editTime'));
                }
            }
    /*
     * Punch Types
     */
            PDO_query('TRUNCATE `'.TABLE_PREFIX.'punch_types`');
            
            $oldPunchTypes = PDO_query('SELECT * FROM `'.$tablePrefix.'punch_statuses`', false, false, $dbCredentials);
            foreach ($oldPunchTypes as $type){
                extract($type);
                $data = array();
                $data['id'] = $punch_id;
                $data['status'] = $status_in;
                $data['name'] = $punch_status_name;
                $data['color'] = $colour;
                $data['enabled'] = $enabled;
                PDO_query('INSERT INTO `'.TABLE_PREFIX.'punch_types` (id, status, name, color, enabled) VALUES (:id, :status, :name, :color, :enabled)', $data);
//                $this->db->insert('punch_types', $data);
            }


            $addedUsers = number_format($addedUsers, 0);
            $output.= "<br />Added $addedUsers Users";
            $addedGroups = number_format($addedGroups, 0);
            $output.= "<br />Added $addedGroups Groups";
            $addedPunches = number_format($addedPunches, 0);
            $output.= "<br />Added $addedPunches Punches";
            $timeElapsed = number_format(microtime(true) - $timeStart, 4);
            $output.= "<br>DB Import ran in $timeElapsed";
            $_SESSION['import_success_message'] = $output;
    }

/********************************
 ********** Copy table **********
 ********************************/

    function copy_table($dbCredentials, $tableName, $tablePrefix){
        $addedRows = 0;
        $oldTable = PDO_query("SELECT * FROM `$tablePrefix"."$tableName`", false, false, $dbCredentials);

        foreach ($oldTable as $index => $tableRow){
            $query = "INSERT INTO `".TABLE_PREFIX."$tableName` (";
            $values = array();
            foreach ($tableRow as $index => $value){
                $values[] = $value;
                $query .= "`$index`,";
            }
            $query = substr($query, 0, strlen($query) - 1);
            $query .= ') VALUES ';

            $query .= '(';
            for ($i = 1; $i <= count($tableRow); $i++){
                $query .= "?,";
            }
            $query = substr($query, 0, strlen($query) - 1);
            $query .= ')';

            PDO_query($query, $values);

//            $this->db->insert($tableName, $data);

            $addedRows++;
        }
        return $addedRows;
    }

/********************************
 ******* Version 3 Import *******
 ********************************/
    function import_from_v3($dbCredentials, $tablePrefix){
/*
 * Users
 */
        $addedUsers = copy_table($dbCredentials, 'users', $tablePrefix);

/*
 * Groups
 */
        $addedGroups = copy_table($dbCredentials, 'groups', $tablePrefix);

/*
 * User Groups / Permissions
 */
        copy_table($dbCredentials, 'user_groups', $tablePrefix);

/*
 * Punch Types
 */
        PDO_query('TRUNCATE `'.TABLE_PREFIX.'punch_types`');
        copy_table($dbCredentials, 'punch_types', $tablePrefix);

/*
 * Punches
 */
        $users = PDO_query('SELECT id FROM `'.$tablePrefix.'users`', false, false, $dbCredentials);
        $addedPunches = 0;
        foreach ($users as $user){
            $numPunches = PDO_query('SELECT COUNT(*) FROM `'.$tablePrefix.'punches` WHERE user_id = :userID', array('userID' => $user['id']), false, $dbCredentials);
            $numPunches = $numPunches[0]['COUNT(*)'];
            for ($i = 0; $i < $numPunches; $i += 100){
                $params = array();
                $params['userID'] = $user['id'];
                $query = "SELECT id, user_id, group_id, punch_type_id, next_punch_id, ip_address, date_time, notes, approved, approved_by
                            FROM `".$tablePrefix."punches`
                            WHERE user_id = :userID
                            ORDER BY date_time ASC
                            LIMIT $i, 101";
                $oldPunches = PDO_query($query, $params, false, $dbCredentials);
                $query = 'INSERT INTO `'.TABLE_PREFIX.'punches` (id, user_id, group_id, punch_type_id, next_punch_id, ip_address, date_time, notes, approved, approved_by) VALUES ';
                $values = array();
                foreach ($oldPunches as $index => $punch){
                    if ($index != 100){
                        extract($punch);
                        $data = array();

                        $values[] = $id;
                        $values[] = $user_id ;
                        $values[] = $group_id;
                        $values[] = $punch_type_id;
                        $values[] = $next_punch_id;
                        $values[] = $ip_address;
                        $values[] = $date_time;
                        $values[] = $notes;
                        $values[] = $approved;
                        $values[] = $approved_by;

                        $query .= "(?, ?, ?, ?, ?, ?, ?, ?, ?, ?),";

                        $addedPunches++;
                    }
                }
                $query = substr($query, 0, strlen($query) -1);
                PDO_query($query, $values);
//                $this->db->query($query, $values);
            }
        }
/*
 * Tags
 */
        copy_table($dbCredentials, 'tags', $tablePrefix);

/*
 * Audits
 */
        copy_table($dbCredentials, 'audits', $tablePrefix);

/*
 * Config
 */
        $oldTable = PDO_query('SELECT * FROM `'.$tablePrefix.'config`', false, false, $dbCredentials);

        foreach ($oldTable as $index => $tableRow){
            extract($tableRow);
            PDO_query('UPDATE `'.TABLE_PREFIX.'config` SET `value` = :value WHERE `option` = :option', array('option' => $option, 'value' => $value));
        }
    }

    function create_admin($username, $password, $firstName, $lastName){
        $data = array();
        $data['username'] = strtolower($_POST['username']);
        $data['password'] = encrypt_password($_POST['password']);
        $data['firstName'] = $_POST['firstName'];
        $data['lastName'] = $_POST['lastName'];
        $data['email'] = $_POST['email'];
        $data['sysAdmin'] = 1;

        $userID = PDO_query('INSERT INTO `'.TABLE_PREFIX.'users` (username, password, first_name, last_name, email, sys_admin) VALUES (:username, :password, :firstName, :lastName, :email, :sysAdmin)', $data, true);
        PDO_query('INSERT INTO `'.TABLE_PREFIX.'groups` (id, parent_id, name) VALUES (1, 0, "All Users")');
        
        $data = array();
        $data['userID'] = $userID;
        $data['groupID'] = 1;
        PDO_query('INSERT INTO `'.TABLE_PREFIX.'user_groups` (user_id, group_id) VALUES (:userID, :groupID)', $data);
    }

?>
