ALTER TABLE `gni`.`artists`     CHANGE `desc` `descr` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;
ALTER TABLE `gni`.`curators`     CHANGE `desc` `descr` VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;
ALTER TABLE `gni`.`admins`     CHANGE `group` `role` VARCHAR(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT 'editor' NOT NULL;