\u gateway1_tas;
#CREATE USER 'tasuser'@'localhost' IDENTIFIED BY 'tasuser123';
create database gateway1_tas;
CREATE USER 'gateway1_tasuser'@'localhost' IDENTIFIED BY 'tasuser123';
grant all on gateway1_tas.* to 'gateway1_tasuser'@'localhost';
CREATE TABLE TASUSER (ID int(9) NOT NULL auto_increment, `DATESTAMP` DATE, `TIME` VARCHAR(8), `IP` VARCHAR(15), `BROWSER` TINYTEXT, `USERNAME` VARCHAR(255), PRIMARY KEY (id))
--2017.05.24_TAS.NEW_0.1.001
CREATE TABLE STATS (STAT_TYPE VARCHAR(10) NOT NULL, `DATESTAMP` DATE, `TIME` VARCHAR(8), `IP` VARCHAR(15), `BROWSER` TINYTEXT, `DESCRIPTION` VARCHAR(50), `ACTUAL` FLOAT, BALANCE FLOAT, TARGET FLOAT, PRIMARY KEY (STAT_TYPE))
----2017.05.25
CREATE TABLE OPERATIONS	(OPERATION_ID int(9) NOT NULL auto_increment, STAT_TYPE	VARCHAR(10) NOT NULL, `DATESTAMP` DATE, `TIME` VARCHAR(8), `IP` VARCHAR(15), `BROWSER` TINYTEXT, `YEAR` SMALLINT, QUARTER SMALLINT, PROVINCE VARCHAR(2), QTY SMALLINT, PRIMARY KEY (OPERATION_ID))
CREATE TABLE PROGRAMS(PROGRAM_ID int(9) NOT NULL auto_increment, STAT_TYPE VARCHAR(10) NOT NULL, `DATESTAMP` DATE, `TIME` VARCHAR(8), `IP` VARCHAR(15), `BROWSER` TINYTEXT, `YEAR` SMALLINT, QUARTER SMALLINT, PROVINCE VARCHAR(2), QTY SMALLINT, QTY_PCT FLOAT, BUDGET FLOAT, PRIMARY KEY (PROGRAM_ID))
CREATE TABLE STAT_TYPES(STAT_TYPE VARCHAR(10) NOT NULL, `DATESTAMP` DATE, `TIME` VARCHAR(8), `IP` VARCHAR(15), `BROWSER` TINYTEXT, `DESCRIPTION` VARCHAR(50), PRIMARY KEY (STAT_TYPE))
--CREATE TABLE PROG_CODES(PROG_CODE VARCHAR(10) NOT NULL, `DATESTAMP` DATE, `TIME` VARCHAR(8), `IP` VARCHAR(15), `BROWSER` TINYTEXT, `DESCRIPTION` VARCHAR(50), PRIMARY KEY (PROG_CODE))
--CREATE TABLE OBJECTIVE_CODES(OBJECTIVE_CODE VARCHAR(10) NOT NULL, `DATESTAMP` DATE, `TIME` VARCHAR(8), `IP` VARCHAR(15), `BROWSER` TINYTEXT, `DESCRIPTION` VARCHAR(50), PRIMARY KEY (OBJECTIVE_CODE))
--CREATE VIEW ORGANISATIONALPROGRESS AS
--SELECT "TAS" AS 'Programme/ Dept', p.YEAR, DESCRIPTION 'KPI', p.QTY 'TARGET', o.QTY 'ACTUAL', (1- (o.QTY / p.QTY))*100 'VARIANCE (%)'
--FROM STAT_TYPES s 
--JOIN PROGRAMS p ON s.STAT_TYPE = p.STAT_TYPE AND p.QUARTER=1 
--JOIN OPERATIONS o ON s.STAT_TYPE = o.STAT_TYPE AND o.QUARTER=1
----2017.05.26_TAS.NEW_0.02.001
CREATE VIEW ORGANISATIONALPROGRESS AS
SELECT "TAS" AS 'Programme/ Dept', IFNULL(IFNULL(p.YEAR,o.YEAR), 0) 'YEAR', DESCRIPTION 'KPI', IFNULL(FORMAT(AVG(p.QTY), 0), 0) 'TARGET', IFNULL(FORMAT(AVG(o.QTY), 0), 0) 'ACTUAL', 
	IFNULL(FORMAT((1- (o.QTY / p.QTY))*100, 2), 0) 'VARIANCE (%)', FORMAT((IFNULL(AVG(p.QTY), 0) - IFNULL(AVG(o.QTY), 0)), 0) 'BALANCE', 
	CASE (1- (o.QTY / p.QTY))*100 WHEN 0 THEN 'YES' ELSE 'NO' END AS 'OBJECTIVE MET?', s.STAT_TYPE	
FROM STAT_TYPES s 
LEFT JOIN PROGRAMS p ON s.STAT_TYPE = p.STAT_TYPE  
LEFT JOIN OPERATIONS o ON s.STAT_TYPE = o.STAT_TYPE
GROUP BY p.YEAR,o.YEAR,DESCRIPTION
----2017.05.27
CREATE TABLE PROVINCES(PROV_CODE VARCHAR(10) NOT NULL, `DATESTAMP` DATE, `TIME` VARCHAR(8), `IP` VARCHAR(15), `BROWSER` TINYTEXT, `DESCRIPTION` VARCHAR(50), PRIMARY KEY (PROV_CODE))

