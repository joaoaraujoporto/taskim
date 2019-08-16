CREATE DATABASE taskim_db;

SELECT * FROM user;
DELETE FROM user;

SET SQL_SAFE_UPDATES = 0;

CREATE TABLE seq_task (id INT NOT NULL);
INSERT INTO seq_task VALUES (0);

UPDATE seq_task SET id=LAST_INSERT_ID(id+1);
SELECT LAST_INSERT_ID();

CREATE TABLE seq_user (id INT NOT NULL);
INSERT INTO seq_user VALUES (0);

UPDATE seq_user SET id=LAST_INSERT_ID(id+1);
SELECT LAST_INSERT_ID();

INSERT INTO user (id_user, name, email, password) VALUES (0, "joao", "joaov.aporto@dia.com", "123");

INSERT INTO user (name, email, password) VALUES ("João", "joaov.aporto@exe.com", "$2y$10$Dx16zj50dw56n3GWvVSKRe2pDGp6l4k.vSWmHNNmV2UtBNzG1i4ua");

ALTER TABLE user CHANGE COLUMN email email VARCHAR(50) NOT NULL UNIQUE;
ALTER TABLE user CHANGE COLUMN password password VARCHAR(100) NOT NULL;
ALTER TABLE task CHANGE COLUMN last_play last_play TIMESTAMP NULL DEFAULT NULL;

DELETE FROM user;

USE taskim_db;

CREATE TABLE user
(
	id_user INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL,
    PRIMARY KEY (id_user)
);

CREATE TABLE task
(
	id_task INT UNSIGNED NOT NULL AUTO_INCREMENT,
    id_user INT UNSIGNED NOT NULL,
    scheduled_time FLOAT NOT NULL,
    spent_time FLOAT NOT NULL DEFAULT '0',
    done TINYINT NOT NULL DEFAULT '0',
    working TINYINT NOT NULL DEFAULT '0',
    deadline TIMESTAMP NOT NULL,
    last_play TIMESTAMP NOT NULL,
    PRIMARY KEY (id_task),
    CONSTRAINT fk_task_user FOREIGN KEY(id_user) REFERENCES user(id_user)
);