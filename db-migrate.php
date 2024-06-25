Ins-profile page need to update saving data.

*******************************************************************************
---------- Finance Item Month SETUP -------------------
---------------------------------------------------------------------------------------------------------------
Profile Track table full replace korte hobe server er ta delete kore ....
Full table transfer (user-level)
ALTER TABLE `teacher` ADD `nid` VARCHAR(17) NULL DEFAULT NULL AFTER `mobile`;
ALTER TABLE `teacher` ADD `bgroup` VARCHAR(5) NULL DEFAULT NULL AFTER `nid`;
ALTER TABLE `teacher` ADD `spouse` VARCHAR(100) NULL DEFAULT NULL AFTER `mname`, ADD `emergency` INT(11) NULL DEFAULT NULL AFTER `spouse`;
ALTER TABLE `teacher` ADD `previll` VARCHAR(100) NULL DEFAULT NULL AFTER `preadd`, ADD `prepo` VARCHAR(100) NULL DEFAULT NULL AFTER `previll`, ADD `preps` VARCHAR(100) NULL DEFAULT NULL AFTER `prepo`, ADD `predist` VARCHAR(100) NULL DEFAULT NULL AFTER `preps`, ADD `pervill` VARCHAR(100) NULL DEFAULT NULL AFTER `predist`, ADD `perpo` VARCHAR(100) NULL DEFAULT NULL AFTER `pervill`, ADD `perps` VARCHAR(100) NULL DEFAULT NULL AFTER `perpo`, ADD `perdist` VARCHAR(100) NULL DEFAULT NULL AFTER `perps`;
ALTER TABLE `teacher` CHANGE `emergency` `emergency` VARCHAR(11) NULL DEFAULT NULL;

------------------- Whatsnew table full upload to server --------------------

ALTER TABLE `usersapp` ADD `whatsnew_last_id` INT NOT NULL DEFAULT '0' AFTER `admin`;

