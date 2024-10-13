---------- Ins-profile page need to update saving data.
---------- Finance Item Month SETUP -------------------
---------- Profile Track table full replace korte hobe server er ta delete kore ....
---------- Whatsnew table full upload to server --------------------
-------------- all account number in all table length change to 20 character --------------------------
**************************************************************************************************************


///////////////////////////////////////////////////
STFINANCE Scanning......

// Check Multiple Entry
SELECT stid, partid, particulareng, count(*) FROM `stfinance` WHERE sccode='103187' and sessionyear LIKE '2024%' group by stid, particulareng having count(*)>1 order by classname, sectionname, rollno;
// Check Existing PR in Multiple Entry?
// if not remove them.

update stfinance set idmon= CONCAT(stid, month) 
update stfinance set idmon= CONCAT(stid, '-', partid, '-', month) 


//////////////////////////////////////////////////////////////////////////////


Class Teacher/ Teacher / Principal Payment Option OK

audit temp  table whole transfer (structure) SCHEMA 



INSERT INTO `sessioninfo` 
(`id`, `stid`, `sessionyear`, `classname`, `sectionname`, `rollno`, `sccode`, `icardst`, `fourth_subject`, `voter_no`, `groupname`, `status`, `gender`, `religion`, `finsetup`, `lastpr`, `real_tution`, `sector`, `rate`, `amount`, `trackyesterday`, `tracktoday`, `validate`, `validationtime`) 
VALUES 
(NULL, '1031872294', '2024', 'Eleven', 'Science', '241001', '103187', '0', '0', NULL, NULL, '1', NULL, NULL, '0', NULL, '0', NULL, '100', '0', NULL, NULL, '0', '2024-01-01 00:00:00')


GEMOINI API  AIzaSyBGK4pYmqLk1CGCjuOztXLtV4CUcLyaZOc








******************************************************************************
ALTER TABLE `scinfo` ADD `backup` INT NOT NULL DEFAULT '0' AFTER `self_control`, ADD `algorithm` VARCHAR(20) NULL DEFAULT NULL AFTER `backup`, ADD `secret_key` VARCHAR(50) NULL DEFAULT NULL AFTER `algorithm`, ADD `api_key` VARCHAR(50) NULL DEFAULT NULL AFTER `secret_key`, ADD `backup_mail_2` VARCHAR(100) NULL DEFAULT NULL AFTER `api_key`, ADD `backup_mail_3` VARCHAR(100) NULL DEFAULT NULL AFTER `backup_mail_2`, ADD `daily_backup` INT NOT NULL DEFAULT '0' AFTER `backup_mail_3`, ADD `monthly_backup` INT NOT NULL DEFAULT '0' AFTER `daily_backup`, ADD `cloud_storage` INT NOT NULL DEFAULT '0' AFTER `monthly_backup`;
ALTER TABLE `scinfo` ADD `last_backup_time` DATETIME NULL DEFAULT NULL AFTER `cloud_storage`;
RENAME TABLE `eimbox`.`my-club` TO `eimbox`.`my_club`;
ALTER TABLE `admission` ADD `modifieddate` DATETIME NULL DEFAULT NULL AFTER `admtime`;
ALTER TABLE `areas` ADD `sccode` INT NULL DEFAULT NULL AFTER `entrytime`, ADD `modifieddate` DATETIME NULL DEFAULT NULL AFTER `sccode`;
ALTER TABLE `backup_info` ADD `modifieddate` DATETIME NULL DEFAULT NULL AFTER `deletion_time`;
ALTER TABLE `bankinfo` ADD `modifieddate` DATETIME NULL DEFAULT NULL AFTER `status`;
ALTER TABLE `banklist` ADD `modifieddate` DATETIME NULL DEFAULT NULL AFTER `bname`;
ALTER TABLE `banktrans` ADD `modifieddate` DATETIME NULL DEFAULT NULL AFTER `verifytime`;
ALTER TABLE `branchlist` ADD `modifieddate` DATETIME NULL DEFAULT NULL AFTER `brdisp`;

SCCODE check kora hoy ni (ager gula)

ALTER TABLE `calendar` ADD `modifieddate` DATETIME NULL DEFAULT NULL AFTER `dateto`;
ALTER TABLE `cashbook` ADD `modifieddate` DATETIME NULL DEFAULT NULL AFTER `status`;
ALTER TABLE `classroutine` ADD `modifieddate` DATETIME NULL DEFAULT NULL AFTER `periodtimeend`;
ALTER TABLE `classschedule` ADD `modifieddate` DATETIME NULL DEFAULT NULL AFTER `duration`;
ALTER TABLE `clsroutine` ADD `modifieddate` DATETIME NULL DEFAULT NULL AFTER `entryby`;
ALTER TABLE `committee` ADD `modifieddate` DATETIME NULL DEFAULT NULL AFTER `entrytime`;
ALTER TABLE `examlist` ADD `modifieddate` DATETIME NULL DEFAULT NULL AFTER `status`;
ALTER TABLE `examroutine` ADD `modifieddate` DATETIME NULL DEFAULT CURRENT_TIMESTAMP AFTER `subj`;
ALTER TABLE `financesetup` ADD `modifieddate` DATETIME NULL DEFAULT NULL AFTER `validationtime`;
ALTER TABLE `logbook` ADD `modifieddate` DATETIME NULL DEFAULT NULL AFTER `entrytime`;
ALTER TABLE `markmodify` ADD `modifieddate` DATETIME NULL DEFAULT NULL AFTER `dtprocess`;
ALTER TABLE `my_club` ADD `modifieddate` DATETIME NULL DEFAULT NULL AFTER `entryby`;
ALTER TABLE `notice` ADD `modifieddate` DATETIME NULL DEFAULT NULL AFTER `entrytime`;
ALTER TABLE `payroll_track` ADD `modifieddate` DATETIME NULL DEFAULT NULL AFTER `modifytime`;
ALTER TABLE `permissions_role` ADD `modifieddate` DATETIME NULL DEFAULT NULL AFTER `sccode`;
ALTER TABLE `permissions_user` ADD `modifieddate` DATETIME NULL DEFAULT NULL AFTER `issuetime`;
ALTER TABLE `refbook` ADD `modifieddate` DATETIME NULL DEFAULT NULL AFTER `entrytime`;
ALTER TABLE `ref_docs` ADD `modifieddate` DATETIME NULL DEFAULT NULL AFTER `entrytime`;
ALTER TABLE `salarydetails` ADD `modifieddate` DATETIME NULL DEFAULT NULL AFTER `edit_lock`;
ALTER TABLE `salaryextracolumn` ADD `modifieddate` DATETIME NULL DEFAULT NULL AFTER `entrytime`;
ALTER TABLE `salarysummery` ADD `modifieddate` DATETIME NULL DEFAULT NULL AFTER `status`;
ALTER TABLE `sessioninfo` ADD `modifieddate` DATETIME NULL DEFAULT NULL AFTER `validationtime`;
ALTER TABLE `sms` ADD `modifieddate` DATETIME NULL DEFAULT NULL AFTER `cnt`;
ALTER TABLE `stattnd` ADD `modifieddate` DATETIME NULL DEFAULT NULL AFTER `mobileno`;
ALTER TABLE `stattndsummery` ADD `modifieddate` DATETIME NULL DEFAULT NULL AFTER `submittime`;
ALTER TABLE `stmark` ADD `modifieddate` DATETIME NULL DEFAULT NULL AFTER `entryby`;
ALTER TABLE `stpr` ADD `modifieddate` DATETIME NULL DEFAULT NULL AFTER `cashbook`;
ALTER TABLE `sttracking` ADD `modifieddate` DATETIME NULL DEFAULT NULL AFTER `distance`;
ALTER TABLE `students` ADD `modifieddate` DATETIME NULL DEFAULT NULL AFTER `gla`;
ALTER TABLE `subjects` ADD `modifieddate` DATETIME NULL DEFAULT NULL AFTER `fourth`;
ALTER TABLE `subjectsettinglist` ADD `modifieddate` DATETIME NULL DEFAULT NULL AFTER `entrycnt`;
ALTER TABLE `subsetup` ADD `modifieddate` DATETIME NULL DEFAULT NULL AFTER `donetime2`;
ALTER TABLE `tabulatingsheet` ADD `modifieddate` DATETIME NULL DEFAULT NULL AFTER `failsub`;
ALTER TABLE `tcert` ADD `modifieddate` DATETIME NULL DEFAULT NULL AFTER `refno`;
ALTER TABLE `teacher` ADD `modifieddate` DATETIME NULL DEFAULT NULL AFTER `net2`;
ALTER TABLE `teacherattnd` ADD `modifieddate` DATETIME NULL DEFAULT NULL AFTER `entrytime`;
ALTER TABLE `teacher_salary_structure` ADD `modifieddate` DATETIME NULL DEFAULT NULL AFTER `net2`;
ALTER TABLE `testimonial` ADD `modifieddate` DATETIME NULL DEFAULT NULL AFTER `issuetime`;
ALTER TABLE `todolist` ADD `modifieddate` DATETIME NULL DEFAULT NULL AFTER `responsetime`;
ALTER TABLE `transaction` ADD `modifieddate` DATETIME NULL DEFAULT NULL AFTER `bankaccid`;
ALTER TABLE `transaction_tracker` ADD `modifieddate` DATETIME NULL DEFAULT NULL AFTER `entrytime`;


The Tech Lexicon
A Modern Comprehensive Handbook to Tech Terminology for Professionals 













------------------ backup info -------------------- table structure
------------------ backup module -------------------- table structure