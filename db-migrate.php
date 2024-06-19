document.getElementById('defbtn').innerHTML = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    document.getElementById('defmenu').innerHTML = '';
    function defbtn() {
        goprint(0);
    }

Table : profile-track 
ALTER TABLE `financesetup` ADD `custom` INT NOT NULL DEFAULT '0' AFTER `inexex`;
ALTER TABLE `financeitem` ADD `sccode` INT NOT NULL DEFAULT '0' AFTER `expenditure`;
ALTER TABLE `financesetup` ADD `play_update` DATETIME NULL DEFAULT NULL AFTER `ten`, ADD `nursery_update` DATETIME NULL DEFAULT NULL AFTER `play_update`, ADD `one_update` DATETIME NULL DEFAULT NULL AFTER `nursery_update`, ADD `two_update` DATETIME NULL DEFAULT NULL AFTER `one_update`, ADD `three_update` DATETIME NULL DEFAULT NULL AFTER `two_update`, ADD `four_update` DATETIME NULL DEFAULT NULL AFTER `three_update`, ADD `five_update` DATETIME NULL DEFAULT NULL AFTER `four_update`, ADD `six_update` DATETIME NULL DEFAULT NULL AFTER `five_update`, ADD `seven_update` DATETIME NULL DEFAULT NULL AFTER `six_update`, ADD `eight_update` DATETIME NULL DEFAULT NULL AFTER `seven_update`, ADD `nine_update` DATETIME NULL DEFAULT NULL AFTER `eight_update`, ADD `ten_update` DATETIME NULL DEFAULT NULL AFTER `nine_update`;

ALTER TABLE `stfinance` ADD `last_update` DATE NULL DEFAULT NULL AFTER `extra`;
ALTER TABLE `sessioninfo` CHANGE `rate` `rate` INT(11) NOT NULL DEFAULT '100';
update sessioninfo set rate = 100;

ALTER TABLE `financesetup` ADD `last_update` DATETIME NULL DEFAULT NULL AFTER `custom`, ADD `need_update` INT NOT NULL DEFAULT '1' AFTER `last_update`;

---------- Finance Item Month SETUP -------------------
ALTER TABLE `financesetup` CHANGE `sessionyear` `sessionyear` VARCHAR(7) NOT NULL;
ALTER TABLE `sessioninfo` CHANGE `sessionyear` `sessionyear` VARCHAR(9) NOT NULL;




