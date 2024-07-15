---------- Ins-profile page need to update saving data.
---------- Finance Item Month SETUP -------------------
---------- Profile Track table full replace korte hobe server er ta delete kore ....
---------- Whatsnew table full upload to server --------------------

**************************************************************************************************************

----------- notice table whole transfer (REPLACE) -------------------------------
----------- notice Category table whole transfer (REPLACE) -------------------------------
----------- teacher_salary_structure ---------------------------------






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

