CREATE TABLE IF NOT EXISTS pw_category (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, name VARCHAR(50) UNIQUE);
CREATE TABLE IF NOT EXISTS pw_user (id INT AUTO_INCREMENT PRIMARY KEY, login VARCHAR(30) UNIQUE, password VARCHAR(32), role INT);