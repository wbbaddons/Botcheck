-- question
DROP TABLE IF EXISTS wcf1_botcheck_question;
CREATE TABLE wcf1_botcheck_question (
	questionID INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	question VARCHAR(255) NOT NULL,
	answers TEXT NOT NULL,
	regex TINYINT(1) NOT NULL DEFAULT 0
);

-- sample questions
INSERT INTO wcf1_botcheck_question (question, answers) VALUES ('1 + 1 = ?', '2');
INSERT INTO wcf1_botcheck_question (question, answers) VALUES ('2 + 2 = ?', '4');
INSERT INTO wcf1_botcheck_question (question, answers) VALUES ('3 + 3 = ?', '6');
