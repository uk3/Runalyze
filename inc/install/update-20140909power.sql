ALTER TABLE  `runalyze_training` ADD  `arr_powerdistribution` LONGTEXT NULL DEFAULT NULL AFTER  `arr_power`;
ALTER TABLE  `runalyze_training` ADD  `normalizedpower` INT NOT NULL DEFAULT 0 AFTER  `power`;
ALTER TABLE  `runalyze_training` ADD  `vipower` FLOAT NULL DEFAULT NULL AFTER  `normalizedpower`;
ALTER TABLE  `runalyze_training` ADD  `isvirtualpower` BOOL NOT NULL DEFAULT 0 AFTER  `power`;
