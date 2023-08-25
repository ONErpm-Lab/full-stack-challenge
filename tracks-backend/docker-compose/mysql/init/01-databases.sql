# create databases
CREATE DATABASE IF NOT EXISTS `tracks`;

CREATE DATABASE IF NOT EXISTS `tracks_testing`;

# create user and grant rights
CREATE USER 'tracksonerpm'@'db' IDENTIFIED BY 'tr4cks0n3rpm';
GRANT ALL PRIVILEGES ON *.* TO 'tracksonerpm'@'%';

