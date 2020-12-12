# create extra databases
CREATE DATABASE IF NOT EXISTS `lumen_test`;

# grant rights
GRANT ALL PRIVILEGES ON *.* TO 'andre'@'%';