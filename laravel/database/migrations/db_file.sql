-- Active: 1767324804942@@127.0.0.1@5432
-- List all tables in the current schema

CREATE SCHEMA IF NOT EXISTS aegis;

CREATE TABLE IF NOT EXISTS access_roles (
    role_id         BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,                    -- unique role identifier
    role_name       VARCHAR(20) UNIQUE NOT NULL,                                        -- name of the role (e.g., admin, doctor, nurse, supervisor, caregiver, patient)

    created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP                                -- timestamp of role creation
    -- updated_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP     -- timestamp of last role update
);


CREATE TABLE IF NOT EXISTS users (
    user_id         BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,                    -- unique user identifier   
    fname           VARCHAR(50) NOT NULL,                                               -- first name   
    lname           VARCHAR(50) NOT NULL,                                               -- last name
    email           VARCHAR(255) UNIQUE NOT NULL,                                       -- email address
    password        VARCHAR(255) NOT NULL,                                              -- hashed password
    phone           VARCHAR(15),                                                        -- phone number
    dob             DATE NOT NULL,                                                      -- date of birth
    approved        BOOLEAN NOT NULL DEFAULT false,                                     -- account approval status

    role_id         BIGINT NOT NULL REFERENCES access_roles(role_id),                   -- foreign key to access_roles table
    
    created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP                                -- timestamp of user creation
    -- updated_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP     -- timestamp of last user update
);

CREATE TABLE IF NOT EXISTS patients (
    patient_id      BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,                    -- unique patient identifier
    family_code     VARCHAR(20),                                                        -- allows family member to access patient info   
    -- Emergency contact details moved to separate table --
    -- can be null because admin/supervisor updates after user registration is approved.
    care_group      VARCHAR(10) CHECK (care_group IN ('red','blue','green','yellow')),  -- care group assignment
    admission_date  DATE,                                                               -- date of admission to care facility
    bill_amount     INT DEFAULT 0,                                                      -- total amount billed to patient // updated each day
    
    user_id         BIGINT UNIQUE NOT NULL REFERENCES users(user_id),                   -- foreign key to users table

    created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP                                -- timestamp of patient record creation
    -- updated_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP     -- timestamp of last patient record update
);
CREATE TABLE IF NOT EXISTS emergency_contacts (
    em_id      BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,                    -- unique contact identifier
    em_fname        VARCHAR(50),                                                        -- first name
    em_lname        VARCHAR(50),                                                        -- last name
    em_phone        VARCHAR(15),                                                        -- phone number
    relation        VARCHAR(20),                                                        -- emergency contact relationship to patient

    patient_id      BIGINT NOT NULL REFERENCES patients(patient_id),                    -- foreign key to patients table

    created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP                                 -- timestamp of contact creation
    -- updated_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,    -- timestamp of last contact update
);

-- CREATE TABLE IF NOT EXISTS patients (
--     patient_id      int PRIMARY KEY AUTO_INCREMENT,                                  -- unique patient identifier

--     family_code     varchar(20),                                                     -- allows family member to access patient info

--     em_fname        varchar(50),                                                     -- emergency contact first name
--     em_lname        varchar(50),                                                     -- emergency contact last name
--     em_phone        varchar(10),                                                     -- emergency contact phone number
--     em_relation     varchar(20),                                                     -- relationship to patient

--     admission_date  date NOT NULL,                                                   -- date of admission to care facility
--     care_group      enum('red', 'blue', 'green', 'yellow'),                          -- care group assignment

--     med_morn        varchar(50),                                                     -- morning medications   // assigned by doctor at appointment
--     med_noon        varchar(50),                                                     -- noon medications      // assigned by doctor at appointment
--     med_even        varchar(50),                                                     -- evening medications   // assigned by doctor at appointment
--     med_night       varchar(50),                                                     -- night medications      // assigned by doctor at appointment
--     bill_amount     int DEFAULT 0,                                                   -- total amount billed to patient // updated each day
--     user_id         int NOT NULL,                                                    -- foreign key to users
--     FOREIGN KEY (user_id) REFERENCES users(user_id)                                  -- link to user info
-- );

CREATE TABLE IF NOT EXISTS employees (
    emp_id          BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,                    -- unique employee identifier
    hire_date       DATE NOT NULL,                                                      -- date of hire
    salary          INT,                                                                -- employee salary

    user_id         BIGINT UNIQUE NOT NULL REFERENCES users(user_id),                   -- foreign key to users table
    
    created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP                                 -- timestamp of employee record creation
    -- updated_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP     -- timestamp of last employee
);

CREATE TABLE IF NOT EXISTS cares (
    record_id       BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,                    -- unique care record identifier    
    care_date       DATE NOT NULL,                                                      -- date of care provided

    med_morn        BOOLEAN DEFAULT false,                                              -- morning medication given
    med_noon        BOOLEAN DEFAULT false,                                              -- noon medication given
    med_even        BOOLEAN DEFAULT false,                                              -- evening medication given
    med_night       BOOLEAN DEFAULT false,                                              -- night medication given
    breakfast       BOOLEAN DEFAULT false,                                              -- breakfast provided
    lunch           BOOLEAN DEFAULT false,                                              -- lunch provided
    dinner          BOOLEAN DEFAULT false,                                              -- dinner provided

    patient_id      BIGINT NOT NULL REFERENCES patients(patient_id),                    -- foreign key to patients table
    emp_id          BIGINT NOT NULL REFERENCES employees(emp_id),                       -- foreign key to employees table (caregiver who provided care)

    created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP,                                -- timestamp of care record creation
    -- updated_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,    -- timestamp of last care record update

    UNIQUE (patient_id, care_date)                                                      -- ensure one care record per patient per day   
);


CREATE TABLE IF NOT EXISTS appointments (
    appt_id         BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,                    -- unique appointment identifier
    appt_date       DATE NOT NULL,                                                      -- date of appointment
    appt_time       TIME NOT NULL,                                                      -- time of appointment
    appt_comment    VARCHAR(255),                                                       -- comments or notes for the appointment

    patient_id      BIGINT NOT NULL REFERENCES patients(patient_id),                    -- foreign key to patients table
    doctor_id       BIGINT NOT NULL REFERENCES employees(emp_id),                       -- foreign key to employees table (doctor) 
    
    created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP,                                 -- timestamp of appointment creation
    -- updated_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,    -- timestamp of last appointment
    
    UNIQUE (doctor_id, appt_date, appt_time)                                            -- ensure no double-booking for doctors
);

CREATE TABLE IF NOT EXISTS schedules (
    schedule_id     BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,                    -- unique schedule identifier
    schedule_date   DATE NOT NULL,                                                      -- date of schedule

    created_by      BIGINT NOT NULL REFERENCES users(user_id),                          -- user who made the schedule

    created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP                                 -- timestamp of schedule creation
    -- updated_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,    -- timestamp of last schedule update
);    

-- seperated assignments into its own table for flexibility --
CREATE TABLE IF NOT EXISTS schedule_assignments (
    assignment_id   BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,                    -- unique assignment identifier
    shift           VARCHAR(10) CHECK (shift IN ('morn','noon','eve','night')),         -- type of shift
    -- role            VARCHAR(20) CHECK (role IN ('doctor','supervisor','caregiver')),    -- role assigned for the shift
    care_group      VARCHAR(10) CHECK (care_group IN ('red','blue','green','yellow')),  -- care group for caregiver role
    
    schedule_id     BIGINT NOT NULL REFERENCES schedules(schedule_id),                  -- foreign key to schedules
    emp_id          BIGINT NOT NULL REFERENCES employees(emp_id),                       -- foreign key to employees

    created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP,                                 -- timestamp of assignment creation
    -- updated_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,    -- timestamp of last assignment update

    UNIQUE (shift, emp_id)
);

CREATE INDEX idx_users_role ON users(role_id);
CREATE INDEX idx_patients_group ON patients(care_group);
CREATE INDEX idx_assignments_emp ON schedule_assignments(emp_id);
