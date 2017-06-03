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
----2017.05.27_TAS.NEW_0.03.001
CREATE TABLE PROVINCES(PROV_CODE VARCHAR(10) NOT NULL, `DATESTAMP` DATE, `TIME` VARCHAR(8), `IP` VARCHAR(15), `BROWSER` TINYTEXT, `DESCRIPTION` VARCHAR(50), PRIMARY KEY (PROV_CODE))
CREATE VIEW ORGANISATIONALPROGRESS AS
SELECT "TAS" AS 'Programme/ Dept', IFNULL(IFNULL(p.YEAR,o.YEAR), 0) 'YEAR', DESCRIPTION 'KPI', IFNULL(FORMAT(AVG(p.QTY), 0), 0) 'TARGET', IFNULL(FORMAT(SUM(o.QTY), 0), 0) 'ACTUAL', 
	IFNULL(FORMAT((1- (SUM(o.QTY) / p.QTY))*100, 2), 0) 'VARIANCE (%)', FORMAT((IFNULL(AVG(p.QTY), 0) - IFNULL(SUM(o.QTY), 0)), 0) 'BALANCE', 
	CASE (1- (o.QTY / p.QTY))*100 WHEN 0 THEN 'YES' ELSE 'NO' END AS 'OBJECTIVE MET?', s.STAT_TYPE	
FROM STAT_TYPES s 
LEFT JOIN PROGRAMS p ON s.STAT_TYPE = p.STAT_TYPE 
LEFT JOIN OPERATIONS o ON s.STAT_TYPE = o.STAT_TYPE
GROUP BY p.YEAR,o.YEAR,DESCRIPTION
----2017.05.28
CREATE VIEW ORGPROGRESSFILTERERD AS
SELECT "TAS" AS 'Programme/ Dept', IFNULL(IFNULL(p.YEAR,o.YEAR), 0) 'YEAR', DESCRIPTION 'KPI', IFNULL(FORMAT(AVG(p.QTY), 0), 0) 'TARGET', IFNULL(FORMAT(SUM(o.QTY), 0), 0) 'ACTUAL', p.PROVINCE 'Prog_Prov', o.PROVINCE 'Ops_Prov', p.QUARTER 'PROG_QUARTER', o.QUARTER 'OPS_QUARTER',
	IFNULL(FORMAT((1- (SUM(o.QTY) / p.QTY))*100, 2), 0) 'VARIANCE (%)', FORMAT((IFNULL(AVG(p.QTY), 0) - IFNULL(SUM(o.QTY), 0)), 0) 'BALANCE', 
	CASE (1- (o.QTY / p.QTY))*100 WHEN 0 THEN 'YES' ELSE 'NO' END AS 'OBJECTIVE MET?', s.STAT_TYPE	
FROM STAT_TYPES s 
LEFT JOIN PROGRAMS p ON s.STAT_TYPE = p.STAT_TYPE 
LEFT JOIN OPERATIONS o ON s.STAT_TYPE = o.STAT_TYPE
GROUP BY p.YEAR,o.YEAR,DESCRIPTION,p.PROVINCE,o.PROVINCE,p.QUARTER,o.QUARTER
----2017.05.30
CREATE TABLE BUDGETS(BUDGET_ID int(9) NOT NULL auto_increment, `DATESTAMP` DATE, `TIME` VARCHAR(8), `IP` VARCHAR(15), `BROWSER` TINYTEXT, `YEAR` SMALLINT, QUARTER SMALLINT, PROVINCE VARCHAR(2), QTY SMALLINT, QTY_PCT FLOAT, BUDGET FLOAT, PRIMARY KEY (BUDGET_ID))
----2017.05.31_TAS.NEW_0.04.001
ALTER TABLE PROGRAMS ADD COLUMN BUDGET_ID int(9) NOT NULL;
CREATE VIEW ORGANISATIONALPROGRESS AS
SELECT "TAS" AS 'Programme/ Dept', IFNULL(IFNULL(p.YEAR,o.YEAR), 0) 'YEAR', DESCRIPTION 'KPI', IFNULL(FORMAT(SUM(b.QTY), 0), 0) 'TARGET', IFNULL(FORMAT(SUM(o.QTY), 0), 0) 'ACTUAL', 
	IFNULL(FORMAT((1- (SUM(o.QTY) / SUM(b.QTY)))*100, 2), 0) 'VARIANCE (%)', FORMAT((IFNULL(SUM(b.QTY), 0) - IFNULL(SUM(o.QTY), 0)), 0) 'BALANCE', o.OPERATION_ID, 
	CASE (1- (o.QTY / b.QTY))*100 WHEN 0 THEN 'YES' ELSE 'NO' END AS 'OBJECTIVE MET?', s.STAT_TYPE
FROM STAT_TYPES s 
LEFT JOIN PROGRAMS p ON s.STAT_TYPE = p.STAT_TYPE 
LEFT JOIN OPERATIONS o ON s.STAT_TYPE = o.STAT_TYPE
LEFT JOIN BUDGETS b ON b.BUDGET_ID = p.BUDGET_ID
GROUP BY p.YEAR,o.YEAR,DESCRIPTION, o.OPERATION_ID;
CREATE VIEW ORGPROGRESSFILTERERD AS
SELECT "TAS" AS 'Programme/ Dept', IFNULL(IFNULL(p.YEAR,o.YEAR), 0) 'YEAR', DESCRIPTION 'KPI', IFNULL(FORMAT(SUM(b.QTY), 0), 0) 'TARGET', IFNULL(FORMAT(SUM(o.QTY), 0), 0) 'ACTUAL', p.PROVINCE 'Prog_Prov', o.PROVINCE 'Ops_Prov', p.QUARTER 'PROG_QUARTER', o.QUARTER 'OPS_QUARTER', o.OPERATION_ID,
	IFNULL(FORMAT((1- (SUM(o.QTY) / SUM(b.QTY)))*100, 2), 0) 'VARIANCE (%)', FORMAT((IFNULL(SUM(b.QTY), 0) - IFNULL(SUM(o.QTY), 0)), 0) 'BALANCE', 
	CASE (1- (o.QTY / p.QTY))*100 WHEN 0 THEN 'YES' ELSE 'NO' END AS 'OBJECTIVE MET?', s.STAT_TYPE	
FROM STAT_TYPES s 
LEFT JOIN PROGRAMS p ON s.STAT_TYPE = p.STAT_TYPE 
LEFT JOIN OPERATIONS o ON s.STAT_TYPE = o.STAT_TYPE
LEFT JOIN BUDGETS b ON b.BUDGET_ID = p.BUDGET_ID
GROUP BY p.YEAR,o.YEAR,DESCRIPTION,p.PROVINCE,o.PROVINCE,p.QUARTER,o.QUARTER,o.OPERATION_ID
----2017.06.03_TAS.NEW_0.05.001
CREATE VIEW ORGANISATIONALPROGRESS AS
SELECT "TAS" AS 'Programme/ Dept', IFNULL(IFNULL(p.YEAR,o.YEAR), 0) 'YEAR', DESCRIPTION 'KPI', IFNULL(FORMAT(SUM(b.QTY), 0), 0) 'TARGET', IFNULL(FORMAT(SUM(o.QTY), 0), 0) 'ACTUAL', 
	IFNULL(FORMAT((1- (SUM(o.QTY) / SUM(b.QTY)))*100, 2), 0) 'VARIANCE (%)', FORMAT((IFNULL(SUM(b.QTY), 0) - IFNULL(SUM(o.QTY), 0)), 0) 'BALANCE', 
	CASE (1- (o.QTY / b.QTY))*100 WHEN 0 THEN 'YES' ELSE 'NO' END AS 'OBJECTIVE MET?', s.STAT_TYPE
FROM STAT_TYPES s 
LEFT JOIN PROGRAMS p ON s.STAT_TYPE = p.STAT_TYPE 
LEFT JOIN OPERATIONS o ON s.STAT_TYPE = o.STAT_TYPE
LEFT JOIN BUDGETS b ON b.BUDGET_ID = p.BUDGET_ID
GROUP BY p.YEAR,o.YEAR,DESCRIPTION;
CREATE VIEW ORGPROGRESSDETAILED AS
SELECT "TAS" AS 'Programme/ Dept', IFNULL(IFNULL(p.YEAR,o.YEAR), 0) 'YEAR', v.DESCRIPTION 'PROVINCE', p.QUARTER, s.STAT_TYPE, s.DESCRIPTION, IFNULL(FORMAT(SUM(b.QTY), 0), 0) 'TARGET', IFNULL(FORMAT(SUM(o.QTY), 0), 0) 'ACTUAL', 
	IFNULL(FORMAT((1- (SUM(o.QTY) / SUM(b.QTY)))*100, 2), 0) 'VARIANCE (%)', FORMAT((IFNULL(SUM(b.QTY), 0) - IFNULL(SUM(o.QTY), 0)), 0) 'BALANCE',
	CASE (1- (o.QTY / b.QTY))*100 WHEN 0 THEN 'YES' ELSE 'NO' END AS 'OBJECTIVE MET?'
FROM STAT_TYPES s 
JOIN PROGRAMS p ON s.STAT_TYPE = p.STAT_TYPE 
JOIN OPERATIONS o ON s.STAT_TYPE = o.STAT_TYPE
JOIN BUDGETS b ON b.BUDGET_ID = p.BUDGET_ID
JOIN PROVINCES v ON p.PROVINCE = v.PROV_CODE
GROUP BY p.YEAR,o.YEAR, p.PROVINCE, p.QUARTER, s.STAT_TYPE, s.DESCRIPTION
ORDER BY p.YEAR,o.YEAR, p.PROVINCE, p.QUARTER, s.STAT_TYPE, s.DESCRIPTION;







