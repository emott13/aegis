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
    role_id int NOT NULL,
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
    med_morn varchar(50),
    med_noon varchar(50),
    med_night varchar(50),
    bill_amount int DEFAULT 0,
    user_id int NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

CREATE TABLE IF NOT EXISTS employees (
    emp_id int PRIMARY KEY AUTO_INCREMENT,
    hire_date date NOT NULL,
    salary int,
    user_id int NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

CREATE TABLE IF NOT EXISTS cares (
    record_id int PRIMARY KEY AUTO_INCREMENT,
    med_morn bool,
    med_noon bool,
    med_night bool,
    breakfast bool,
    lunch bool,
    dinner bool,
    care_date date NOT NULL,
    emp_id int NOT NULL,
    patient_id int NOT NULL,
    FOREIGN KEY (emp_id) REFERENCES employees(emp_id),
    FOREIGN KEY (patient_id) REFERENCES patients(patient_id)
);

CREATE TABLE IF NOT EXISTS appointments (
    appt_id int PRIMARY KEY AUTO_INCREMENT,
    appt_date date NOT NULL,
    patient_id int NOT NULL,
    doctor_id int NOT NULL,
    appt_comment varchar(255) NOT NULL,
    FOREIGN KEY (patient_id) REFERENCES patients(patient_id),
    FOREIGN KEY (doctor_id) REFERENCES employees(emp_id)
);

CREATE TABLE IF NOT EXISTS schedules (
    schedule_id int PRIMARY KEY AUTO_INCREMENT,
    schedule_date date NOT NULL,
    made_by int NOT NULL,
    doctor_id int NOT NULL,
    supervisor_id int NOT NULL,
    care_red int NOT NULL,
    care_blue int NOT NULL,
    care_green int NOT NULL,
    care_yellow int NOT NULL,
    FOREIGN KEY (made_by) REFERENCES employees(emp_id),
    FOREIGN KEY (doctor_id) REFERENCES employees(emp_id),
    FOREIGN KEY (supervisor_id) REFERENCES employees(emp_id),
    FOREIGN KEY (care_red) REFERENCES employees(emp_id),
    FOREIGN KEY (care_blue) REFERENCES employees(emp_id),
    FOREIGN KEY (care_green) REFERENCES employees(emp_id),
    FOREIGN KEY (care_yellow) REFERENCES employees(emp_id)
);
