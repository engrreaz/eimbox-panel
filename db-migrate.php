clublist 
my-club 

ALTER TABLE `stattnd` ADD `entrytime` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `entryby`;

ALTER TABLE `financeitem` ADD `payment` INT NOT NULL DEFAULT '1' AFTER `particularben`, ADD `income` INT NOT NULL DEFAULT '0' AFTER `payment`, ADD `expenditure` INT NOT NULL DEFAULT '0' AFTER `income`;

update financeitem set payment=0 where id>80;





coin

checkbox-marked-circle-outline

account









