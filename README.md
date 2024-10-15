// install php and mysql
$ sudo apt update
$ sudo add-apt-repository ppa:ondrej/php
$ sudo apt install php8.3 php8.3-mysql php8.3-mbstring php8.3-intl
$ sudo apt install mysql-server -y
$ sudo mysql_secure_installation

// install & configure ngrok
$ curl -sSL https://ngrok-agent.s3.amazonaws.com/ngrok.asc \
	| sudo tee /etc/apt/trusted.gpg.d/ngrok.asc >/dev/null \
	&& echo "deb https://ngrok-agent.s3.amazonaws.com buster main" \
	| sudo tee /etc/apt/sources.list.d/ngrok.list \
	&& sudo apt update \
	&& sudo apt install ngrok
$ ngrok config add-authtoken <my_auth_token>

// setup database for project
$ sudo mysql
mysql> CREATE TABLE forcolin;
mysql> CREATE USER 'colin'@'localhost' IDENTIFIED BY 'password';
mysql> FLUSH PRIVILEGES;
mysql> CREATE TABLE users (id INT AUTO_INCREMENT PRIMARY KEY, username varchar(60) NOT NULL, password varchar(255) NOT NULL, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);
mysql> INSERT INTO users (username, password) VALUES ('colin', 'password');
mysql> EXIT;

// code stuff

// git init and commit, push
$ git init
$ git add README.md
$ git commit -m "first commit"
$ git branch -M main
$ git remote add origin https://github.com/erincz44/OG-login-forcolin.git
$ git push -u origin main

// development server
$ php -S localhost:8000

// ngrok proxy for public demo
$ ngrok http http://localhost:8000