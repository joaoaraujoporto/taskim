CREATE DATABASE taskim_db;

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