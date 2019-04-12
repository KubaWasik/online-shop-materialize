DROP TABLE IF EXISTS `users`;
CREATE TABLE users
(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    login VARCHAR(50) NOT NULL,
    passwd VARCHAR(100) NOT NULL,
    name VARCHAR(30),
    surname VARCHAR(50),
    email VARCHAR(50),
    address VARCHAR(100),
    phone int(9)
);

-- login: Admin, password: admin (sha256)
insert into users(login, passwd, email) values('Admin','8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'admin@mail.com');
