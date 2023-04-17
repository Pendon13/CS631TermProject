/*ALTER TABLE Vehicle
    DROP CONSTRAINT cust_owns_vehicle;
ALTER TABLE Employee
    DROP CONSTRAINT employee_works_at_location;
ALTER TABLE Manager
    DROP CONSTRAINT emp_is_manager;
ALTER TABLE Technician
    DROP CONSTRAINT emp_is_technician;
ALTER TABLE TechnicianHasSkill
    DROP CONSTRAINT tech_has_skill;
ALTER TABLE TechnicianHasSkill
    DROP CONSTRAINT skill_for_tech;
ALTER TABLE ServicesOffered
    DROP CONSTRAINT service_requires_skill;
ALTER TABLE PartUsedInService
    DROP CONSTRAINT part_use_in_service;
ALTER TABLE PartUsedInService
    DROP CONSTRAINT service_has_id;
ALTER TABLE Inventory
    DROP CONSTRAINT part_in_inventory;
ALTER TABLE Inventory
    DROP CONSTRAINT inventory_location;
ALTER TABLE Appointment
    DROP CONSTRAINT loc_of_service;
ALTER TABLE Appointment
    DROP CONSTRAINT cust_makes_appt;
ALTER TABLE Appointment
    DROP CONSTRAINT vin_in_service;
ALTER TABLE InvoiceDetails
    DROP CONSTRAINT appointment_in_detail;
ALTER TABLE InvoiceDetails
    DROP CONSTRAINT location_in_detail;
ALTER TABLE InvoiceDetails
    DROP CONSTRAINT invoice_in_detail;
DROP TABLE Customer;
DROP TABLE Vehicle;
DROP TABLE BusinessLocation;
DROP TABLE Employee;
DROP TABLE Manager;
DROP TABLE Technician;
DROP TABLE Skill;
DROP TABLE TechnicianHasSkill;
DROP TABLE Part;
DROP TABLE ServicesOffered;
DROP TABLE PartUsedInService;
DROP TABLE Inventory;
DROP TABLE Appointment;
DROP TABLE Invoice;
DROP TABLE InvoiceDetails;
*/
CREATE TABLE Customer (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    fname VARCHAR(30) NOT NULL,
    minit CHAR(1),
    lname VARCHAR(30) NOT NULL,
    haddress VARCHAR(100) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    creditcard VARCHAR(20) NOT NULL,
    email VARCHAR(50)
);
CREATE TABLE Vehicle (
    vin VARCHAR(20) NOT NULL,
    cust_id INT(6) UNSIGNED NOT NULL,
    model VARCHAR(30) NOT NULL,
    make_year INT(4) NOT NULL,
    color VARCHAR(15) NOT NULL,
    vehicle_type VARCHAR(20) NOT NULL,
    manufacturer VARCHAR(20) NOT NULL,
    PRIMARY KEY (vin),
    CONSTRAINT cust_owns_vehicle FOREIGN KEY (cust_id) REFERENCES Customer(id)
);
CREATE TABLE BusinessLocation (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    loc_address VARCHAR(100) NOT NULL
);
CREATE TABLE Employee (
    ssn CHAR(9) PRIMARY KEY,
    loc_id INT(6) UNSIGNED NOT NULL,
    fname VARCHAR(30) NOT NULL,
    minit CHAR(1),
    lname VARCHAR(30) NOT NULL,
    haddress VARCHAR(100) NOT NULL,
    hire_date DATE NOT NULL,
    CONSTRAINT employee_works_at_location FOREIGN KEY (loc_id) REFERENCES BusinessLocation(id)
);
CREATE TABLE Manager (
    emp_ssn CHAR(9) PRIMARY KEY,
    salary int(7) NOT NULL,
    CONSTRAINT emp_is_manager FOREIGN KEY (emp_ssn) REFERENCES Employee(ssn)
);
CREATE TABLE Technician (
    emp_ssn CHAR(9) PRIMARY KEY,
    hourly_rate FLOAT(7) NOT NULL,
    CONSTRAINT emp_is_technician FOREIGN KEY (emp_ssn) REFERENCES Employee(ssn)
);
CREATE TABLE Skill (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    skill_name VARCHAR(20) NOT NULL
);
CREATE TABLE TechnicianHasSkill (
    tech_ssn CHAR(9) NOT NULL,
    skill_id INT(6) UNSIGNED NOT NULL,
    PRIMARY KEY (tech_ssn, skill_id),
    CONSTRAINT tech_has_skill FOREIGN KEY (tech_ssn) REFERENCES Technician(emp_ssn),
    CONSTRAINT skill_for_tech FOREIGN KEY (skill_id) REFERENCES Skill(id)
);
CREATE TABLE ServicesOffered (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    svc_type VARCHAR(25) NOT NULL,
    vehicle_type VARCHAR(25) NOT NULL,
    skill_id INT(6) UNSIGNED NOT NULL,
    price FLOAT(7) NOT NULL,
    CONSTRAINT service_requires_skill FOREIGN KEY (skill_id) REFERENCES Skill(id)
);
CREATE TABLE Part (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    part_name VARCHAR(20) NOT NULL,
    price FLOAT(7) NOT NULL
);
CREATE TABLE PartUsedInService (
    part_id INT(6) UNSIGNED NOT NULL,
    service_id INT(6) UNSIGNED NOT NULL,
    PRIMARY KEY (part_id, service_id),
    CONSTRAINT part_use_in_service FOREIGN KEY (part_id) REFERENCES Part(id),
    CONSTRAINT service_has_id FOREIGN KEY (service_id) REFERENCES ServicesOffered(id)
);
CREATE TABLE Inventory (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    quantity INT(6) NOT NULL,
    part_id INT(6) UNSIGNED NOT NULL,
    loc_id INT(6) UNSIGNED NOT NULL,
    CONSTRAINT part_in_inventory FOREIGN KEY (part_id) REFERENCES Part(id),
    CONSTRAINT inventory_location FOREIGN KEY (loc_id) REFERENCES BusinessLocation(id)
);
CREATE TABLE Appointment (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    appt_date DATE NOT NULL,
    loc_id INT(6) UNSIGNED NOT NULL,
    cust_id INT(6) UNSIGNED NOT NULL,
    vin VARCHAR(20) NOT NULL,
    CONSTRAINT loc_of_service FOREIGN KEY (loc_id) REFERENCES BusinessLocation(id),
    CONSTRAINT cust_makes_appt FOREIGN KEY (cust_id) REFERENCES Customer(id),
    CONSTRAINT vin_in_service FOREIGN KEY (vin) REFERENCES Vehicle(vin)
);
CREATE TABLE Invoice (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    amount INT(6) NOT NULL,
    date_paid DATE
);
CREATE TABLE InvoiceDetails (
    appt_id INT(6) UNSIGNED NOT NULL,
    loc_id INT(6) UNSIGNED NOT NULL,
    invoice_id INT(6) UNSIGNED NOT NULL,
    price FLOAT(7) NOT NULL,
    PRIMARY KEY (appt_id, loc_id, invoice_id),
    CONSTRAINT appointment_in_detail FOREIGN KEY (appt_id) REFERENCES Appointment(id),
    CONSTRAINT location_in_detail FOREIGN KEY (loc_id) REFERENCES BusinessLocation(id),
    CONSTRAINT invoice_in_detail FOREIGN KEY (invoice_id) REFERENCES Invoice(id)
);