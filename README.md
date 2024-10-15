$ sudo apt update
$ sudo add-apt-repository ppa:ondrej/php
$ sudo apt install php8.3 php8.3-mysql php8.3-mbstring php8.3-intl
$ sudo apt install mysql-server -y
$ sudo mysql_secure_installation
$ sudo mysql

mysql> CREATE TABLE forcolin;
mysql> CREATE USER 'colin'@'localhost' IDENTIFIED BY 'password';
mysql> FLUSH PRIVILEGES;
mysql> CREATE TABLE users (id INT AUTO_INCREMENT PRIMARY KEY, username varchar(60) NOT NULL, password varchar(255) NOT NULL, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);
mysql> INSERT INTO users (username, password) VALUES ('colin', 'password');
mysql> EXIT;

// code stuff

$ php -S localhost:8000