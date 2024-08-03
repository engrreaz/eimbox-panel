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