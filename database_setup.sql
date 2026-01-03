-- Active: 1767324804942@@127.0.0.1@5432
CREATE SCHEMA IF NOT EXISTS aegis;
USE aegis;

CREATE TABLE IF NOT EXISTS access_roles (
    role_id BIGINT PRIMARY KEY AUTO_INCREMENT,          -- unique role identifier
    role_name varchar(20) NOT NULL,                     -- name of the role (e.g., admin, doctor, nurse, patient, family)
);

CREATE TABLE IF NOT EXISTS users (
    user_id int PRIMARY KEY AUTO_INCREMENT,             -- unique user identifier   
    fname varchar(50) NOT NULL,                         -- first name
    lname varchar(50) NOT NULL,                         -- last name    
    email varchar(255) NOT NULL,                        -- email address
    password varchar(255) NOT NULL,                     -- hashed password  
    dob	date NOT NULL,                                  -- date of birth  
    phone varchar(10),                                  -- phone number
    approved bool,                                      -- whether the user has been approved by an admin
    role_id int NOT NULL,                               -- foreign key to access_roles
    FOREIGN KEY(role_id) REFERENCES access_roles(role_id)   -- link to role info
);

CREATE TABLE IF NOT EXISTS patients (
    patient_id int PRIMARY KEY AUTO_INCREMENT,          -- unique patient identifier
    family_code varchar(20),                            -- allows family member to access patient info
    em_fname varchar(50),                               -- emergency contact first name
    em_lname varchar(50),                               -- emergency contact last name
    em_phone varchar(10),                               -- emergency contact phone number
    em_relation varchar(20),                            -- relationship to patient
    admission_date date NOT NULL,                       -- date of admission to care facility
    care_group enum('red', 'blue', 'green', 'yellow'),  -- care group assignment
    med_morn varchar(50),                               -- morning medications
    med_noon varchar(50),                               -- noon medications
    med_night varchar(50),                              -- night medications
    bill_amount int DEFAULT 0,                          -- total amount billed to patient
    user_id int NOT NULL,                               -- foreign key to users
    FOREIGN KEY (user_id) REFERENCES users(user_id)     -- link to user info
);

CREATE TABLE IF NOT EXISTS employees (
    emp_id int PRIMARY KEY AUTO_INCREMENT,              -- unique employee identifier
    hire_date date NOT NULL,                            -- date of hire
    salary int,                                         -- salary of employee                       
    user_id 'fk_id' int NOT NULL,                       -- foreign key to users
    FOREIGN KEY (user_id) REFERENCES users(user_id),    -- link to user info
    CHECK (users.dob <= (CURRENT_DATE - INTERVAL '18' YEAR))    -- ensure employee is at least 18 years old
);

CREATE TABLE IF NOT EXISTS cares (
    record_id int PRIMARY KEY AUTO_INCREMENT,           -- unique care record identifier
    med_morn bool,                                      -- whether morning medication was given
    med_noon bool,                                      -- whether noon medication was given
    med_night bool,                                     -- whether night medication was given
    breakfast bool,                                     -- whether breakfast was given
    lunch bool,                                         -- whether lunch was given
    dinner bool,                                        -- whether dinner was given
    care_date date NOT NULL,                            -- date of care
    emp_id int NOT NULL,                                -- foreign key to employees
    patient_id int NOT NULL,                            -- foreign key to patients
    FOREIGN KEY (emp_id) REFERENCES employees(emp_id),              -- link to employee info
    FOREIGN KEY (patient_id) REFERENCES patients(patient_id)        -- link to patient info
);

CREATE TABLE IF NOT EXISTS appointments (
    appt_id int PRIMARY KEY AUTO_INCREMENT,                     -- unique appointment identifier
    appt_date date NOT NULL,                                    -- date of appointment
    patient_id int NOT NULL,                                    -- foreign key to patients
    doctor_id int NOT NULL,                                     -- foreign key to employees (doctors)
    appt_comment varchar(255) NOT NULL,                         -- comments regarding the appointment
    FOREIGN KEY (patient_id) REFERENCES patients(patient_id),   -- link to patient info
    FOREIGN KEY (doctor_id) REFERENCES employees(emp_id)        -- link to doctor info
);

CREATE TABLE IF NOT EXISTS schedules (
    schedule_id int PRIMARY KEY AUTO_INCREMENT,                 -- unique schedule identifier
    schedule_date date NOT NULL,                                -- date of schedule
    made_by int NOT NULL,                                       -- employee who made the schedule
    doctor_id int NOT NULL,                                     -- assigned doctor
    supervisor_id int NOT NULL,                                 -- assigned supervisor
    care_red int NOT NULL,                                      -- assigned care staff for red group
    care_blue int NOT NULL,                                     -- assigned care staff for blue group
    care_green int NOT NULL,                                    -- assigned care staff for green group
    care_yellow int NOT NULL,                                   -- assigned care staff for yellow group
    FOREIGN KEY (made_by) REFERENCES employees(emp_id),         -- link to employee who made the schedule
    FOREIGN KEY (doctor_id) REFERENCES employees(emp_id),       -- link to assigned doctor
    FOREIGN KEY (supervisor_id) REFERENCES employees(emp_id),   -- link to assigned supervisor
    FOREIGN KEY (care_red) REFERENCES employees(emp_id),        -- link to assigned care staff for red group
    FOREIGN KEY (care_blue) REFERENCES employees(emp_id),       -- link to assigned care staff for blue group
    FOREIGN KEY (care_green) REFERENCES employees(emp_id),      -- link to assigned care staff for green group
    FOREIGN KEY (care_yellow) REFERENCES employees(emp_id)      -- link to assigned care staff for yellow group
);
