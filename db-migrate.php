Table : profile-track 

ALTER TABLE `students` ADD `bgroup` VARCHAR(3) NULL DEFAULT NULL AFTER `gender`;
ALTER TABLE `students` ADD `disable` VARCHAR(20) NULL DEFAULT NULL AFTER `bgroup`, ADD `height` INT NULL DEFAULT NULL AFTER `disable`, ADD `weight` INT NULL DEFAULT NULL AFTER `height`;
ALTER TABLE `students` ADD `guarnid` VARCHAR(17) NULL DEFAULT NULL AFTER `guarmobile`;













