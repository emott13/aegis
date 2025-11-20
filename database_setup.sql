CREATE DATABASE IF NOT EXISTS aegis;
USE aegis;

CREATE TABLE IF NOT EXISTS access_roles (
    role_id INT PRIMARY KEY AUTO_INCREMENT,
    role_name VARCHAR(20) NOT NULL,
    access_level INT
);

CREATE TABLE IF NOT EXISTS users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    fname VARCHAR(50) NOT NULL,
    lname VARCHAR(50) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    dob DATE NOT NULL,
    phone VARCHAR(10),
    approved BOOL,
    role_id INT NOT NULL,
    FOREIGN KEY (role_id)
        REFERENCES access_roles (role_id)
);

CREATE TABLE IF NOT EXISTS patients (
    patient_id INT PRIMARY KEY AUTO_INCREMENT,
    family_code VARCHAR(20),
    em_fname VARCHAR(50),
    em_lname VARCHAR(50),
    em_phone VARCHAR(10),
    em_relation VARCHAR(20),
    admission_date DATE NOT NULL,
    care_group ENUM('red', 'blue', 'green', 'yellow'),
    med_morn VARCHAR(50),
    med_noon VARCHAR(50),
    med_night VARCHAR(50),
    bill_amount INT DEFAULT 0,
    user_id INT NOT NULL,
    FOREIGN KEY (user_id)
        REFERENCES users (user_id)
);

CREATE TABLE IF NOT EXISTS employees (
    emp_id INT PRIMARY KEY AUTO_INCREMENT,
    hire_date DATE NOT NULL,
    salary INT,
    user_id INT NOT NULL,
    FOREIGN KEY (user_id)
        REFERENCES users (user_id)
);

CREATE TABLE IF NOT EXISTS cares (
    record_id INT PRIMARY KEY AUTO_INCREMENT,
    med_morn BOOL,
    med_noon BOOL,
    med_night BOOL,
    breakfast BOOL,
    lunch BOOL,
    dinner BOOL,
    care_date DATE NOT NULL,
    emp_id INT NOT NULL,
    patient_id INT NOT NULL,
    FOREIGN KEY (emp_id)
        REFERENCES employees (emp_id),
    FOREIGN KEY (patient_id)
        REFERENCES patients (patient_id)
);

CREATE TABLE IF NOT EXISTS appointments (
    appt_id INT PRIMARY KEY AUTO_INCREMENT,
    appt_date DATE NOT NULL,
    patient_id INT NOT NULL,
    doctor_id INT NOT NULL,
    appt_comment VARCHAR(255) NOT NULL,
    FOREIGN KEY (patient_id)
        REFERENCES patients (patient_id),
    FOREIGN KEY (doctor_id)
        REFERENCES employees (emp_id)
);

CREATE TABLE IF NOT EXISTS schedules (
    schedule_id INT PRIMARY KEY AUTO_INCREMENT,
    schedule_date DATE NOT NULL,
    made_by INT NOT NULL,
    doctor_id INT NOT NULL,
    supervisor_id INT NOT NULL,
    care_red INT NOT NULL,
    care_blue INT NOT NULL,
    care_green INT NOT NULL,
    care_yellow INT NOT NULL,
    FOREIGN KEY (made_by)
        REFERENCES employees (emp_id),
    FOREIGN KEY (doctor_id)
        REFERENCES employees (emp_id),
    FOREIGN KEY (supervisor_id)
        REFERENCES employees (emp_id),
    FOREIGN KEY (care_red)
        REFERENCES employees (emp_id),
    FOREIGN KEY (care_blue)
        REFERENCES employees (emp_id),
    FOREIGN KEY (care_green)
        REFERENCES employees (emp_id),
    FOREIGN KEY (care_yellow)
        REFERENCES employees (emp_id)
);
