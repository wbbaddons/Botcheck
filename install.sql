-- question
DROP TABLE IF EXISTS wcf1_botquestion;
	CREATE TABLE wcf1_botquestion (
	questionID INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	question VARCHAR(255) NOT NULL,
	answers TEXT NOT NULL
);
