-- question
DROP TABLE IF EXISTS wcf1_botcheck_question;
CREATE TABLE wcf1_botcheck_question (
	questionID INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	question VARCHAR(255) NOT NULL,
	answers TEXT NOT NULL
);

-- sample questions
INSERT INTO wcf1_botcheck_question (question, answers) VALUES ('2 + 2 = ?', '4');
