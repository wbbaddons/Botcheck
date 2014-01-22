ALTER TABLE wcf1_botcheck_question ADD failed INT(10) NOT NULL DEFAULT 0;
ALTER TABLE wcf1_botcheck_question ADD succeeded INT(10) NOT NULL DEFAULT 0;

ALTER TABLE wcf1_botcheck_question ADD INDEX failed (failed);
ALTER TABLE wcf1_botcheck_question ADD INDEX succeeded (succeeded);
