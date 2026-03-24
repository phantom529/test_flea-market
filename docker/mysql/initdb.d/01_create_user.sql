CREATE DATABASE IF NOT EXISTS flea_market
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE USER IF NOT EXISTS 'flea_user'@'%' IDENTIFIED BY 'flea_pass';
GRANT ALL PRIVILEGES ON flea_market.* TO 'flea_user'@'%';
FLUSH PRIVILEGES;
