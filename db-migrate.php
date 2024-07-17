---------- Ins-profile page need to update saving data.
---------- Finance Item Month SETUP -------------------
---------- Profile Track table full replace korte hobe server er ta delete kore ....
---------- Whatsnew table full upload to server --------------------

**************************************************************************************************************

----------- notice table whole transfer (REPLACE) -------------------------------
----------- notice Category table whole transfer (REPLACE) -------------------------------
----------- teacher_salary_structure ---------------------------------

ALTER TABLE `banktrans` ADD `partid` INT NULL DEFAULT NULL AFTER `transtype`, ADD `particulareng` VARCHAR(200) NULL DEFAULT NULL AFTER `partid`, ADD `particularben` VARCHAR(200) NULL DEFAULT NULL AFTER `particulareng`;



INSERT INTO `financesetup` (`id`, `sccode`, `sessionyear`, `slno`, `particulareng`, `particularben`, `play`, `nursery`, `one`, `two`, `three`, `four`, `five`, `six`, `seven`, `eight`, `nine`, `ten`, `play_update`, `nursery_update`, `one_update`, `two_update`, `three_update`, `four_update`, `five_update`, `six_update`, `seven_update`, `eight_update`, `nine_update`, `ten_update`, `month`, `inexin`, `inexex`, `custom`, `last_update`, `need_update`, `validationtime`) VALUES
(5, 0, '', 0, 'Expenditures', 'ব্যয়সমূহ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 30, 30, 30, 30, 30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0, NULL, 1, '2024-01-01 00:00:00');
ALTER TABLE `refbook` ADD `slot` VARCHAR(20) NULL DEFAULT NULL AFTER `sccode`;
ALTER TABLE `financesetup` ADD `cheque` INT NOT NULL DEFAULT '0' COMMENT 'issue cheque on this category' AFTER `inexex`;
ALTER TABLE `salarydetails` ADD `govtcol3` FLOAT NOT NULL DEFAULT '0' AFTER `govtcol2`;
ALTER TABLE `salarydetails` ADD `schoolcol3` FLOAT NOT NULL DEFAULT '0' AFTER `schoolcol2`;
ALTER TABLE `salarydetails` ADD `refnogovtcol1` VARCHAR(20) NULL DEFAULT NULL AFTER `refnoextra`, ADD `refnogovtcol2` VARCHAR(20) NULL DEFAULT NULL AFTER `refnogovtcol1`, ADD `refnogovtcol3` VARCHAR(20) NULL DEFAULT NULL AFTER `refnogovtcol2`, ADD `refnoschoolcol1` VARCHAR(20) NULL DEFAULT NULL AFTER `refnogovtcol3`, ADD `refnoschoolcol2` VARCHAR(20) NULL DEFAULT NULL AFTER `refnoschoolcol1`, ADD `refnoschoolcol3` VARCHAR(20) NULL DEFAULT NULL AFTER `refnoschoolcol2`;


///////////////////////////////////////////////////
STFINANCE Scanning......

// Check Multiple Entry
SELECT stid, partid, particulareng, count(*) FROM `stfinance` WHERE sccode='103187' and sessionyear LIKE '2024%' group by stid, particulareng having count(*)>1 order by classname, sectionname, rollno;
// Check Existing PR in Multiple Entry?
// if not remove them.

update stfinance set idmon= CONCAT(stid, month) 
update stfinance set idmon= CONCAT(stid, '-', partid, '-', month) 


// Check

Search
SELECT * FROM stfinance WHERE `sessionyear` = 2024 AND `sccode` = 103187 AND partid=49 and classname !='Ten' order by pr1 desc;

Delete  FROM stfinance WHERE `sessionyear` = 2024 AND `sccode` = 103187 AND partid=49 and classname !='Ten' order by pr1 desc;




//////////////////////////////////////////////////////////////////////////////


Class Teacher/ Teacher / Principal Payment Option OK


update `salarydetails` set sccode='103188' WHERE `month` = 6;
UPDATE `salaryextracolumn` SET `sccode` = '103188' WHERE `salaryextracolumn`.`id` = 2;



31/12/2013 (bank)  5270966.03
31/01/2024 (bank)  5968430.03

