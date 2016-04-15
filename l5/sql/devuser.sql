GRANT ALL PRIVILEGES ON myl5app.* to devadmin@localhost;
GRANT ALL ON myl5app.* to 'devadmin'@'127.0.0.1' identified by 'devadminRingo2#' WITH GRANT OPTION;
FLUSH PRIVILEGES;
--SHOW GRANTS FOR 'devadmin'@'localhost';
