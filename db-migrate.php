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

We, the undersigned members of the Audit Committee, audited the income and expenditure accounts of Dhaka High School for the month of January (from 01-01-2024 to 31-01-2024) on 07/01/2024. Thoroughly audited all income sections and expenditure vouchers including receipts and found correct. All accounts and financial status are listed below.