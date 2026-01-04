-- Active: 1767324804942@@127.0.0.1@5432
-- database setup script for Aegis healthcare management system 
-- formatted for postgreSQL
-- BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY

CREATE SCHEMA IF NOT EXISTS aegis;
USE aegis;

CREATE TABLE IF NOT EXISTS access_roles (
    role_id     BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,                    -- unique role identifier
    role_name   VARCHAR(20) UNIQUE NOT NULL                                         -- name of the role (e.g., admin, doctor, nurse, supervisor, caregiver, patient)
    
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,                                -- timestamp of role creation
    updated_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP     -- timestamp of last role update
);


CREATE TABLE IF NOT EXISTS users (
    user_id     BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,                    -- unique user identifier   
    fname       VARCHAR(50) NOT NULL,                                               -- first name   
    lname       VARCHAR(50) NOT NULL,                                               -- last name
    email       VARCHAR(255) UNIQUE NOT NULL,                                       -- email address
    password    VARCHAR(255) NOT NULL,                                              -- hashed password
    phone       VARCHAR(15),                                                        -- phone number
    dob         DATE NOT NULL,                                                      -- date of birth
    approved    BOOLEAN NOT NULL DEFAULT false,                                     -- account approval status

    role_id     BIGINT NOT NULL REFERENCES access_roles(role_id),                   -- foreign key to access_roles table
    
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,                                -- timestamp of user creation
    updated_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP     -- timestamp of last user update
);

CREATE TABLE patients (
    patient_id      BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    user_id         BIGINT UNIQUE NOT NULL REFERENCES users(user_id),
    family_code     VARCHAR(20),
    admission_date  DATE NOT NULL,
    care_group      VARCHAR(10) CHECK (care_group IN ('red','blue','green','yellow')),
    bill_amount     INT DEFAULT 0
);
CREATE TABLE emergency_contacts (
    contact_id      BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    patient_id      BIGINT NOT NULL REFERENCES patients(patient_id),
    fname           VARCHAR(50),
    lname           VARCHAR(50),
    phone           VARCHAR(15),
    relation        VARCHAR(20)
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

    med_morn varchar(50),                               -- morning medications // assigned by doctor at appointment
    med_noon varchar(50),                               -- noon medications // assigned by doctor at appointment
    med_night varchar(50),                              -- night medications // assigned by doctor at appointment
    bill_amount int DEFAULT 0,                          -- total amount billed to patient // updated each day
    user_id int NOT NULL,                               -- foreign key to users
    FOREIGN KEY (user_id) REFERENCES users(user_id)     -- link to user info
);

CREATE TABLE IF NOT EXISTS employees (
    emp_id int PRIMARY KEY AUTO_INCREMENT,              -- unique employee identifier
    hire_date date NOT NULL,                            -- date of hire
    salary int,                                         -- salary of employee // adjusted by admin                       
    user_id 'fk_id' int NOT NULL,                       -- foreign key to users
    FOREIGN KEY (user_id) REFERENCES users(user_id),    -- link to user info
    UNIQUE (user_id)                                    -- ensure one-to-one relationship between users and employees
);

CREATE TABLE IF NOT EXISTS cares (
    record_id int PRIMARY KEY AUTO_INCREMENT,           -- unique care record identifier
    med_morn bool,                                      -- whether morning medication was given // set by care staff
    med_noon bool,                                      -- whether noon medication was given // set by care staff
    med_night bool,                                     -- whether night medication was given // set by care staff
    breakfast bool,                                     -- whether breakfast was given // set by care staff
    lunch bool,                                         -- whether lunch was given // set by care staff
    dinner bool,                                        -- whether dinner was given // set by care staff
    care_date date NOT NULL,                            -- date of care // record generated daily, can be updated by care staff until 11:59 PM. then only admin can update.
    emp_id int NOT NULL,                                -- foreign key to employees (care staff)
    patient_id int NOT NULL,                            -- foreign key to patients
    FOREIGN KEY (emp_id) REFERENCES employees(emp_id),              -- link to employee info
    FOREIGN KEY (patient_id) REFERENCES patients(patient_id)        -- link to patient info
);

CREATE TABLE IF NOT EXISTS appointments (
    appt_id int PRIMARY KEY AUTO_INCREMENT,                     -- unique appointment identifier // supervisor or doctor can set appointment
    appt_date date NOT NULL,                                    -- date of appointment
    patient_id int NOT NULL,                                    -- foreign key to patients // patient for whom the appointment is scheduled
    doctor_id int NOT NULL,                                     -- foreign key to employees (doctors) // doctor assigned to the appointment
    appt_comment varchar(255) NOT NULL,                         -- comments regarding the appointment
    FOREIGN KEY (patient_id) REFERENCES patients(patient_id),   -- link to patient info
    FOREIGN KEY (doctor_id) REFERENCES employees(emp_id)        -- link to doctor info
);

CREATE TABLE IF NOT EXISTS schedules (
    schedule_id int PRIMARY KEY AUTO_INCREMENT,                 -- unique schedule identifier
    schedule_date date NOT NULL,                                -- date of schedule
    made_by int NOT NULL,                                       -- employee who made the schedule

    -- Morning, Afternoon, Evening, Night shifts hours
    -- Morning: 6 AM - 12 PM
    -- Afternoon: 12 PM - 6 PM
    -- Evening: 6 PM - 12 AM
    -- Night: 12 AM - 6 AM

    morn_doctor_id int NOT NULL,                                     -- morning assigned doctor
    morn_supervisor_id int NOT NULL,                                 -- morning assigned supervisor
    morn_care_red int NOT NULL,                                      -- morning assigned care staff for red group
    morn_care_blue int NOT NULL,                                     -- morning assigned care staff for blue group
    morn_care_green int NOT NULL,                                    -- morning assigned care staff for green group
    morn_care_yellow int NOT NULL,                                   -- morning assigned care staff for yellow group

    aft_doctor_id int NOT NULL,                                     -- afternoon assigned doctor
    aft_supervisor_id int NOT NULL,                                 -- afternoon assigned supervisor
    aft_care_red int NOT NULL,                                      -- afternoon assigned care staff for red group
    aft_care_blue int NOT NULL,                                     -- afternoon assigned care staff for blue group
    aft_care_green int NOT NULL,                                    -- afternoon assigned care staff for green group
    aft_care_yellow int NOT NULL,                                   -- afternoon assigned care staff for yellow group

    eve_doctor_id int NOT NULL,                                     -- evening assigned doctor
    eve_supervisor_id int NOT NULL,                                 -- evening assigned supervisor
    eve_care_red int NOT NULL,                                      -- evening assigned care staff for red group
    eve_care_blue int NOT NULL,                                     -- evening assigned care staff for blue group
    eve_care_green int NOT NULL,                                    -- evening assigned care staff for green group
    eve_care_yellow int NOT NULL,                                   -- evening assigned care staff for yellow group

    night_doctor_id int NOT NULL,                                   -- night assigned doctor
    night_supervisor_id int NOT NULL,                               -- night assigned supervisor
    night_care_red int NOT NULL,                                    -- night assigned care staff for red group            
    night_care_blue int NOT NULL,                                   -- night assigned care staff for blue group
    night_care_green int NOT NULL,                                  -- night assigned care staff for green group
    night_care_yellow int NOT NULL,                                 -- night assigned care staff for yellow group


    FOREIGN KEY (made_by) REFERENCES employees(emp_id),         -- link to employee who made the schedule
    FOREIGN KEY (doctor_id) REFERENCES employees(emp_id),       -- link to assigned doctor
    FOREIGN KEY (supervisor_id) REFERENCES employees(emp_id),   -- link to assigned supervisor
    FOREIGN KEY (care_red) REFERENCES employees(emp_id),        -- link to assigned care staff for red group
    FOREIGN KEY (care_blue) REFERENCES employees(emp_id),       -- link to assigned care staff for blue group
    FOREIGN KEY (care_green) REFERENCES employees(emp_id),      -- link to assigned care staff for green group
    FOREIGN KEY (care_yellow) REFERENCES employees(emp_id)      -- link to assigned care staff for yellow group
);
