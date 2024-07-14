---------- Ins-profile page need to update saving data.
---------- Finance Item Month SETUP -------------------
---------- Profile Track table full replace korte hobe server er ta delete kore ....
---------- Whatsnew table full upload to server --------------------

**************************************************************************************************************

----------- notice table whole transfer (REPLACE) -------------------------------
----------- notice Category table whole transfer (REPLACE) -------------------------------
----------- teacher_salary_structure ---------------------------------

ALTER TABLE `financeitem` ADD `icon` VARCHAR(50) NULL DEFAULT NULL AFTER `sccode`;
ALTER TABLE `salarydetails` ADD `edit_lock` INT NOT NULL DEFAULT '0' AFTER `entrytime`;

ALTER TABLE `salaryextracolumn` ADD `govt3title` VARCHAR(50) NULL DEFAULT NULL AFTER `govt2value`, ADD `govt3type` VARCHAR(20) NULL DEFAULT NULL AFTER `govt3title`, ADD `govt3value` INT NOT NULL DEFAULT '0' AFTER `govt3type`;
ALTER TABLE `salaryextracolumn` ADD `school3title` VARCHAR(50) NULL DEFAULT NULL AFTER `school2value`, ADD `school3type` VARCHAR(20) NULL DEFAULT NULL AFTER `school3title`, ADD `school3value` INT NOT NULL DEFAULT '0' AFTER `school3type`;
ALTER TABLE `salaryextracolumn` ADD `govt1pool` VARCHAR(20) NULL DEFAULT NULL AFTER `school3value`, ADD `govt2pool` VARCHAR(20) NULL DEFAULT NULL AFTER `govt1pool`, ADD `govt3pool` VARCHAR(20) NULL DEFAULT NULL AFTER `govt2pool`, ADD `school1pool` VARCHAR(20) NULL DEFAULT NULL AFTER `govt3pool`, ADD `school2pool` VARCHAR(20) NULL DEFAULT NULL AFTER `school1pool`, ADD `school3pool` VARCHAR(20) NULL DEFAULT NULL AFTER `school2pool`, ADD `govt1chq` INT NOT NULL DEFAULT '0' AFTER `school3pool`, ADD `govt2chq` INT NOT NULL DEFAULT '0' AFTER `govt1chq`, ADD `govt3chq` INT NOT NULL DEFAULT '0' AFTER `govt2chq`, ADD `school1chq` INT NOT NULL DEFAULT '0' AFTER `govt3chq`, ADD `school2chq` INT NOT NULL DEFAULT '0' AFTER `school1chq`, ADD `school3chq` INT NOT NULL DEFAULT '0' AFTER `school2chq`;
ALTER TABLE `salaryextracolumn` ADD `govt1desc` VARCHAR(120) NULL DEFAULT NULL AFTER `school3chq`, ADD `govt2desc` VARCHAR(120) NULL DEFAULT NULL AFTER `govt1desc`, ADD `govt3desc` VARCHAR(120) NULL DEFAULT NULL AFTER `govt2desc`, ADD `school1desc` VARCHAR(120) NULL DEFAULT NULL AFTER `govt3desc`, ADD `school2desc` VARCHAR(120) NULL DEFAULT NULL AFTER `school1desc`, ADD `school3desc` VARCHAR(120) NULL DEFAULT NULL AFTER `school2desc`;






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
