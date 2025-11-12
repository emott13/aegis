CREATE SCHEMA IF NOT EXISTS aegis;
USE aegis;

CREATE TABLE IF NOT EXISTS access_roles (
    role_id int PRIMARY KEY AUTO_INCREMENT,
    role_name varchar(20) NOT NULL,
    access_level int
);

CREATE TABLE IF NOT EXISTS users (
    user_id int PRIMARY KEY AUTO_INCREMENT,
    fname varchar(50) NOT NULL,
    lname varchar(50) NOT NULL,
    email varchar(255) NOT NULL,
    password varchar(255) NOT NULL,
    dob	date NOT NULL,
    phone varchar(10),
    approved bool,
    role_id int,
    FOREIGN KEY(role_id) REFERENCES access_roles(role_id)
);

CREATE TABLE IF NOT EXISTS patients (
    patient_id int PRIMARY KEY AUTO_INCREMENT,
    family_code varchar(20),
    em_fname varchar(50),
    em_lname varchar(50),
    em_phone varchar(10),
    em_relation varchar(20),
    admission_date date NOT NULL,
    care_group enum('red', 'blue', 'green', 'yellow'),
    user_id int,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);
